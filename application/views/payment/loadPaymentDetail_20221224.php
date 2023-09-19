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
      $u_email = $user->email;
      $u_icno = $user->icno;
      //echo "<b>".$user->name."</b> <br> No. Ahli : ". sprintf('%04d',$user->userId)."<br> Alamat : ".$user->address;
    }
  endforeach 
  //$this->load->helper('form');
  //echo $role_user;
  ?>
<form role="form" id="payUser" action="<?php echo base_url(); ?>paymentUser" method="post">
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

<?php 
if ($status == "Belum Selesai") { ?>
<div class="row">
  <div class="col-md-12">
     <table class="table table-striped">
          <tr>
            <td><b>Emel</b></td><td>:</td>
            <td><input type="email" class="form-control" id="email" placeholder="cth: ahli@mail.com" name="email" value="<?php echo $u_email; ?>" maxlength="128" required>
            </td>
            <td><small><i>cth : ahmad@mail.com</i></small> </td>
          </tr>
          <tr>
            <td><b>Telefon</b></td><td>:</td>
            <td>
              <input type="phone" class="form-control" id="phone" placeholder="cth: 013-4567890" name="phone" value="<?php echo $u_phone; ?>" maxlength="11" pattern="[0-9]{10,11}" required>
            </td>
            <td><small><i>cth : 0128910228</i></small></td>
          </tr>
          <tr>
            <td colspan="4">

                         <small><font color="blue">Sila masukkan emel dan telefon yang sah untuk membuat bayaran secara FPX >> </font></small>
                        <button type="submit" name="submit" class="btn btn-sm btn-danger" value="Submit">Bayar Sekarang</button>
                   
            </td>
          </tr>
      </table>
  </div>
</div>
<? }?>  
<p>
  
<div class="row"> <!-- start row A -->
   <div class="col-md-12">
      <b><?php echo strtoupper($u_name); ?></b>
   </div>
</div>
<div class="row">
   <div class="col-md-6">
     <div class="form-group">
          <label for="int">Jenis Yuran : </label> 
              <?php
                  foreach ($yuranlist as $yu)
                  {
                       if($yu->yid == $yid)
                          echo $yurandesc = $yu->y_title; 
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
                        <?php 
                        if (!empty($pg_billcode)) { ?>
                        <a href="<?php echo $pg_defaulturl.$pg_billcode; ?>" target="_blank">
                          <span class="badge bg-blue">Resit FPX: <?php echo $pg_billcode;?></span>
                        </a>
                       <?php } ?>
                    <? } else if ($status == "Belum Selesai") { ?>
                        <span class="badge bg-red">Belum Selesai</span><br>
                        <input type="hidden" name="userid" value="<?php echo $u_id; ?>" /> 
                        <input type="hidden" name="p_id" value="<?php echo $p_id; ?>" /> 
                        <input type="hidden" name="yurandesc" value="<?php echo $yurandesc; ?>" /> 
             <? } ?>
          <!--<label for="payDate">Tarikh Bayaran : </label>                     
            <?php echo date("d-m-Y", strtotime($khairat->k_date)); ?>
          -->
      </div>
    </div>
</div> <!-- end row A -->





<div class="row"> <!-- start row B -->
<?php if (!empty($paymentdetail)) { ?> <!-- starf ifAll -->
  <div class="col-md-12"> 
  <div class="box-body table-responsive"> <!-- start table A -->
    <table class="table table-bordered table-striped table-hover" style="margin-bottom: 10px">
      <tr>
        <th>Bil.<?php $num = 1;?></th>
        <th>Nama</th>
        <th>Pertalian</th>
        <th>Amaun</th>
      </tr>
     <?php 
      $feesA = 0;
      $totalA = 0;
      foreach ($paymentdetail_ahli as $det_a)
      { 
        ?>    
        <tr>
          <td width="30"><?php echo $num++; ?>.</td>
          <td>
            <strong><?php echo strtoupper($det_a->name); ?></strong>
          </td>
          <td width="100"><?php echo strtoupper("AHLI"); ?></td>
          <td align="right">
            <?php 
            $feesA = $det_a->amaun;
            echo $feesA; ?>
          </td>    
        </tr>
      <?php 
      }
      $feesF = 0;
      $sumF = 0;
      foreach ($paymentdetail as $det)
      { 
        ?>    
        <tr>
          <td width="30"><?php echo $num++; ?>.</td>
          <td>
            <strong><?php echo strtoupper($det->f_name); ?></strong>
          </td>
          <td width="100"><?php echo strtoupper($det->f_pertalian); ?></td>
          <td align="right">
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
                         {
                            echo $yu->y_title; 
                            //echo "&nbsp;<font color='blue'><small>(*Yuran tahunan hanya dikenakan sekali setiap tahun)</small></font>";
                          }
                    }
                ?>
          </strong>
        </td>
        <td align="right">
              <?php
                  $YearlFee = $amaun;
                  echo "<font color='blue'>*".number_format($YearlFee,2)."</font>"; 
              ?>

      </td>
      </tr>
      <tr>
        <td colspan="3"><strong>Jumlah Yuran</strong></td>
        <td align="right">
          <strong>
            <?php 
            $total = $feesA + $sumF + $YearlFee;
            echo number_format($total ,2); ?>
          </strong>
          <input type="hidden" name="amaun" value="<?php echo $total; ?>" /> 
        </td>
      </tr>
    </table>
    <font color='blue'><small>* Yuran tahunan hanya dikenakan sekali setiap tahun</small></font>
  </div>
  </div> <!-- end table A -->
<?php } else { ?>

                <!-- starf ifNext & paymentdetail empty -->
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
                          <input type="hidden" name="amaun" value="<?php echo $total; ?>" /> 
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
                      <td align="right" width="100"><?php echo $jumlah = $de->amaun; ?>
                      </td>
                    </tr>
                    <tr>
                    <td colspan="3">
                      <strong>
                            <?php
                                foreach ($yuranlist as $yu)
                                {
                                     if($yu->yid == $yid)
                                     {
                                        echo $yu->y_title; 
                                        //echo "&nbsp;<font color='blue'><small>(* Yuran tahunan hanya dikenakan sekali setiap tahun)</small></font>";
                                      }
                                }
                            ?>
                      </strong>
                    </td>
                    <td align="right">
                            <?php
                                $YearlFee = $amaun;
                                echo "<font color='blue'>*".number_format($YearlFee,2)."</font>"; 
                            ?>
                            <input type="hidden" name="amaun" value="<?php echo $YearlFee; ?>" /> 
                    </td>
                  </tr>
                  <?php } //endforeach ?>
                  </table>
                  <font color='blue'><small>* Yuran tahunan hanya dikenakan sekali setiap tahun </small></font>
                </div>
                </div>
                <?php } ?> <!-- end ifNext -->

<?php } ?> <!-- end ifAll-->
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
</form>

             

