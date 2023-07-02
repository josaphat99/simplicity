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
    }
?>

 <!-- Main Content -->
 <div class="main-content">
    <section class="section">
        <div class="section-body">
            <!-- insights -->            
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon l-bg-purple">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="padding-20">
                            <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-succes"></i> <?=count($book)?>
                            </h3>
                            <span class="text-muted">Books</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon l-bg-green">
                        <i class="fa fa-book-reader"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="padding-20">
                            <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> <?=count($request)?>
                            </h3>
                            <span class="text-muted">Requests</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon l-bg-red">
                        <i class="fas fa-book-open"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="padding-20">
                            <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> <?=count($issued_book)?>
                            </h3>
                            <span class="text-muted">Issued books</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon l-bg-cyan">
                            <i data-feather="film"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="padding-20">
                            <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> <?=count($event)?>
                            </h3>
                            <span class="text-muted">Events</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- book table -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Books</h4>
                        <div class="card-header-action">
                            <a data-collapse="#book-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="book-collapse">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                    <th>Cover</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Nb. Pages</th>
                                    <th>Action</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($book as $b)
                                            {
                                        ?>  
                                        <tr>                                  
                                            <td><img class="img-fluid img-responsive" style="width:30px" src="<?=base_url('assets/files/books/'.$b->cover)?>"/></td>
                                            <td><?=$b->title?></td>
                                            <td><?=$b->author?></td>
                                            <td><?=$b->number_page?></td>
                                            <td>
                                                <a href="<?=site_url('library/detail_book?book_id='.$b->id)?>" class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
                                        
            <!-- requests table -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pending requests</h4>
                        <div class="card-header-action">
                            <a data-collapse="#request-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="request-collapse">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                    <th>Cover</th>
                                    <th>Title</th>
                                    <th>Student</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($request as $r)
                                            {
                                        ?>  
                                        <tr>                                  
                                            <td><img class="img-fluid img-responsive" style="width:30px" src="<?=base_url('assets/files/books/'.$r->cover)?>"/></td>
                                            <td><?=$r->title?></td>
                                            <td><?=$r->fullname?></td>
                                            <td><?=$r->date?></td>
                                            <td>
                                                <a href="<?=site_url('library/detail_request_book?request_id='.$r->id)?>" class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>

             <!-- issued books table -->
             <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Latest Issued Books</h4>
                            <div class="card-header-action">
                                <a data-collapse="#issued-collapse" class="btn btn-icon btn-info" href="#"><i
                                class="fas fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="collapse show" id="issued-collapse">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                        <th>Cover</th>
                                        <th>Title</th>
                                        <th>Student</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                        </tr>
                                        <tbody>                 
                                            
                                            <?php
                                                foreach($issued_book as $ib)
                                                {
                                            ?>  
                                            <tr>                                  
                                                <td><img class="img-fluid img-responsive" style="width:30px" src="<?=base_url('assets/files/books/'.$ib->cover)?>"/></td>
                                                <td><?=$ib->title?></td>
                                                <td><?=$ib->fullname?></td>
                                                <td><?=$ib->date?></td>
                                                <td>
                                                    <a href="<?=site_url('library/detail_request_book?request_id='.$ib->id)?>" class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <!-- events table -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Events</h4>
                            <div class="card-header-action">
                                <a data-collapse="#event-collapse" class="btn btn-icon btn-info" href="#"><i
                                class="fas fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="collapse show" id="event-collapse">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                        </tr>
                                        <tbody>                 
                                            
                                            <?php
                                                foreach($event as $e)
                                                {
                                            ?>  
                                            <tr>                                  
                                                <td><img class="img-fluid img-responsive" style="width:30px" src="<?=base_url('assets/files/events/'.$e->image)?>"/></td>
                                                <td><?=$e->title?></td>
                                                <td><?=$e->category?></td>
                                                <td><?=$e->date?></td>
                                                <td>
                                                    <a href="<?=site_url('admin/detail_event?event_id='.$e->id)?>" class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>