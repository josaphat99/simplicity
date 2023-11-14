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
                        <h4><?=$course_title.' '?> Tests</h4>
                        <!-- <div class="card-header-action">
                            <a href="#" type="button" class="btn btn-info">
                            <i class="fas fa-book"></i>&nbsp;
                                View Mark Schedule
                            </a>&nbsp;&nbsp;
                        </div> -->

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
                                <table class="table table-striped table-bordered table-sm">
                                    <tr class="bg-info text-white text-center">
                                        <th>Title</th>                                        
                                        <th>Max Mark</th>
                                        <th>Date</th>     
                                        <th>Term</th>                           
                                        <th>Action</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($test as $t)
                                            {
                                        ?>  
                                        <tr class="text-center">                                  
                                            <td><?=$t->title?></td>                                            
                                            <td><?=$t->max_mark?></td>
                                            <td><?=$t->start_date?></td>
                                            <td><?=$t->term?></td>
                                            <td>
                                                <a href="<?=site_url('student/view_grade?test_id='.$t->id)?>" class="btn btn-success btn-action btn-sm mr-1 view_btn" id=<?="view_btn-".$t->id?>
                                                data-toggle="modal" data-target="#gradeModal" titre="<?=$t->title?>"  term="<?=$t->term?>"  max_mark="<?=$t->max_mark?>" title="View Grade">
                                                <i class="fas fa-eye view_btn" id=<?="view_icon-".$t->id?> titre="<?=$t->title?>" term="<?=$t->term?>" max_mark="<?=$t->max_mark?>"></i>
                                                </a>
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
                                    <p class="text-center alert alert-light">No test has been added for this course yet!</p>
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

        <!-- view grade modal -->
        <div class="modal fade" id="gradeModal" tabindex="-1" role="dialog"
          aria-labelledby="gradeModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gradeModalCenterTitle">Modal title</h5>                
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="grade_space">               
                </div>
            </div>
        </div>
    </div>      
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script>
    $(function(){
        $('.view_btn').click(function(e){
            e.preventDefault();

            var id = e.target.getAttribute('id').split('-')[1];
            var titre = e.target.getAttribute('titre');
            var term = e.target.getAttribute('term');
            var max = e.target.getAttribute('max_mark');

            $("#gradeModalCenterTitle").html(titre+', '+term);

            $.post('<?=site_url("ajax/view_grade")?>',{test_id:id,max_mark:max},function(data)
            {
                $("#grade_space").html(data);
            })
        })
    })
</script>