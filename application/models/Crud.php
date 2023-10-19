<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Model
{
    public function get_data($table, $clause=[],$ordre=null,$limit=null)
	{ 
        $this->db->order_by($ordre);
		$this->db->limit($limit);
        $this->db->where($clause);
        return $this->db->get($table)->result();
	}
	
	public function get_data_desc($table,$clause=[],$limit=null)
	{
		$this->db->order_by('id','DESC');
        $this->db->limit($limit);
        $this->db->where($clause);
        return $this->db->get($table)->result();
	}

	public function add_data($table, $data){
		$this->db->insert($table, $data);
	}

	public function delete_data($table, $clause)
	{
		$this->db->where($clause);
		$this->db->delete($table);
	}

	public function update_data($table, $clause, $data)
	{
		$this->db->where($clause);
		$this->db->update($table, $data);
	}

    public function join_data($table,$table2,$join,$order,$sens,$clause=[],$limit=null)
    {
        $this->db->select("*,".$table.'.id as id')
                 ->from($table)
                 ->join($table2,$join)
                 ->order_by($order,$sens)
                 ->limit($limit)
                 ->where($clause);

        return $this->db->get()->result();
    }

	//join account and student

	public function join_account_student($option_id)
	{
		$this->db->select("*, account.id as id, student.id as id_student")
				 ->from('account')
				 ->join('student','account.student_id = student.id')
				 ->order_by('account.id','DESC')
				 ->where(['role'=>'student','student.option_id'=>$option_id]);
		
		return $this->db->get()->result();
	}

	//join account, student, option, grade

	public function join_student_account_option_grade($student_id=null)
	{
		$this->db->select("*, account.id as id, student.id as id_student, option.id as id_option, grade.id as id_grade")
				 ->from('account')
				 ->join('student','account.student_id = student.id')
				 ->join('option','student.option_id = option.id')
				 ->join('grade','option.grade_id = grade.id')
				 ->order_by('account.id','DESC')
				 ->where(['role'=>'student']);
		
				 if($student_id != null)
				 {
					$this->db->where(['account.id'=>$student_id]);
				 }
		
		return $this->db->get()->result();
	}

	
	//join request, books and user

	public function join_reading_book_account($status=null,$request_id=null,$book_id=null,$limit=null,$account_id=null)
	{

		$this->db->select("*, reading.id as id, account.id as id_student,book.id as id_book")
				 ->from('reading')
				 ->join('account','reading.user_id = account.id')
				 ->join('book','reading.book_id = book.id')
				 ->order_by('reading.id','DESC')
				 ->limit($limit);

		if($request_id != null)
		{
			$this->db->where(['reading.id'=>$request_id]); 
		}

		if($status != null)
		{
			$this->db->where(['status'=>$status]);
		}elseif($status == '0'){
			$this->db->where(['status'=>$status]);
		}

		if($book_id != null)
		{
			$this->db->where(['book.id'=>$book_id]);
		}

		if($account_id != null)
		{
			$this->db->where(['account.id'=>$account_id]);
		}
		
		return $this->db->get()->result();
	}	
}  
