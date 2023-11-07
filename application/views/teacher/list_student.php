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
                    <h4>Students in <?=$department_name?></h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tr class="text-white bg-info">
                          <th>Full name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Gender</th>
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
</div>
    