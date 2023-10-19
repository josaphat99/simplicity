<?php
    if(($this->session->book_added))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Book added successfully!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->book_added = null;
    }if($this->session->book_not_added){
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
    $this->session->book_not_added = null;
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
        transform: scale(0.9);
    }
</style>
 <!-- Main Content -->
 <div class="main-content">
    <section class="section">
        <div class="section-body">  
            <div class="row">
                <div class="col-12">
                    <h2>Books</h2>
                </div>
            </div>
                <!-- events -->
            <?php
                if($this->session->role == 'librarian')
                {
            ?>           
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-outline-success btn-lg" data-toggle="modal" data-target="#newBookForm">
                                <i class="fas fa-plus"></i> &nbsp;Add a book
                            </button>
                        </div>
                    </div>
                    <br>
            <?php
                }
            ?>
            <div class="card card-success">
                <div class="card-body">                    
                    <div class="row">
                <?php
                    foreach($book as $b)
                    {
                ?>
                        <div class="col-md-2 book-hover-zoom"">
                            <a href="<?=site_url('library/detail_book?book_id='.$b->id)?>">
                                <img class="img-fluid" src="<?=base_url('assets/files/books/'.$b->cover)?>" alt="Image">
                            </a>
                            <p class="text-center"><b><?=$b->title?></b> 
                                <br> <small><?=$b->author?></small>
                                <br> <small><?=$b->number_page?> pages</small>
                            </p>                            
                        </div>
                <?php
                    }
                ?>
                    </div>
                </div>
            </div>             
        </div>
    </section>

     <!-- Modal form for a new book-->
     <div class="modal fade" id="newBookForm" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add a new Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=site_url('library/new_book')?>" method="post" class="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Titile</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-book"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Title" name="title">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Author</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-user-tie"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Author" name="author">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Number of pages</label>
                        <div class="input-group mb-2">

                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-paperclip"></i>
                                </div>
                            </div>

                            <input type="number" class="form-control text-right" name="number_page"
                            placeholder="Number of pages" required>

                            <div class="input-group-append">
                                <div class="input-group-text">Pages</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>ISBN</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-barcode"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="ISBN" name="isbn">
                        </div>
                    </div>

                    <div class="form-group">
                      <label>Cover</label>
                      <input type="file" class="form-control" name="cover" required>
                    </div>
                    
                    <input type="hidden" name="role" value="teacher">
                    <button type="submit" class="btn btn-outline-success btn-lg m-t-15 waves-effect">ADD</button>
                </form>
            </div>
            </div>
        </div>
    </div>
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