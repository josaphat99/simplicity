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
}