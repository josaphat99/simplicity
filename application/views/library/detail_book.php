<?php
    if(($this->session->book_returned))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Book returned successfully!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->book_returned = null;
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
    $this->session->event_added = null;
    }
?>

<style>
    .book-hover-zoom {
        /* height: 300px; [1.1] Set it as per your need */
        overflow: hidden; /* [1.2] Hide the overflowing of child elements */
    }

    .book-hover-zoom img {
        transition: transform .5s ease;
    }

    .book-hover-zoom:hover img {
        transform: scale(1.1);
    }
</style>
 <!-- Main Content -->
 <div class="main-content">
    <section class="section">
        <div class="section-body">  
            <div class="row">
                <div class="col-12">
                    <h2>Book details</h2>
                </div>
            </div>
           
            <br>
            <div class="row">   
                <div class="col-md-8">                         
                    <div class="card card-success">
                        <div class="card-body">                    
                            <div class="row">
                                <div class="col-md-5 book-hover-zoom">
                                    <img class="img-fluid" src="<?=base_url('assets/files/books/'.$book->cover)?>" alt="Image">                                                       
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-2 offset-md-10">
                                            <?php
                                                $action_btn = '';
                                                $href = '';

                                                if($request == null)
                                                {
                                                    $action_btn = 'Latest requests';
                                                    $href = 'library/latest_request';
                                            ?>
                                                <p class="badge badge-info text-white">Available!</p>
                                            <?php
                                                }else{
                                                    if($request->status == 0)
                                                    {
                                                        $action_btn = 'View details';
                                                        $href = 'library/view_pending_request?request_id='.$request->id;
                                            ?>
                                                <p class="badge badge-info text-white animated check infinite" style="margin-left:-35px">Pending request!</p>
                                            <?php
                                                    }else if($request->status == 1)
                                                    {
                                                        $action_btn = 'View details';
                                                        $href = 'library/view_issued_request?request_id='.$request->id;
                                            ?>
                                                        <p class="badge badge-info text-white animated check infinite">Issued!</p>
                                            <?php
                                                    }else{
                                                        $action_btn = 'Latest requests';
                                                        $href = 'library/latest_request';
                                            ?>
                                                        <p class="badge badge-info text-white animated check infinite">Available!</p>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <br>
                                    <h2 class="text-center"><?=$book->title?></h2>
                                    <p class="text-center"><b>by <?=$book->author?></b>                                      
                                        <br> <small><?=$book->number_page?> Pages</small>
                                        <br><small>ISBN <span class="fas fa-barcode"></span> <?=$book->isbn?></small>
                                    </p>
                                    
                                    <div class="row">                                        
                                        <div class="col-md-6 offset-md-4">
                                            <a href=<?=site_url($href)?> class="btn btn-success"><?=$action_btn?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">                
                    <div class="card">
                        <div class="card-header">
                            <h4 style="margin:auto">Other books</h4>
                        </div>
                        <div class="card-body">
                            <?php
                                foreach($all_book as $ab){
                                    if($ab->id == $book->id)
                                    {
                                        continue;
                                    }
                            ?>
                                <div class="row book-hover-zoom">
                                    <div class="col-md-5 book-hover-zoom">
                                        <a href="<?=site_url('library/detail_book?book_id='.$ab->id)?>">
                                            <img class="img-fluid" src="<?=base_url('assets/files/books/'.$ab->cover)?>" alt="Image">                                                       
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-center"><b><?=$ab->title?></b>
                                            <small><?=$ab->author?></small> <br>
                                            <small><?=$ab->number_page?> pages</small>
                                        </p>
                          
                                    </div>
                                </div><br>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
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