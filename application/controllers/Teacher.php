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

        $ongoing_ass = $this->Teacher_model->join_assignment_course($teacher_id,'0');
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

        $id_option_tab = []; 
        $counter = 0;

        foreach($department as $d)
        {
            /**Check if an id_option is in the idoption array
             * no, add it
             * yes, remove item from deaprtment array
             */

            if(!in_array($d->id_option,$id_option_tab))
            {
                array_push($id_option_tab,$d->id_option);
                $d->nb_student = count($this->Crud->join_account_student($d->id_option));
            }else{
                unset($department[$counter]);
            }
            $counter++;
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
        $grade = $this->input->get('grade');
        
        $department_name = $this->Crud->get_data('option',['id'=>$department_id])[0]->name;
        $teacher_id = $this->session->id;

        $student = $this->Crud->join_account_student($department_id);
        $course = $this->Crud->get_data('course',['option_id'=>$department_id,'teacher_id'=>$teacher_id]);

        $d = [
            'student' => $student,       
            'department_name' => $department_name,
            'course' => $course,
            'grade' => $grade
        ];

        $this->load->view('teacher/list_student',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }
    //================================
    public function list_term()
    {
        $teacher_id = $this->session->id;
        $term = $this->Teacher_model->get_term();

        foreach($term as $t)
        {
            $t->nb_test = count($this->Crud->get_ass_course_teacher($t->id,$teacher_id));
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
        $course = $this->Teacher_model->get_course_teacher($teacher_id); // for adding a new test
        $nb_test_term = count($this->Teacher_model->test_term($term_id,$this->session->id));
        
        $d = [
            'term_id' => $term_id,
            'term' => $term,
            'test' => $test,   
            'course' => $course,
            'nb_test_term' => $nb_test_term
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
        $teacher_id = $this->session->id;
        /**
         * Check number of tests that came before
         * determine the max_mark
         * if the nb is 3 don't add the test
         */

        $nb_test_term = $this->Teacher_model->get_test_teacher($teacher_id,$term_id);
        $max_mark = 0;
        $add_test = false;

        if(count($nb_test_term) <= 1)
        {
            $max_mark = 20;
            $add_test = true;
        }else if(count($nb_test_term) == 2){
            $max_mark = 60;
            $add_test = true;
        }else{
            $add_test = false;
        }

        if($add_test)
        {
            $d = [
                'title' => $this->input->post('title'),
                'course_id' => $this->input->post('course_id'),
                'description' => $this->input->post('description'),
                'start_date' => $this->input->post('date'),
                'max_mark' => $max_mark,
                'term_id' => $term_id,
                'type' => 'test'
            ];
    
            $this->Crud->add_data('assignment',$d);
    
            $this->session->set_flashdata(['test_added'=>true]);
        }else{
            $this->session->set_flashdata(['test_not_added'=>true]);
        }     

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

    //mark schedule
    public function mark_schedule()
    {
        $term_id = $this->input->get('term_id');
        $term = $this->Crud->get_data('term',['id'=>$term_id])[0]->term;
        $teacher_name = $this->Crud->get_data('account',['id'=>$this->session->id])[0]->fullname;

        $test_term = $this->Teacher_model->test_term($term_id,$this->session->id); //all tests of a term
        $student = $this->Crud->join_account_student(); //all students
        
        $student_tab = [];
        
        // var_dump($student);die();

        foreach($test_term as $t)
        {
            foreach($student as $s)
            {   
                //we colect the point for test $t for each student
                $res = $this->Teacher_model->result_test($t->id,$s->id_student);
                
                if(count($res) > 0)
                {
                    $s->tab[$t->title] = $res[0]->mark;
                    $s->mark[$t->title.'_mark_'.$s->id_student] = $t->max_mark;

                    if(!in_array($s->id_student,$student_tab))
                    {
                        array_push($student_tab,$s->id_student);
                    }
                }
            }          
        }

        $d = [
            'test_term' => $test_term,
            'term' => $term,
            'teacher_name' => $teacher_name,  
            'student' => $student,
            'student_tab' => $student_tab,
        ];

        $this->load->view('teacher/mark_schedule',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');

        // foreach($student as $s)
        // {
        //     $res = $this->Teacher_model->result_test($t->id,$s->id_student);
            
        //     if(count($res) > 0)
        //     {
        //         echo $s->fullname.' : ';

        //         foreach ($s->tab as $title => $mark) {
        //             echo $title.' => '.$mark.', ';
        //         }
        //         echo '<br/>';
        //     }
        // }
        // die();
    }
}