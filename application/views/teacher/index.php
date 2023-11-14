<?php
    if(($this->session->test_added))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Test added successfully!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->test_added = null;
    }
?>

 <!-- Main Content -->
 <div class="main-content">
    <section class="section">
        <div class="section-body">
            <!-- insights -->            
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon l-bg-purple">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="padding-20">
                            <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-succes"></i> <?=count($ongoing_ass)?>
                            </h3>
                            <span class="text-muted">Uncorrected tests</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon l-bg-green">
                        <i class="fas fa-book"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="padding-20">
                            <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> <?=count($course)?>
                            </h3>
                            <span class="text-muted">Your courses</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon l-bg-cyan">
                            <i data-feather="film"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="padding-20">
                            <div class="text-right">
                            <h3 class="font-light mb-0">
                                <?=count($event)?>
                            </h3>
                            <span class="text-muted">Upcoming Events</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ongoing assignment -->
            <!-- <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ongoing Assignment</h4>
                        <div class="card-header-action">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newAssForm">
                            <i class="fas fa-plus"></i>&nbsp; New assignment
                            </button>&nbsp;&nbsp;
                        </div>
                        <div class="card-header-action">
                            <a data-collapse="#ass-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="ass-collapse">
                        <div class="card-body">
                            <?php
                                if(count($ongoing_ass) > 0){
                            ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr class="bg-info text-white text-center">
                                    <th>Title</th>
                                    <th>Starting date</th>
                                    <th>Due date</th>
                                    <th>Course</th>
                                    <th>Action</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($ongoing_ass as $o)
                                            {
                                        ?>  
                                        <tr>                                  
                                            <td><?=$o->title?></td>
                                            <td><?=$o->start_date?></td>
                                            <td><?=$o->end_date?></td>
                                            <td><?=$o->course_title?></td>
                                            <td>
                                                <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="View"><i
                                                    class="fas fa-eye"></i></a>
                                                <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                                                data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                                }else{
                            ?>
                                    <p class="text-center alert alert-light">Once you upload an assignment you will see it here!</p>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
              </div>
            </div> -->

               <!-- tests -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tests</h4>
                        <div class="card-header-action">&nbsp;&nbsp;
                        </div>
                        <div class="card-header-action">
                            <a data-collapse="#test-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="test-collapse">
                        <div class="card-body">
                            <?php
                                if(count($test) > 0)
                                {
                            ?>                            
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr class="bg-info text-white text-center">
                                    <th>Title</th>
                                    <th>Term</th>
                                    <th>Course</th>
                                    <th>Max Mark</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($test as $t)
                                            {
                                        ?>  
                                        <tr class="text-center">                                  
                                            <td><?=$t->title?></td>
                                            <td><?=$t->term?></td>
                                            <td><?=$t->course_title?></td>
                                            <td><?=$t->max_mark?></td>
                                            <td><?=$t->start_date?></td>
                                            <td>
                                                <a href="<?=site_url('teacher/view_test_detail?test_id='.$t->id)?>" class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="View"><i
                                                    class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <?php
                                }else{
                            ?>
                                <p class="text-center alert alert-light">Once you add a test you will see it here!</p>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            
             <!-- Courses & events -->
            <div class="row">
                <!--course-->
                <div class="col-lg-6 col-md-6 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Your courses</h4>
                            <div class="card-header-action">
                                <a data-collapse="#course-collapse" class="btn btn-icon btn-info" href="#"><i
                                class="fas fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="collapse show" id="course-collapse">
                            <div class="card-body">
                                <?php
                                    if(count($course) > 0)
                                    {
                                ?>                               
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tr class="bg-info text-white text-center">
                                            <th>Title</th>
                                            <th>Option</th>
                                            <th>Level</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                        <tbody>                 
                                            
                                            <?php
                                                foreach($course as $c)
                                                {
                                            ?>  
                                            <tr class="text-center">                                  
                                                <td><?=$c->title?></td>
                                                <td><?=$c->name?></td>
                                                <td><?=$c->grade?></td>
                                                <!-- <td>
                                                    <a class="btn btn-success btn-action" data-toggle="tooltip" title="View"><i
                                                        class="fas fa-eye"></i></a>
                                                </td> -->
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                                    }else{
                                ?>
                                        <p class="text-center alert alert-light">Your courses will be displayed here!</p>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

              <!--event-->
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
                                <?php
                                    if(count($event) > 0)
                                    {
                                ?>            
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tr class="bg-info text-white text-center">
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
                                <?php
                                    }
                                    else{
                                        ?>
                                        <p class="text-center alert alert-light">When the post a new event, you will see here!</p>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </section>

     <!--================forms area =======================-->

    <!-- Modal form for a new assignment-->
    <div class="modal fade" id="newAssForm" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">New Assignment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=site_url('teacher/new_teacher')?>" method="post" class="">
                    <div class="form-group">
                        <label>Title</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-user-tie"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Title" name="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Phone number</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-phone"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Phone number" name="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>User name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="User name" name="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                    </div>
                    <input type="hidden" name="role" value="teacher">
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">ADD</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
