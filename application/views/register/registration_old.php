
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="eKhairat" content="Sistem Pengurusan Khairat, Masjid Taman Nusa Bayu, Iskandar Puteri, Johor">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/icon.png" type="image/icon type">
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <!-- MODAL CSS // added by amzari-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/modal/js/bootstrap.min.js">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/modal/jquery-1.12.4.min.js">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/modal/js/bootstrap.js">

  </head>
  <body background="<?php echo base_url(); ?>assets/images/cubes.jpg">
  <!--<body class="login-page" background="<?php echo base_url(); ?>assets/images/masjid.jpg">-->
    <div class="login-box">
      <div class="login-logo">
       <!-- <a href="<?php echo base_url(); ?>check"><img src="<?php echo base_url(); ?>assets/images/logo1.png" width="300"><br><small>Web Admin</small></a>-->
      </div><!-- /.login-logo -->
      <div class="login-box-body">
                <a href="<?php echo base_url(); ?>check"><img src="<?php echo base_url(); ?>assets/images/logo1.png" width="300"><br><!--<small>Web Admin</small>--></a>
        <p class="login-box-msg"><strong>PERMOHONAN BARU KEAHLIAN</strong><br><?php echo $g_home_desc; ?>
        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
       <?php
        $this->load->helper('form');
        $success_register = $this->session->flashdata('success_register');
        $warning_register = $this->session->flashdata('warning_register');

        //new registration completed
        if($success_register)
        {
            ?>
            <div align="center" class="alert alert-success alert-dismissable">
                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
                <?php echo $success_register; ?>      
            </div>
        <?php } else {
        //IC already registered.
        $error_register = $this->session->flashdata('error_register');
        $warning_register = $this->session->flashdata('warning_register');

        if($error_register)
        { ?>
          <div align="center" class="alert alert-danger alert-dismissable">
                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
                <?php echo $error_register; ?>      
            </div>
        <?php } else if($warning_register){ ?>
          <div align="center" class="alert alert-warning alert-dismissable">
                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
                <?php echo $warning_register; ?>      
            </div>
        <?php } ?>
        
        <form action="<?php echo base_url(); ?>registerMe" method="post">
          <div class="form-group has-feedback">
            <input type="ic" class="form-control" placeholder="Nama" name="name" maxlength="200" value="<?=set_value('name')?>" required />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>

           <div class="<?php if($error_register){ echo 'form-group has-error';} else if($warning_register){ echo 'form-group has-warning'; } else { echo 'form-group has-feedback';}?>">
            <input type="ic" class="form-control" placeholder="Kad Pengenalan (cth : 888888115678)" name="icno" maxlength="12" value="<?=set_value('icno')?>" required />
            <span class="glyphicon glyphicon-pencil form-control-feedback"></span>
          </div>

          <!--<div class="form-group has-error">
            <input type="text" class="form-control" id="inputError" placeholder="Enter ...">
          </div>-->

           <div class="form-group has-feedback">
            <input type="ic" class="form-control" placeholder="Telefon Bimbit (cth : 0123456789)" name="phone" value="<?=set_value('phone')?>" required />
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="ic" class="form-control" placeholder="Emel (jika ada)" name="email"  value="<?=set_value('email')?>" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="ic" class="form-control" placeholder="Alamat Rumah" name="address" value="<?=set_value('address')?>" required />
            <span class="glyphicon glyphicon-home form-control-feedback"></span>
          </div>

          
          <div class="row">
            <div class="col-xs-8">    
              <!-- <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div> 
              <a href="<?php echo base_url() ?>forgotPassword">Lupa Kata Laluan</a> <br>   
              <a href="<?php echo base_url() ?>registration">Daftar Sebagai Ahli </a>   -->                  
            </div><!-- /.col -->
            <div class="col-xs-12">
              <input type="submit" class="btn btn-primary btn-block btn-flat" value="Daftar" />
            </div><!-- /.col -->
          </div>
        </form>
        <hr>
        <?php } ?>
        <!--
        <div class="row" align="center">
            <div class="col-xl-12">           
                <p class="text-muted well well-sm no-shadow" style="margin-top: 5px;">
                <img src="<?php echo base_url(); ?>assets/images/bankislam.png" width="150"><br>
                <i>Online Transfer</i><br>
               Tabung Kebajikan (Khairat) Surau Al-Furqan<br> Presint 11, Putrajaya. <br>
                (<b>1601-8010-0154-83</b>)<br>
                Hantar bukti pembayaran, nama & no. ahli kepada <br><a href="mailto:admin@myfurqan.com">admin@myfurqan.com</a>
                atau <a href="http://www.wasap.my/+60133403638/eKhairat:">wasap.my/60133403638</a>
            </div>
          </div>

          <div class="row" align="center">
              <div class="col-xs-12">
                  <b>JENIS BAYARAN</b><br>
                  Pendaftaran Ahli Baru = RM60.00 <br>
                  Yuran Tahunan Ahli = RM30.00  <br>
              </div>
          </div>

        <P> &nbsp;</P>
        
        <div class="social-auth-links text-center">
          <a class="btn btn-block btn-social btn-vk" href="<?php echo base_url() ?>check">
                <i class="fa fa-search"></i> SEMAK BAYARAN AHLI
              </a>
          <a class="btn btn-block btn-social btn-vk" href="<?php echo base_url() ?>login">
                <i class="fa fa-sign-in"></i> LOGIN AHLI
              </a>

        </div>-->
        <div class="row" align="center">
              <div class="col-xs-12">
                  <!--<button id="userId" data-id="" type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#searchModal"> LIHAT SYARAT-SYARAT PENDAFTARAN</button> -->
                  <a id="userId" data-id="0" class="btn btn-info" data-toggle="modal" data-target="#viewModal"> POLISI & MANFAAT e-KHAIRAT</a>
              </div>
          </div>

        <P> &nbsp;</P>
        
         <div align="center">
            <!--<img src="<?php echo base_url(); ?>assets/images/bankislam.png" width="200"><br>
            Tabung Kebajikan Surau Al-Furqan<br> Presint 11, Putrajaya. <br>
            (No. Akaun : <b>1601-8010-0154-83</b>)<br>-->
            Sebarang pertanyaan dan pengaktifan akaun <br>sila emel ke <a href="mailto:<?php echo $g_email; ?>">
              <?php echo $g_email; ?></a>
            atau <a href="http://www.wasap.my/+6<?php echo $g_phone; ?>/eKhairat:">Whatsapp</a>
            
        </div>

         <!-- MODAL WINDOW START -->
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <div class="modal-title" id="searchModalLabel">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                   <div class="section-title mb-10" align="center"> 
                    <b>POLISI & MANFAAT e-KHAIRAT</b>                               
                    <b></b>
                  </div>
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

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

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

  </body>
 
</html>