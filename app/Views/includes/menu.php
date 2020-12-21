<!-- START SIDEBAR-->
<nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="<?php echo base_url('/assets/img/admin-avatar.png');?>" width="45px" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong"><?php echo $_SESSION['user_name'];?></div><small><?php echo $_SESSION['user_email'];?></small></div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a href="<?= site_url('/notes') ?>"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="heading">FEATURES</li>
                    <li>
                        <a href="<?= site_url('/notes') ?>"><i class="sidebar-item-icon fa fa-file-text"></i>
                            <span class="nav-label">Notes</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('/labels') ?>"><i class="sidebar-item-icon fa fa-edit"></i>
                            <span class="nav-label">Labels</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('/logout') ?>"><i class="sidebar-item-icon fa fa-sign-out"></i>
                            <span class="nav-label">Logout</span>
                        </a>
                    </li>
                    
                </ul>
            </div>
        </nav>
        <!-- END SIDEBAR-->