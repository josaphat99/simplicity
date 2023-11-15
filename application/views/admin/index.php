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
    if(($this->session->user_edited))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'User Edited successfully!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->user_edited = null;
    }
    if(($this->session->user_deleted))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'User Deleted successfully!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->user_deleted = null;
    }
?>

 <!-- Main Content -->
 <div class="main-content">
    <section class="section">
        <div class="section-body">
            <!-- insights -->            
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon l-bg-purple">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="padding-20">
                            <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-succes"></i> <?=count($teacher)?>
                            </h3>
                            <span class="text-muted">Teachers</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon l-bg-green">
                        <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="padding-20">
                            <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> <?=count($student)?>
                            </h3>
                            <span class="text-muted">Students</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon l-bg-cyan">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="padding-20">
                            <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> <?=count($finance)?>
                            </h3>
                            <span class="text-muted">Financials</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon l-bg-orange">
                        <i class="fa fa-book"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="padding-20">
                            <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i><?=count($librarian)?>
                            </h3>
                            <span class="text-muted">Librarians</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- teacher table -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Teachers</h4>
                        <div class="card-header-action">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newTeacherForm">
                            <i class="fas fa-plus"></i>&nbsp; New teacher
                            </button>&nbsp;&nbsp;
                        </div>
                        <div class="card-header-action">
                            <a data-collapse="#teacher-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="teacher-collapse">
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
                                        foreach($teacher as $t)
                                        {
                                    ?>  
                                    <tr>                                  
                                        <td><?=$t->fullname?></td>
                                        <td><?=$t->email?></td>
                                        <td><?=$t->phone?></td>
                                        <td><?=$t->gender?></td>
                                        <td>
                                            <a href="<?=site_url('admin/edit_account?account_id='.$t->id)?>" class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="Edit"><i
                                                class="fas fa-pen"></i></a>

                                            <form action="<?=site_url('admin/delete_user')?>" method="post" id="<?='form_delete_'.$t->id?>" style="float:right;margin-left:-70px">
                                                <input type="hidden" value="<?=$t->id?>" name="user_id" hidden>
                                                <button class="btn btn-danger btn_delete" type="submit" id="<?='btn_delete-'.$t->id?>">
                                                    <i class="fas fa-trash-alt btn_delete" id="<?='icon_delete-'.$t->id?>"></i>
                                                </button>
                                            </form>
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

            <!-- Financial table -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Financials</h4>
                            <div class="card-header-action">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newFinancialForm">
                                <i class="fas fa-plus"></i>&nbsp; New financial
                                </button>&nbsp;&nbsp;
                            </div>
                            <div class="card-header-action">
                                <a data-collapse="#financial-collapse" class="btn btn-icon btn-info" href="#"><i
                                class="fas fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="collapse show" id="financial-collapse">
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
                                            foreach($finance as $f)
                                            {
                                        ?>  
                                        <tr>                                  
                                            <td><?=$f->fullname?></td>
                                            <td><?=$f->email?></td>
                                            <td><?=$f->phone?></td>
                                            <td><?=$f->gender?></td>
                                            <td>
                                                <a href="<?=site_url('admin/edit_account?account_id='.$f->id)?>" class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="Edit"><i
                                                    class="fas fa-pen"></i></a>

                                                <form action="<?=site_url('admin/delete_user')?>" method="post" id="<?='form_delete_'.$f->id?>" style="float:right;margin-left:-70px">
                                                    <input type="hidden" value="<?=$f->id?>" name="user_id" hidden>
                                                    <button class="btn btn-danger btn_delete" type="submit" id="<?='btn_delete-'.$f->id?>">
                                                        <i class="fas fa-trash-alt btn_delete" id="<?='icon_delete-'.$f->id?>"></i>
                                                    </button>
                                                </form>
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

            <!-- Librarian table -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Librarians</h4>
                            <div class="card-header-action">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newLibrarianForm">
                                <i class="fas fa-plus"></i>&nbsp; New librarian
                                </button>&nbsp;&nbsp;
                            </div>
                            <div class="card-header-action">
                                <a data-collapse="#librarian-collapse" class="btn btn-icon btn-info" href="#"><i
                                class="fas fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="collapse show" id="librarian-collapse">
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
                                            foreach($librarian as $l)
                                            {
                                        ?>  
                                        <tr>                                  
                                            <td><?=$l->fullname?></td>
                                            <td><?=$l->email?></td>
                                            <td><?=$l->phone?></td>
                                            <td><?=$l->gender?></td>
                                            <td>
                                                <a href="<?=site_url('admin/edit_account?account_id='.$l->id)?>" class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="Edit"><i
                                                    class="fas fa-pen"></i></a>

                                                <form action="<?=site_url('admin/delete_user')?>" method="post" id="<?='form_delete_'.$l->id?>" style="float:right;margin-left:-70px">
                                                    <input type="hidden" value="<?=$l->id?>" name="user_id" hidden>
                                                    <button class="btn btn-danger btn_delete" type="submit" id="<?='btn_delete-'.$l->id?>">
                                                        <i class="fas fa-trash-alt btn_delete" id="<?='icon_delete-'.$l->id?>"></i>
                                                    </button>
                                                </form>
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

     <!--================forms area =======================-->

    <!-- Modal form for a new teacher-->
    <div class="modal fade" id="newTeacherForm" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add a new Teacher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=site_url('admin/new_user')?>" method="post" class="">
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
                        <select class="form-control selectric" name="gender">
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

    <!-- Modal form for a new financial-->
    <div class="modal fade" id="newFinancialForm" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add a new Financial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=site_url('admin/new_user')?>" method="post" class="">
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
                        <select class="form-control selectric" name="gender">
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
                    <input type="hidden" name="role" value="finance">
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">ADD</button>
                </form>
            </div>
            </div>
        </div>
    </div>

     <!-- Modal form for a new librarian-->
     <div class="modal fade" id="newLibrarianForm" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add a new Librarian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=site_url('admin/new_user')?>" method="post" class="">
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
                        <select class="form-control selectric" name="gender">
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
                    <input type="hidden" name="role" value="librarian">
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">ADD</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script>
    $(".btn_delete").click(function(e){
        e.preventDefault();
        
        var id = e.target.getAttribute('id').split('-')[1];            

        Swal.fire({
        title: 'Do you realy want to delete this User?',
        text: "You won't be able to undo this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Deleted!',
                'User deleted.',
                'success'
                )
                $("#form_delete_"+id).submit();
            }
        })
    })
</script>