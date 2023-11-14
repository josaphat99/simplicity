<?php
    if(($this->session->student_added))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Student added successfully!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->student_added = null;
    }
?>

 <!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            
            <!-- student table -->
            <div class="row">
              <div class="col-lg-10 col-md-10 offset-md-1 col-12 col-sm-12">
                <p>Click on the eye icon to view all the tests in a specific course</p>
                <div class="card">
                  <div class="card-header">
                    <h4 class="text-center">Courses in <?=$option_name.' '.$grade?></h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                          <tr class="bg-info text-white">
                            <th>N0</th>
                            <th>Title</th>
                            <th>Teacher</th>
                            <th>Action</th>
                          </tr>
                          <tbody>                 
                              
                              <?php
                                  $num = 0;

                                  foreach($course as $c)
                                  {
                                      $num++;
                              ?>  
                              <tr>                                  
                                  <td><?=$num?></td>
                                  <td><?=$c->title?></td>
                                  <td><?=$c->fullname?></td>
                                  <td>
                                      <a href="<?=site_url('student/view_test?course_id='.$c->id_course)?>" class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="View">
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
    </section>
</div>
    