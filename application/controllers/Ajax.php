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
}