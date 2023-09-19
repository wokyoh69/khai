<?php //include ($_SERVER['DOCUMENT_ROOT']."/buuv2/application/views/functions.php"); ?>
<?php //require APPPATH ."/views/functions.php"; ?>
<?php
//print_r($_POST);
//echo log_path();
  //echo base_url()."application/views/functions.php";
  //echo $_SERVER['DOCUMENT_ROOT']."/buuv2/application/views/functions.php";
  //echo $_SERVER['PATH_INFO'];
  //echo $_SERVER['REQUEST_URI'];
  //echo $config['function_path'];
  //echo APPPATH . '/views/functions.php'; /*tambah*/
  
	
	foreach ($applicant_info as $app)
  { 
	 $display_id =  $app->userId;
	 $display_nama =  $app->name;
	 $display_status = $app->status;
	 $display_email =  $app->email;
	 $display_phone =  $app->phone;
	 $display_regdate =  $app->regdate;
   $display_icno =  $app->icno;
   $display_address =  $app->address;
   $display_surau =  $app->surau;
   $display_roleid =  $app->roleId;
   $display_pakej =  $app->pakej;
   $ahli_khairat =  $app->ahli_khairat;
 	} 

 $bulan_daftar = substr($display_regdate,5,2);
 $month_name = date("F", mktime(0, 0, 0, $bulan_daftar, 10));
 $tahun_daftar= substr($display_regdate,0,4);
	
?>
<!--<section class="invoice">-->
      
      
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-12" align="center">
          <b><label class="text-primary">Adakah permohonan ini diluluskan ?</label></b>
          <a href="<?= base_url().'user/applicantApprove/'.$display_id; ?>" class="btn btn-primary" onclick="javasciprt: return confirm('Permohonan menjadi ahli diluluskan ?')">Lulus</a>
          <a href="<?= base_url().'user/applicantReject/'.$display_id; ?>" class="btn btn-danger" onclick="javasciprt: return confirm('Nota : Semua maklumat pemohon akan dipadam')">Tidak</a>
        </div>
        <p>&nbsp;</p>
        <div class="col-sm-12 invoice-col">
           <table class="table table-striped">
              <tr><td width="150"><b>Nama</b></td><td>:</td><td><strong><?php echo strtoupper($display_nama); ?></strong></td></tr>
               <tr><td><b>Tarikh Permohonan</b></td><td>:</td><td><?php echo date("d-m-Y", strtotime($display_regdate)); ?></td></tr>
               <tr><td><b>Kad Pengenalan</b></td><td>:</td><td><?php echo $display_icno; ?></td></tr>
               <tr><td><b>No. Telefon</b></td><td>:</td><td><?php echo $display_phone; ?>&nbsp;<a href="http://www.wasap.my/+6<?php echo $display_phone; ?>/eKhairat:">wasap.my/<?php echo $display_phone; ?></a></td></tr>
                <tr><td><b>Email</b></td><td>:</td><td><?php echo $display_email; ?></td></tr>
               <tr><td><b>Alamat Rumah</b></td><td>:</td><td><?php echo $display_address; ?></td></tr>
               <tr><td><b>Blok</b></td><td>:</td><td>
                <?php
                  foreach ($surauInfo as $sr)
                  {
                      if($sr->id == $display_surau) {
                        echo "<b>".$sr->name.", ".$sr->desc."</b>";
                      }  
                  }
                  ?>
                <?php //echo $display_surau; ?>
                  
                </td></tr>
                <tr><td><b><label class="text-success">Peserta Khairat</label></b></td><td>:</td><td>
                <?php
                  /*foreach ($roles as $rl)
                  {
                      if($rl->roleId == $display_roleid) {
                        echo "<b>".$rl->role."</b>";
                      }  
                  }*/
                  if ($ahli_khairat == "Y"){
                    echo "Ya";
                  } else {
                    echo "Tidak";
                  }
                  ?>
                <?php //echo $display_surau; ?>
                  
                </td></tr>
                <tr><td><b>Kategori Ahli</b></td><td>:</td><td><b><span class="badge bg-orange"><?php echo $display_pakej; ?></span></b></td></tr>
          </table>
                <input type="hidden" name="pakej" id="pakej" value="<?php echo $display_pakej ?>">
        </div> 
      </div>
      <?php
      //if(!empty($apf)){ 
        $num = 1;
        $jumlah = 0;
        $jumlah_ahli = 0;
        $total = 0;
        $ahli = "AHLI"; ?>
        <b>Maklumat Yuran</b>
        <div class="box-body table-responsive">
        <table class="table table-bordered table-striped table-hover" style="margin-bottom: 10px">
          <tr>
            <th>Bil.</th>
            <th>Nama</th>
            <th>No. KP </th>
            <th>Umur</th>
            <!--<th>Yuran</th>-->
            <th>Jumlah</th>
          </tr>
           <tr>
            <td><?php echo $num; ?>.</td>
            <td><strong><?php echo strtoupper($display_nama); ?></strong> (<?php echo $ahli; ?>)</td>
            <td><?php echo $display_icno; ?></td>
            <td><?php echo $umur = umur($display_icno);?></td>
            <!--<td align="right"><?php echo $yuran = yuran($ahli, $umur); ?></td>-->
            <td align="right"><?php echo $jumlah = yuran($ahli, $umur); ?></td>
          </tr> 
        <?php
        if(!empty($apf)){ 
        foreach ($apf as $userr)
          { 
            ?>
            <tr>
              <td><?php echo ++$num; ?>.</td>
              <td><strong><?php echo strtoupper($userr->f_name); ?></strong><br> 
                  (<?php echo strtoupper($userr->f_pertalian); ?>)
              </td>
              <td><?php echo str_replace(' ', '', $userr->f_icno); ?></td>
              <td><?php echo $umur = umur($userr->f_icno);?></td>
              <!--<td align="right"><?php echo $yuran = yuran($userr->f_pertalian, $umur); ?></td>-->
              <td align="right"><?php echo $jumlah_ahli = yuran($userr->f_pertalian, $umur); ?></td>
            </tr>
            <?php
            $total = $total + $jumlah_ahli;
          } 
        }?>
          <tr>
            <td colspan="4">Yuran Pendaftaran</td>
            <td align="right"><strong><?php echo number_format($yuran_pendaftaran,2); ?></strong></td>
          </tr>
          <tr>
            <td colspan="4"><?php echo $title_yuran; ?></td>
            <td align="right"><strong><?php echo number_format($jumlah_yuran,2); ?></strong></td>
          </tr> 
          <tr>
            <td colspan="4"><strong>Jumlah Keseluruhan Yuran</strong></td>
            <td align="right"><strong><?php echo number_format($jumlah + $total + $yuran_pendaftaran + $jumlah_yuran,2); ?></strong></td>
          </tr>

        </table>
        </div>
      <?php
      //}else {
      //  echo "Tiada rekod tanggungan";
      //}
      ?>
      <?php  //date('M-Y') ?>
      <?php // $month_name." ".$tahun_daftar; ?>
      <!--
      <div class="row">
       <div class="col-sm-12">
          <div align="left">
              <font size="2"><i>
              * Yuran bulanan & jumlah yang dikenakan dari 
              <strong>
                <?php echo date('M-Y') ?> sehingga Dec-<?php echo date('Y');
                 echo " (".$month_left = 13 - date('m')." bulan)";
                 ?>
              </strong>
              </i></font>
          </div>
        </div>
      </div>
      -->
