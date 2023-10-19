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
                                        <b>CLASS</b>: <?=$test[0]->grade?>
                                    </p>
                                    <p>
                                        <b><?=$test[0]->description?></b>
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>DEPARTMENT</b> : <?=$test[0]->name?><br>
                                        <b>SUBJECT</b>: <?=$test[0]->course_title?>
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>TEST TITLE</b> : <?=$test[0]->title?><br>
                                        <b>YEAR</b>: <?=date('Y',time())?>
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
                                    <button class="btn btn-success">Provide points</button>
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
    </section>