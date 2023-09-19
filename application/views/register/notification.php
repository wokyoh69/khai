<?php //include ($_SERVER['DOCUMENT_ROOT']."/buuv2/application/views/functions.php"); ?>
<?php //require APPPATH ."/views/functions.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $g_home_title; ?></title>
  <meta content="<?php echo $g_home_title; ?>" name="description">
  <meta content="<?php echo $g_home_desc; ?>" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url(); ?>assets/images/icon.png" rel="icon">
  <link href="<?php echo base_url(); ?>assets/images/icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assetsv2/dist/css/adminlte.min.css">
  <link href="<?php echo base_url(); ?>assetsv4/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assetsv4/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assetsv4/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assetsv4/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assetsv4/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assetsv4/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url(); ?>assetsv4/css/style.css" rel="stylesheet">

  <!-- Check Email -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 

  <!-- =======================================================
  * Template Name: Green - v2.3.1
  * Template URL: https://bootstrapmade.com/green-free-one-page-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <i class="icofont-envelope"></i> <a href="mailto:<?php echo $g_email; ?>"><?php echo $g_email; ?></a>
        <i class="icofont-phone"></i><?php echo $g_phone; ?>
      </div>
      <div class="social-links">
        
        <a href="#"></i> <?php echo $g_bankname; ?> | <?php echo $g_bankaccount; ?></a>

        <!--<a href="#" class="facebook"><i class="icofont-facebook"></i>- Facebook</a>
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="skype"><i class="icofont-skype"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>-->
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <!--<h1 class="logo mr-auto"><a href="index.html">e-Khairat</a></h1>-->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="<?php echo base_url() ?>home" class="logo mr-auto"><img src="<?php echo base_url(); ?>assets/images/<?= $g_logo_url; ?>" alt="" class="img-fluid"></a>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <!--<li class="active"><a href="index.html">Home</a></li>-->
          <li><a href="<?php echo base_url() ?>policy">Syarat & Polisi</a></li>
          <li><a href="<?php echo base_url() ?>register">Pendaftaran</a></li>
          <li><a href="<?php echo base_url() ?>check">Status Bayaran</a></li>
          <!--
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#team">Team</a></li>
          <li class="drop-down"><a href="">Drop Down</a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="drop-down"><a href="#">Deep Drop Down</a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li>-->

        </ul>
      </nav><!-- .nav-menu -->

      <a href="<?php echo base_url() ?>login" class="get-started-btn scrollto">LOGIN</a>

    </div>
  </header><!-- End Header -->
<?php //echo $g_home_title; ?>
<?php echo $_SERVER['DOCUMENT_ROOT']; ?>
  <P>&nbsp;&nbsp;</P>
   <P>&nbsp;&nbsp;</P>
    <P>&nbsp;&nbsp;</P>
   <P>&nbsp;&nbsp;</P>

    <div align="center">

    

    <div class="col-md-8">
      <div class="row">

          <div class="col-sm-12">
            <div class="form-group">
                 <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Terima Kasih!</h5>
                    <p> &nbsp; </p>
                      <?php
                      $message = $this->session->flashdata('success_register');
                      if($message) { echo $message; }
                      ?>
                  </div>
              </div> 
            </div>

        </div> <!-- end row -->
    </div>

    </div>

 <P>&nbsp;&nbsp;</P>



  <main id="main">

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services section-bg">
      <div class="container">

        <div class="row no-gutters">
          <div class="col-lg-4 col-md-6" align="center">
            <div class="icon-box">
              <div class="icon"><i class="<?php echo $g_icon_1; ?>" style="color:green"></i></div>
              <h4 class="title"><a href="<?= base_url().'register/'?>"><?php echo $g_title_1; ?></a></h4>
              <p class="description"><?php echo $g_info_1; ?></p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" align="center">
            <div class="icon-box">
              <div class="icon"><i class="<?php echo $g_icon_2; ?>" style="color:green"></i></div>
              <h4 class="title"><a href="<?= base_url().'check/'?>"><?php echo $g_title_2; ?></a></h4>
              <p class="description"><?php echo $g_info_2; ?></p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" align="center">
            <div class="icon-box">
              <div class="icon"><i class="<?php echo $g_icon_3; ?>" style="color:green"></i></div>
              <h4 class="title"><a href="<?= base_url().'login/'?>"><?php echo $g_title_3; ?></a></h4>
              <p class="description"><?php echo $g_info_3; ?></p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Featured Services Section -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      
      <div class="copyright">
        &copy; Copyright <strong><span><?php echo $g_home_title; ?></span></strong>. Hak Cipta Terpelihara
      </div>
      <div class="credits">
        Developed by <a href="http://www.amricreative.net/">Amri Creative</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url(); ?>assetsv4/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assetsv4/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>assetsv4/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url(); ?>assetsv4/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo base_url(); ?>assetsv4/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>assetsv4/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url(); ?>assetsv4/vendor/venobox/venobox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url(); ?>assetsv4/js/main.js"></script>



</body>

</html>