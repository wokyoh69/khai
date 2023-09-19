<?php

if(!empty($generalinfo)){ 
  foreach ($generalinfo as $info)
  { 
    $pageTitle = $info->g_home_title;
    $g_address = $info->g_address;
    $g_home_title = $info->g_home_title;
    $g_home_desc = $info->g_home_desc;
    $g_email = $info->g_email;
    $g_phone = $info->g_phone;
    $g_bankname = $info->g_bankname;
    $g_bankaccount = $info->g_bankaccount;
    $g_icon_1 = $info->g_icon_1;$g_title_1 = $info->g_title_1;$g_info_1 = $info->g_info_1;
    $g_icon_2 = $info->g_icon_2;$g_title_2 = $info->g_title_2;$g_info_2 = $info->g_info_2;
    $g_icon_3 = $info->g_icon_3;$g_title_3 = $info->g_title_3;$g_info_3 = $info->g_info_3;
    $g_logo_url = $info->g_logo_url;
    $g_background = $info->g_background;
    $g_ekhairat_id = $info->g_ekhairat_id;
  }
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $pageTitle; ?></title>
  <meta content="<?php echo $g_home_title; ?>" name="description">
  <meta content="<?php echo $g_home_desc; ?>" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url(); ?>assets/images/icon.png" rel="icon">
  <link href="<?php echo base_url(); ?>assets/images/icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url(); ?>assetsv4/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assetsv4/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assetsv4/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assetsv4/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assetsv4/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assetsv4/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url(); ?>assetsv4/css/style.css" rel="stylesheet">

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

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 
        <div class="carousel-item active" style="background-image: url(assets/images/masjid.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Salam Ramadhan 1442H </h2>
              <p class="animate__animated animate__fadeInUp">
              “Wahai orang yang beriman! Kamu diwajibkan berpuasa sebagaimana diwajibkan atas orang yang dahulu daripada kamu supaya kamu bertakwa.” <b>(Surah al-Baqarah, ayat 183)</b>
               </p>
              <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
            </div>
          </div>
        </div>-->

        <!-- Slide 2 -->
        <?php 
        $number = 0;
        foreach ($record_data as $fds){ ?>
        <div class="carousel-item <?php if($number == 0) { echo "active"; }?>" style="background-image: url(assets/images/<?= $g_background; ?>)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown"><?php echo $fds->news_headline; ?></h2>
              <p class="animate__animated animate__fadeInUp"><?php echo $fds->news_story; ?></p>
              <!--<a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>-->
            </div>
          </div>
        </div>
      <?php $number++;
      } ?>

        <!-- Slide 3
        <div class="carousel-item" style="background-image: url(assets/img/slide/slide-3.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Sequi ea ut et est quaerat</h2>
              <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
              <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
            </div>
          </div>
        </div>-->

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

    </div>
  </section><!-- End Hero -->

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

   <!-- ======= Contact Section =======
    <section id="contact" class="contact">
      <div class="container">
        
        <div class="section-title">
          <h2>Statistik Pendaftaran Ahli</h2>
          <p>Statistik Pendaftaran Ahli Mengikut Lokasi/Taman di <?php echo $g_address;?></p>
        </div>

        <div class="row">
          <div class="col-md-12">
               <div class="box-body table-responsive">
                  <div class="chart-container">
                    <div class="bar-chart-container">
                      <div align="center"><div id="barchart"></div></div>
                    </div>
                  </div>
              </div>
          </div>
        </div>

      </div>
    </section>  -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      
      <div class="copyright">
        &copy; Copyright <strong><span><?php echo $pageTitle; ?></span></strong>. Hak Cipta Terpelihara
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/green-free-one-page-bootstrap-template/ -->
        Developed by <a href="http://www.amricreative.net/">Amri Creative</a><br>[<?php echo $g_ekhairat_id; ?>]

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
  
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

              <script type="text/javascript">
              // Load google charts
              google.charts.load('current', {'packages':['corechart']});
              google.charts.setOnLoadCallback(drawChart);

              // Draw the chart and set the chart values
              function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Blok', 'Bilangan Ahli'], 
                <?php 
                      foreach ($surau as $rowe){
                         echo "['".$rowe['surauName']." (".$rowe['regNumber'].")',".$rowe['regNumber']."],";
                    } ?>
              ]);

                // Optional; add a title and set the width and height of the chart
                var options = {'title':'Senarai Ahli Mengikut Lokasi/Taman', 'width':1000, 'height':500};

                // Display the chart inside the <div> element with id="piechart"
                var chart = new google.visualization.BarChart(document.getElementById('barchart'));
                chart.draw(data, options);
              }
              </script>



</body>

</html>