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
              <!-- tests -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4><?=$term?></h4>
                        <div class="card-header-action">
                            <a href="<?=site_url('teacher/mark_schedule?term_id='.$term_id)?>" type="button" class="btn btn-info">
                            <i class="fas fa-book"></i>&nbsp;
                                View Mark Schedule
                            </a>&nbsp;&nbsp;
                        </div>

                        <?php
                            if($nb_test_term < 3)
                            {
                        ?>
                                 <div class="card-header-action">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newTestForm">
                                        <i class="fas fa-plus"></i>&nbsp; New Test
                                    </button>&nbsp;&nbsp;
                                </div>
                        <?php
                            }
                        ?>
                        
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
                                            <td><?=$t->course_title?></td>
                                            <td><?=$t->max_mark?></td>
                                            <td><?=$t->start_date?></td>

                                            <td>
                                                <a href="<?=site_url('teacher/view_test_detail?test_id='.$t->id)?>" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="View"><i
                                                    class="fas fa-eye"></i></a>
                                                <!-- <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                                                data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a> -->
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
                                    <p class="text-center alert alert-light">No test has been added in this term yet!</p>
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
      <!-- Modal form for a new test-->
      <div class="modal fade" id="newTestForm" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">New Test</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=site_url('teacher/new_test')?>" method="post" class="">
                    <!--title-->
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Title</label>
                        <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="title">
                        </div>
                    </div>
                    
                    <!--course-->
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Course</label>
                        <div class="col-sm-12 col-md-10">
                        <select class="form-control selectric" name="course_id">
                            <?php
                                foreach($course as $c)
                                {
                            ?>
                                    <option value=<?=$c->id?>><?=$c->title?></option>
                            <?php
                                }
                            ?>                        
                        </select>
                        </div>
                    </div>
                    
                    <!--description-->
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Description</label>
                        <div class="col-sm-12 col-md-10">
                        <textarea class="summernote-simple" name="description"></textarea>
                        </div>
                    </div>
                    
                    <!--Max mark-->
                    <!-- <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Max</label>
                        <div class="col-sm-12 col-md-10">
                            <input type="number" class="form-control" name="max_mark">
                        </div>
                    </div> -->
                    
                    <!--Date-->
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Date</label>
                        <div class="col-sm-12 col-md-10">
                            <input type="date" class="form-control" name="date">
                        </div>
                    </div>
                    <input type="hidden" name="term_id" value=<?=$term_id?>>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">ADD</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>