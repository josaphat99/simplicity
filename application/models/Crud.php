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

	
	//join request, books and user

	public function join_reading_book_account($status, $request_id=null)
	{
		$where = '';

		if($request_id != null)
		{
			$where = ['status'=>$status,'reading.id'=>$request_id];
		}else{
			$where = ['status'=>$status];
		}

		$this->db->select("*, reading.id as id, account.id as id_student,book.id as id_book")
				 ->from('reading')
				 ->join('account','reading.user_id = account.id')
				 ->join('book','reading.book_id = book.id')
				 ->order_by('reading.id','DESC')
				 ->limit(5)
				 ->where($where );
		
		return $this->db->get()->result();
	}


}  
