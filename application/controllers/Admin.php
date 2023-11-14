<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
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

    //restriction method
    public function restriction()
    {
        $this->load->view('errors/restriction');
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
       
    }

    //dashboard
    public function index()
    {
        if($this->session->role != 'admin')
        {
           redirect('admin/restriction');
        }

        //fetch users from DB       

        $student = $this->Crud->get_data_desc('account',['role'=>'student']);        
        $teacher = $this->Crud->get_data_desc('account',['role'=>'teacher']);
        $finance = $this->Crud->get_data_desc('account',['role'=>'finance']);
        $librarian = $this->Crud->get_data_desc('account',['role'=>'librarian']);

        $d = [
            'student' => $student,
            'teacher' => $teacher,
            'finance' => $finance,
            'librarian' => $librarian
        ];

        $this->load->view('admin/index',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    //new user
    public function new_user()
    {
        if($this->session->role != 'admin')
        {
           redirect('admin/restriction');
        }

        $fullname = $this->input->post('fullname');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $gender = $this->input->post('gender');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        

        $d = [
            'fullname' => $fullname,
            'email' => $email,
            'phone' => $phone,
            'gender' => $gender,
            'username' => $username,
            'password' => $password,
            'role' => $this->input->post('role')
        ];

        //add the teacher into the database
        $this->Crud->add_data('account',$d);

        $this->session->set_flashdata(['user_added' => true]);

        redirect('admin/index');
    }

    //view and add grades
    public function view_grade()
    {
        if($this->session->role != 'admin')
        {
           redirect('admin/restriction');
        }

        $grade = $this->Crud->get_data('grade');
        
        //counting options and student per grade
        foreach($grade as $g)
        {
            $g->option = count($this->Crud->get_data('option',['grade_id'=>$g->id]));
            $g->student = count($this->Crud->get_data('student',['grade_id'=>$g->id]));
        }

        $d = [
            'grade' => $grade,
        ];

        $this->load->view('admin/view_grade',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    //view and add options
    public function view_option()
    {
        if($this->session->role != 'admin')
        {
           redirect('admin/restriction');
        }

        $grade_id = $this->input->get('grade_id');

        $option = $this->Crud->get_data_desc('option',['grade_id'=>$grade_id]); 
            
        //counting student per option
        foreach($option as $o)
        {
            $o->student = count($this->Crud->get_data('student',['option_id'=>$o->id]));
        }
        
        $d = [
            'option' => $option,
            'grade_id' => $grade_id
        ];

        $this->load->view('admin/view_option',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    //new option
    public function new_option()
    {
        if($this->session->role != 'admin')
        {
           redirect('admin/restriction');
        }

        $grade_id = $this->input->post('grade_id');

        $this->Crud->add_data('option',[
            'name' => $this->input->post('name'),
            'grade_id' => $grade_id,
        ]);

        $this->session->set_flashdata(['option_added' => true]);

        redirect('admin/view_option?grade_id='.$grade_id);
    }

     //new grade
     public function new_grade()
     {
         if($this->session->role != 'admin')
         {
            redirect('admin/restriction');
         }
 
         $this->Crud->add_data('grade',[
             'grade' => $this->input->post('grade'),
         ]);
 
         $this->session->set_flashdata(['grade_added' => true]);
 
         redirect('admin/view_grade');
     }

    //==========STUDENTS=============
    //view students
    public function view_student()
    {
        if($this->session->role != 'admin')
        {
           redirect('admin/restriction');
        }

        $option_id = $this->input->get('option_id');
        $option = $this->Crud->get_data('option',['id'=>$option_id]);

        $d['course'] = $this->Crud->get_course_option($option_id);
        $d['teacher'] = $this->Crud->get_data('account',['role'=>'teacher']);
        $d['student'] = $this->Crud->join_account_student($option_id);
        $d['option_name'] = count($option) > 0?$option[0]->name:'';
        $d['grade_id'] = count($option) > 0?$option[0]->grade_id:'';
        $d['option_id'] = $option_id;

        $this->load->view('admin/view_student',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    //new student
    public function new_student()
    {
        if($this->session->role != 'admin')
        {
           redirect('admin/restriction');
        }

        $fullname = $this->input->post('fullname');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $gender = $this->input->post('gender');
        $username = $this->input->post('username');
        $password = $this->input->post('password');     

        //===creation de la transition===
		$this->db->trans_start();	

        //inserting the student

        $option_id = $this->input->post('option_id');

        $this->Crud->add_data('student',[
            'option_id' => $option_id,
            'grade_id' => $this->input->post('grade_id')
        ]);

        //add the student's account into the database
        $student_id = $this->Crud->get_data_desc('student')[0]->id;

        $d = [
            'fullname' => $fullname,
            'email' => $email,
            'phone' => $phone,
            'gender' => $gender,
            'username' => $username,
            'password' => $password,
            'role' => $this->input->post('role'),   
            'student_id' => $student_id         
        ];

        $this->Crud->add_data('account',$d);       

        //===--Fin transition--===
		$this->db->trans_commit();

        $this->session->set_flashdata(['student_added' => true]);

        redirect('admin/view_student?option_id='.$option_id);
    }

    //============COURSES=========
    public function new_course()
    {
        if($this->session->role != 'admin')
        {
           redirect('admin/restriction');
        }

        $option_id = $this->input->post('option_id');

        $d = [
            'title' => $this->input->post('title'),
            'teacher_id' => $this->input->post('teacher_id'),
            'option_id' => $option_id,
        ];

        $this->Crud->add_data('course',$d);

        $this->session->set_flashdata(['course_added' => true]);

        redirect('admin/view_student?option_id='.$option_id);
    }

    //==========EVENTS=============

    //view events
    public function view_event()
    {
        $event = $this->Crud->get_data_desc('event');
        $category = $this->Crud->get_data('category');

        foreach($event as $e)
        {
            $e->category = $this->Crud->get_data('category',['id'=>$e->category_id])[0]->category;
        }

        foreach($category as $c)
        {
            $c->nb_event = $this->Crud->get_data('event',['category_id'=>$c->id]);
        }

        $d = [
            'event' => $event,
            'category' => $category
        ]; 

        $this->load->view('admin/view_event',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    //detail event
    public function detail_event()
    {
        $event_id = $this->input->get('event_id');
        $event = $this->Crud->get_data('event',['id'=>$event_id]);

        foreach($event as $e)
        {
            $e->category = $this->Crud->get_data('category',['id'=>$e->category_id])[0]->category;
        }

        $d = [
            'event' => $event,
        ]; 

        $this->load->view('admin/detail_event',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    //add event
    public function new_event()
    {
        if($this->session->role != 'admin')
        {
           redirect('admin/restriction');
        }
        
        if(count($_POST) <= 0)
        {
            $d['category'] = $this->Crud->get_data('category');

            $this->load->view('admin/new_event',$d);
            $this->load->view('layout/footer');
            $this->load->view('layout/js');
        }else{
            $image_uploaded = false;
            
            if($_FILES['image']['name'] != null)
            {
                $image_file_name = str_replace(' ','_',$_FILES['image']['name']);
                $image = 'fichier'.md5(time())."_".$image_file_name;

                //upload files
                if(move_uploaded_file($_FILES['image']['tmp_name'], './assets/files/events/'.$image))
                {
                    $d = [
                        'title' => $this->input->post('title'),
                        'description' => $this->input->post('description'),
                        'image' => $image,
                        'category_id' => $this->input->post('category_id'),
                        'date' => $this->input->post('date'),
                    ];

                    $this->Crud->add_data('event',$d);       

                    $image_uploaded = true;
                }
            }

            if($image_uploaded)
            {
                $this->session->set_flashdata(['event_added'=>true]);                
            }else{
                $this->session->set_flashdata(['event_not_added'=>false]);
            }

            redirect('admin/view_event');
           
        }
    }

    //edit event    
    public function edit_event()
    {
        $event_id = $this->input->get('event_id');
        $event = $this->Crud->get_data('event',['id'=>$event_id]);
        $category = $this->Crud->get_data('category');
        foreach($event as $e)
        {
            $e->category = $this->Crud->get_data('category',['id'=>$e->category_id])[0]->category;
        }

        $d = [
            'event' => $event,
            'category' => $category
        ]; 

        $this->load->view('admin/edit_event',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    //delete event
    public function delete_event()
    {
        $event_id = $this->input->get('event_id');

        $this->Crud->delete_data('event',['id'=>$event_id]);

        redirect('admin/view_event');
    }
}
