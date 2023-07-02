<?php
    if(($this->session->book_issued))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Book issued successfully!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->book_issued = null;
    }
?>
 <!-- Main Content -->
 <div class="main-content">
    <section class="section">
        <div class="section-body">
             <!-- pending request table -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Issued books</h4>
                        <div class="card-header-action">
                            <a data-collapse="#book-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="book-collapse">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>Requesting date</th>
                                        <th>Book Cover</th>
                                        <th>Book Title</th>
                                        <th>Student Name</th>
                                        <th>Issueing date</th>
                                        <th>DeadLine</th>
                                        <th>Remaining days</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($request as $r)
                                            {
                                                $today_date = date('d-m-Y',time());
                                                $deadline = $r->deadline;

                                                $remaining_day = strtotime($deadline) - strtotime($today_date);
                                                $remaining_day = abs($remaining_day/(60 * 60)/24);
                                        ?>  
                                        <tr>       
                                            <td><?=$r->date?></td>                           
                                            <td class="text-center"><img class="img-fluid img-responsive" style="width:30px" src="<?=base_url('assets/files/books/'.$r->cover)?>"/></td>
                                            <td><?=$r->title?></td>
                                            <td><?=$r->fullname?></td>
                                            <td><?=$r->issueing_date?></td>
                                            <td><?=$deadline?></td>
                                            <td class="text-center"><?=$remaining_day?></td>
                                            <td>
                                                <a href="<?=site_url('library/return_book?request_id='.$r->id)?>" class="btn btn-success btn-action" data-toggle="tooltip" title="return">
                                                    Book returned
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