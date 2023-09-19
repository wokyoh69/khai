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
        <li class="active"> Tambah</li>
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
                <h3 class="box-title"> Tambah </h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                          title="Collapse"> <i class="fa fa-minus"></i>
                  </button>   
                </div>
              </div>
              
            <div class="box-body">
            <div class="row">
                <!--<div class="col-xs-2">
                    <img src="<?php echo base_url(); ?>assets/images/logoNew.png" width="100">
                </div>-->
                <div class="col-xs-12">
                    
                    <strong><?php //echo strtoupper($g_home_desc); ?></strong> <BR>
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
                      <br> No. Ahli (e-Khairat) : ". sprintf('%04d',$u_id)."
                      <br> No. Ahli (manual) : ".$u_noAhli."
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
             <div class="form-group has-success">
                  <label for="int">Jenis Yuran <?php echo form_error('yid') ?></label> 
                  <select class="form-control" id="yid" name="yid" required>
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


          <div class="row">
            <div class="col-md-12"> <!-- right column -->
            <div class="box-body ">
              <div class="box-body table-responsive">
              <table class="table table-condensed table-striped table-hover" >
              <tr>
                
                <!--<th>&nbsp;</th>-->
                <th>Nama</th>
                <!--<th>Pasangan</th>-->
                <th>Pertalian</th>
                <th>No. KP </th>
                <th>Umur </th>
                <th><span class="float-right text-sm text-warning"><i class="fa fa-info-circle"></i></span>&nbsp;Yuran</th>
                <th>#</th>
              </tr>
              <?php 
              $num = 1;
              if(!empty($familyInfo))
                  {
                  foreach ($familyInfo as $fy)
                      {
                       
                      ?>
                      <tr>
                       
                        
                        <!--<td><?php //echo $num++; ?>.</td>-->
                        <td><?php echo $num++; ?>. <?php echo strtoupper($fy->f_name); ?></td>
                        <!--<td><?php echo strtoupper($fy->f_pasangan); ?></td>-->
                        <td><?php echo strtoupper($fy->f_pertalian); ?></td>
                        <td><?php echo str_replace(' ', '', $fy->f_icno); ?></td>
                        <td>
                          <?php 
                          if($fy->f_icno != "") {
                            $no_ic = str_replace(' ', '', $fy->f_icno);
                            $age = umur($no_ic); 
                            echo $age;
                          } else {
                            $age = 0;
                            echo $age;
                          }
                          ?>
                        </td>
                        <td align="center">
                          <?php 
                          //echo $age;
                          echo yuran ($fy->f_pertalian, $age);
                          /*
                          if($fy->f_pasangan != "Y") {
                            if($age > 21) {
                              echo $yuran_tanggungan = number_format("5", 2); 
                              $yuran = $yuran + $yuran_tanggungan;                                       
                            } else {
                              echo "0.00";
                            }
                          } else {
                              echo "0.00";
                          }*/
                            ?>
                        </td>
                        <td width="40">
                        <?php if ($fy->deathStatus !="Y"){ 
                              if ($fy->approval !="N") { ?>
                              <input class="has-success" type="checkbox" name="checked_id[]" value="<?php echo $fy->f_id; ?>" > &nbsp;

                          <?php } else { ?>
                              <span class="float-right text-sm text-danger">
                              <i class="fa fa-exclamation-triangle"></i>
                             </span>
                          <?php } 
                          } ?>
                          
                          <input type="hidden" value="<?php echo $userid; ?>" name="userId" id="userId" />    
                        </td>
                    
                      </tr>
                      <?php
                      }

                  }
              ?>
            </table>
            </div>
            </div>
          </div>

     
      </div>


          

            <div class="row">
            <div class="col-md-8"> 
              <div class="form-group">
                  <label for="attachment">Resit Bayaran <font color="red"> <small>( jpg, png, gif, pdf )</small></font><?php echo form_error('userfile') ?></label>
                  <input type="file" name="userfile" size="20" class="form-control" />
                   <?php //if($attachment != "default.jpg") { ?>
                  <?php if((!empty($attachment)) AND ($attachment != "default.jpg")) { ?>
                    <a href="<?= site_url().'upload/'.$attachment; ?>" target="_blank"> <span class="badge bg-red"><i class="fa fa-paperclip"></i></span> view attachment : "<?php echo $attachment; ?>"</a>
                    <a href="<?= base_url().'payment/update_attachment/'.$p_id; ?>" onclick="javasciprt: return confirm('Delete ?')"><span class="badge bg-red"><i class="fa fa-trash"></i></span></a>
                  <?php } //else if($attachment=="") { ?>
                    <!--<img src="<?= site_url().'upload/default.jpg'; ?>" width="30%">-->
                    <!--No Attachment -->
                  <? //} ?>
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
                <!--<a href="<?= base_url()?>paymentListing" class="btn btn-default">Cancel</a>-->
                <a class="btn btn-info" href="<?php echo base_url().'editUsers/'.$userid; ?>" title="Edit"><i class="fa fa-user"></i> Maklumat Ahli</a>

                
              </div>


            <!-- /.box-footer-->
            </div>
            <!-- /.box -->
            


            
          </div> <!-- end colum left -->
          

    

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