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
         <div class="col-md-6">
              <!-- general form elements -->


         
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
              <div class="form-group">
                  <label for="payDate"> Tarikh Bayaran </label>                     
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    <input class="form-control" id="payDate" name="payDate" placeholder="YYYY/MM/DD" type="text" value="<?php echo date('Y-m-d'); ?>"/>
                    <!--<input class="form-control" id="payDate" name="payDate" placeholder="YYYY/MM/DD" type="text" value="<?php echo date('Y-m-d'); ?>"/>-->
                    </div>
              </div>

            <div class="form-group">
                  <label for="int">Nama Ahli <?php echo form_error('userid') ?></label> 
                  <select class="form-control required" id="userid" name="userid">
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

      	    <!--<div class="form-group">
                  <label for="int">Yid <?php echo form_error('yid') ?></label>
                  <input type="text" class="form-control" name="yid" id="yid" placeholder="Yid" value="<?php echo $yid; ?>" />
              </div>-->

             <div class="form-group">
                  <label for="int">Jenis Yuran <?php echo form_error('yid') ?></label> 
                  <select class="form-control required" id="yid" name="yid">
                      <option value="0">Pilih Yuran</option>
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

            
      	    <div class="form-group">
                  <label for="decimal">Jumlah Bayaran <?php echo form_error('amaun') ?></label>
                  <input type="text" class="form-control" name="amaun" id="amaun" placeholder="Jumah Bayaran" value="<?php echo $amaun; ?>" />
              </div>
            

              
      	    
            <!--<div class="form-group">
                  <label for="enum">Status <?php echo form_error('status') ?></label>
                  <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
              </div>-->

              <div class="form-group">
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

      	    <div class="form-group">
                  <label for="catatan">Catatan <?php echo form_error('catatan') ?></label>
                  <textarea class="form-control" rows="3" name="catatan" id="catatan" placeholder="Catatan"><?php echo $catatan; ?></textarea>
              </div>
      	    
              <input type="hidden" name="p_id" value="<?php echo $p_id; ?>" /> 
              <input type="hidden" name="attachment" value="<?php echo $attachment; ?>" />

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

          <div class="col-md-6"> <!-- right column -->
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Bukti Bayaran</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body ">

              <div class="form-group">
                  <label for="attachment">Resit Bayaran <font color="red"> (Jenis Fail : JPG, PNG, GIF)</font><?php echo form_error('userfile') ?></label>
                  <input type="file" name="userfile" size="20" class="form-control" />
              </div>
              
              <?php if($attachment) { ?>
                <a href="<?= site_url().'upload/'.$attachment; ?>"><img src="<?= site_url().'upload/'.$attachment; ?>" width="30%"></a><br>&nbsp;<br>
                <a class="btn btn-danger" href="<?= base_url().'payment/update_attachment/'.$p_id; ?>">Remove Attachment</a>
              <?php } else if($attachment==""){ ?>
                <img src="<?= site_url().'upload/default.jpg'; ?>" width="30%">
              <? } ?>
              

            </div>
            <!-- /.box-body -->
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