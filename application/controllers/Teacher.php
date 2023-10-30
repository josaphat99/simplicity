<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller
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
        $this->load->model('Teacher_model');
        //==========================================================
        $this->load->view('layout/head');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
    }

    public function index()
    {
        /**
         * Assignment statuses
         * 0 : ongoing
         * 1: passed (result provided)
         */

        $teacher_id = $this->session->id;        

        $ongoing_ass = $this->Teacher_model->join_assignment_course($teacher_id,'0',5);
        $test = $this->Teacher_model->get_test_teacher($teacher_id,5);
        $course = $this->Teacher_model->get_course_teacher($teacher_id);

        $event = $this->Crud->get_data_desc('event',[],5);        

        foreach($event as $e)
        {
            $e->category = $this->Crud->get_data('category',['id'=>$e->category_id])[0]->category;
        }
        
        $d = [
            'ongoing_ass' => $ongoing_ass,
            'test' => $test,
            'course' => $course,
            'event' => $event,            
        ];

        $this->load->view('teacher/index',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    public function list_test()
    {
        $teacher_id = $this->session->id;   

        $test = $this->Teacher_model->get_test_teacher($teacher_id);
        $course = $this->Teacher_model->get_course_teacher($teacher_id);

        $d = [
            'test' => $test,   
            'course' => $course,
        ];

        $this->load->view('teacher/list_test',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }   

    //view_test_detail
    public function view_test_detail()
    {
        $test_id = $this->input->get('test_id');

        $test = $this->Teacher_model->get_test_teacher(null,null,$test_id);
        $course = $this->Crud->get_data('course',['id'=>$test[0]->course_id])[0];
        $option_id = $this->Crud->get_data('option',['id'=>$course->option_id])[0]->id;

        $result_test = $this->Teacher_model->get_test_result(null,null,$test_id);

        // var_dump($result_test);die();

        if(count($result_test) <= 0)
        {
            $student = $this->Crud->join_account_student($option_id);
        }else{
            $student = [];
        }
                
        $d = [
            'test' => $test,   
            'student' => $student,
            'result_test' => $result_test
        ];

        $this->load->view('teacher/view_test_detail',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

     //new test
     public function new_test()
     {
         $d = [
             'title' => $this->input->post('title'),
             'course_id' => $this->input->post('course_id'),
             'description' => $this->input->post('description'),
             'start_date' => $this->input->post('date'),
             'max_mark' => $this->input->post('max_mark'),
             'type' => 'test'
         ];
 
         $this->Crud->add_data('assignment',$d);
 
         $this->session->set_flashdata(['test_added'=>true]);
 
         redirect('teacher/list_test');
     }

     //record points
     public function record_point()
    {
        $test_id = $this->input->post('test_id');        

        $test = $this->Teacher_model->get_test_teacher(null,null,$test_id);
        $course = $this->Crud->get_data('course',['id'=>$test[0]->course_id])[0];
        $option_id = $this->Crud->get_data('option',['id'=>$course->option_id])[0]->id;

        $student = $this->Crud->join_account_student($option_id);

        $point_provided = false;

        foreach($student as $s)
        {
            $mark = $this->input->post($s->id_student);

            if($mark != null)
            {
                $point_provided = true;

                $this->Crud->add_data('result_test',[
                    'student_id' => $s->id_student,
                    'test_id' => $this->input->post('test_id'),
                    'mark' =>$mark,
                    'date' => date('d-m-Y',time())                
                ]);
            }else{
                continue;
            }         
        }

        if($point_provided)
        {
            $this->Crud->update_data('assignment',['id'=>$test_id],['status'=>1]);

            $this->session->set_flashdata(['point_recorded'=>true]);
        }else{
            $this->session->set_flashdata(['point_not_recorded'=>true]);
        }
 
        redirect('teacher/view_test_detail?test_id='.$test_id);
    }
}