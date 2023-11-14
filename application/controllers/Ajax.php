<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

       //======================================================
		$this->load->model('Crud');
    }
    
    public function filter_event()
    {
        $cat_id = $this->input->post('cat_id');

        if($cat_id == 'all')
        {
            $event = $this->Crud->get_data_desc('event');
        }else{
            $event = $this->Crud->get_data_desc('event',['category_id'=>$cat_id]);
        }        
        
        foreach($event as $e)
        {
            $e->category = $this->Crud->get_data('category',['id'=>$e->category_id])[0]->category;
        }
        
        $html = '';

        foreach($event as $e)
        {
            $tab_description = explode(' ',$e->description);
            $description = '';

            for($i=0;$i<count($tab_description);$i++)
            {
                if($i < 26)
                {
                    $description .= $tab_description[$i].' ';
                }else{
                    break;
                }
            }

            $html .= '<div class="col-12 col-md-4 col-lg-6 animated zoomIn">
                        <div class="card card-success">
                            <div class="card-header">
                                <h4>'.$e->title.'</h4>
                                <div class="card-header-action">
                                    <a href="#" class="btn btn-success">
                                        <i class="fas fa-eye"></i>
                                    </a>&nbsp;&nbsp;
                                </div>
                                <div class="card-header-action">
                                    <a data-collapse="#'.$e->id.'-collapse" class="btn btn-icon btn-info"><i
                                    class="fas fa-minus"></i></a>
                                </div>
                            </div>
                            <div class="collapse show" id="'.$e->id.'-collapse">
                                <div class="card-body">
                                    <img class="img-fluid" src='.base_url("assets/files/events/$e->image").' alt="Image">
                                    <br><br>                    
                                    <p>'.$description.'...</p>                            
                                    <em>'.$e->category.'</em> 
                                    <p class="text-right"><small>'.$e->date.'</small></p>                                                                  
                                </div>
                            </div>
                        </div>
                    </div>';
            
        }
        echo $html;
    }

    public function view_grade()
    {
        $account_id = $this->session->id;
        $student_id = $this->Crud->get_data('account',['id'=>$account_id])[0]->student_id;
        $test_id = $this->input->post('test_id');
        $max_mark = $this->input->post('max_mark');

        $result = $this->Crud->get_data('result_test',['student_id'=>$student_id,'test_id'=>$test_id]);
        $html = '';
        $note = '';

        if(count($result) > 0)
        {
            if($result[0]->mark != null)
            {
                $mark_percent = explode('.',$result[0]->mark*100/$max_mark)[0];
            }else{
                $mark_percent = 0;
            }

            if($mark_percent >= 0 && $mark_percent <= 44)
            {
                $note = 'E';
            }else if($mark_percent >= 45 && $mark_percent <= 54)
            {
                $note = 'D';
        
            }else if($mark_percent >= 55 && $mark_percent <= 64)
            {
                $note = 'C';
            }
            else if($mark_percent >= 65 && $mark_percent <= 74)
            {
                $note = 'B';                
            }else if($mark_percent >= 75 && $mark_percent <= 100)
            {
                $note = 'A';
            }

            $html ="<table class='table table-striped table-bordered table-sm'>
                        <tr class='text-center'>
                            <th>Obtained mark</th>
                            <td>".$result[0]->mark."</td>
                        </tr>
                        <tr class='text-center'>
                            <th>Mark in %</th>
                            <td>".$mark_percent."</td>
                        </tr>
                        <tr class='text-center'>
                            <th>Analysis</th>
                            <td>".$note."</td>
                        </tr>
                    </table>
            " ;
        }else{
            $html = "<p class='alert alert-light'>Grades are not yet available!</p>";
        }

        echo $html;
    }
}