
<?php 
  foreach ($userlist as $user): 
    if ($user->userId == $userid){
      $u_name = $user->name;
      $u_id = $user->userId;
      $u_noAhli = $user->noAhli;
      $u_address = $user->address;
      $u_phone = $user->phone;
      //echo "<b>".$user->name."</b> <br> No. Ahli : ". sprintf('%04d',$user->userId)."<br> Alamat : ".$user->address;
    }
  endforeach 
  ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php if($role == 1) { ?>
    <section class="content-header">
      <h1>
        <i class="fa fa-calculator" aria-hidden="true"></i> <?php echo $pageTitle; ?>
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    
        <li><a href="<?= base_url().'editUsers/'.$userid; ?>">Maklumat Ahli</a></li>
       
        <li class="active"><?php echo $pageTitle; ?></li>
      </ol>
    </section>
       <?php } ?><!-- Content Header (Page header) -->


    <section class="content">

     
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">&nbsp;</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i></button> 
          </div>
        </div>

        <div class="box-body"> 

         <div class="row"><!-- row 1-->
            <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>

                <?php  
                    $warning = $this->session->flashdata('warning');
                    if($warning)
                    {
                ?>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('warning'); ?>
                </div>
                <?php } ?>

                <?php
                   /*() if(!empty($message)){
                        echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".$message."</div>";
                    }
                    if(!empty($message_error)){
                        echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".$message_error."</div>";
                    }
                     if(!empty($message_warning)){
                        echo "<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".$message_warning."</div>";
                    }*/
                    
                ?>

            </div>
        </div>

      <div class="row">
          <div class="col-xs-2">
              <img src="<?php echo base_url(); ?>assets/images/<?= $profile_url; ?>" width="90%">
          </div>
          <div class="col-xs-10">
              <big>
              <strong><?php echo strtoupper($g_home_desc); ?></strong> <BR>
              <?php echo $g_address; ?><br>
              <!--<i>Laman Sesawang : <u><?php echo $g_weburl; ?></u></i> <br>
              <i>Email : <u><?php echo $g_email; ?> </u></i>-->
            </big>
          </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <hr>
      <div class="row invoice-info">
        <div class="col-sm-8 invoice-col">
          <medium>
           <i><u><strong>KEPADA :</strong></u></i><br>
            <?php 
            //foreach ($userlist as $user): 
            //  if ($user->userId == $userid)
                echo "<b>".$u_name."</b> 
                <br> No. Ahli: ".$u_noAhli;
           // endforeach 


            ?>
          
          </medium>
        </div>
        <div class="col-sm-4">
          <medium class="pull-right">
                <strong>Ruj. Kami: </strong><?php echo sprintf('%04d',$userid) ?><br>
                <strong>Tarikh : </strong> 
                <?php 
                    //$date = strtotime($p_date); 
                    echo $new_date = date('d-m-Y');
                ?>
              </medium>
        </div>
      </div>
      <!-- /.row -->
      <p><br>
      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-12">
          <medium>
        
          Assalamualaikum W.B.T<br>
          
          YBhg.Dato'/Datin/Tuan/Puan,<p>&nbsp;</p>

          <b><u>PER: NOTIS PERINGATAN TUNGGAKAN YURAN </u></b><br>
          Perkara di atas adalah dirujuk.</p>

          2.&nbsp; Dengan hormatnya, adalah dimaklumkan bahawa semakan mendapati YBhg.Dato'/Datin/Tuan/Puan masih
          mempunyai tunggakan yuran seperti perincian di bawah : <p>&nbsp;</p>

          <table class="table table-striped">
            <tr>   
              <td><b>Keterangan</b></td>
              <td><b>Status</b></td>
              <td><b>Catatan Resit</b></td>
              <td align="right"><b>Jumlah (RM)</b></td>
            </tr>

            <?php
                $total_amaun = 0;
                if(!empty($paymentrecord))
                {
                    
                    foreach ($paymentrecord as $pr)
                    {
                        $total_amaun = $total_amaun + $pr->total_amaun;
                        ?>
                        <tr>
                        
                            <td>
                              <?php if ($pr->status == "Belum Selesai"){ ?>
                                <font color="red"><?php echo $pr->y_title; ?></font>
                                <?php } else { 
                                  echo $pr->y_title; 
                                }?>
                            </td>
                          
                          <td>
                            <?php 
                            //echo $pr->statusbayaran;
                            if ($pr->statusbayaran == "Belum Selesai") { ?>
                                <!--<span class="badge bg-red">Belum Selesai</span> -->
                                <span class="badge bg-red">Belum Selesai</span>
                            <?php } ?>
                          </td>
                          <td> <?php 
                            if ($pr->statusbayaran == "Selesai") { ?>
                                <font color="blue"><?php echo $pr->catatan;?></font>
                            <?php } else if ($pr->statusbayaran == "Belum Selesai") { ?>
                                -
                            <?php } ?>
                          </td>
                          
                    
                            <td align="right">
                              <?php if ($pr->status == "Belum Selesai"){ ?>
                              <font color="red"><?php echo $pr->total_amaun; ?></font>
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
              <td colspan="3" align="right"><b>Jumlah Bayaran</b></td>
              <td align="right"><?= number_format($total_amaun, 2); ?></td>
            </tr>
            
          </table>



          3.&nbsp; Sehubungan dengan itu, pihak kami amat berterima kasih di atas kerjasama pihak Ybhg.Dato'/Datin/Tuan/Puan untuk menyemak dan menjelaskan yuran sebanyak <b>RM<?= number_format($total_amaun, 2); ?></b>
          dengan kadar <b>SEGERA</b>. Berdasarkan peraturan <b><?php echo $g_home_desc; ?></b>, kegagalan menjelaskan yuran akan menyebabkan keahlian dan manfaat <b>DIBATALKAN</b>. Bayaran boleh dijelaskan secara tunai, <i>online transfer</i> <b><?php echo $g_bankname." (".$g_bankaccount.")"; ?></b> atau secara FPX melalui sistem.<p>&nbsp;</p>

          4.&nbsp; Sekiranya ada pertanyaan lanjut, mohon hubungi pentadbir. Komitmen Ybhg.Dato'/Datin/Tuan/Puan dalam perkara ini sangatlah dihargai dan didahului ucapan terima kasih.<p>&nbsp;</p>
          Sekian.
          </medium>


          <?php 
            /*foreach ($yuranlist as $yuran): 
              if ($yuran->yid == $yid){
                echo "<p><b>".$yuran->y_title."</b></p>";
                 if ($catatan){
                  echo "<p><b>Catatan</b> :&nbsp;".$catatan."</p>";
                 } 
               }
            endforeach*/ ?>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            <i>* Resit Ini Adalah Cetak Komputer. Tandatangan Tidak Diperlukan.</i>
          </p>

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <?php 
          //echo $role;
          if($role == 1) { ?>
          <!--<a href="<?= base_url().'payment/delete/'.$p_id; ?>" class="btn btn-danger" onclick="javasciprt: return confirm('Adakah anda pasti untuk batalkan resit ini ?')"><i class="fa fa-delete"></i> Batal Resit No.<?php echo sprintf('%05d',$p_id);?></a>
          <a class="btn btn-info" href="<?= base_url().'payment/update/'.$p_id; ?>" title="Edit">Kemaskini Resit</a>-->
          
          <a class="btn btn-primary" href="<?= base_url().'editUsers/'.$userid; ?>" title="View">Maklumat Ahli</a>
          <!--
          <a class="btn btn-success" href="http://www.wasap.my/+6<?php echo $u_phone; ?>/*<?php echo $g_home_title ?>*: Jumlah tunggakan yuran khairat <?php echo $u_name; ?> ialah *RM<?= number_format($total_amaun, 2); ?>*. Terima Kasih" target="_blank">Whatsapp</a>-->
          &nbsp;
          <a class="btn btn-success" href="" id="whatsappId" data-id="<?php echo $userid; ?>" title="Message" data-toggle="modal" data-target="#whatsappModal"><i class="ion ion-social-whatsapp"></i> Whatsapp</a>

           &nbsp;
          <a class="btn btn-warning" href="" id="smsId" data-id="<?php echo $userid; ?>" title="Message" data-toggle="modal" data-target="#smsModal"><i class="ion ion-android-textsms"></i> SMS</a>

          <!--<a class="btn btn-success" href="<?= base_url().'payment/send_mail_payment/'.$p_id; ?>" title="View"> 
            <i class="fa fa-envelope"></i> Hantar Emel
          </a>-->
          <?php } ?>
          <button type="button" class="btn btn-primary pull-right" onclick="window.print();return false;">
            <i class="fa fa-print"></i> Cetak Surat
          </button>

        </div>
      </div> 
          
          <!--<table class="table table-bordered">
        	    <tr><td>P Date</td><td><?php echo $p_date; ?></td></tr>
        	    <tr><td>Userid</td><td><?php echo $userid; ?></td></tr>
        	    <tr><td>Yid</td><td><?php echo $yid; ?></td></tr>
        	    <tr><td>Attachment</td><td><?php echo $attachment; ?></td></tr>
        	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
        	    <tr><td>Catatan</td><td><?php echo $catatan; ?></td></tr>
  	      </table>-->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">&nbsp;
          <!--<a href="<?php echo site_url('payment') ?>" class="btn btn-default">Cancel</a>-->
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      </section>


</div>

<!-- MODAL WINDOW START -->
        <div class="modal fade" id="whatsappModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <div class="modal-title" id="searchModalLabel">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                   </button>
                   <div class="section-title mb-10">                                
                    <b>NOTIS PERINGATAN - WEB WHATSAPP</b>
                  </div>
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

  <!-- MODAL WINDOW START -->
        <div class="modal fade" id="smsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <div class="modal-title" id="searchModalLabel2">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                   </button>
                   <div class="section-title mb-10">                                
                    <b>NOTIS PERINGATAN - SMS</b>
                  </div>
                </div>
                
              </div>
              <div class="modal-body">
                  <div id="modal-loader" style="display: none; text-align: center;"></div>         
                  <div id="dynamic-content2"></div>
                  <div id="dynamic-name"></div>
              </div>
              
              <!--<div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Tutup</button>
              </div>-->
            </div>
          </div>
        </div>
        <!-- MODAL WINDOW -->

<!-- MODAL JSCRIPT WHATSAPP-->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>
    <script>
      $(document).ready(function(){
        $(document).on('click', '#whatsappId', function(e){
          e.preventDefault();
          var uid = $(this).data('id');   // it will get id of clicked row
          
          $('#dynamic-content').html(''); // leave it blank before ajax call
          $('#whatsappModal').show();      // load ajax loader
          
          $.ajax({
            url: '<?php echo base_url() ?>whatsappDetail',
            type: 'POST',
            data: 'id='+uid,
            dataType: 'html'
          })
          .done(function(data){
            console.log(data);  
            $('#dynamic-content').html('');    
            $('#dynamic-content').html(data); // load response 
            $('#whatsappModal').hide();      // hide ajax loader 
          })
          .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#whatsappModal').hide();
          });
          
        });
        
      });
    </script>

<!-- MODAL JSCRIPT SMS-->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>
    <script>
      $(document).ready(function(){
        $(document).on('click', '#smsId', function(e){
          e.preventDefault();
          var usid = $(this).data('id');   // it will get id of clicked row

          
          $('#dynamic-content2').html(''); // leave it blank before ajax call
          $('#smsModal').show();      // load ajax loader
          
          $.ajax({
            url: '<?php echo base_url() ?>smsDetail',
            type: 'POST',
            data: 'uid='+usid,
            dataType: 'html'
          })
          .done(function(data){
            console.log(data);  
            $('#dynamic-content2').html('');    
            $('#dynamic-content2').html(data); // load response 
            $('#smsModal').hide();      // hide ajax loader 
          })
          .fail(function(){
            $('#dynamic-content2').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#smsModal').hide();
          });
          
        });
        
      });
    </script>