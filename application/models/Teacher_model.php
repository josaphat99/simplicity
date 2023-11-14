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
	public function get_test_teacher($teacher_id=null,$term_id=null,$limit=null,$test_id=null)
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
					->where(['assignment.type'=>'test']);

		if($teacher_id != null)
		{
			$this->db->where(['course.teacher_id'=>$teacher_id]);
		}
		if($term_id != null)
		{
			$this->db->where(['term.id'=>$term_id]);
		}
		if($test_id != null)
		{
			$this->db->where(['assignment.id'=>$test_id]);
		}
					
		
		return $this->db->get()->result();
	}

	//get test results
	public function get_test_result($teacher_id=null,$limit=null,$test_id=null)
	{
		$this->db->select("*, assignment.id as id, assignment.title as title")
				->from('assignment')
				->join('result_test','result_test.test_id = assignment.id')
				->join('student','result_test.student_id = student.id')
				->join('account','student.id = account.student_id')
				->order_by('account.fullname','ASC')
				->limit($limit)
				->where(['result_test.test_id'=>$test_id]);

		if($teacher_id != null)
		{
			$this->db->where(['account.id'=>$teacher_id]);
		}					
		
		return $this->db->get()->result();
	}

	//mark schedule
	public function mark_schedule($term_id)
	{
		$this->db->select("*, assignment.id as id, assignment.title as title,student.id as id_student")
				->from('assignment')
				->join('course','assignment.course_id = course.id')
				->join('option','course.option_id = option.id')
				->join('student','student.option_id = option.id')
				->join('account','student.id = account.student_id')
				->order_by('account.fullname','ASC')
				->where(['assignment.term_id'=>$term_id]);

		// if($teacher_id != null)
		// {
		// 	$this->db->where(['account.id'=>$teacher_id]);
		// }					
		
		return $this->db->get()->result();
	}

	//get courses
	public function get_course_teacher($teacher_id)
	{
		$this->db->select('*, course.id as id, option.id as id_option,grade.id as id_grade')
				 ->from('course')
				 ->join('option','course.option_id = option.id','right')
				 ->join('grade','option.grade_id = grade.id')
				 ->order_by('course.id','DESC')
				 ->where(['course.teacher_id'=>$teacher_id]);

		return $this->db->get()->result();
	}

	//get terms
	public function get_term($term_id = null)
	{		
		$this->db->select('*, term.id as id')
				 ->from('term')
				 ->join('year','term.year_id = year.id');

				if($term_id != null)
				{
				$this->db->where(['term.id'=>$term_id]);
				}
				 

		return $this->db->get()->result();
	}

	//get tests of a term
	public function test_term($term_id)
	{ 
		$this->db->select("*, assignment.id as id,assignment.title as title, course.id as id_course,course.title as course_title,option.name as department")
				->from('assignment')
				->join('course','assignment.course_id = course.id')
				->join('option','course.option_id = option.id')
				->join('grade','option.grade_id = grade.id')
				->join('term','assignment.term_id = term.id')
				->join('year','term.year_id = year.id')
				->where(['assignment.term_id'=>$term_id]);					
		
		return $this->db->get()->result();
	}

	//get result of test
	public function result_test($test_id,$student_id)
	{
		$this->db->select("*")
				->from('result_test')
				->where(['test_id'=>$test_id,'student_id'=>$student_id]);					
		
		return $this->db->get()->result();
	}
}