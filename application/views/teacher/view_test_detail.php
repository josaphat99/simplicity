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
                                    }else{
                                        ?>
                                <div class="row">
                                    <div class="col-md-4 offset-md-4">
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-success" id="view_statistic">View statistics</button>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                                <!--statistics area-->
                                <div id="statistic_area" class="row animated fadeIn" hidden>
                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-sm">
                                                <tr class="bg-info text-white text-center">
                                                    <th colspan="4">Participants</th>
                                                </tr>
                                                <tr class="bg-light text-center">
                                                    <th>Gender</th>
                                                    <th>N0 in Class</th>
                                                    <th>N0 Sat.</th>
                                                    <th>N0 Absent</th>
                                                </tr>
                                                <tbody>                 
                                                   <tr class="text-center">
                                                        <th>M</th>
                                                        <td><?=$count_male?></td>
                                                        <td><?=$male_sat?></td>
                                                        <td><?=$count_male - $male_sat?></td>
                                                   </tr>
                                                   <tr class="text-center">
                                                        <th>F</th>
                                                        <td><?=$count_female?></td>
                                                        <td><?=$female_sat?></td>
                                                        <td><?=$count_female - $female_sat?></td>
                                                   </tr>
                                                   <tr class="bg-light text-center">
                                                        <th>Total</th>
                                                        <td><?=$count_male + $count_female?></td>
                                                        <td><?=$male_sat + $female_sat?></td>
                                                        <td><?=($count_male - $male_sat) + ($count_female - $female_sat)?></td>
                                                   </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-sm">
                                                <tr class="bg-info text-white text-center">
                                                    <th colspan="8">Analysis</th>
                                                </tr>
                                                <tr class="bg-light text-center">                                                    
                                                    <th colspan="5">Passed</th>
                                                    <th>Failed</th>
                                                    <th colspan="2">Pass %</th>
                                                </tr>
                                                <tbody>                 
                                                   <tr class="bg-secondary text-center">
                                                        <th>Gender</th>
                                                        <th>A</th>
                                                        <th>B</th>
                                                        <th>C</th>
                                                        <th>D</th>
                                                        <th>E</th>
                                                        <th>A-B</th>
                                                        <th>C-D</th>
                                                   </tr>
                                                   <tr class="text-center">
                                                        <th>M</th>                                                        
                                                        <td><?=$tab_result['male_A']?></td>
                                                        <td><?=$tab_result['male_B']?></td>
                                                        <td><?=$tab_result['male_C']?></td>
                                                        <td><?=$tab_result['male_D']?></td>
                                                        <td><?=$tab_result['male_E']?></td>
                                                        <td><?=explode('.',$tab_result['male_pass_AB'])[0]?>%</td>
                                                        <td><?=explode('.',$tab_result['male_pass_CD'])[0]?>%</td>
                                                   </tr>
                                                   <tr class="text-center">
                                                        <th>F</th>
                                                        <td><?=$tab_result['female_A']?></td>
                                                        <td><?=$tab_result['female_B']?></td>
                                                        <td><?=$tab_result['female_C']?></td>
                                                        <td><?=$tab_result['female_D']?></td>
                                                        <td><?=$tab_result['female_E']?></td>
                                                        <td><?=explode('.',$tab_result['female_pass_AB'])[0]?>%</td>
                                                        <td><?=explode('.',$tab_result['female_pass_CD'])[0]?>%</td>
                                                   </tr>
                                                   <tr class="bg-light text-center">
                                                        <th>Total</th>
                                                        <td><?=$tab_result['male_A'] + $tab_result['female_A'] ?></td>
                                                        <td><?=$tab_result['male_B'] + $tab_result['female_B'] ?></td>
                                                        <td><?=$tab_result['male_C'] + $tab_result['female_C'] ?></td>
                                                        <td><?=$tab_result['male_D'] + $tab_result['female_D'] ?></td>
                                                        <td><?=$tab_result['male_E'] + $tab_result['female_E'] ?></td>
                                                   </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--proving points to each student-->
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
                                        <h6>Provide points for each student bellow leave blank for absent students</h6>
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

            <!--Student grades displayed after the teacher provides the points-->
            <?php
                if(count($result_test) > 0)
                {
            ?>
            <div class="row" id="student_grade">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h4 class="text-white">Class list</h4>

                            <div class="card-header-action">
                                <a data-collapse="#grade-collapse" class="btn btn-icon btn-info" href="#"><i
                                class="fas fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="collapse show" id="grade-collapse">
                            <div class="card-body">
                                </<>
                                <!-- <div class="row">
                                </div> -->
                                <div class="row">
                                    <div class="col-md-7 offset-md-2">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <tr class="bg-info text-white text-center">
                                                    <th>N0</th>
                                                    <th>Full Name</th>
                                                    <th>Obtained Point</th>
                                                    <th>Points in %</th>
                                                    <th>Note</th>
                                                </tr>
                                                <tbody>                 
                                                    <?php
                                                        $num = 0;
                                                        foreach($result_test as $r)
                                                        {
                                                            $num++;

                                                            $note = 'E';
                                                            $percent = 0;

                                                            if($r->mark != null)
                                                            {
                                                                $percent = $r->mark * 100 / $r->max_mark;

                                                                if($percent >= 45 && $percent <= 54)
                                                                {
                                                                    $note = 'D';
                                                                }else if($percent >= 55 && $percent <= 64)
                                                                {
                                                                    $note = 'C';
                                                                }
                                                                else if($percent >= 65 && $percent <= 74)
                                                                {
                                                                    $note = 'B';
                                                                }else if($percent >= 75 && $percent <= 100)
                                                                {
                                                                    $note = 'A';
                                                                }
                                                            }
                                                    ?>  
                                                    <tr class="text-center">                                  
                                                        <td><?=$num?></td>
                                                        <td><?=$r->fullname?></td>
                                                        <td><?=$r->mark!=null?$r->mark:'<span style="color:red;font-weight:bold">Absent</span>'?></td>
                                                        <td><?=$percent?>%</td>
                                                        <td><?=$note?></td>
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
            </div>
            <?php
                }
            ?>
        </div>
    </section>



<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script>
    $(function(){
        $('#provide_point').click(function(e){
            e.preventDefault();
            $("#provide_point_area").removeAttr('hidden');
        })

        $('#view_statistic').click(function(e){
            e.preventDefault();

            $("#view_statistic").attr('hidden',true);
            $("#statistic_area").removeAttr('hidden');
        })
    })
</script>