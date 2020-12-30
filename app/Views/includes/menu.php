<!-- START SIDEBAR-->
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="<?php echo base_url('/assets/img/admin-avatar.png'); ?>" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong"><?php echo $_SESSION['user_name']; ?></div><small><?php echo $_SESSION['user_email']; ?></small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <!-- <li>
                        <a href="<?= site_url('/notes') ?>"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li> -->
            <li class="heading">FEATURES</li>
            <li>
                <a href="<?= site_url('/notes') ?>"><i class="sidebar-item-icon ti-light-bulb"></i>
                    <span class="nav-label">Notes</span>
                </a>
            </li>
            <li>
                <a href="" data-toggle="modal" data-target="#labelModal"><i class="sidebar-item-icon fa fa-pencil"></i>
                    <span class="nav-label">Edit Labels</span>
                </a>
            </li>
            <li id="label_list">

            </li>
            <li>
                <a href="<?= site_url('/archive') ?>"><i class="sidebar-item-icon fa fa-archive"></i>
                    <span class="nav-label">Archive</span>
                </a>
            </li>
            <li>
                <a href="<?= site_url('/trash') ?>"><i class="sidebar-item-icon fa fa-trash"></i>
                    <span class="nav-label">Trash</span>
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

<!-- submitModal -->
<div class="modal fade" id="labelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Label</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_label">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeSubmit"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" name="submitDetail" class="btn btn-primary"><i class="fa fa-check-circle"></i> Save</button>
                </div>
            </form>
            <div class="modal-body">
                <div id="label_result">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->