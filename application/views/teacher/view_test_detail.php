<?php
    if(($this->session->point_recorded))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Points recorded successfully!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->point_recorded = null;
    }

    if(($this->session->point_not_recorded))
    {
?>
        <script>
            Swal.fire({            
            icon: 'warning',
            title: 'No point was provided!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->point_not_recorded = null;
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
                        <div class="card-header bg-info">
                            <h4 class="text-white">Test's Details</h4>

                            <div class="card-header-action">
                                <a data-collapse="#test-collapse" class="btn btn-icon btn-info" href="#"><i
                                class="fas fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="collapse show" id="test-collapse">
                            <div class="card-body">
                                </<>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h3>NORTHIRISE COMBINED SCHOOL OF EXCELLENCE</h3>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 offset-md-2">
                                        <p>
                                            <b>TEACHER</b> : <?=$test[0]->fullname?><br>
                                            <b>CLASS</b>: <?=$test[0]->grade?><br>
                                            <b>YEAR</b>: <?=$test[0]->year?>
                                        </p>
                                        <p>
                                            <b><?=$test[0]->description?></b>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>
                                            <b>DEPARTMENT</b> : <?=$test[0]->name?><br>
                                            <b>SUBJECT</b>: <?=$test[0]->course_title?><br>
                                            <b>TEST TITLE</b> : <?=$test[0]->title?>                                            
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>
                                            <b>TERM</b>: <?=$test[0]->term?><br>
                                            <b>MAX POINT</b>: <?=$test[0]->max_mark?>
                                            
                                        </p>
                                    </div>
                                </div>
                                <?php
                                    if($test[0]->status == 0)
                                    {
                                ?>                            
                                <div class="row">
                                    <div class="col-md-4 offset-md-4">
                                        <p class="alert alert-info text-center text-white">
                                            Grades are not yet provided!
                                        </p>

                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-success" id="provide_point">Provide points</button>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row animated fadeIn" id="provide_point_area" hidden>
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h4 class="text-white">Points Providing</h4>

                            <div class="card-header-action">
                                <a data-collapse="#point-collapse" class="btn btn-icon btn-info" href="#"><i
                                class="fas fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="collapse show" id="point-collapse">
                            <div class="card-body">
                                </<>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h5>Provide points for each student bellow </h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 offset-md-3">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <tr class="bg-info text-white text-center">
                                                    <th>N0</th>
                                                    <th>Full Name</th>
                                                    <th>Point</th>
                                                </tr>
                                                <tbody>                 
                                                    <form action="<?=site_url('teacher/record_point')?>" method="post">
                                                    <?php
                                                        $num = 0;
                                                        foreach($student as $s)
                                                        {
                                                            $num++;
                                                    ?>  
                                                    <tr class="text-center">                                  
                                                        <td><?=$num?></td>
                                                        <td><?=$s->fullname?></td>
                                                            
                                                        <td>
                                                            <input class="form-control" type="number" name="<?=$s->id_student?>" placeholder="Point">
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                    <input type="hidden" name="test_id" value="<?=$test[0]->id?>">
                                                </tbody>
                                            </table>
                                            <div class="col-md-12 text-center">
                                                <button type="submit" class="btn btn-success btn-lg">Save</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row animated fadeIn" id="student_grade" hidden>
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h4 class="text-white">Student Points</h4>

                            <div class="card-header-action">
                                <a data-collapse="#grade-collapse" class="btn btn-icon btn-info" href="#"><i
                                class="fas fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="collapse show" id="grade-collapse">
                            <div class="card-body">
                                </<>
                                <div class="row">
                                </div>
                                <div class="row">
                                    <div class="col-md-7 offset-md-3">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <tr class="bg-info text-white text-center">
                                                    <th>N0</th>
                                                    <th>Full Name</th>
                                                    <th>Point</th>
                                                </tr>
                                                <tbody>                 
                                                    <form action="<?=site_url('teacher/record_point')?>" method="post">
                                                    <?php
                                                        $num = 0;
                                                        foreach($student as $s)
                                                        {
                                                            $num++;
                                                    ?>  
                                                    <tr class="text-center">                                  
                                                        <td><?=$num?></td>
                                                        <td><?=$s->fullname?></td>
                                                            
                                                        <td>
                                                            <input class="form-control" type="number" name="<?=$s->id_student?>" placeholder="Point">
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                    <input type="hidden" name="test_id" value="<?=$test[0]->id?>">
                                                </tbody>
                                            </table>
                                            <div class="col-md-12 text-center">
                                                <button type="submit" class="btn btn-success btn-lg">Save</button>
                                            </div>
                                            </form>
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



<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script>
    $(function(){
        $('#provide_point').click(function(e){
            e.preventDefault();
            $("#provide_point_area").removeAttr('hidden');
        })
    })
</script>