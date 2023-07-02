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
                <!-- events -->
            <div class="row" id="event_area">
                <div class="card card-success">
                    <div class="card-header">
                        <h4><?=$event[0]->title?></h4>

                        <div class="card-header-action">
                            <a href="<?=site_url('admin/edit_event?event_id='.$event[0]->id)?>" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                            </a>&nbsp;&nbsp;
                        </div>

                        <div class="card-header-action">                                        
                            <form action="<?=site_url('admin/delete_event')?>" id="<?='form_delete_'.$event[0]->id?>">
                                <input type="hidden" value="<?=$event[0]->id?>" name="event_id" hidden>
                                <button class="btn btn-danger btn_delete" type="submit" id="<?='btn_delete-'.$event[0]->id?>">
                                    <i class="fas fa-trash-alt btn_delete" id="<?='icon_delete-'.$event[0]->id?>"></i>
                                </button>&nbsp;&nbsp;
                            </form>
                        </div>
                    </div>
                   

                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 offset-md-1">                                
                                    <img class="img-fluid" src="<?=base_url('assets/files/events/'.$event[0]->image)?>" alt="Image">
                                </div>
                                <div class="col-md-10 offset-md-1">                               
                                    <br><br>
                                    <p><?=$event[0]->description?></p>   
                                    
                                    <em><?=$event[0]->category?></em> 
                                    <p class="text-right"><small><?=$event[0]->date?></small></p>  
                                </div>  
                            </div>
                        </div>
                    </div>                                                              
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script>
    $(".btn_delete").click(function(e){
        e.preventDefault();
        
        var id = e.target.getAttribute('id').split('-')[1];            

        Swal.fire({
        title: 'Do you realy want to delete this event?',
        text: "You won't be able to undo this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Deleted!',
                'Event deleted.',
                'success'
                )
                $("#form_delete_"+id).submit();
            }
        })
    })
</script>