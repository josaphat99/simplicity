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
                                <i class="ti-arrow-up text-succes"></i> <?=count($pending_request)?>
                            </h3>
                            <span class="text-muted">Assignments</span>
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
                                <i class="ti-arrow-up text-success"></i> <?=count($pending_request)?>
                            </h3>
                            <span class="text-muted">Pending requests</span>
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
              <div class="col-lg-6 col-md-6 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Profile</h4>
                        <div class="card-header-action">
                            <a data-collapse="#profile-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="profile-collapse">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src=<?=base_url('assets/img/users/user-3.png')?> class="img-fluid"/>
                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <h4><?=$student->fullname?></h4>
                                    <p>
                                        Email : <?=$student->email?><br/>
                                        Tel : <?=$student->phone?><br/>
                                        Grade : <?=$student->grade?><br/>
                                        Option : <?=$student->name?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
                                        
                <!-- pending requests table -->
              <div class="col-lg-6 col-md-6 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Your pending requests</h4>
                        <div class="card-header-action">
                            <a data-collapse="#request-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="request-collapse">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr class="text-center">
                                        <th>Cover</th>
                                        <th>Title</th>
                                        <th>Requesting date</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($pending_request as $r)
                                            {
                                        ?>  
                                        <tr class="text-center">                                  
                                            <td><img class="img-fluid img-responsive" style="width:30px" src="<?=base_url('assets/files/books/'.$r->cover)?>"/></td>
                                            <td><?=$r->title?></td>
                                            <td><?=$r->date?></td>
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
                <div class="col-lg-6 col-md-6 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>You are reading the following books</h4>
                            <div class="card-header-action">
                                <a data-collapse="#issued-collapse" class="btn btn-icon btn-info" href="#"><i
                                class="fas fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="collapse show" id="issued-collapse">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr class="text-center">
                                            <th>Cover</th>
                                            <th>Title</th>
                                            <th>Issuing date</th>
                                            <th>Remaining days</th>
                                        </tr>
                                        <tbody>                 
                                            
                                            <?php
                                                foreach($issued_book as $ib)
                                                {
                                                    $today_date = date('d-m-Y',time());
                                                    $deadline = $ib->deadline;

                                                    $remaining_day = strtotime($deadline) - strtotime($today_date);
                                                    $remaining_day = abs($remaining_day/(60 * 60)/24);
                                            ?>  
                                            <tr class="text-center">                                  
                                                <td><img class="img-fluid img-responsive" style="width:30px" src="<?=base_url('assets/files/books/'.$ib->cover)?>"/></td>
                                                <td><?=$ib->title?></td>
                                                <td><?=$ib->issueing_date?></td>
                                                <td><?=$remaining_day?></td>
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

             <!-- events table -->
                <div class="col-lg-6 col-md-6 col-12 col-sm-12">
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