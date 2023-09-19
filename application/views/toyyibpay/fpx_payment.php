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

/*$userId = ''; $noAhli = ''; $name = ''; $email = ''; $phone = ''; $icno = ''; $regdate = ''; $status = '';
$catatan = ''; $roleId = ''; $address = ''; $age =''; $surau = '';
if(!empty($user_data))
{
    foreach ($user_data as $uf)
    {
        $userId = $uf->userId;
        $noAhli = $uf->noAhli;
        $name = $uf->name;
        $email = $uf->email;
        $phone = $uf->phone;
        $icno = $uf->icno;
        $regdate = $uf->regdate;
        $status = $uf->status;
        $catatan = $uf->catatan;
        $roleId = $uf->roleId;
        $address = $uf->address;
        $surau = $uf->surau;
    }
}*/

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
       <a href="<?php echo base_url() ?>home" class="logo mr-auto"><img src="<?php echo base_url(); ?>assets/images/<?= $g_logo_url; ?>" alt="" class="img-fluid"></a>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <!--<li class="active"><a href="index.html">Home</a></li>-->
          <li><a href="<?php echo base_url() ?>policy">Syarat & Polisi </a></li>
          <li><a href="<?php echo base_url() ?>register">Pendaftaran</a></li>
          <li><a href="<?php echo base_url() ?>check">Status Bayaran</a></li>
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
            <img src="<?= site_url().'assets/images/toyyibpay.png'; ?>">
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <?php $this->load->helper("form"); ?>

            <form action="<?php echo base_url(); ?>FPXprocess" method="post" name="formcheck">
            <div class="card-body">
            <?php 
            foreach ($user_data as $usr){ ?>
            <div class="row" align="left">
              <div class="col-md-8">                                
                  <div class="form-group">
                      <b>Nama</b> : <font color="blue"><?php echo strtoupper($usr->name); ?></font>  
                  </div>    
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <b>No. Ahli</b> : <?php echo $usr->noAhli; ?>
                      <input type="hidden" value="<?php echo $usr->userId;; ?>" name="userId" id="userId" />  
                  </div>
              </div>
            </div>

            <div class="row" align="left">
              <div class="col-sm-12">
                <div class="form-group">
                      <b>Kariah</b> : 
                      <?php
                          if(!empty($surauInfo))
                          {
                              foreach ($surauInfo as $sr)
                              {
                                  if($sr->id == $usr->surau) {
                                    echo $sr->name.", ".$sr->desc;
                                  }  
                              }
                          }
                      ?><br>
                </div>
              </div>
            </div>

            <div class="row" align="left">
              <div class="col-md-8">                                
                  <div class="form-group">
                      <b>Emel</b> : <input type="email" class="form-control" id="email" placeholder="cth: ahli@mail.com" name="email" value="<?php echo $g_email ?>" maxlength="128" required><small><font color="blue">* Sila tukar emel anda jika perlu.</font></small>
                  </div>    
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <b>Telefon</b> : <input type="phone" class="form-control" id="phone" placeholder="cth: 0134567890" name="phone" value="<?php //echo $usr->phone; ?>" maxlength="11" pattern="[0-9]{10,11}" required>
                  </div>
              </div>
            </div>
           <?php } //end foreach ?>

           <hr>
           

            <div class="row"><!-- row 3-->
              <div class="col-md-12">
                  <div class="box-body table-responsive no-padding">
                    <table class="table table-condensed table-hover" >
                      <thead>
                        <th width="30">&nbsp;</th>
                        <th><b>Jenis Yuran</b></th>
                        <th><b>Status</b></th>
                        <th align="right" width="130"><b>Jumlah (RM)</b></th>
                      </thead>

                      <?php
                          $total_amaun = 0;
                          $desc = "";

                          if(!empty($paymentrecord))
                          {
                              
                              foreach ($paymentrecord as $pr)
                              {
                                  $jum = (double)$pr->total_amaun;
                                  //echo $total_amaun = $total_amaun + $pr->total_amaun;
                                  //$desc .= $pr->y_title.",";
                                  ?>
                                  <tr>
                                    <td>
                                      <input type="checkbox" name="pmid[]" id="pmid" value="<?php echo $pr->p_id; ?>" 
                                      onclick="calctotal(<?=$jum;?>, this.checked)" class="checks" 
                                      data-price="<?=$jum;?>">
                                      <?php //echo $pr->p_id; ?>
                                    </td>
                                    <td>
                                      <?php if ($pr->status == "Belum Selesai"){ ?>
                                      <p><?php echo $pr->y_title; ?></p>
                                      <?php } else { 
                                        echo $pr->y_title; 
                                      }?>
                                    </td>
                                    <td>
                                      <?php if ($pr->status == "Belum Selesai"){ ?>
                                      <p><?php echo $pr->status; ?></p>
                                      <?php } else { 
                                        echo $pr->status; 
                                      }?>
                                    </td>
                                    <td align="right">
                                      <?php if ($pr->status == "Belum Selesai"){ ?>
                                      <p><?php echo $pr->total_amaun; ?></p>
                                      <?php } else { 
                                        echo $pr->total_amaun; 
                                      }?>
                                    </td>
                                  </tr>
                                  
                                  <?php
                              }

                          }
                      ?>
                      <tr> 
                        <td colspan="3" align="right"><b>Jumlah Keseluruhan</b></td>
                        <td align="right">
                          <b><?php //echo number_format($total_amaun, 2); ?></b>
                          <script>
  
                          var total = 0;
                          function calctotal(price, toglecheck) {
                              //var input = document.getElementById("form");
                              //alert (toglecheck);
                              if(toglecheck==true){
                                  this.total=this.total+price;
                              }else{
                                  this.total=this.total-price;
                              }
                              document.getElementById("totalprice").value = total.toFixed(2);

                              if (total != 0){
                                document.getElementById("submit").disabled = false;
                              } else {
                                document.getElementById("submit").disabled = true;
                              }
                          }
                          </script>

                          
                          <!--<input type="hidden" name="desc" value="<?php echo $desc?>">-->
                          <input type="text" name="totalprice" id="totalprice" readonly value="0.0" class="form-control">
                        </td>
                      </tr>
                      
                    </table>

                    
                    </div>
              </div>
            </div>

          
            <div class="card-footer">
              <div align="right">
                <small> Sila pilih sekurang-kurang satu jenis item >> </small>&nbsp;
                <button type="submit" id="submit" name="submit" class="btn btn-sm btn-danger" value="Submit" disabled="disabled">Bayar Sekarang</button>
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
        Developed by <a href="http://www.amricreative.com/">Amri Creative</a>
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