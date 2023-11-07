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
    .term_link:hover{
        text-decoration:none;        
    }
    .term_card{
        transition-property: margin-left,margin-right;
        transition-duration: 0.5s;
    }
    .term_card:hover{
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
                    <a class="term_link" href="<?=site_url('teacher/list_test?term_id='.$term[0]->id)?>">
                        <div class="col-xl-6 col-lg-6 offset-md-2">
                            <div class="card l-bg-cyan term_card">
                                <div class="card-statistic-3">
                                    <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
                                    <div class="card-content">
                                    <h4 class="card-title text-center"><?=$term[0]->term?></h4>
                                    <?php
                                        $nb_test = $term[0]->nb_test;
                                        $data_width = $nb_test *100 /3;
                                    ?>
                                    <span><?=$nb_test?> test(s) out of 3</span>
                                    <div class="progress mt-1 mb-1" data-height="8">
                                        <div class="progress-bar l-bg-orange" role="progressbar" data-width=<?=$data_width.'%'?> aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax=3"></div>
                                    </div>
                                    <p class="mb-0 text-sm">
                                        <span class="mr-2"><i class="fa fa-arrow-up"></i></span>
                                        <span class="text-nowrap">Year, <?=$term[0]->year?></span>
                                    </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a class="term_link" href="<?=site_url('teacher/list_test?term_id='.$term[1]->id)?>">
                        <div class="col-xl-6 col-lg-6 offset-md-2">
                            <div class="card l-bg-green term_card">
                            <div class="card-statistic-3">
                                <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
                                <div class="card-content">
                                <h4 class="card-title text-center"><?=$term[1]->term?></h4>
                                <?php
                                    $n_test = $term[1]->nb_test;
                                    $d_width = $n_test *100 /3;
                                ?>
                                <span><?=$n_test?> test(s) out of 3</span>
                                <div class="progress mt-1 mb-1" data-height="8">
                                    <div class="progress-bar l-bg-purple" role="progressbar" data-width="<?=$d_width.'%'?>" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="3"></div>
                                </div>
                                <p class="mb-0 text-sm">
                                    <span class="mr-2"><i class="fa fa-arrow-up"></i></span>
                                    <span class="text-nowrap">Year, <?=$term[1]->year?></span>
                                </p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </a>

                    <a class="term_link" href="<?=site_url('teacher/list_test?term_id='.$term[2]->id)?>">
                        <div class="col-xl-6 col-lg-6 offset-md-2">
                            <div class="card l-bg-red term_card">
                            <div class="card-statistic-3">
                                <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
                                <div class="card-content">
                                <h4 class="card-title text-center"><?=$term[2]->term?></h4>
                                <?php
                                    $n_test = $term[2]->nb_test;
                                    $d_width = $n_test *100 /3;
                                ?>
                                <span><?=$n_test?> test(s) out of 3</span>
                                <div class="progress mt-1 mb-1" data-height="8">
                                    <div class="progress-bar l-bg-purple" role="progressbar" data-width="<?=$d_width.'%'?>" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="3"></div>
                                </div>
                                <p class="mb-0 text-sm">
                                    <span class="mr-2"><i class="fa fa-arrow-up"></i></span>
                                    <span class="text-nowrap">Year, <?=$term[2]->year?></span>
                                </p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </a>
                </div>
              </div>
            </div>
        </div>
    </section>
</div>