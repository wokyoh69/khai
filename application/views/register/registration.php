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
    <?php
    if(!empty($getUserInfo)){
      foreach ($getUserInfo as $ui)
          {
            $regId = $ui->regId;
            $name =  $ui->name;
            $email =  $ui->email;
            $phone = $ui->phone;
            $icno =  $ui->icno;
            $address =  $ui->address;
            $surau =  $ui->surau;
            $pakej =  $ui->pakej;
            $ahli_khairat =  $ui->ahli_khairat;
            $roleid =  $ui->roleId;
          }
    } else {

      $regId = "";
      $name =  "";
      $email = "";
      $phone = "";
      $icno =  "";
      $address =  "";
      $surau =  "";
      $pakej = "";
      $roleid =  "";
      $ahli_khairat = "";
    }

    ?>

    <div class="col-md-6">
        <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title"><i class="icofont-user"></i>&nbsp;PENDAFTARAN AHLI</h3>
                    <?php  $this->session->userdata('tempUser'); ?> 
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <?php $this->load->helper("form"); ?>
                    <form role="form" id="regUser" action="<?php echo base_url(); ?>regUser" method="post">
                    <div class="card-body">
    
                    <div align="left"><label><strong>Maklumat Ahli</strong></label></div>

                <?php if($surau == 0) { ?>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <input type="text" class="form-control" name="name" placeholder="Nama" value="<?php echo $name ?>" required>
                          <input type="hidden" name="regId" id="regId" value="<?php echo $this->session->userdata('tempUser'); ?> ">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <!--<input type="text" class="form-control" name="icno" maxlength="12" placeholder="No. Kad Pengenalan" required>
                          <span id="icno_result"></span> -->

                          <input type="text" name="icno" id="icno" pattern="[0-9]{12}" class="form-control" value="<?php echo $icno ?>" placeholder="My Kad (cth:560101041111)" maxlength="12" required/>  
                          <div align="left"><font size="2" color="red"><div class="" name="icno_result" id="icno_result"></div></font></div>


                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="phone" pattern="[0-9]{10,11}" value="<?php echo $phone ?>"  maxlength="11" placeholder="No. Telefon (cth:0129000123)" required>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <!--<input type="text" class="form-control required email" id="email" name="email" placeholder="Email" required>

                          <input type="text" name="email" id="email" class="form-control" value="<?php echo $email ?>" placeholder="Email" />-->
                          <input type="text" class="form-control required email" id="email" value="<?php echo $email ?>" name="email" maxlength="128" placeholder="Emel (cth:nama@mail.com)" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$">
                          <!--<div align="left"><font size="2"><span id="email_result"></span></font></div>-->
                        </div>
                      </div>
                    </div>

                    

                    <div align="left"><label><strong>Maklumat Lokasi/Taman</strong></label></div>
                    <div class="row">
                      <div class="col-sm-6">
                            <div class="form-group">
                                <select class="form-control" id="blok" name="blok" required>
                                    <option value="">Sila Pilih</option>
                                    <?php
                                    if(!empty($surauInfo))
                                    {
                                        foreach ($surauInfo as $sr)
                                        {
                                            ?>
                                            <option value="<?php echo $sr->id; ?>" <?php if($sr->id == $surau) {echo "selected=selected";} ?>>
                                                <?php echo $sr->name.", ".$sr->desc; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                      </div> 
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Alamat Rumah" value="<?php echo $address ?>" name="address" required>
                        </div>
                      </div>
                    </div>
                    <!--<div class="row">
                      <div class="col-sm-12">
                        <div align="left">&nbsp;<i>" Jalan Kasturi, 62150 W.P. Putrajaya "</i></div>
                      </div>
                    </div>-->

                    <hr>
                    <div align="left"><label><strong>Kategori Ahli</strong></label></div>
                    <div class="row">
                      <div class="col-sm-6">
                            <div class="form-group">
                                <select class="form-control" id="pakej" name="pakej">
                                  <?php 
                                    if ($pakej == "Keluarga")
                                      { ?>
                                              <option value="Keluarga" selected="selected"> Keluarga </option>
                                              <option value="Bujang"> Bujang </option>
                                    <?php } else if ($pakej == "Bujang") {?> 
                                              <option value="Keluarga"> Keluarga </option>
                                              <option value="Bujang" selected="selected"> Bujang</option>
                                    <?php } else { ?> 
                                              <option value="Keluarga" selected> Keluarga </option>
                                              <option value="Bujang"> Bujang</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> 
                    </div>

                    <hr>
                    <div align="left"><label class="text-success"><strong>Ingin menyertai khairat kematian ?</strong></label></div>
                    <div class="row">
                      <div class="col-sm-12" align="left">
                            <div class="form-group">
                              <div class="radio">
                                <label>
                                  <input type="radio" name="ahli_khairat" id="ahli_khairat" value="Y" checked>
                                  Ya
                                </label>
                              </div>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="ahli_khairat" id="ahli_khairat" value="N">
                                  Tidak 
                                </label>
                              </div>
                            </div> 
                        <label class="text-muted"> <small>Yuran tahunan dikenakan bagi ahli qaryah yang menyertai khairat kematian. Sila rujuk <a href="<?php echo base_url() ?>policy">Syarat & Polisi</a> untuk keterangan lanjut.</small></label>
                    </div>
                  </div>
                <?php } else { ?>

                     <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <input type="text" class="form-control"  value="<?php echo $name ?>" disabled>
                          <input type="hidden" name="name" id="name" value="<?php echo $name ?>">
                          <input type="hidden" name="regId" id="regId" value="<?php echo $this->session->userdata('tempUser'); ?> ">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <!--<input type="text" class="form-control" name="icno" maxlength="12" placeholder="No. Kad Pengenalan" required>
                          <span id="icno_result"></span> -->

                          <input type="text" class="form-control" value="<?php echo $icno ?>" placeholder="No. Kad Pengenalan" maxlength="12" disabled/>  
                          <input type="hidden" name="icno" id="icno" value="<?php echo $icno ?>">


                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="text" class="form-control"  value="<?php echo $phone ?>"  maxlength="11" placeholder="No. Telefon" disabled>
                          <input type="hidden" name="phone" id="phone" value="<?php echo $phone ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <!--<input type="text" class="form-control required email" id="email" name="email" placeholder="Email" required>

                          <input type="text" name="email" id="email" class="form-control" value="<?php echo $email ?>" placeholder="Email" />-->
                          <input type="text" class="form-control required email" value="<?php echo $email ?>"  maxlength="128" placeholder="cth : nama@mail.com" disabled>
                          <input type="hidden" name="email" id="email" value="<?php echo $email ?>">
                          <!--<div align="left"><font size="2"><span id="email_result"></span></font></div>-->
                        </div>
                      </div>
                    </div>

                    

                    <div align="left"><label><strong>Maklumat Lokasi/Taman</strong></label></div>
                    <div class="row">
                      <div class="col-sm-6">
                            <div class="form-group">
                                <select class="form-control" disabled>
                                    <option value="">Sila Pilih</option>
                                    <?php
                                    if(!empty($surauInfo))
                                    {
                                        foreach ($surauInfo as $sr)
                                        {
                                            ?>
                                            <option value="<?php echo $sr->id; ?>" <?php if($sr->id == $surau) {echo "selected=selected";} ?>>
                                                <?php echo $sr->name.", ".$sr->desc; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="blok" id="blok" value="<?php echo $surau ?>">
                            </div>
                      </div> 
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="text" class="form-control" value="<?php echo $address ?>" disabled>
                          <input type="hidden" name="address" id="address" value="<?php echo $address ?>">
                        </div>
                      </div>
                    </div>
                    <!--<div class="row">
                      <div class="col-sm-12">
                        <div align="left">&nbsp;<i>" Jalan Kasturi, 62150 W.P. Putrajaya "</i></div>
                      </div>
                    </div>-->

                    <hr>
                    <div align="left"><label><strong>Kategori Ahli <?php //echo $pakej ?></strong></label></div>
                    <div class="row">
                      <div class="col-sm-6">
                            <div class="form-group">
                                <select class="form-control" disabled>
                                  <?php 
                                    if ($pakej == "Keluarga")
                                      { ?>
                                              <option value="Keluarga" selected="selected"> Keluarga </option>
                                              <option value="Bujang"> Bujang </option>
                                    <?php } else if ($pakej == "Bujang") {?> 
                                              <option value="Keluarga"> Keluarga </option>
                                              <option value="Bujang" selected="selected"> Bujang</option>
                                    <?php } else { ?> 
                                              <option value="Keluarga" selected> Keluarga </option>
                                              <option value="Bujang"> Bujang</option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="pakej" id="pakej" value="<?php echo $pakej ?>">
                            </div>
                        </div> 
                    </div>

                    <hr>
                    <div align="left"><label class="text-success"><strong>Ingin menyertai khairat kematian ?</strong></label></div>
                    <div class="row">
                      <div class="col-sm-12">
                            <div class="form-group" align="left">
                            <?php 
                            if ($ahli_khairat == "Y"){ ?>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="ahli_khairat" id="ahli_khairat" value="Y" checked disabled>
                                  Ya
                                </label>
                              </div>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="ahli_khairat" id="ahli_khairat" value="N" disabled>
                                  Tidak 
                                </label>
                              </div>
                            <? } else { ?>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="ahli_khairat" id="ahli_khairat" value="Y" disabled>
                                  Ya
                                </label>
                              </div>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="ahli_khairat" id="ahli_khairat" value="N" checked disabled>
                                  Tidak 
                                </label>
                              </div>
                            <? } ?>
                            <input type="hidden" name="ahli_khairat" id="ahli_khairat" value="<?php echo $ahli_khairat ?>">
                            <label class="text-muted"> <small>Yuran tahunan dikenakan bagi ahli qaryah yang menyertai khairat kematian. Sila rujuk <a href="<?php echo base_url() ?>policy">Syarat & Polisi</a> untuk keterangan lanjut.</small></label>
                        </div> 
                    </div>
                    </div>

                <?php } ?>

                        

                    
                    <?php if(!empty($getUserInfo)){ ?>
                      <hr>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group" align="left">                            
                                <div align="left"><label><strong>Maklumat Tanggungan</strong></label></div>
                                <a class="btn btn-primary" href="" id="regFamilyId" data-id="<?php //echo $fy->f_id; ?>" title="Lihat" data-toggle="modal" data-target="#regFamilyModal">
                                <div class="icon"><i class="icofont-ui-add"></i>&nbsp;&nbsp;TANGGUNGAN</div></a>
                          </div> 
                        </div>
                      </div>

                      <div class="row">

                        <div class="box-body table-responsive no-padding">
                              <table class="table table-condensed table-striped table-hover" >
                                <tr>
                                  <th>Nama</th>
                                  <th>Pertalian</th>
                                  <th>No. KP </th>
                                  <th>&nbsp;</th>
                                </tr>
                                <?php //echo $pageTitle; ?>
                                <?php 
                                $num = 1;

                                if (!empty($this->session->userdata('tempUser'))){
//                                    {
                                    foreach ($regFamilylist as $fy)
                                        {
                                        
                                        ?>
                                        <tr>
                                          <td><?php echo $num++; ?>. <?php echo strtoupper($fy->f_name); ?></td>
                                          <td><?php echo strtoupper($fy->f_pertalian); ?></td>
                                          <td><?php echo str_replace(' ', '', $fy->f_icno); ?></td>
                                          
                                          <td>
                                            <a class="btn btn-sm btn-danger" href="<?= base_url().'register/regFamilyDelete/'.$fy->f_id; ?>" onclick="javasciprt: return confirm('Adakah anda pasti untuk padam ?')" title="Padam"><i class="icofont-trash"></i></a>
                                          </td>
                                        </tr>
                                        <?php
                                        }
                                    }
                                ?>
                              </table>
                            </div> 
                      </div>
                    <?php } ?>


                    </div>
                    
                    <div class="card-footer">
                      <div align="left">
                        <!--<input type="submit" class="btn btn-success" name="submit" id="submit" value="" disabled="disabled">-->
                        <!--<button id="ajax_button">Send Ajax Request</button>-->
                         <input type="submit" class="btn btn-success" value="Seterusnya" id="submit" />
                        <!--<a href="" name="btn" id="btn">button</a>-->
                        <!--<input type="text" id="tbName" />-->
                        <!--<input type="submit" id="submit" disabled="disabled" />-->
                        <!--<button name="submit" id="submit">SUBMIT</button> -->
                       <?php if(!empty($getUserInfo)){ ?>
                        <a class="btn btn-danger" href="<?= base_url().'register/regReset/'?>" onclick="javasciprt: return confirm('Nota : Semua maklumat ahli dan tanggungan akan dipadam')">Reset</a>
                       <?php } ?>
                       </div>
                    </div>
                   

                  </form>
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
        <div class="modal fade" id="regFamilyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">

              <div class="modal-header">
                <div class="modal-title" id="searchModalLabel">
                  <b>MAKLUMAT TANGGUNGAN</b>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" align="right">&times;</span>
                  </button>
                </div>
              </div>

              <div class="modal-body">
                  <div id="modal-loader" style="display: none; text-align: center;"></div>         
                  <div id="dynamic-content"></div>
                  <div id="dynamic-name"></div>
              </div>
              
              <!--<div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Tutup</button>
              </div>-->

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
 
  <!-- MODAL JSCRIPT -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>
    <script>
      $(document).ready(function(){
        $(document).on('click', '#regFamilyId', function(e){
          e.preventDefault();
          var uid = $(this).data('id');   // it will get id of clicked row
          $('#dynamic-content').html(''); // leave it blank before ajax call
          $('#modal-loader').show();      // load ajax loader
          $.ajax({
            url: '<?php echo base_url() ?>regFamily',
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

<!-- CHECK ICNO -->

 <script>  
 $(document).ready(function(){  
      $('#icno').change(function(){  
           var icno = $('#icno').val();  
           if(icno != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>register/check_icno_avalibility",  
                     method:"POST",  
                     data:{icno:icno},  
                     success:function(data){  
                          $('#icno_result').html(data); 
                          //$('#submit').attr("disabled", true);
                          //alert(data);
                          //result = data;
                     }  
                     //failure: function (data) {
                     //   alert("hi");
                     //}
                     //complete: function(){
                        //Ajax request is finished, so we can enable
                        //the button again.
                       // $('#submit').attr("disabled", true);
                    //}
                });
                //return result;
            }

            //if (result != ''){
             // alert("ada rekod");
            //}

      });  
 });  
 </script> 



</body>

</html>