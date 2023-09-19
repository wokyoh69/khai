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

    <div class="col-md-4">
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
    $yuran = 0;
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
    }

    ?>

    <div class="col-md-8">
        <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">MAKLUMAT AHLI & YURAN</h3>
                    <?php  $this->session->userdata('tempUser'); ?> 
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <?php //$this->load->helper("form"); ?>
                    <form role="form" action="<?php echo base_url(); ?>regUser" method="post" id="regUser">
                    <div class="card-body">
                    
                    <div align="left"><label><strong>Maklumat Ahli</strong></label>
                    <div class="row">
                      
                      <div class="col-sm-12">
                        <div class="form-group">
                          <Table>
                            <tr><td width="100">Nama</td><td>:</td><td>&nbsp;<?php echo $name ?></td></tr>
                              <tr><td width="100">No. KP</td><td>:</td><td>&nbsp;<?php echo $icno ?></td></tr>
                              <tr><td width="100">Emel</td><td>:</td><td>&nbsp;<?php echo $email ?></td></tr>
                             <tr> <td width="100">Telefon</td><td>:</td><td>&nbsp;<?php echo $phone ?></td></tr>
                              <tr><td width="100">Alamat</td><td>:</td><td>&nbsp;<?php echo $address ?></td></tr>
                              <tr><td width="100">Lokasi</td><td>:</td><td>&nbsp;<?php
                                if(!empty($surauInfo))
                                {
                                    foreach ($surauInfo as $sr)
                                    {
                                        if($sr->id == $surau) {
                                          echo $sr->name.", ".$sr->desc;
                                        }  
                                    }
                                }
                                ?>
                                </td>
                              </tr>
                              <tr><td width="100">Jenis Ahli</td><td>:</td><td>&nbsp;<?php
                                if(!empty($roles))
                                {
                                    foreach ($roles as $rl)
                                    {
                                        if($rl->roleId == $roleid) {
                                          echo $rl->role;
                                        }  
                                    }
                                }
                                ?>
                                </td>
                              </tr>
                              <tr><td>Kategori Ahli</td><td>:</td><td><b>&nbsp; <?php echo $pakej ?></b></td></tr>
                          </Table>
                          <input type="hidden" name="pakej" id="pakej" value="<?php echo $pakej ?>">
                        </div>
                      </div>

                    </div>
                    </div>

                    
                    <?php if(!empty($getUserInfo)){ 
                      $num = 1;
                      $jumlah = 0;
                      $jumlah_ahli = 0;
                      $total = 0;
                      $ahli = "AHLI";
                      ?>
                      
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group" align="left">                            
                                <div align="left">
                                  
                                    <b>Maklumat Yuran</b>
                                  <!--<p class="text-primary"><?php echo "RM".yuran_pendaftaran()." seumur hidup"; ?></p>  -->
                                  

                                </div>
                          </div> 
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-12">
                         <div class="box-body table-responsive no-padding">
                          <table class="table table-bordered table-striped table-hover" style="margin-bottom: 10px">
                                <tr>
                                  <th>Nama</th>
                                  <th>Pertalian</th>
                                  <th>No. KP </th>
                                  <th>Umur</th>
                                  <!--<th>Yuran *</th>-->
                                  <th align="right">*Yuran</th>
                                </tr>
                                <tr>
                                  <td width="30%"><?php echo $num; ?>. <?php echo strtoupper($name); ?></td>
                                  <td><?php echo $ahli; ?></td>
                                  <td><?php echo $icno; ?></td>
                                  <td><?php echo $umur = umur($icno);?></td>
                                  <!--<td align="right"><?php echo $yuran = yuran($ahli, $umur); ?></td>-->
                                  <td align="right"><?php echo $jumlah = yuran($ahli, $umur); ?></td>
                                </tr> 
                                <?php 
                                
                            
                                if (!empty($this->session->userdata('tempUser'))){
//                                    {
                                    foreach ($regFamilylist as $fy)
                                        {
                                        ?>
                                        <tr>
                                          <td width="30%"><?php echo ++$num; ?>. <?php echo strtoupper($fy->f_name); ?></td>
                                          <td><?php echo strtoupper($fy->f_pertalian); ?></td>
                                          <td><?php echo str_replace(' ', '', $fy->f_icno); ?></td>
                                          <td>
                                            <?php //echo $umur = umur($fy->f_icno);?>
                                            <?php 
                                            if($fy->f_icno != "") {
                                              $no_ic = str_replace(' ', '', $fy->f_icno);
                                              $age = umur($no_ic); 
                                              echo $age;
                                            } else {
                                              $age = 0;
                                              echo $age;
                                            }
                                            ?>
                                          </td>
                                          <!--<td align="right">
                                            <?php echo $yuran = yuran($fy->f_pertalian, $age); ?>
                                          </td>-->
                                          <td align="right"><?php echo $jumlah_ahli = yuran($fy->f_pertalian, $age); ?></td>
                                        </tr>
                                        <?php
                                        $total = $total + $jumlah_ahli;
                                        }
                                    }
                                ?>
                                <tr>
                                  <td colspan="4">Yuran Pendaftaran
                                  </td>
                                  <td align="right"><strong><?php echo number_format($yuran_pendaftaran,2); ?></strong></td>
                                </tr> 
                                <tr>
                                  <td colspan="4">
                                    <?php echo $title_yuran; ?>
                                  </td>
                                  <td align="right"><strong><?php echo number_format($jumlah_yuran,2); ?></strong></td>
                                </tr> 
                                <tr>
                                  <td colspan="4"><strong>Jumlah Keseluruhan Yuran</strong></td>
                                  <td align="right"><strong>
                                    <?php echo number_format($jumlah + $total + $yuran_pendaftaran + $jumlah_yuran ,2); ?>
                                    </strong>
                                  </td>
                                </tr>

                              </table>
                            </div> 
                          </div>

                          <div class="col-sm-12">
                            <div align="right">
                                <!--<small class="text-primary">
                                * Yuran bulanan</small> |-->
                                <small class="text-muted">
                                * Yuran tahunan </small>
                            </div>
                          </div>

                          <div class="col-sm-12">
                            <div align="left">
                                <input type="checkbox" value="Y" name="polisi" id="polisi" required>
                                <Font size="2">&nbsp; <b>SAYA BERSETUJU DENGAN
                                  <a href="" id="polisiId" data-id="0" data-toggle="modal" data-target="#viewPolisi"> POLISI & SYARAT </a> e-Khairat. </b></font> 
                            </div>
                          </div>


                      </div> <!-- end row -->
                    <?php } ?>
                    

                    </div>
                    
                    <div class="card-footer">
                    <div align="left">
                        
                       <?php if(!empty($getUserInfo)){ ?>
                        <input type="hidden" name="regId" id="regId" value="<?php echo $this->session->userdata('tempUser'); ?> ">

                        <button type="submit" class="btn btn-success">Daftar</button>
                        <a class="btn btn-danger" href="<?= base_url().'register'?>" >Kembali</a>
                       <?php } else { ?>
                        <button type="submit" class="btn btn-success">Seterusnya</button>
                       <?php }  ?>
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
        <div class="modal fade" id="viewPolisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">

              <div class="modal-header">
                <div class="modal-title" id="searchModalLabel">
                  <b>SYARAT & POLISI</b>
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
  <script src="<?php echo base_url(); ?>assetsv4/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo base_url(); ?>assetsv4/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>assetsv4/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url(); ?>assetsv4/vendor/venobox/venobox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url(); ?>assetsv4/js/main.js"></script>

  <!-- MODAL JSCRIPT -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>
    <script>
      $(document).ready(function(){
        $(document).on('click', '#polisiId', function(e){
          e.preventDefault();
          var uid = $(this).data('id');   // it will get id of clicked row
          $('#dynamic-content').html(''); // leave it blank before ajax call
          $('#modal-loader').show();      // load ajax loader
          $.ajax({
            url: '<?php echo base_url() ?>registerDetail',
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
                     }  
                });  
           }  
      });  
 });  
 </script>  


</body>

</html>