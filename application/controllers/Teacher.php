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
        $test = $this->Teacher_model->get_test_teacher($teacher_id,null,5);
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

    //===========================
    public function list_department()
    {
        $teacher_id = $this->session->id;       

        $department = $this->Teacher_model->get_course_teacher($teacher_id);

        foreach($department as $d)
        {
            $d->nb_student = count($this->Crud->join_account_student($d->id_option));
        }

        $d = [
            'department' => $department,           
        ];

        $this->load->view('teacher/list_department',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    public function list_student()
    {
        $department_id = $this->input->get('department_id');
        $department_name = $this->Crud->get_data('option',['id'=>$department_id])[0]->name;

        $student = $this->Crud->join_account_student($department_id);

        $d = [
            'student' => $student,       
            'department_name' => $department_name    
        ];

        $this->load->view('teacher/list_student',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }
    //================================
    public function list_term()
    {
   
        $term = $this->Teacher_model->get_term();

        foreach($term as $t)
        {
            $t->nb_test = count($this->Crud->get_data('assignment',['term_id'=>$t->id]));
        }

        $d = [
            'term' => $term,   
        ];

        $this->load->view('teacher/list_term',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    //=========================
    public function list_test()
    {
        $teacher_id = $this->session->id;   
        $term_id = $this->input->get('term_id');

        $term = $this->Crud->get_data('term',['id'=>$term_id])[0]->term;
        $test = $this->Teacher_model->get_test_teacher($teacher_id,$term_id);
        $course = $this->Teacher_model->get_course_teacher($teacher_id);

        $d = [
            'term_id' => $term_id,
            'term' => $term,
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

        $test = $this->Teacher_model->get_test_teacher(null,null,null,$test_id);
        $course = $this->Crud->get_data('course',['id'=>$test[0]->course_id])[0];
        $option_id = $this->Crud->get_data('option',['id'=>$course->option_id])[0]->id;

        $result_test = $this->Teacher_model->get_test_result(null,null,$test_id);
        // var_dump($result_test);die();

        $count_male = 0;
        $count_female = 0;
        $male_sat = 0;
        $female_sat = 0;
        $tab_result = [
            'male_A'=> 0,
            'male_B'=> 0,
            'male_C'=> 0,
            'male_D'=> 0,
            'male_E'=> 0,
            'female_A'=> 0,
            'female_B'=> 0,
            'female_C'=> 0,
            'female_D'=> 0,
            'female_E'=> 0,
        ];

        if(count($result_test) <= 0)
        {
            $student = $this->Crud->join_account_student($option_id);
        }else{
            $student = [];

            /**
             * statistics data
             * ================
             * Nb Male and Female
             * Nb Male who sat and Female who sat
             * -------------------------------------
             * male_A up to E
             * female_A up to E
             */            

            foreach($result_test as $r)
            {
                if($r->gender == 'male')
                {
                    $count_male++;

                    if($r->mark != null)
                    {
                        $male_sat++;

                        $percent = $r->mark * 100 / $r->max_mark;

                        if($percent >= 0 && $percent <= 44)
                        {
                            $tab_result['male_E'] = $tab_result['male_E'] + 1;
                        }else if($percent >= 45 && $percent <= 54)
                        {
                            $tab_result['male_D'] = $tab_result['male_D'] + 1;
                    
                        }else if($percent >= 55 && $percent <= 64)
                        {
                            $tab_result['male_C'] = $tab_result['male_C'] + 1;
                        }
                        else if($percent >= 65 && $percent <= 74)
                        {
                            $tab_result['male_B'] = $tab_result['male_B'] + 1;                
                        }else if($percent >= 75 && $percent <= 100)
                        {
                            $tab_result['male_A'] = $tab_result['male_A'] + 1;
                        }
                    }else{
                        $tab_result['male_E'] = $tab_result['male_E'] + 1;
                    }
                }else{
                    $count_female++;

                    if($r->mark != null)
                    {
                        $female_sat++;

                        $percent = $r->mark * 100 / $r->max_mark;

                        if($percent >= 0 && $percent <= 44)
                        {
                            $tab_result['female_E'] = $tab_result['female_E'] + 1;
                        }else if($percent >= 45 && $percent <= 54)
                        {
                            $tab_result['female_D'] = $tab_result['female_D'] + 1;
                    
                        }else if($percent >= 55 && $percent <= 64)
                        {
                            $tab_result['female_C'] = $tab_result['female_C'] + 1;
                        }
                        else if($percent >= 65 && $percent <= 74)
                        {
                            $tab_result['female_B'] = $tab_result['female_B'] + 1;                
                        }else if($percent >= 75 && $percent <= 100)
                        {
                            $tab_result['female_A'] = $tab_result['female_A'] + 1;
                        }
                    }else{
                        $tab_result['female_E'] = $tab_result['female_E'] + 1;
                    }
                }
            }

                    //calulate pass % for both male and female
            $tab_result['male_pass_AB'] = ($tab_result['male_A'] + $tab_result['male_B']) * 100 / $count_male;
            $tab_result['male_pass_CD'] = ($tab_result['male_C'] + $tab_result['male_D']) * 100 / $count_male;
            $tab_result['female_pass_AB'] = ($tab_result['female_A'] + $tab_result['female_B']) * 100 / $count_male;
            $tab_result['female_pass_CD'] = ($tab_result['female_C'] + $tab_result['female_D']) * 100 / $count_male;
        }
        
 

        $d = [
            'test' => $test,   
            'student' => $student,
            'result_test' => $result_test,
            'count_male' => $count_male,
            'count_female' => $count_female,
            'male_sat' => $male_sat,
            'female_sat' => $female_sat,
            'tab_result' => $tab_result
        ];

        $this->load->view('teacher/view_test_detail',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

     //new test
     public function new_test()
     {
        $term_id = $this->input->post('term_id');

         $d = [
             'title' => $this->input->post('title'),
             'course_id' => $this->input->post('course_id'),
             'description' => $this->input->post('description'),
             'start_date' => $this->input->post('date'),
             'max_mark' => $this->input->post('max_mark'),
             'term_id' => $term_id,
             'type' => 'test'
         ];
 
         $this->Crud->add_data('assignment',$d);
 
         $this->session->set_flashdata(['test_added'=>true]);
 
         redirect('teacher/list_test?term_id='.$term_id);
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
              
            }else{
                continue;
            }         
        }

        if($point_provided)
        {
            foreach($student as $s)
            {
                $this->Crud->add_data('result_test',[
                    'student_id' => $s->id_student,
                    'test_id' => $this->input->post('test_id'),
                    'mark' => $this->input->post($s->id_student),
                    'date' => date('d-m-Y',time())                
                ]);
            }

            $this->Crud->update_data('assignment',['id'=>$test_id],['status'=>1]);
            $this->session->set_flashdata(['point_recorded'=>true]);
        }else{
            $this->session->set_flashdata(['point_not_recorded'=>true]);
        }
 
        redirect('teacher/view_test_detail?test_id='.$test_id);
    }
}