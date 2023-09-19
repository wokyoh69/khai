<?php 
  foreach ($userlist as $user): 
    if ($user->userId == $userid){
      $u_name = $user->name;
      $u_id = $user->userId;
      $u_noAhli = $user->noAhli;
      $u_address = $user->address;
      $u_phone = $user->phone;
      $u_icno = $user->icno;
      //echo "<b>".$user->name."</b> <br> No. Ahli : ". sprintf('%04d',$user->userId)."<br> Alamat : ".$user->address;
    }
  endforeach 
  ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php if($role == 1) { ?>
    <section class="content-header">
      <h1>
        <i class="fa fa-calculator" aria-hidden="true"></i> Resit Bayaran
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    
        <li><a href="<?php echo base_url(); ?>paymentListing">Senarai Bayaran</a></li>
       
        <li class="active">Resit Bayaran</li>
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
      <div class="row">
          <div class="col-xs-12" align="center">
              <img src="<?php echo base_url(); ?>assets/images/<?= $profile_url; ?>" width="100"><br>
              <strong><?php echo strtoupper($g_home_desc); ?></strong> <BR>
              <?php //echo $g_address; ?><br>
              <!--<i>Laman Sesawang : <u><?php echo $g_weburl; ?></u></i> <br>
              <i>Email : <u><?php echo $g_email; ?> </u></i>-->
            
          </div>
        <!-- /.col -->
      </div>

      <div class="row">
          <div class="col-xs-12">
              <medium class="pull-right">
                No. Resit : <font color="red"><?php echo sprintf('%05d',$p_id);?></font><br>
                Tarikh : <?php //echo $p_date; ?>
                <?php 
                    $date = strtotime($p_date); 
                    echo $new_date = date('d-m-Y', $date);
                ?>
              </medium>
          </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <p>
      <div class="row">
        <div class="col-sm-12">
            <medium>
              <?php 
              //foreach ($userlist as $user): 
              //  if ($user->userId == $userid)
                  echo "<b>".strtoupper($u_name)."</b> 
                  
                  <br> No. Ahli : ".$u_noAhli."
                  <br> Alamat : ".$u_address;
             // endforeach 
              ?>
            </medium>
        </div>
      </div>
      <!-- /.row -->
      <p>
      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-12">
          <br><b>Jumlah</b> : RM<?php echo $total_amaun; ?></br>
          <?php 
            foreach ($yuranlist as $yuran): 
              if ($yuran->yid == $yid){
                echo "<p><b>Jenis Yuran : </b>".$yuran->y_title."</p>";
                 if ($catatan){
                  echo "<p><b>Catatan : </b>".$catatan."</p>";
                 } 
               }
            endforeach ?>
        </div>
        <div class="col-xs-12"> 
          <div class="form-group">
              <label for="status">Status : </label>
                  <?php 
                        //echo $status;
                        if ($status == "Selesai") { ?>
                            <span class="badge bg-green">Selesai</span>
                            <span class="badge bg-yellow">No.Resit : <?php echo sprintf('%05d',$p_id);?></span>
                            <?php 
                            if (!empty($pg_billcode)) { ?>
                            <a href="<?php echo $pg_defaulturl.$pg_billcode; ?>" target="_blank">
                              <span class="badge bg-blue">Resit FPX: <?php echo $pg_billcode;?></span>
                            </a>
                           <?php } ?>
                        <?php  } ?>
                            
              <!--<label for="payDate">Tarikh Bayaran : </label>                     
                <?php echo date("d-m-Y", strtotime($khairat->k_date)); ?>
              -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <?php if (!empty($paymentdetail)) { ?> 
          <div class="col-md-12"> <!-- right column -->
            <div class="box">
            <!-- /.box-header -->
            <div class="box-body ">
              <div class="box-body table-responsive">
                <table class="table table-bordered table-striped table-hover" style="margin-bottom: 10px">
                  <tr>
                    <th>Bil.<?php $num = 0;?></th>
                    <!--<th>&nbsp;</th>-->
                    <th>Nama</th>
                    <th>Pertalian</th>
                    <th>Amaun</th>
                  </tr>
                  <?php
                  $feesA = 0;
                  foreach ($paymentdetail_ahli as $det_a)
                  { 
                      ?>
                  <tr>
                    <td width="30"><?php echo ++$num; ?>.</td>
                    <!--<td>&nbsp;</td>-->
                    <td><?php echo "<strong>".strtoupper($det_a->name)."</strong>";?></td>
                    <td width="30"><?php echo strtoupper("AHLI"); ?></td>
                    <td align="right">
                      <?php 
                        $feesA = $det_a->amaun;
                        echo $feesA; ?>
                    </td>
                  </tr>


                  <?php } ?>
                  <?php
                  $feesF = 0;
                  $sumF = 0;
                  foreach ($paymentdetail as $det)
                  { 
                    ?>    
                    <tr>
                      <td width="30"><?php echo ++$num; ?>.</td>
                      <!--<td><input type="hidden" name="checked_fid[]" value="<?php echo $det->f_id; ?>" > </td>-->
                      <td><strong><?php echo strtoupper($det->f_name); ?></strong></td>
                      <td width="30"><?php echo strtoupper($det->f_pertalian); ?></td>
                      <td align="right" width="100">
                        <?php 
                        //$feesF = total_yuran_in_year(date('m'),$det->amaun); 
                        $feesF = $det->amaun;
                        echo $feesF; ?>
                      </td>    
                    </tr>
                   <?php
                    $sumF = $sumF + $feesF;
                  } 
                  ?>
                  <tr>
                    <td colspan="3">
                      <strong>
                            <?php
                                foreach ($yuranlist as $yu)
                                {
                                     if($yu->yid == $yid)
                                        echo $yu->y_title; 
                                }
                            ?>
                      </strong>
                    </td>
                    <td align="right">
                          <?php
                                //echo $checkyuran;
                                $YearlFee = $amaun;
                                //if ($countyuran > 1){
                                //  $YearlFee = 0;
                                //} else { 
                                //  foreach ($yuranlist as $yu)
                                //  {
                                //       if($yu->yid == $yid)
                                //          $YearlFee = $yu->y_jumlah; 
                                //  }
                                //} 
                                echo "<font color='blue'>".number_format($YearlFee,2)."</font>"; 
                            ?>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3"><strong>Jumlah Keseluruhan Yuran</strong></td>
                    <td align="right"><strong>
                      <?php 
                        $total = $feesA + $sumF + $YearlFee;
                        echo number_format($total ,2); ?></strong></td>
                  </tr>

                </table>
              </div>
            </div>
            <!-- /.box-body -->
            </div>
          <?php } ?>




      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            <i>Nota : Resit ini adalah cetakan komputer. Tandatangan tidak diperlukan.</i>
          </p>

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <?php 
          //echo $vendorId;
          if($role == 1) { 
            if($vendorId == 0) {?>
          <a href="<?php echo base_url().'payment/delete/'.$p_id; ?>" class="btn btn-danger" onclick="javasciprt: return confirm('Adakah anda pasti untuk batalkan resit ini ?')"><i class="fa fa-delete"></i> Batal Resit No.<?php echo sprintf('%05d',$p_id);?></a>
            <?php } ?>
          <a class="btn btn-info" href="<?php echo base_url().'payment/update/'.$p_id; ?>" title="Edit">Kemaskini Resit</a>
          
          <a class="btn btn-primary" href="<?php echo base_url().'editUsers/'.$userid; ?>" title="View">Maklumat Ahli</a>
          <?php } ?>
          <button type="button" class="btn btn-primary pull-right" onclick="window.print();return false;">
            <i class="fa fa-print"></i> Cetak Resit
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