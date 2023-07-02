<?php
    if(($this->session->event_added))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Event added successfully!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->event_added = null;
    }if($this->session->event_not_added){
?>
        <script>
            Swal.fire({            
            icon: 'error',
            title: 'Oups! Something went wrong',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->event_not_added = null;
    }
?>

 <!-- Main Content -->
 <div class="main-content">
    <section class="section">
        <div class="section-body">  
            <div class="row">
                <div class="col-12">
                    <h2>Events</h2>
                </div>
            </div>
            <br><br>

            <div class="row">
              <div class="col-12">
                <div class="card mb-0">
                  <div class="card-body">
                    <div class="row">                    
                        <div class="col-md-6 col-12">                    
                            <ul class="nav nav-pills">
                                <li class="nav-item category_menu">
                                    <a class="nav-link category_menu_link active" id="all-category-menu" href="#">All <span class="badge badge-white category_span" id="all-category-span"><?=count($event)?></span></a>
                                </li>
                                <?php
                                    foreach($category as $cat)
                                    {
                                    ?>                    
                                        <li class="nav-item category_menu">
                                            <a class="nav-link category_menu_link" id='<?=$cat->id."-category-menu"?>' href="#"><?=$cat->category?> <span class="badge badge-primary category_span" id=<?=$cat->id."-category-span"?>><?=count($cat->nb_event)?></span></a>
                                        </li>
                                <?php
                                    }
                                ?>                           
                            </ul>
                        </div>   
                        <?php
                        if($this->session->role == 'admin')
                        {
                        ?>                                    
                        <div class="col-md-2 col-6 offset-3 offset-md-4">
                            <span class="text-right" >
                                <a href="<?=site_url('admin/new_event')?>" class="btn btn-success">
                                    <i class="fas fa-plus"></i>&nbsp;New Event
                                </a>
                            </span>
                        </div>
                        <?php
                        }        
                        ?> 
                    </div>
                  </div>
                </div>
              </div>
            </div>  

           <br><br><br>
                <!-- events -->
                <div class="row" id="event_area">
                    <?php
                        foreach($event as $e)
                        {
                    ?>
                        <div class="col-12 col-md-4 col-lg-6">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h4><?="$e->title"?></h4>
                                    <div class="card-header-action">
                                        <a href="<?=site_url('admin/detail_event?event_id='.$e->id)?>" class="btn btn-success">
                                            <i class="fas fa-eye"></i>
                                        </a>&nbsp;&nbsp;
                                    </div>                                 
                                    <div class="card-header-action">
                                        <a data-collapse=<?="#".$e->id."-collapse"?> class="btn btn-icon btn-info" href="#"><i
                                        class="fas fa-minus"></i></a>
                                    </div>
                                </div>
                                <div class="collapse show" id=<?=$e->id."-collapse"?>>
                                    <div class="card-body">
                                        <img class="img-fluid" src="<?=base_url('assets/files/events/'.$e->image)?>" alt="Image">
                                        <br><br>

                                        <?php
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
                                        ?>
                                        <p><?=$description?>...</p>   
                                        
                                        <em><?=$e->category?></em> 
                                        <p class="text-right"><small><?=$e->date?></small></p>                                                                  
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                </div>
              
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    $(function(){
        $('.category_menu').click(function(e){
            e.preventDefault();

            var id = e.target.getAttribute('id').split('-')[0];

            $('.category_menu_link').removeClass('active');
            $('.category_span').removeClass('badge-white');
            

            $('#'+id+'-category-menu').addClass('active');
            $('.category_span').addClass('badge-primary');
            $('#'+id+'-category-span').addClass('badge-white');

            $.post("<?=site_url('ajax/filter_event')?>",{cat_id:id},function(data)
            {
                $("#event_area").html(data);
                console.log(data);
            })
            
        });      

    })
</script>