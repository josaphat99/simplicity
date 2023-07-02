<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"> <img alt="" src=<?=base_url("assets/img/logo/logo.jpeg")?> class="header-logo" /> <span class="logo-name">Simplicity</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header"><b><?=$this->session->role?></b></li>
            <?php

                if($this->session->role == 'admin')
                {
            ?>
                    <li class="dropdown active">
                        <a href="<?=site_url('admin/index')?>" class="nav-link">
                        &nbsp;&nbsp;<i data-feather="monitor"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="<?=site_url('admin/view_grade')?>" class="nav-link">
                            <i class="fas fa-graduation-cap"></i><span>Grades</span>
                        </a>
                    </li>
            <?php
                }else if($this->session->role == 'librarian'){
            ?>
                      <li class="dropdown active">
                        <a href="<?=site_url('library/index')?>" class="nav-link">
                        &nbsp;&nbsp;<i data-feather="monitor"></i><span>Dashboard</span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-book"></i><span>Books</span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="<?=site_url('library/view_book')?>">All books</a></li>
                            <li><a class="nav-link" href="<?=site_url('library/view_pending_request')?>">Pending requests</a></li>
                            <li><a class="nav-link" href="<?=site_url('library/view_issued_book')?>">Issued books</a></li>
                        </ul>
                    </li>
            <?php
                }
            ?>            
         
            <li class="dropdown">
                <a href="<?=site_url('admin/view_event')?>" class="nav-link">
                  &nbsp;  <i data-feather="film"></i><span>Events</span>
                </a>
            </li>                                  
        </ul>
    </aside>
</div>