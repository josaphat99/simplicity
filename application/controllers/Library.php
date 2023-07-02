<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Controller
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

        /**
         * BOOK STATUSES
         * =============
         * 0 : Available
         * 1 : Issued
         * 
         * READING STATUSES
         * ================
         * 0 : pending
         * 1 : issued
         * 2 : rejected
         * 3 : returned
         */

        $book = $this->Crud->get_data_desc('book',[],5);        
        $request = $this->Crud->join_reading_book_account(0);
        $issued_book = $this->Crud->join_reading_book_account(1);
        $event = $this->Crud->get_data_desc('event',[],5);

        foreach($event as $e)
        {
            $e->category = $this->Crud->get_data('category',['id'=>$e->category_id])[0]->category;
        }
       
        $d = [
            'book' => $book,
            'request' => $request,
            'event' => $event,
            'issued_book' => $issued_book,
        ];

        $this->load->view('library/index',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    public function view_book()
    {
        $d['book'] = $this->Crud->get_data_desc('book');

        $this->load->view('library/view_book',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    //details of a book
    public function detail_book()
    {
        /**
         * Request statuses
         * 0 : available
         * 1: issued
         * 2: archived
         */
        $book_id = $this->input->get('book_id');

        $book = $this->Crud->get_data('book',['id'=>$book_id]);
        $request = $this->Crud->get_data('reading',['book_id'=>$book_id]);

        $d['book'] = count($book) > 0?$book[0] : null;
        $d['request'] = count($request) > 0?$request[0] : null;
        $d['all_book'] = $this->Crud->get_data_desc('book');

        $this->load->view('library/detail_book',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    //add a new book
    public function new_book()
    {
        $image_uploaded = false;
            
        if($_FILES['cover']['name'] != null)
        {
            $cover_file_name = str_replace(' ','_',$_FILES['cover']['name']);
            $cover = 'fichier'.md5(time())."_".$cover_file_name;

            //upload files
            if(move_uploaded_file($_FILES['cover']['tmp_name'], './assets/files/books/'.$cover))
            {
                $d = [
                    'title' => $this->input->post('title'),
                    'author' => $this->input->post('author'),
                    'isbn' => $this->input->post('isbn'),
                    'cover' => $cover,
                    'number_page' => $this->input->post('number_page'),
                ];

                $this->Crud->add_data('book',$d);       

                $image_uploaded = true;
            }
        }

        if($image_uploaded)
        {
            $this->session->set_flashdata(['book_added'=>true]);                
        }else{
            $this->session->set_flashdata(['book_not_added'=>false]);
        }

        redirect('library/view_book');
    }

    //view pending request
    public function view_pending_request()
    {
        $request_id = $this->input->get('request_id');     
        
        if($request_id != null){
            $d['request'] = $this->Crud->join_reading_book_account(0,$request_id);
        }else{
            $d['request'] = $this->Crud->join_reading_book_account(0);
        }


        $this->load->view('library/view_pending_request',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

      //view issued books
      public function view_issued_book()
      {
          $request_id = $this->input->get('request_id');         
  
        if($request_id != null){
            $d['request'] = $this->Crud->join_reading_book_account(1,$request_id);
        }else{
            $d['request'] = $this->Crud->join_reading_book_account(1);
        }
  
          $this->load->view('library/view_issued_book',$d);
          $this->load->view('layout/footer');
          $this->load->view('layout/js');
      }

    //issueing a book
    public function issue_book()
    {
        $request_id = $this->input->get('request_id');
        $action = $this->input->get('action');

        if($action == 'issue')
        {
            //work on dates
            $issueing_date = date('d-m-Y',time());
            $issueing_date_tmp = strtotime($issueing_date);
            $deadline_tmp = strtotime('+7 day',$issueing_date_tmp);
            $deadline = date('d-m-Y',$deadline_tmp);

            $this->Crud->update_data('reading',['id'=>$request_id],['status'=>1]);
            $this->Crud->update_data('reading',['id'=>$request_id],['issueing_date'=>$issueing_date]);
            $this->Crud->update_data('reading',['id'=>$request_id],['deadline'=>$deadline]);

            $this->session->set_flashdata(['book_issued'=>true]);

            redirect('library/view_issued_book?request_id='.$request_id);            
        }else{
            $this->Crud->update_data('reading',['id'=>$request_id],['status'=>2]);
            $this->session->set_flashdata(['request_rejected'=>true]);

            redirect('library/view_pending_request');
        }

    }

    //return a book
    public function return_book()
    {
        $request_id = $this->input->get('request_id');
        $request = $this->Crud->get_data('reading',['id'=>$request_id])[0];
        $book_id = $request->book_id;

        $this->Crud->update_data('reading',['id'=>$request_id],['status'=>3]);

        $this->session->set_flashdata(['book_returned'=>true]);

        redirect('library/detail_book?book_id='.$book_id);
    }
}