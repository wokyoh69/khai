<?php //include ($_SERVER['DOCUMENT_ROOT']."/buuv2/application/views/functions.php"); ?>
<?php //require APPPATH ."/views/functions.php"; ?>
<?php //include (echo base_url()."functions.php"); ?>

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

<div class="row">
    <div class="col-xs-12" align="center">
        <img src="<?php echo base_url(); ?>assets/images/logoNew.png" width="100"><br>
        <strong><?php echo strtoupper($g_home_desc); ?></strong> <BR>
        <?php //echo $g_address; ?><br>
        <!--<i>Laman Sesawang : <u><?php echo $g_weburl; ?></u></i> <br>
        <i>Email : <u><?php echo $g_email; ?> </u></i>-->
      
    </div>
  <!-- /.col -->
</div>

<div class="row">
  <div class="col-md-12">
    <b><?php echo strtoupper($u_name); ?></b>
  </div>
</div>

<div class="row"> <!-- start row A -->
   <div class="col-md-6">
     <div class="form-group">
          <label for="int">Jenis Yuran : </label> 
              <?php
                  foreach ($yuranlist as $yu)
                  {
                       if($yu->yid == $yid)
                          echo $yu->y_title; 
                  }
              ?>
      </div>
    </div>
    <div class="col-md-6" align="right"> 
      <div class="form-group">
          <label for="status">Status : </label>
              <?php 
                    //echo $status;
                    if ($status == "Selesai") { ?>
                        <span class="badge bg-green">Selesai</span>
                        <span class="badge bg-yellow">No.Resit : <?php echo sprintf('%05d',$p_id);?></span>
                    <? } else if ($status == "Belum Selesai") { ?>
                        <span class="badge bg-red">Belum Selesai</span>
             <? } ?>
          <!--<label for="payDate">Tarikh Bayaran : </label>                     
            <?php echo date("d-m-Y", strtotime($khairat->k_date)); ?>
          -->
      </div>
    </div>
</div> <!-- end row A -->





<div class="row"> <!-- start row B -->
<?php if (!empty($paymentdetail)) { ?> 
<div class="col-md-12"> 
<div class="box-body table-responsive"> <!-- start table A -->
  <table class="table table-bordered table-striped table-hover" style="margin-bottom: 10px">
    <tr>
      <th>Bil.<?php $num = 1;?></th>
      <th>Nama</th>
      <th>Pertalian</th>
      <!--<th>No.IC</th>
      <th>Umur</th>
      <th>Yuran</th>-->
      <th>Amaun</th>
    </tr>
    <?
    $jumlah = 0;
    $total = 0;
    foreach ($payment as $de)
    { 
        ?>
    <tr>
      <td width="30"><?php echo $num++; ?>.</td>
      <td>
        <?php
        if(!empty($userlist))
        {
            foreach ($userlist as $us)
            {
                if($us->userId == $de->userid) {
                  echo "<strong>".strtoupper($us->name)."</strong>";
                }
            }
        }
        ?>
      </td>
      <td width="100">AHLI</td>
      <!--<td width="100"><?php echo $u_icno; ?></td>
      <td width="100">
          <?php 
            if($u_icno != "") {
              $no_ic = str_replace(' ', '', $u_icno);
              echo $age = umur($no_ic); 
            } else {
              echo $age = 0;
            }
            ?>
      </td>
      <td width="100"><?php echo yuran ("AHLI", $age); ?></td>-->
      <td align="right" width="100"><?php echo $jumlah = $de->amaun; ?>
      </td>
    </tr>
    <?php } 
    $total = 0;
    foreach ($paymentdetail as $det)
    { 
      ?>    
      <tr>
        <td width="30"><?php echo $num++; ?>.</td>
        <!--<td><input type="hidden" name="checked_fid[]" value="<?php echo $det->f_id; ?>" > </td>-->
        <td>
          <strong><?php echo strtoupper($det->f_name); ?></strong>

        </td>
        <td width="100"><?php echo strtoupper($det->f_pertalian); ?></td>
        <!--<td width="100"><?php echo strtoupper($det->f_icno); ?></td>
        <td width="100"> 
          <?php 
            if($det->f_icno != "") {
              $no_ic = str_replace(' ', '', $det->f_icno);
              echo $age = umur($no_ic); 
            } else {
              echo $age = 0;
            }
            ?>
         </td>
        <td width="100"><?php echo yuran ($det->f_pertalian, $age); ?></td>-->
        <td align="right"><?php echo $det->amaun; ?></td>    
      </tr>
      <?php
      $total = $total + $det->amaun;
    } 
    ?>
    <tr>
      <td colspan="3"><strong>Jumlah Yuran</strong></td>
      <td align="right"><strong><?php echo number_format($jumlah + $total ,2); ?></strong></td>
    </tr>
  </table>
</div>
</div> <!-- end table A -->
<?php } else { ?>
<?php if ($yid == 1 ) { ?>
<!-- start table B -->
<div class="col-md-12"> 
<div class="box-body table-responsive"> 
  <table class="table table-bordered table-striped table-hover" style="margin-bottom: 10px">
    <tr>
      <th>Bil.<?php $num = 1;?></th>
      <th>Yuran</th>
      <th align="right">Amaun</th>
    </tr>
    <?php 
    foreach ($yuranlist as $yu)
        { 
          if($yu->yid == $yid) {?>
          <tr>
              <td width="30"><?php echo $num; ?>.</td>
              <td><strong><?php echo strtoupper($yu->y_title); ?></strong></td>
              <td align="right"><?php echo $yu->y_jumlah ?></td>    
          </tr>
    <?php
          $total = $yu->y_jumlah;
            } 
        }?>
    <tr>
      <td colspan="2"><strong>Jumlah Yuran</strong></td>
      <td align="right" width="100"><strong><?php echo number_format($total ,2); ?></strong></td>
    </tr>
  </table>
</div>
</div>
<!-- end table B -->
<?php } else { ?>
<div class="col-md-12"> 
<div class="box-body table-responsive"> 
<table class="table table-bordered table-striped table-hover" style="margin-bottom: 10px">
    <tr>
      <th>Bil.<?php $num = 1;?></th>
      <th>Nama</th>
      <th>Pertalian</th>
      <!--<th>No.IC</th>
      <th>Umur</th>
      <th>Yuran</th>-->
      <th>Jumlah</th>
    </tr>
    <?
    $jumlah = 0;
    $total = 0;
    foreach ($payment as $de)
    { 
        ?>
    <tr>
      <td width="30"><?php echo $num = 1; ?>.</td>
      <td><?php
        if(!empty($userlist))
        {
            foreach ($userlist as $us)
            {
                if($us->userId == $de->userid)
                  echo "<strong>".strtoupper($us->name)."</strong>";
            }
        }
        ?>
      </td>
      <td width="100">AHLI</td>
      <!--<td width="100"><?php echo $u_icno; ?></td>
      <td width="100">
          <?php 
            if($u_icno != "") {
              $no_ic = str_replace(' ', '', $u_icno);
              echo $age = umur($no_ic); 
            } else {
              echo $age = 0;
            }
            ?>
      </td>
      <td width="100"><?php echo yuran ("AHLI", $age); ?></td>-->
      <td align="right" width="100"><?php echo $jumlah = $de->amaun; ?>
      </td>
    </tr>
  <?php } //endforeach ?>
  </table>
</div>
</div>
<?php }
}
?>

</div> <!--end row B -->

<div class="row"> <!-- start row C-->
    <div class="col-md-12" align="left"> 
      <div class="form-group">
          <label for="status">Catatan : </label>
            <?php 
            if ($catatan) { ?>
               <font color="blue"><?php echo $catatan; ?></font>
             <?php }  ?>
      </div>
    </div>
</div> <!-- end row C-->

             

