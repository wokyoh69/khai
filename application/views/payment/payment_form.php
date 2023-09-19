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

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-calculator" aria-hidden="true"></i> Bayaran
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>paymentListing">Senarai Bayaran</a></li>
        <li class="active"> Tambah/Kemaskini</li>
      </ol>
    </section>

      <!-- Content Header (Page header) -->
    <section class="content">
       <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
       <div class="row">
          <!-- left column -->
         <div class="col-md-12"> 
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"> Tambah/Kemaskini </h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                          title="Collapse"> <i class="fa fa-minus"></i>
                  </button>   
                </div>
              </div>
              
            <div class="box-body">
            <div class="row">
                <div class="col-xs-12" align="center">
                    <img src="<?php echo base_url(); ?>assets/images/<?php echo $profile_url; ?>" width="100"><br>
                    <strong><?php echo strtoupper($g_home_desc); ?></strong> <BR>
                    <?php //echo $g_address; ?><br>
                    <!--<i>Laman Sesawang : <u><?php echo $g_weburl; ?></u></i> <br>
                    <i>Email : <u><?php echo $g_email; ?> </u></i>-->
                  
                </div>
              <!-- /.col -->
            </div>

            <div class="row invoice-info">
              <div class="col-sm-8 invoice-col">
                <medium>
                  <?php 
                  //foreach ($userlist as $user): 
                  //  if ($user->userId == $userid)
                      echo "<b>".strtoupper($u_name)."</b> 
                      <br> No. ID : ". sprintf('%04d',$u_id)."
                      <br> No. e-Khairat: ".$u_noAhli."
                      <br> Alamat : ".$u_address;
                 // endforeach 
                  ?>
                
                </medium>
              </div>
              <div class="col-sm-4">
                <!--<medium class="pull-right">
                      <strong>Ruj. Kami: </strong> e-Khairat/<?php echo sprintf('%04d',$userid) ?><br>
                      <strong>Tarikh : </strong> 
                      <?php 
                          //$date = strtotime($p_date); 
                          echo $new_date = date('d-m-Y');
                      ?>
                </medium>-->
              </div>
            </div>
            <HR>
            <!--
            <div class="row">
            <div class="col-md-12"> 
            <div class="form-group">
                  <label for="int">Nama Ahli <?php echo form_error('userid') ?></label> 
                  <select class="form-control required" id="userid" name="userid" disabled="disabled">
                      <option value="0">Pilih Ahli</option>
                      <?php
                      if(!empty($userlist))
                      {
                          foreach ($userlist as $us)
                          {
                              ?>
                              <option value="<?php echo $us->userId ?>" <?php if($us->userId == $userid) {echo "selected=selected";} ?>><?php echo $us->name ?> - [No.Ahli:<?php echo sprintf('%04d',$us->userId);?>]</option>
                              <?php
                          }
                      }
                      ?>
                  </select>

              </div>
            </div>
            </div>
          -->

          <div class="row"> <!-- start row A -->
             <div class="col-md-8">
             <div class="form-group">
                  <label for="int">Jenis Yuran <?php echo form_error('yid') ?></label> 
                  <select class="form-control" id="yid" name="yid" disabled>
                      <option value="">Pilih Yuran</option>
                      <?php
                      //if(!empty($yuranlist))
                      //{
                          foreach ($yuranlist as $yu)
                          {
                              ?>
                              <!--<option><?php echo $yu->y_title; ?> - RM<?php echo $yu->y_jumlah;?></option>-->
                              <option value="<?php echo $yu->yid ?>" <?php if($yu->yid == $yid) {echo "selected=selected";} ?>><?php echo $yu->y_title; ?> <?php //echo $yu->y_jumlah;?></option>
                              <?php
                          }
                      //}
                      ?>

                  </select>
              </div>
              </div>
              <div class="col-md-4"> 
              <div class="form-group has-success">
                  <label for="payDate"> Tarikh Bayaran </label>                     
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    <input class="form-control" id="payDate" name="payDate" placeholder="YYYY/MM/DD" type="text" value="<?php echo date('Y-m-d'); ?>"/>
                    <!--<input class="form-control" id="payDate" name="payDate" placeholder="YYYY/MM/DD" type="text" value="<?php echo date('Y-m-d'); ?>"/>-->
                    </div>
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
                    <th>No.IC</th>
                    <th>Umur</th>
                    <th>Yuran</th>
                    <th>Jumlah</th>
                  </tr>
                  <?php
                  //$jumlah = 0;
                  //$total = 0;
                  $feesA = 0;
                  foreach ($paymentdetail_ahli as $det_a)
                  { 
                      ?>
                  <tr>
                    <td width="30"><?php echo $num++; ?>.</td>
                    <td>
                      <a href="<?php echo base_url().'payment/deletePaymentDetail/'.$p_id.'/'.$det_a->pf_id; ?>" onclick="javasciprt: return confirm('Delete ?')"><span class="badge bg-red"><i class="fa fa-trash"></i></span></a>
                      <?php echo "<strong>".strtoupper($det_a->name)."</strong>";?>
                    </td>
                    <td width="100"><?php echo strtoupper("AHLI"); ?></td>
                    <td width="100"><?php echo $det_a->icno; ?></td>
                    <td width="100">
                        <?php 
                          if($det_a->icno != "") {
                            $no_ic = str_replace(' ', '', $det_a->icno);
                            echo $age = umur($no_ic); 
                          } else {
                            echo $age = 0;
                          }
                          ?>
                    </td>
                    <td width="100"><?php echo yuran ("AHLI", $age); ?></td>
                    <td align="right" width="100">
                      <?php 
                        $feesA = $det_a->amaun;
                        echo $feesA; ?>
                    </td>
                  </tr>
                  <?php } 
                  $feesF = 0;
                  $sumF = 0;
                  foreach ($paymentdetail as $det)
                  { 
                    ?>    
                    <tr>
                      <td width="30"><?php echo $num++; ?>.</td>
                      <!--<td><input type="hidden" name="checked_fid[]" value="<?php echo $det->f_id; ?>" > </td>-->
                      <td>
                        <a href="<?php echo base_url().'payment/deletePaymentDetail/'.$p_id.'/'.$det->pf_id; ?>" onclick="javasciprt: return confirm('Delete ?')"><span class="badge bg-red"><i class="fa fa-trash"></i></span></a>
                        <strong><?php echo strtoupper($det->f_name); ?></strong>

                      </td>
                      <td width="100"><?php echo strtoupper($det->f_pertalian); ?></td>
                      <td width="100"><?php echo strtoupper($det->f_icno); ?></td>
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
                      <td width="100"><?php echo yuran ($det->f_pertalian, $age); ?></td>
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
                    <td colspan="6">
                      <strong>
                            <?php
                                foreach ($yuranlist as $yu)
                                {
                                     if($yu->yid == $yid)
                                     {
                                        echo $yu->y_title; 
                                        if($yu->yid != 2){
                                          echo "&nbsp;<font color='blue'><small>(*Yuran tahunan hanya dikenakan sekali setiap tahun)</small></font>";
                                        }
                                      }
                                }
                            ?>
                      </strong>
                    </td>
                    <td align="right">
                          <?php
                                //echo $countyuran;
                               /* $YearlFee = 0;
                                if ($countyuran > 1){
                                  $YearlFee = 0;
                                } else { 
                                  foreach ($yuranlist as $yu)
                                  {
                                       if($yu->yid == $yid)
                                          $YearlFee = $yu->y_jumlah; 
                                  }
                                } 
                                echo "<font color='blue'>".number_format($YearlFee,2)."</font>"; */
                            ?>

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
                                echo "<font color='blue'>*".number_format($YearlFee,2)."</font>"; 
                            ?>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="6"><strong>Jumlah Yuran</strong></td>
                    <td align="right">
                    <strong>
                        <?php 
                        $total = $feesA + $sumF + $YearlFee;
                        echo number_format($total ,2); ?>
                    </strong></td>
                  </tr>
                  <tr>
                    <td colspan="6"><strong>Jumlah Bayaran</strong></td>
                    <td align="right" width="100">
                      <div class="form-group has-success">
                      <input type="text" class="form-control" name="total_amaun" id="total_amaun" placeholder="Jumah Bayaran" value="<?php echo $total_amaun; ?>" />
                      </div>
                    </td>
                   </tr>
                  <!--<tr>
                    <td colspan="7" align="right">
                      <button type="submit" name="fpx" class="btn btn-danger" value="<?php echo $total_amaun; ?>">FPX Payment via Toyyibpay</button> 
                    </td>
                   </tr>-->
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
                    <th align="right">Jumlah</th>
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
                    <td colspan="2"><strong>Jumlah Keseluruhan Yuran</strong></td>
                    <td align="right" width="100"><strong><?php echo number_format($total ,2); ?></strong></td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>Jumlah Bayaran</strong></td>
                    <td align="right" width="100">
                      <div class="form-group has-success">
                      <input type="text" class="form-control" name="total_amaun" id="total_amaun" placeholder="Jumah Bayaran" value="<?php echo $total_amaun; ?>" />
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="7" align="right">
                      <!--<button type="submit" name="fpx" class="btn btn-danger" value="<?php echo $total_amaun; ?>">FPX Payment via Toyyibpay</button> -->
                    </td>
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
                    <th>No.IC</th>
                    <th>Umur</th>
                    <th>Yuran</th>
                    <th>Jumlah</th>
                  </tr>
                  <?php
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
                    <td width="100"><?php echo $u_icno; ?></td>
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
                    <td width="100"><?php echo yuran ("AHLI", $age); ?></td>
                    <td align="right" width="100"><?php echo $jumlah = $de->amaun; ?>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="6">
                      <strong>
                            <?php
                                foreach ($yuranlist as $yu)
                                {
                                     if($yu->yid == $yid)
                                     {
                                        echo $yu->y_title; 
                                        if($yu->yid != 2){
                                          echo "&nbsp;<font color='blue'><small>(*Yuran tahunan hanya dikenakan sekali setiap tahun)</small></font>";
                                        }
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
                <?php } //endforeach ?>
                <tr>
                    <td colspan="6"><strong>Jumlah Bayaran</strong></td>
                    <td align="right" width="100">
                      <div class="form-group has-success">
                      <input type="text" class="form-control" name="total_amaun" id="total_amaun" placeholder="Jumah Bayaran" value="<?php echo $total_amaun; ?>" />
                      </div>
                    </td>
                  </tr>
                <tr>
                    <td colspan="7" align="right">
                      <!--<button type="submit" name="fpx" class="btn btn-danger" value="<?php echo $total_amaun; ?>">FPX Payment via Toyyibpay</button> -->
                    </td>
                   </tr>
                </table>
              </div>
              </div>
          <?php }
             }
              ?>
            </div> <!--end row B -->

            <div class="row">
            <div class="col-md-8"> 
              <div class="form-group">
                  <label for="attachment">Resit Bayaran <font color="red"> <small>( jpg, png, gif, pdf )</small></font><?php echo form_error('userfile') ?></label>
                  <input type="file" name="userfile" size="20" class="form-control" />
                   <?php //if($attachment != "default.jpg") { ?>
                  <?php if((!empty($attachment)) AND ($attachment != "default.jpg")) { ?>
                    <a href="<?php echo base_url().'payment/update_attachment/'.$p_id; ?>" onclick="javasciprt: return confirm('Delete ?')"><span class="badge bg-red"><i class="fa fa-trash"></i></span></a>
                    <a href="<?php echo site_url().'upload/'.$attachment; ?>" target="_blank"> <span class="badge bg-blue"><i class="fa fa-paperclip"></i></span> view attachment : "<?php echo $attachment; ?>"</a>
                    
                  <?php } //else if($attachment=="") { ?>
                    <!--<img src="<?php echo site_url().'upload/default.jpg'; ?>" width="30%">-->
                    <!--No Attachment -->
                  <?php //} ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group has-success">
                 <label for="enum">Status Bayaran</label>
                  
                  <select name="status" id="status" class="form-control" >
                    <?php 
                      if ($status == "Selesai")
                        { ?>
                                <option value="Selesai" selected="selected"> Selesai </option>
                                <option value="Belum Selesai"> Belum Selesai </option>
                      <?php } else if ($status == "Belum Selesai") {?> 
                                <option value="Selesai"> Selesai </option>
                                <option value="Belum Selesai" selected="selected"> Belum Selesai</option>
                      <?php } else { ?> 
                                <option value="Selesai"> Selesai </option>
                                <option value="Belum Selesai" selected="selected"> Belum Selesai</option>
                      <?php } ?>
                  </select>
              </div> 
            </div>
            </div>
            
            <div class="row">
              <div class="col-md-4"> 
                 <div class="form-group has-warning">
                    <label for="billcode">FPX Billcode <?php echo form_error('billcode') ?></label>
                    <input class="form-control" type="text" name="billcode" value="<?php echo $billcode; ?>" maxlength="10">
                  </div>
              </div>
              <div class="col-md-4"> 
                 <div class="form-group has-warning">
                    <label for="transactionid">FPX Invoice No <?php echo form_error('transactionid') ?></label>
                    <input class="form-control" type="text" name="transactionid" value="<?php echo $transactionid; ?>" >
                  </div>
              </div>
              <div class="col-md-4"> 
                 <div class="form-group has-warning">
                    <label for="label">Nota: <br>Sekiranya ingin kemaskini bayaran secara FPX sahaja.</label>
                  </div>
              </div>
            </div>
          
            
            <div class="row">
            <div class="col-md-12"> 
      	       <div class="form-group">
                  <label for="catatan">Catatan <?php echo form_error('catatan') ?></label>
                  <textarea class="form-control" rows="3" name="catatan" id="catatan" placeholder="Catatan"><?php echo $catatan; ?></textarea>
                </div>
            </div>
            </div>
      	    
              <input type="hidden" name="userid" value="<?php echo $userid; ?>" /> 
              <input type="hidden" name="p_id" value="<?php echo $p_id; ?>" />
              <input type="hidden" name="attachment" value="<?php echo $attachment; ?>" />
              <input type="hidden" name="yid" value="<?php echo $yid; ?>" /> 
              

              </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                <!--<a href="<?php echo base_url()?>paymentListing" class="btn btn-default">Cancel</a>-->
                <a class="btn btn-info" href="<?php echo base_url().'editUsers/'.$userid; ?>" title="Edit"><i class="fa fa-user"></i> Maklumat Ahli</a>

                
              </div>


            <!-- /.box-footer-->
            </div>
            <!-- /.box -->
            


            
          </div> 

          </div>



        </div> <!-- end row -->
        </form>
    </section>
</div>
<script>
  $(document).ready(function(){
    var payDate=$('input[name="payDate"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    payDate.datepicker({
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    })

   
  })
</script>