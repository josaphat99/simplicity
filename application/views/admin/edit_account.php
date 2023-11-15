 <!-- Main Content -->
 <div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Account</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?=site_url('admin/edit_account')?>" method="post" class="">
                                <div class="form-group">
                                    <label>Full name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                            <i class="fas fa-user-tie"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Full name" name="fullname" value="<?=$account->fullname?>">
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
                                        <input type="text" class="form-control" placeholder="Email" name="email" value="<?=$account->email?>">
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
                                        <input type="text" class="form-control" placeholder="Phone number" name="phone" value="<?=$account->phone?>">
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
                                        <input type="text" class="form-control" placeholder="User name" name="username" value="<?=$account->username?>">
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
                                    <input type="password" class="form-control" placeholder="Password" name="password" value="<?=$account->password?>">
                                    </div>
                                </div>
                                <input type="hidden" name="role" value="<?=$account->role?>">
                                <input type="hidden" name="account_id" value="<?=$account->id?>">
                                <input type="hidden" name="option_id" value="<?=$option_id?>">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">SAVE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
