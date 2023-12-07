<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		//======================================================
		$this->load->model('Crud');
        //==========================================================
        $this->load->view('layout/public/css');
        $this->load->view('layout/public/navbar');
    }

    public function index()
    {
        $this->load->view('public/index');
        $this->load->view('layout/public/footer');
        $this->load->view('layout/public/js');
    }
}