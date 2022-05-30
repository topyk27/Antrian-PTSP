<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="<?php echo base_url(); ?>" class="nav-link" id="sidebar_dashboard">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
      </a>
    </li>   
    <li class="nav-item">
      <a href="<?php echo base_url('antrian'); ?>" class="nav-link" id="sidebar_antrian">
        <i class="nav-icon fas fa-list"></i>
        <p>Antrian</p>
      </a>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link" id="sidebar_setting">
        <i class="nav-icon fas fa-cog"></i>
        <p>Pengaturan<i class="fas fa-angle-left right"></i></p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url('setting/user'); ?>" class="nav-link" id="sidebar_setting_user">
            <i class="nav-icon far fa-user"></i>
            <p>Pengguna</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('setting/sistem'); ?>" class="nav-link" id="sidebar_setting_sistem">
            <i class="nav-icon fas fa-rocket"></i>
            <p>Sistem</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="<?php echo base_url('about'); ?>" class="nav-link" id="sidebar_about">
        <i class="nav-icon fas fa-info-circle"></i>
        <p>About</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link" onclick="modal_logout();">
        <i class="nav-icon fas fa-power-off"></i>
        <p>Keluar</p>
      </a>
    </li>
</nav>
<script type="text/javascript" src="https://uprimp.com/bnr.php?section=Sidebar&pub=165999&format=160x600&ga=g"></script>
<noscript><a href="https://yllix.com/publishers/165999" target="_blank"><img src="//ylx-aff.advertica-cdn.com/pub/160x600.png" style="border:none;margin:0;padding:0;vertical-align:baseline;" alt="ylliX - Online Advertising Network" /></a></noscript>