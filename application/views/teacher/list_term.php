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
              <!-- terms -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card-body">
                    <a href="<?=site_url('teacher/list_test?term_id='.$term[0]->id)?>">
                        <div class="col-xl-6 col-lg-6 offset-md-2">
                            <div class="card l-bg-cyan">
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
                                    <span class="mr-2"><i class="fa fa-arrow-up"></i> <?=explode('.',$data_width)[0]?>%</span>
                                    <span class="text-nowrap">Year, <?=$term[0]->year?></span>
                                </p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </a>

                    <a href="<?=site_url('teacher/list_test?term_id='.$term[1]->id)?>">
                        <div class="col-xl-6 col-lg-6 offset-md-2">
                            <div class="card l-bg-green">
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
                                    <span class="mr-2"><i class="fa fa-arrow-up"></i> <?=explode('.',$d_width)[0]?>%</span>
                                    <span class="text-nowrap">Year, <?=$term[1]->year?></span>
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