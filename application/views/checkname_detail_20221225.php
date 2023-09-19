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
    $g_weburl = $info->g_weburl;
  }
}

if(!empty($user_data)){ 
	foreach ($user_data as $userr)
  { 
	 $display_id =  $userr->userId;
   $display_noAhli =  $userr->noAhli;
	 $display_nama =  $userr->name;
	 $display_status = $userr->status;
	 $display_email =  $userr->email;
	 $display_phone =  $userr->phone;
	 $display_regdate =  $userr->regdate;
   $display_icno =  $userr->icno;
   $display_address =  $userr->address;
   $display_surau =  $userr->surau;
   $display_roleid =  $userr->roleId;
 	} 
}
	
?>


<!--<section class="invoice">-->
      
     <!--<div class="row">
        <div class="col-sm-12" align="center">
          <h2 class="page-header">
            <img src="<?php echo base_url(); ?>assets/images/logo1.png" width="250"> 
          </h2>
        </div>
      </div>-->
    
      <!-- info row -->
      <div class="row">
        <div class="col-sm-12">
          <b>Nama : <font color="blue"><?php echo strtoupper($display_nama); ?></font></b><br>
          <!--<b>Tarikh Pendaftaran :</b> <?php echo date("d-m-Y", strtotime($display_regdate)); ?><br>-->
          <b>Nombor Ahli :</b> <?php echo $display_noAhli; ?><br> 
          <b>Kariah :</b> 
          <?php
              if(!empty($surauInfo))
              {
                  foreach ($surauInfo as $sr)
                  {
                      if($sr->id == $display_surau) {
                        echo $sr->name.", ".$sr->desc;
                      }  
                  }
              }
              ?>
          <br> 
          <b>Jenis Ahli :</b> 
          <?php
              if(!empty($roles))
              {
                  foreach ($roles as $rl)
                  {
                      if($rl->roleId == $display_roleid) {
                        echo $rl->role;
                      }  
                  }
              }
              ?>
          <br> 
          <!--<b>Alamat : </b> <?php if (empty($display_address)) { echo "<font color=red>Belum dikemaskini !</font>"; } else { echo "************"; } ?><br>-->
        </div>
        <!--<div class="col-sm-12 invoice-col">
          <b>No. IC : </b>
            <?php if (empty($display_icno)) { echo "<font color=red>Belum dikemaskini !</font>"; } else { echo "************"; } ?><br>
          <b>Email :</b> <?php if (empty($display_email)) { echo "<font color=red>Belum dikemaskini !</font>"; } else { echo "************"; } ?><br>
          <b>No. Telefon:</b> <?php if (empty($display_phone)) { echo "<font color=red>Belum dikemaskini !</font>"; } else { echo "************"; } ?><br> 
        </div>-->
      </div>
      <br>
      <!-- /.row -->
      <!-- Table row -->
      <div class="row">
        <div class="col-md-12">
          
            <table class="table table-striped table-hover table-responsive" width="100%">
              <tr>
                <td><b>Bil.</b></td>
                <td width="200px"><b>Perkara</b></td>
                <td width="150px"><b>Status</b></td>
                <!--<td><b>No. Resit</b></td>-->
                <td align="right"><b>Jumlah(RM)</b></td>
              </tr>

              <?php
                  $total_amaun = 0;
                  $bil = 1;
                  if(!empty($paymentrecord))
                  {
                      
                      foreach ($paymentrecord as $pr)
                      {
                          $total_amaun = $total_amaun + $pr->total_amaun;
                          ?>
                          <tr>
                            <td><?php echo $bil++; ?>.</td>
                           <td>
                              <?php if ($pr->status == "Belum Selesai"){ ?>
                              <font color="red"><?php echo $pr->y_title; ?></font>
                              <?php } else {  
                                echo $pr->y_title; 
                                echo "<br><small><i><font color='blue'>".$pr->catatan."</font></i></small>";
                              }?>
                            </td>
                            
                            <td>
                              <?php 
                              if ($pr->status == "Selesai") { ?>
                                  <font color='green'>Selesai</font>
                              <? } else if ($pr->status == "Belum Selesai") { ?>
                                  <font color='red'>Belum Selesai</font>
                              <? } ?>
                              
                            </td>
                            <!--<td> <?php 
                              if ($pr->status == "Selesai") { ?>
                                  <font color="red"><?php echo sprintf('%05d',$pr->p_id);?></font>
                              <? } else if ($pr->status == "Belum Selesai") { ?>
                                  -
                              <? } ?></td>-->
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
                <td align="right"><b><?= number_format($total_amaun, 2); ?></b></td>
              </tr>
              
            </table>

        </div>
        <!-- /.col -->
      </div>

      <div class="row">
        <div class="col-sm-12 invoice-col">
        <div align="center">
          <p>"Sila <a href="<?php echo $g_weburl; ?>">LOGIN</a> untuk mengemaskini maklumat ahli"</p>
        </div>
        </div>
      </div>
      <!-- /.row -->
      <form role="form" id="payUserPublic" action="<?php echo base_url(); ?>FPXPayment" method="post">
      <div class="row">
        <div class="col-sm-12 invoice-col">
        <div align="center">
          <img src="<?php echo base_url(); ?>assets/images/toyyibpay_button.png" alt="" class="img-fluid"><br>&nbsp;<br>
           <input type="hidden" name="userid" value="<?php echo $display_id; ?>" /> 
           <button type="submit" name="submit" class="btn btn-sm btn-danger" value="Submit">Bayar Sekarang</button>
        </div>
        </div>
      </div>
      </form>

      <!-- /.row -->

      <!-- this row will not appear when printing -->
  <!--  </section> -->
