<?php
    if(($this->session->grade_added))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Year added successfully!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->grade_added = null;
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
                    <h4>Years</h4>
                    <div class="card-header-action">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newYearForm">
                         <i class="fas fa-plus"></i>&nbsp; New Year
                        </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tr class="text-center">
                          <th>Year</th>
                          <th>Nb. of Programs</th>
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

    <!-- Modal form for a new option-->
    <div class="modal fade" id="newYearForm" tabindex="-1" role="dialog" aria-labelledby="formModal"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="formModal">Add a new Year</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form action="<?=site_url('admin/new_grade')?>" method="post" class="">
                  <div class="form-group">
                      <label>Year</label>
                      <div class="input-group">
                          <input type="text" class="form-control" placeholder="Year" name="grade">
                      </div>
                  </div>                  
                  <button type="submit" class="btn btn-primary m-t-15 waves-effect">ADD</button>
              </form>
          </div>
          </div>
      </div>
    </div>
</div>