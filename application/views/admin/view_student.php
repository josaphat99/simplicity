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
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Students in <?=$option_name?></h4>
                    <div class="card-header-action">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newStudentForm">
                         <i class="fas fa-plus"></i>&nbsp; New student
                        </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tr>
                          <th>Full name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Gender</th>
                          <th>Action</th>
                        </tr>
                        <tbody>                 
                            
                            <?php
                                foreach($student as $s)
                                {
                            ?>  
                            <tr>                                  
                                <td><?=$s->fullname?></td>
                                <td><?=$s->email?></td>
                                <td><?=$s->phone?></td>
                                <td><?=$s->gender?></td>
                                <td>
                                    <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i
                                        class="fas fa-pencil-alt"></i></a>
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
                  </div>
                </div>
              </div>
            </div>
        </div>
    </section>

    <!-- Modal form for a new student-->
    <div class="modal fade" id="newStudentForm" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Add a new Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?=site_url('admin/new_student')?>" method="post" class="">
                        <div class="form-group">
                            <label>Full name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <i class="fas fa-user-tie"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" placeholder="Full name" name="fullname">
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
                        <input type="hidden" name="role" value="student">
                        <input type="hidden" name="grade_id" value=<?=$grade_id?>>
                        <input type="hidden" name="option_id" value=<?=$option_id?>>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    