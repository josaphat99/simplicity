<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_model extends CI_Model
{
    //get assignment by teacher and course
    public function join_assignment_course($teacher_id,$status='0',$limit=null)
	{
		$this->db->select("*, assignment.id as id, assignment.title as title, course.title as course_title, course.id as id_course, account.id as id_account")
				 ->from('assignment')
				 ->join('course','assignment.course_id = course.id')
                 ->join('account','course.teacher_id = account.id')
				 ->order_by('assignment.id','DESC')
				 ->limit($limit)
				 ->where(['account.id'=>$teacher_id,'status'=>$status,'type'=>'assignment']);
		
		return $this->db->get()->result();
	}

	//get tests by teacher
	public function get_test_teacher($teacher_id=null,$limit=null,$test_id=null)
	{
		$this->db->select("*, assignment.id as id, assignment.title as title, course.title as course_title, course.id as id_course, account.id as id_account")
					->from('assignment')
					->join('course','assignment.course_id = course.id')
					->join('option','course.option_id = option.id')
					->join('grade','option.grade_id = grade.id')
					->join('account','course.teacher_id = account.id')
					->join('term','assignment.term_id = term.id')
					->join('year','term.year_id = year.id')
					->order_by('assignment.id','DESC')
					->limit($limit)
					->where(['type'=>'test']);

		if($teacher_id != null)
		{
			$this->db->where(['account.id'=>$teacher_id]);
		}
		if($test_id != null)
		{
			$this->db->where(['assignment.id'=>$test_id]);
		}
					
		
		return $this->db->get()->result();
	}

	//get courses
	public function get_course_teacher($teacher_id)
	{
		$this->db->select('*')
				 ->from('course')
				 ->join('option','course.option_id = option.id')
				 ->join('grade','option.grade_id = grade.id')
				 ->order_by('course.id','DESC')
				 ->where(['course.teacher_id'=>$teacher_id]);

		return $this->db->get()->result();
	}
}