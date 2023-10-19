<?php
    if(($this->session->option_added))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Option added successfully!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->option_added = null;
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
                    <h4>Programs</h4>
                    <div class="card-header-action">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newOptionForm">
                         <i class="fas fa-plus"></i>&nbsp; New Program
                        </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tr class="text-center">
                          <th>Program</th>
                          <th>Total number of Students</th>
                          <th>Action</th>
                        </tr>
                        <tbody class="text-center">                 
                            
                            <?php
                                foreach($option as $o)
                                {
                            ?>  
                            <tr>                                  
                                <td><?=$o->name?></td>
                                <td><?=$o->student?></td>
                                <td class="media-cta">
                                    <a href="<?=site_url('admin/view_student?option_id='.$o->id)?>" class="btn btn-outline-primary">
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
    <div class="modal fade" id="newOptionForm" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add a new Option</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=site_url('admin/new_option')?>" method="post" class="">
                    <div class="form-group">
                        <label>Option name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i data-feather="menu"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Option" name="name">
                        </div>
                    </div>
                    <input type="hidden" name="grade_id" value="<?=$grade_id?>">
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">ADD</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>