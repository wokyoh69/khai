<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->

    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="<?php echo base_url(); ?>assets/images/icon.png" type="image/icon type">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>

    <style>
      .error{
        color:red;
        font-weight: normal;
      }
    </style>

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
    var baseURL = "<?php echo base_url(); ?>";
</script>

<!-- CK Editor -->
<script src="<?php echo base_url(); ?>assets/plugins/ckeditorv2/ckeditor.js"></script>
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<!-- Date Picker -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
<style>
.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}
.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}
</style>
<!-- End Date Picker -->




  </head>
  <body class="skin-black sidebar-mini">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>KR</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="<?php echo base_url(); ?>assets/images/<?= $logo_url; ?>" width="200"> </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                  <i class="fa fa-history"></i>
                </a>
                <ul class="dropdown-menu">
                  <li class="header"> Last Login : <i class="fa fa-clock-o"></i> <?= empty($last_login) ? "First Time Login" : $last_login; ?></li>
                </ul>
              </li>

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>assets/images/<?= $profile_url; ?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $name; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url(); ?>assets/images/<?= $profile_url; ?>" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $name; ?>
                      <small><?php echo $role_text; ?></small>

                    </p>
                  </li>
                  <!-- Menu Footer <a class="btn btn-sm btn-info" href="<?php echo base_url().'editUsers/'.$record->userId; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url(); ?>loadChangePass" class="btn btn-danger"><i class="fa fa-key"></i> Katalaluan</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>loadChangeProfile" class="btn btn-success"><i class="fa fa-profile"></i> Maklumat Akaun</a>
                      <!--<a href="<?php echo base_url(); ?>loadAccount" class="btn btn-success"><i class="fa fa-profile"></i> Maklumat Akaun</a>-->
                    </div>
                  </li>
                </ul>
              </li>

              <li class="dropdown tasks-menu">
                <a href="<?php echo base_url(); ?>logout" aria-expanded="true">
                  <i class="fa fa-sign-out"></i>
                </a>
              </li>

            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <!-- search form -->
      <!--<form action="<?php echo base_url() ?>userListing" method="POST" class="sidebar-form" id="searchList">
        <div class="input-group">
          <input type="text" name="searchText" class="form-control" placeholder="Carian Nama Ahli">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat searchList"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <?php
            if($role == ROLE_ADMIN)
            {
            ?>
            <form action="<?php echo base_url() ?>userListing" method="POST" class="sidebar-form" id="searchList">
              <div class="input-group">
                <input type="text" name="searchText" class="form-control" placeholder="Carian Nama Ahli">
                <span class="input-group-btn">
                      <button type="submit" name="search" id="search-btn" class="btn btn-flat searchList"><i class="fa fa-search"></i>
                      </button>
                    </span>
              </div>
            </form>

            <li class="treeview active">
              <a href="#">
                <i class="fa fa-caret-square-o-right"></i>
                <span>eKhairat</span>
                <span class="pull-right-container"><i class="fa fa-plus-square pull-right"></i></span>
              </a>
              <ul class="treeview-menu">
                <!--<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-caret-square-o-right"></i>Menu</a></li>-->
                <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-angle-right"></i>Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>userListing"><i class="fa fa-angle-right"></i>Senarai Ahli </a></li>
                <li><a href="<?php echo base_url(); ?>familyListing"><i class="fa fa-angle-right"></i>Senarai Tanggungan</a></li>
                <li><a href="<?php echo base_url(); ?>khairat"><i class="fa fa-angle-right"></i>Senarai Perbelanjaan</a></li>
                <li><a href="<?php echo base_url(); ?>paymentListing"><i class="fa fa-angle-right"></i>Senarai Yuran</a></li>
                <li><a href="<?php echo base_url(); ?>laporan"><i class="fa fa-angle-right"></i>Laporan</a></li>      
              </ul>
            </li>

            <li class="treeview active">
              <a href="#">
                <i class="fa fa-cogs"></i>
                <span>Settings</span>
                <span class="pull-right-container"><i class="fa fa-plus-square pull-right"></i></span>
              </a>
              <ul class="treeview-menu">       
                <!--<li><a href="#"><i class="fa fa-cogs"></i>Settings</a></li>-->
                <li><a href="<?php echo base_url(); ?>general"><i class="fa fa-angle-right"></i>General</a></li>
                <li><a href="<?php echo base_url(); ?>news"><i class="fa fa-angle-right"></i>Makluman</a></li>
                <li><a href="<?php echo base_url(); ?>kadar"><i class="fa fa-angle-right"></i>Jenis Yuran </a></li>
                <li><a href="<?php echo base_url(); ?>surau"><i class="fa fa-angle-right"></i>Taman/Lokasi</a></li>
                <!--<li><a href="<?php echo base_url(); ?>kadar_family"><i class="fa fa-angle-right"></i>Kadar Yuran</a></li>-->
                <li><a href="<?php echo base_url(); ?>toyyibpay"><i class="fa fa-angle-right"></i>Toyyibpay</a></li>
                <li><a href="<?php echo base_url(); ?>whatsapp"><i class="fa fa-angle-right"></i>Whatsapp</a></li>
                <li><a href="<?php echo base_url(); ?>sms"><i class="fa fa-angle-right"></i>SMS </a></li>
              </ul>
            </li>

            <!--<li class="treeview">
              <a href="#">
                <i class="fa fa-caret-square-o-right"></i>
                <span>eRamadhan</span>
                <span class="pull-right-container"><i class="fa fa-plus-square pull-right"></i></span>
              </a>
              <ul class="treeview-menu">              
                <li><a href="#"><i class="fa fa-angle-right"></i>Coming Soon</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-caret-square-o-right"></i>
                <span>eQurban</span>
                <span class="pull-right-container"><i class="fa fa-plus-square pull-right"></i></span>
              </a>
              <ul class="treeview-menu">              
                <li><a href="#"><i class="fa fa-angle-right"></i>Coming Soon</a></li>
              </ul>
            </li>-->

             
            <?php
            } else {
            ?>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>dashboard">
                <i class="fa fa-tachometer"></i>
                <span>Dashboard</span>
              </a>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url(); ?>loadChangeProfile">
                <i class="fa fa-user"></i>
                <span>Maklumat Ahli</span>
              </a>
            </li>

            <li class="treeview">
               <a href="<?php echo base_url(); ?>loadChangePass">
                <i class="fa fa-key"></i>
                <span>Tukar Katalaluan</span>
              </a>
            </li>

            <li class="treeview">
               <a href="<?php echo base_url(); ?>loadPolicy">
                <i class="fa fa-info-circle"></i>
                <span>Syarat & Polisi</span>
              </a>
            </li>


            
            <?php
            }
            ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

            