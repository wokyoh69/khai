<?php 
if(!empty($generalinfo)){ 
  foreach ($generalinfo as $info)
  { 
    $pageTitle = $info->g_home_title;
    $g_home_desc = $info->g_home_desc;
    $g_email = $info->g_email;
    $g_phone = $info->g_phone;
    $g_bankname = $info->g_bankname;
    $g_bankaccount = $info->g_bankaccount;
  }
}
?>


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
      <!--  <a href="#"><img src="<?php echo base_url(); ?>assets/images/logo1.png" width="300"><br><small>Web Admin</small></a>-->
      </div><!-- /.login-logo -->
      <div class="login-box-body">
                <a href="#"><img src="<?php echo base_url(); ?>assets/images/logo1.png" width="300"><br><!--<small>Web Admin</small>--></a>
        <p class="login-box-msg"><strong>SEMAK BAYARAN KHAIRAT</strong>
        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>

        
        <form action="<?php echo base_url(); ?>checkMe" method="post" name="formcheck">
          <div class="form-group has-feedback">
            <input type="ic" class="form-control" placeholder="Sila Masukkan Nama" name="nama" required />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <input type="submit" class="btn btn-primary btn-block btn-flat" value="Semak" />
            </div><!-- /.col -->
          </div>
        </form>

        <?php if(!empty($rows)){ ?>           
        <div class="row">
        <div class="col-xs-12 table-responsive">
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
            foreach ($search_data as $search)
            { ?>
             <tr>
              
              <td><?php echo $search->name; ?> [<?php echo sprintf('%04d',$search->userId);?>]</td>
              <td align="center"> 
                <button id="userId" data-id="<?php echo $search->userId; ?>" type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#searchModal"> <i class="fa fa-search"></i></button> 
                 <!--<a id="userId" data-id="<?php echo $search->userId; ?>" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalSearch"> <i class="fa fa-search"></i></a>-->  
              </td>
            </tr>
            <?php } ?>
            </tbody>
          </table>
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
            <div class="col-xl-12">         
                <p class="text-muted well well-sm no-shadow" style="margin-top: 5px; background-color: #ECD159">
                <!--<img src="<?php echo base_url(); ?>assets/images/maybank.png" width="150">--><br>
                <b><font size="5"><?php echo $g_bankname; ?></b> <i>Online Transfer</i></font><br>
                <?php echo $g_home_desc; ?><br>
                (<label id="acc"><?php echo $g_bankaccount; ?></label>)<br>
                <button onclick="copyToClipboard('#acc')">Salin No Akaun</button><br>
                Hantar bukti pembayaran, nama & no. ahli kepada <br><a href="mailto:<?php echo $g_email; ?>"><?php echo $g_email; ?></a> atau <a href="http://www.wasap.my/+6<?php echo $g_phone; ?>/eKhairat:">Whatsapp</a>
                
               <!-- <br>2. Hj Mokhtar (019-2666234)
                
                atau <a href="http://www.wasap.my/+60132265572/eKhairat:">Whatsapp</a>-->
            </div>
          </div>

          <!--<div class="row" align="center">
              <div class="col-xs-12">
                  <b>JENIS BAYARAN</b><br>
                  Pendaftaran Ahli Baru = RM60.00 <br>
                  Yuran Tahunan Ahli = RM30.00  <br>
              </div>
          </div>-->
        <hr>
        <div align="center">
            <!--Sebarang pertanyaan sila hubungi <br> <a href="mailto:admin@myfurqan.com">admin@myfurqan.com</a> 
            atau <a href="http://www.wasap.my/+60139080721/eKhairat:">WhatsApp</a>
          <a href="<?php echo base_url() ?>register">[Pendaftaran Baru]</a><br>-->
          <a class="btn btn-block btn-social btn-vk" href="<?php echo base_url() ?>register">
                <i class="fa fa-user-plus"></i> PENDAFTARAN AHLI BARU
              </a>
          <a class="btn btn-block btn-social btn-vk" href="<?php echo base_url() ?>login">
                <i class="fa fa-sign-in"></i> LOGIN AHLI
              </a>
          <!--<a href="<?php echo base_url() ?>login">[Login]</a>-->
        
        </div>
      

      <!-- MODAL WINDOW START -->
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <div class="modal-title" id="searchModalLabel">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                   <div class="section-title mb-10" align="center"> 
                    <b>PENYATA BAYARAN </b>                               
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

    <!-- COPY TEXT -->

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