<?php
    if(($this->session->request_canceled))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Request Canceled!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->request_canceled = null;
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
                        <h4>Your pending requests</h4>
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
                                        <th>Date</th>
                                        <th>Book Cover</th>
                                        <th>Book Title</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($request as $r)
                                            {
                                        ?>  
                                        <tr>       
                                            <td><?=$r->date?></td>                           
                                            <td><img class="img-fluid img-responsive" style="width:30px" src="<?=base_url('assets/files/books/'.$r->cover)?>"/></td>
                                            <td><?=$r->title?></td>
                                            <td class="text-center">
                                                <a href="<?=site_url('student/cancel_request?request_id='.$r->id.'&action=issue')?>" class="btn btn-success btn-action" data-toggle="tooltip" title="issue">
                                                    Cancel
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