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

<style>
    .department_link:hover{
        text-decoration:none;        
    }
    .department_card{
        transition-property: margin-left,margin-right;
        transition-duration: 0.5s;
    }
    .department_card:hover{
        margin-left:10px;
        margin-right:10px;
    }    
</style>
 <!-- Main Content -->
 <div class="main-content">
    <section class="section">
        <div class="section-body">
              <!-- terms -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card-body">
                    <p class="text-center alert alert-light">Here are the departments in which you have at least one course</p>
                       <br>
                    <?php
                        foreach($department as $d)
                        {
                    ?>                    
                        <a class="department_link" href="<?=site_url('teacher/list_student?department_id='.$d->id_option.'&grade='.$d->grade)?>">
                            <div class="col-xl-6 col-lg-6 offset-md-2">
                                <div class="card l-bg-cyan department_card">
                                    <div class="card-statistic-3">
                                        <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
                                        <div class="card-content">
                                        <h4 class="card-title text-center"><?=$d->name?></h4>
                                        <p class="mb-0 text-sm">
                                            <span class="mr-2"><i class="fa fa-arrow-up"></i></span>
                                            <span class="text-nowrap"><?=$d->grade.' | '.$d->nb_student.' students'?></span>
                                        </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php
                        }
                    ?>
                </div>
              </div>
            </div>
        </div>
    </section>
</div>