<?php 

if(!empty($generalinfo)){ 
  foreach ($generalinfo as $info)
  { 
    $pageTitle = $info->g_home_title;
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
  }
}

if(empty($search_data)){
  $name = "";
}
            
?>
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

  <!-- Check Email 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
  <!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>

<!-- MODAL CSS // added by amzari-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/modal/js/bootstrap.min.js">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/modal/jquery-1.12.4.min.js">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/modal/js/bootstrap.js">

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
       <a href="<?php echo base_url() ?>home" class="logo mr-auto"><img src="<?php echo base_url(); ?>assets/images/<?php echo $g_logo_url; ?>" alt="" class="img-fluid"></a>

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
<?php echo $g_home_title; ?>
  <P>&nbsp;&nbsp;</P>
   <P>&nbsp;&nbsp;</P>
    <P>&nbsp;&nbsp;</P>
   <P>&nbsp;&nbsp;</P>

    <div align="center">

    <div class="col-md-6">
            <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
        <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if($error)
        {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error; ?>                    
            </div>
        <?php } ?>
    </div>


    <div class="col-md-6">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title"><i class="icofont-user"></i>&nbsp;SEMAKAN STATUS BAYARAN</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <?php $this->load->helper("form"); ?>
            
            <div class="card-body">
            <!--<div align="left"><label><strong>Maklumat Ahli</strong></label></div>-->

            <form action="<?php echo base_url(); ?>checkMe" method="post" name="formcheck">
            <div class="row">
              <div class="col-sm-4">
                    <div class="form-group">
                        <select class="form-control" id="jeniscarian" name="jeniscarian" required>  
                             <?php 
                              if ($jeniscarian == "AHLI")
                                { ?>
                                        <option value="AHLI" selected>AHLI</option>
                                        <option value="TANGGUNGAN">TANGGUNGAN</option>  
                              <?php } else if ($jeniscarian == "TANGGUNGAN") {?> 
                                        <option value="AHLI">AHLI</option>
                                        <option value="TANGGUNGAN" selected>TANGGUNGAN</option>  
                              <?php } else { ?> 
                                        <option value="AHLI">AHLI</option>
                                        <option value="TANGGUNGAN">TANGGUNGAN</option> 
                              <?php } ?>

                        </select>
                    </div>
              </div> 
              <div class="col-sm-8">
                <div class="form-group">
                  <!--<input type="text" class="form-control" name="name" placeholder="Sila Masukkan Nama" value="" required>
                  <input type="text" class="form-control" placeholder="Sila Masukkan Nama" name="nama" value="<?php echo $name ?>" required />-->

                  <div class="input-group input-group-xl">
                    <input type="number" class="form-control" placeholder="No. Kad Pengenalan" name="nama" value="<?php echo $name ?>" required>
                    <span class="input-group-append">
                      <button id="submit" type="submit" class="btn btn-success"><i class="icofont-ui-search"></i> CARIAN</button>
                    </span>
                   </div>

                </div>
              </div>
              <!--<div class="col-sm-2">
                <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="Semak" id="submit" />
                  <button id="submit" type="submit" class="btn btn-success btn-xs"><i class="icofont-ui-search"></i></button> 
                </div>
              </div>-->
            </div>
            </form>

            </div>

            <?php if(!empty($rows)){ ?>           
              <div class="row">
              <div class="col-sm-12 table-responsive">
                <div class="form-group">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th>SENARAI NAMA [NO.AHLI]</th>
                    <th>&nbsp;</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tr>
                  <?php 
                  $no = 0;
                  foreach ($search_data as $search)
                  { ?>
                   <tr>
                    <?php if ((!empty($jeniscarian)) && ($jeniscarian == "AHLI")) { ?>
                    <td>&nbsp;&nbsp;<?php echo ++$no.". ".strtoupper($search->name); ?> [<?php echo $search->noAhli;?>]</td>
                    <td align="center"> 
                      <button id="userId" data-id="<?php echo $search->userId; ?>" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#searchModal"><i class="icofont-search-document"></i></button> 
                    <?php } else { ?>
                      <td>&nbsp;&nbsp;<?php echo ++$no.". ".strtoupper($search->name); ?> [<?php echo $search->noAhli;?>] <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="icofont-tick-boxed"></i>
                        <i><?php echo strtoupper($search->f_name); ?> [<?php echo $search->f_icno; ?>]</i>
                      </td>
                    <td align="center"> 
                      <button id="userId" data-id="<?php echo $search->userId; ?>" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#searchModal"><i class="icofont-search-document"></i></button> 
                    <?php } ?>
                       <!--<a id="userId" data-id="<?php echo $search->userId; ?>" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalSearch"> <i class="fa fa-search"></i></a>-->  
                    </td>
                  </tr>
                  <?php } ?>
                  </tbody>
                </table>
                 </div>
              </div>
            </div>
            <?php } ?>
              <?php 
                if(!isset($rows)){ 
                  echo " ";
                } else if ($rows == 0){ ?>
                <br>
                <div class="form-group has-error" align="center">
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> 
                      Maaf! Tiada maklumat dijumpai
                    </label>
                </div>
            <?php } ?>

          <hr>
          <div class="row" align="center">
            <div class="col-sm-12">         
                <!--<p class="text-muted well well-sm no-shadow" style="background-color: #d2f9d4">-->
                <p class="text-muted well well-sm no-shadow" style="background-color: #ffffff">
                <!--<img src="<?php echo base_url(); ?>assets/images/maybank.png" width="150">--><br>
                <b><font size="5"><strong><?php echo $g_bankname; ?></b> <i>Online Transfer</i></strong></font><br>
                <?php echo $g_home_desc; ?><br>
                (<label id="acc"><?php echo $g_bankaccount; ?></label>)<br>
                <button onclick="copyToClipboard('#acc')">Salin No Akaun</button><br>
                Hantar bukti pembayaran, nama & no. ahli kepada <br><a href="mailto:<?php echo $g_email; ?>"><?php echo $g_email; ?></a> atau <a href="http://www.wasap.my/+6<?php echo $g_phone; ?>/eKhairat:">Whatsapp</a>
                
               <!-- <br>2. Hj Mokhtar (019-2666234)
                
                atau <a href="http://www.wasap.my/+60132265572/eKhairat:">Whatsapp</a>-->
            </div>
          </div>

            <div class="card-footer">
              <div align="left">
                &nbsp;
                <!--<input type="submit" class="btn btn-success" name="submit" id="submit" value="" disabled="disabled">-->
                <!--<button id="ajax_button">Send Ajax Request</button>-->
                 <!--<input type="submit" class="btn btn-primary" value="Semak" id="submit" />-->

                <!--<a href="" name="btn" id="btn">button</a>-->
                <!--<input type="text" id="tbName" />-->
                <!--<input type="submit" id="submit" disabled="disabled" />-->
                <!--<button name="submit" id="submit">SUBMIT</button> -->
               </div>
            </div>
          
        </div>
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

  <!-- MODAL WINDOW START -->
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <div class="modal-title" id="searchModalLabel">
                  <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>-->
                   <!--<div class="section-title mb-12" align="center"> -->
                    <BIG><strong>STATUS BAYARAN </strong></BIG>                               
                  <!--</div>-->
                </div>
                
              </div>
              <div class="modal-body">
                  <div id="modal-loader" style="display: none; text-align: center;"></div>         
                  <div id="dynamic-content"></div>
                  <div id="dynamic-name"></div>
              </div>
             <div class="modal-footer">
                    <button class="btn btn-info" data-dismiss="modal">Tutup</button>
              </div>
              
            </div>
          </div>
        </div>
        <!-- MODAL WINDOW -->

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
  <!--<script src="<?php echo base_url(); ?>assetsv4/vendor/php-email-form/validate.js"></script>-->
  <script src="<?php echo base_url(); ?>assetsv4/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>assetsv4/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url(); ?>assetsv4/vendor/venobox/venobox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url(); ?>assetsv4/js/main.js"></script>
 
  <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- MODAL JSCRIPT -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>
    <script>
      $(document).ready(function(){
        
        $(document).on('click', '#userId', function(e){
          
          e.preventDefault();
          
          var uid = $(this).data('id');   // it will get id of clicked row
          
          $('#dynamic-content').html(''); // leave it blank before ajax call
          $('#modal-loader').show();      // load ajax loader
          
          $.ajax({
            url: '<?php echo base_url() ?>checkDetail',
            type: 'POST',
            data: 'id='+uid,
            dataType: 'html'
          })
          .done(function(data){
            console.log(data);  
            $('#dynamic-content').html('');    
            $('#dynamic-content').html(data); // load response 
            $('#modal-loader').hide();      // hide ajax loader 
          })
          .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
          });
          
        });
        
      });
    </script>

<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
      }
     </script>

</body>

</html>