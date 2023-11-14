            <!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <!--Details-->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h4 class="text-white text-center">NORTHIRISE COMBINED SCHOOL OF EXCELLENCE</h4>

                            <div class="card-header-action">
                                <a data-collapse="#test-collapse" class="btn btn-icon btn-info" href="#"><i
                                class="fas fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="collapse show" id="test-collapse">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 text-center">                                    
                                        <h3 class="text-center">MARK SCHEDULE</h3>
                                        <hr>
                                    </div>
                                </div>

                                <?php
                                    if(count($test_term) > 0){
                                ?>                               
                                <div class="row">
                                    <div class="col-md-3 offset-md-2">
                                        <p>
                                            <b>TEACHER</b> : <?=$teacher_name?><br>
                                            <b>CLASS</b>: <?=$test_term[0]->grade?><br>
                                            <b>YEAR</b>: <?=$test_term[0]->year?>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>
                                            <b>DEPARTMENT</b> : <?=$test_term[0]->department?><br>
                                            <b>SUBJECT</b>: <?=$test_term[0]->course_title?><br>                                         
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>
                                            <b>TERM</b>: <?=$term?><br>                                        
                                        </p>
                                    </div>
                                </div> 
                                <?php
                                    }else{
                                ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="alert alert-danger text-center text-white">No Available Mark schedule!</p>
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
            
            <!--mark schdule table-->
            <?php
                if(count($test_term) > 0)
                {
            ?> 
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-sm">
                        <tr class="text-white bg-info text-center">
                          <th>S/N</th>
                          <th>Names</th>
                          <th>Sex</th>
                          <th>T1</th>
                          <th>Analysis</th>
                          <th>T2</th>
                          <th>Analysis</th>
                          <th>EOT</th>
                          <th>Analysis</th>
                        </tr>
                        <tbody>                 
                            
                            <?php
                                $count = 0;
                                foreach($student as $s)
                                {
                                    if(in_array($s->id_student,$student_tab))
                                    {
                                   
                                    $count++;
                            ?>  
                            <tr class="text-center">                
                                <td><?=$count?></td>                  
                                <td><?=$s->fullname?></td>
                                <td><?=$s->gender=='male'?'M':'F'?></td>
                                <?php
                                    $note = "";

                                    foreach($s->tab as $title => $mark)
                                    {
                                        if($mark != null)
                                        {          
                                        $mark_percent = $mark * 100 / $s->mark[$title.'_mark_'.$s->id_student];   
                                        $mark_percent = explode('.',$mark_percent)[0];                           
                                ?>  
                                        <td><?=$mark_percent?></td>
                                <?php                                        
                                        if($mark_percent >= 45 && $mark_percent <= 54)
                                        {
                                            $note = 'D';
                                        }else if($mark_percent >= 55 && $mark_percent <= 64)
                                        {
                                            $note = 'C';
                                        }
                                        else if($mark_percent >= 65 && $mark_percent <= 74)
                                        {
                                            $note = 'B';
                                        }else if($mark_percent >= 75 && $mark_percent <= 100)
                                        {
                                            $note = 'A';
                                        }
                                        else if($mark_percent >= 0 && $mark_percent <= 44)
                                        {
                                            $note = 'E';
                                        }
                                ?>
                                        <td><?=$note?></td>
                                <?php
                                        }else{
                                ?>
                                            <td><?=0?></td>
                                            <td><?="E"?></td>
                                <?php
                                        }
                                    }
                                ?>                                
                            </tr>
                            <?php
                                }
                            }
                            ?>                            
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
                }
            ?>