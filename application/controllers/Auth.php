<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // if(!$this->session->connected)
		// {
		// 	redirect('compte');
		// }

		//======================================================
		$this->load->model('Crud');
        //==========================================================
        $this->load->view('layout/head');
        // $this->load->view('layout/admin/sidebar');
        // $this->load->view('layout/admin/topbar');
    }

    public function index()
    {
        $this->session->sess_destroy();
        $this->login();
    }

    //login view and process
    public function login()
    {
        if(count($_POST) <= 0)
        {
            $this->load->view('auth/login');
            $this->load->view('layout/footer');
            $this->load->view('layout/js');
        }else{
            $username = $this->input->post('username');
            $pwd = $this->input->post('password');

            $res = $this->Crud->get_data('account',['username'=>$username,'password'=>$pwd]);

            if(count($res) > 0)
            {
                $fullname = $res[0]->fullname;
                $email = $res[0]->email;
                $role = $res[0]->role;

                //creation de la session
                $session = [
                    "id"=>$res[0]->id,                    
                    "username"=>$res[0]->username,
                    "fullname"=>$fullname,
                    "role"=>$role,
                    "email"=>$email,
                    "connected"=>true,                    
                ];
    
                $this->session->set_userdata($session);
    
                //interfaces management
                if(trim($role) == trim("admin"))
                {
                    redirect('admin/index');                    
                }               
                else if(trim($role) == trim("teacher"))
                {
                    redirect('teacher/index'); 
                }
                else if(trim($role) == trim("student"))
                {
                    redirect('student/index'); 
                }
                else if(trim($role) == trim("finance"))
                {
                    redirect('finance/index'); 
                }
                else if(trim($role) == trim("librarian"))
                {
                    redirect('library/index'); 
                }
                else{				
                    $login_error = array("error_login" => "Your username or password is incorrect!!");
                    $this->session->set_flashdata($login_error);
                    redirect('auth/login'); 
                }
            }else{
                $login_error = array("error_login" => "Your username or password is incorrect!!");
                $this->session->set_flashdata($login_error);
                redirect('auth/login');
            }
        }
    }

    //signup view and process
    public function signup()
    {
        if(count($_POST) <= 0)
        {
            $this->load->view('layout/sidebar');
            $this->load->view('layout/topbar');
            $this->load->view('auth/signup');
            $this->load->view('layout/footer');
            $this->load->view('layout/js');
        }else{
            
            echo 'process';die();
        }
    }

    //logout
    public function logout()
    {
        $this->session->sess_destroy();

        redirect('auth');
    }
}
