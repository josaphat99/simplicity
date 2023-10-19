 <!-- Main Content -->
 <div class="main-content">
    <section class="section">
        <div class="section-body">
             <!-- pending request table -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>5 latest requests</h4>
                        <div class="card-header-action">
                            <a data-collapse="#book-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="book-collapse">
                        <div class="card-body">
                            <div class="row">                            
                                <div class="col-md-3">
                                    <p><img class="img-fluid img-responsive" src="<?=base_url('assets/files/books/'.$request[0]->cover)?>"/></p>
                                </div>
                                <div class="col-md-3">
                                    <br><br><br>
                                    <h4><?=$request[0]->title?></h4>
                                    <p class="text-center"><b>by <?=$request[0]->author?></b>                                      
                                        <br> <small><?=$request[0]->number_page?> Pages</small>
                                        <br><small>ISBN <span class="fas fa-barcode"></span> <?=$request[0]->isbn?></small>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <tr class="text-center">
                                                <th>Date</th>                                                
                                                <th>Student Name</th>
                                                <th>Status</th>
                                            </tr>
                                            <tbody>                 
                                                
                                                <?php
                                                    foreach($request as $r)
                                                    {
                                                        $status = '';

                                                        if($r->status == 2)
                                                        {
                                                            $status = "Was rejected";
                                                        }elseif($r->status == 3)
                                                        {
                                                            $status = "Was issued";
                                                        }
                                                ?>  
                                                <tr class="text-center">       
                                                    <td><?=$r->date?></td>                                                    
                                                    <td><?=$r->fullname?></td>
                                                    <td><?=$status?></td>
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
            </div>
        </div>
    </section>
</div>