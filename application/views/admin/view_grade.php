<?php
    if(($this->session->user_added))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'User added successfully!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->user_added = null;
    }
?>

 <!-- Main Content -->
 <div class="main-content">
    <section class="section">
        <div class="section-body">
           

            <!-- grade table -->
            <div class="row">
              <div class="col-lg-8 offset-lg-2 col-md-12 col-12 col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Grades</h4>
                    <!-- <div class="card-header-action">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newTeacherForm">
                         <i class="fas fa-plus"></i>&nbsp; New grade
                        </button>
                    </div> -->
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tr class="text-center">
                          <th>Grade</th>
                          <th>Nb. of Options</th>
                          <th>Total number of Students</th>
                          <th>Action</th>
                        </tr>
                        <tbody class="text-center">                          
                            <?php
                                foreach($grade as $g)
                                {
                            ?>  
                            <tr>                                  
                                <td><?=$g->grade?></td>
                                <td><?=$g->option?></td>
                                <td><?=$g->student?></td> 
                                <td class="media-cta">
                                    <a href="<?=site_url('admin/view_option?grade_id='.$g->id)?>" class="btn btn-outline-primary">
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