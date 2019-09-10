<section class="sidebar">
  <div class="user-panel">
    <div class="pull-left image">
      <img src="<?php echo base_url('assets/adminlte/dist/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p><?php echo $this->session->lg_username; ?></p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
      <span class="input-group-btn">
        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
        </button>
      </span>
    </div>
  </form>
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN</li>
    <li class=""><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <li class=""><a href="<?php echo base_url('Main/Member') ?>"><i class="fa fa-user"></i> <span>Member</span></a></li>
    <li class=""><a href="<?php echo base_url('Main/GuildWar') ?>"><i class="fa fa-anchor"></i> <span>Guild War</span></a></li>
    <li class="header">Management</li>
    <li class=""><a href="<?php echo base_url('Management/User') ?>"><i class="fa fa-users"></i> <span>Pengguna</span></a></li>
  </ul>
</section>