<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url() ?>/asset/images/user.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo strtoupper($this->session->userdata(SESS_HD . 'user_name')); ?>
          - <i><?php echo strtoupper($this->session->userdata(SESS_HD . 'user_type')); ?></i></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online </a>

      </div>
    </div>

    <?php if ($this->session->userdata(SESS_HD . 'user_type') == 'Admin') { ?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Dashboard</li>
        <li <?php if ($this->uri->segment(1, 0) === 'dash')
          echo 'class="active"'; ?>><a
            href="<?php echo site_url('dash') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li
          class="treeview <?php if (in_array($this->uri->segment(1, 0), array('ams-asset-qrcode-list')))
            echo 'active'; ?>">
          <a href="#">
            <i class="fa fa-qrcode"></i> <span>Asset QR-Code</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if ($this->uri->segment(1, 0) === 'ams-asset-qrcode-list')
              echo 'class="active"'; ?>><a
                href="<?php echo site_url('ams-asset-qrcode-list/0') ?>"><i class="fa fa-qrcode"></i> Asset QR
                Generate</a></li>
          </ul>
        </li>

        <li
          class="treeview <?php if (in_array($this->uri->segment(1, 0), array('ams-category-list', 'ams-location-list', 'ams-asset-item-list')))
            echo 'active'; ?>">
          <a href="#">
            <i class="fa fa-bell"></i> <span>Masters</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if ($this->uri->segment(1, 0) === 'ams-category-list')
              echo 'class="active"'; ?>><a
                href="<?php echo site_url('ams-category-list/0') ?>"><i class="fa fa-briefcase"></i> Asset Category</a>
            </li>
            <li <?php if ($this->uri->segment(1, 0) === 'ams-location-list')
              echo 'class="active"'; ?>><a
                href="<?php echo site_url('ams-location-list/0') ?>"><i class="fa fa-briefcase"></i> Asset Location</a>
            </li>
            <li <?php if ($this->uri->segment(1, 0) === 'ams-asset-item-list')
              echo 'class="active"'; ?>><a
                href="<?php echo site_url('ams-asset-item-list/0') ?>"><i class="fa fa-briefcase"></i> Asset Items</a>
            </li>
          </ul>
        </li>

        <li class="header"></li>
        <li><a href="<?php echo site_url('change-password') ?>"><i class="fa fa-empire"></i> <span>Change
              Password</span></a></li>
        <li class="header"></li>
        <li><a href="<?php echo site_url('logout') ?>"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
      </ul>
    <?php } ?>

    <?php if ($this->session->userdata(SESS_HD . 'user_type') == 'Manager') { ?>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Dashboard</li>
      <li <?php if ($this->uri->segment(1, 0) === 'dash')
        echo 'class="active"'; ?>><a
          href="<?php echo site_url('dash') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li
        class="treeview <?php if (in_array($this->uri->segment(1, 0), array('ams-asset-qrcode-list')))
          echo 'active'; ?>">
        <a href="#">
          <i class="fa fa-qrcode"></i> <span>Asset QR-Code</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if ($this->uri->segment(1, 0) === 'ams-asset-qrcode-list')
            echo 'class="active"'; ?>><a
              href="<?php echo site_url('ams-asset-qrcode-list/0') ?>"><i class="fa fa-qrcode"></i> Asset QR
              Generate</a></li>
        </ul>
      </li>

      <li
        class="treeview <?php if (in_array($this->uri->segment(1, 0), array('ams-category-list', 'ams-location-list', 'ams-asset-item-list')))
          echo 'active'; ?>">
        <a href="#">
          <i class="fa fa-bell"></i> <span>Masters</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if ($this->uri->segment(1, 0) === 'ams-category-list')
            echo 'class="active"'; ?>><a
              href="<?php echo site_url('ams-category-list/0') ?>"><i class="fa fa-briefcase"></i> Asset Category</a>
          </li>
          <li <?php if ($this->uri->segment(1, 0) === 'ams-location-list')
            echo 'class="active"'; ?>><a
              href="<?php echo site_url('ams-location-list/0') ?>"><i class="fa fa-briefcase"></i> Asset Location</a>
          </li>
          <li <?php if ($this->uri->segment(1, 0) === 'ams-asset-item-list')
            echo 'class="active"'; ?>><a
              href="<?php echo site_url('ams-asset-item-list/0') ?>"><i class="fa fa-briefcase"></i> Asset Items</a>
          </li>
        </ul>
      </li>

      <li class="header"></li>
      <li><a href="<?php echo site_url('change-password') ?>"><i class="fa fa-empire"></i> <span>Change
            Password</span></a></li>
      <li class="header"></li>
      <li><a href="<?php echo site_url('logout') ?>"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
    </ul>

    <?php } ?>

    <?php if ($this->session->userdata(SESS_HD . 'user_type') == 'Staff') { ?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Dashboard</li>
        <li <?php if ($this->uri->segment(1, 0) === 'staff-dash')
          echo 'class="active"'; ?>><a
            href="<?php echo site_url('staff-dash') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li <?php if ($this->uri->segment(1, 0) === 'staff-calender')
          echo 'class="active"'; ?>><a
            href="<?php echo site_url('staff-calender') ?>"><i class="fa fa-calendar"></i> <span>Calendar</span></a></li>

        <li class="header">Help Desk</li>
        <li
          class="treeview <?php if (in_array($this->uri->segment(1, 0), array('hd-category-list', 'ticket', 'ticket-list')))
            echo 'active'; ?>">
          <a href="#">
            <i class="fa fa-ticket"></i> <span>Help Desk</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if ($this->uri->segment(1, 0) === 'ticket-list')
              echo 'class="active"'; ?>><a
                href="<?php echo site_url('ticket-list') ?>"><i class="fa fa-ticket"></i> Ticket List</a></li>
          </ul>
        </li>
        <!--<li class="header">Staff Payroll</li> 
            <li class="treeview <?php if (in_array($this->uri->segment(1, 0), array('leave-request', 'permission-request')))
              echo 'active'; ?>">
              <a href="#">
                <i class="fa fa-hand-paper-o"></i> <span>Attendance</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li <?php if ($this->uri->segment(1, 0) === 'leave-request')
                    echo 'class="active"'; ?>><a href="<?php echo site_url('leave-request') ?>"><i class="fa fa-envelope"></i> Leave Request  </a></li> 
                  <li <?php if ($this->uri->segment(1, 0) === 'permission-request')
                    echo 'class="active"'; ?>><a href="<?php echo site_url('permission-request') ?>"><i class="fa fa-envelope"></i> Permission Request  </a></li> 
               </ul>
            </li> -->
        <li class="header"></li>
        <li><a href="<?php echo site_url('change-password') ?>"><i class="fa fa-empire"></i> <span>Change
              Password</span></a></li>
        <li class="header"></li>
        <li><a href="<?php echo site_url('logout') ?>"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>

      </ul>
    <?php } ?>
  </section>
  <!-- /.sidebar -->
</aside>