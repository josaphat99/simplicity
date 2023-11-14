<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!$this->session->connected)
		{
			redirect('auth');
		}

		//======================================================
		$this->load->model('Crud');
        //==========================================================
        $this->load->view('layout/head');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
    }

    public function index()
    {
        //fetch infos from DB

        $student_id = $this->session->id;        

        $student = $this->Crud->join_student_account_option_grade($student_id); 
        $student = count($student) > 0? $student[0] : null;

        $pending_request = $this->Crud->join_reading_book_account(0,null,null,null,$student->id);
        $issued_book = $this->Crud->join_reading_book_account(1,null,null,null,$student->id);

        $event = $this->Crud->get_data_desc('event',[],5);

        foreach($event as $e)
        {
            $e->category = $this->Crud->get_data('category',['id'=>$e->category_id])[0]->category;
        }
       
        $d = [
            'student' => $student,
            'pending_request' => $pending_request,
            'event' => $event,
            'issued_book' => $issued_book,
        ];

        $this->load->view('student/index',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    public function request_book()
    {
        $book_id = $this->input->get('book_id');

        $d = [
            'book_id' => $book_id,
            'user_id' => $this->session->id,
            'date' => date('d-m-Y',time()),
            'status' => 0
        ];

        $this->Crud->add_data('reading',$d);

        $this->session->set_flashdata(['request_submitted'=>true]);

        redirect('library/detail_book?book_id='.$book_id);
    }

     //view pending request
     public function view_pending_request()
     {
        $student_id = $this->session->id;
        
        $d['request'] = $this->Crud->join_reading_book_account(0,null,null,null,$student_id);

        $this->load->view('student/view_pending_request',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
     }
 
    //view issued books
    public function view_issued_book()
    {
        $student_id = $this->session->id;
        
        $d['request'] = $this->Crud->join_reading_book_account(1,null,null,null,$student_id);
        
        $this->load->view('student/view_issued_book',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    //cancel request
    public function cancel_request()
    {
        $request_id = $this->input->get('request_id');

        $this->Crud->delete_data('reading',['id'=>$request_id]);

        $this->session->set_flashdata(['request_canceled'=>true]);

        redirect('student/view_pending_request');
    }

    //view course
    public function view_course()
    {
        $account_id = $this->session->id;
        $student_id = $this->Crud->get_data('account',['id'=>$account_id])[0]->student_id;
        $option_id = $this->Crud->get_data('student',['id'=>$student_id])[0]->option_id;
        $option = $this->Crud->get_data('option',['id'=>$option_id]);
        $option_name = $option[0]->name;

        $grade = $this->Crud->get_data('grade',['id'=>$option[0]->grade_id])[0]->grade;
       
        $course = $this->Crud->get_course_option($option_id);

        $d = [
            'option_id' => $option_id,
            'option_name' => $option_name,
            'grade' => $grade,
            'course' => $course
        ];
        
        $this->load->view('student/view_course',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    //view test
    public function view_test()
    {
        $course_id = $this->input->get('course_id');
        $course = $this->Crud->get_data('course',['id'=>$course_id]);
        $test = $this->Crud->get_data("assignment",['course_id'=>$course_id]);

        //get the term
        if(count($test) > 0)
        {
            foreach($test as $t)
            {
                $t->term = $this->Crud->get_data("term",['id'=>$t->term_id])[0]->term;
            }
        }

        $d = [
            'test' => $test,   
            'course_title' => $course[0]->title,
        ];

        $this->load->view('student/view_test',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }
}