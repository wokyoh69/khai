<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-dollar" aria-hidden="true"></i>&nbsp;Senarai Perbelanjaan
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>khairat">Khairat</a></li>
        <li class="active">Penerima </li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">

    <form action="<?php echo $action; ?>" method="post">
      <div class="row">
          <!-- left column -->
         <div class="col-md-6">
              <!-- general form elements -->

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Perbelanjaan Khairat</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i>
            </button>   
          </div>
        </div>
        
        <div class="box-body">
	    <div class="form-group">
            <?php 
                if (empty($k_date)) { 
                    $k_date = date('Y-m-d');
                }
             ?>
            <label for="k_date"> Tarikh </label>                     
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
            <input class="form-control required" id="k_date" name="k_date" placeholder="YYYY/MM/DD" type="text" value="<?php echo $k_date; ?>"/>
            </div>
        </div>
      <div class="form-group">
            <label for="">Perkara <?php echo form_error('k_jenis') ?></label>
            <input type="k_jenis" class="form-control" name="k_jenis" id="k_jenis" placeholder="Jenis Perbelanjaan" value="<?php echo $k_jenis; ?>" maxlength="100" required />
        </div>
	    <div class="form-group">
            <!--<label for="int">Userid <?php echo form_error('userid') ?></label>
            <input type="text" class="form-control" name="userid" id="userid" placeholder="Userid" value="<?php echo $userid; ?>" />-->
            <?php //echo $userid ?>
            <label for="int">Nama Ahli <?php echo form_error('userid') ?></label> 

              <select class="form-control required" id="userid" name="userid" <?php if($userid) {echo "disabled";} ?>>
                  <option value="0">Pilih Ahli</option>
                  <?php
                  if(!empty($userlist))
                  {
                      foreach ($userlist as $us)
                      {
                          ?>
                          <option value="<?php echo $us->userId ?>" <?php if($us->userId == $userid) {echo "selected=selected";} ?>><?php echo $us->name ?> - <?php echo $us->noAhli;?></option>
                          <?php
                      }
                  }
                  ?>
              </select>
            <small>* Abaikan jika perbelanjaan bukan untuk ahli</small>
        </div>
	    <div class="form-group">
            <label for="double">Jumlah<?php echo form_error('k_amaun') ?></label>
            <input type="text" class="form-control" name="k_amaun" id="k_amaun" placeholder="0.00" value="<?php echo $k_amaun; ?>" />
        </div>
	    <div class="form-group">
            <label for="k_catatan">Catatan <?php echo form_error('k_catatan') ?></label>
            <textarea class="form-control" rows="3" name="k_catatan" id="k_catatan" placeholder=""><?php echo $k_catatan; ?></textarea>
        </div>
	    <!--<div class="form-group">
            <label for="int">UpdatedBy <?php echo form_error('updatedBy') ?></label>
            <input type="text" class="form-control" name="updatedBy" id="updatedBy" placeholder="UpdatedBy" value="<?php echo $updatedBy; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">UpdatedDtm <?php echo form_error('updatedDtm') ?></label>
            <input type="text" class="form-control" name="updatedDtm" id="updatedDtm" placeholder="UpdatedDtm" value="<?php echo $updatedDtm; ?>" />
        </div>
      -->
	    <input type="hidden" name="k_id" value="<?php echo $k_id; ?>" />
      <?php if($userid) { ?>
          <input type="hidden" name="userid" value="<?php echo $userid; ?>" />
      <?php } ?>
      
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
          <!--<a href="<?php echo site_url('khairat') ?>" class="btn btn-default">Cancel</a>-->
        </div>


      <!-- /.box-footer-->
      </div>
      <!-- /.box -->
          </div>
        </div> <!-- end row -->
      </form>

    </section>
</div>

<script>
  $(document).ready(function(){
    var k_date=$('input[name="k_date"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    k_date.datepicker({
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    })
   
  })
</script>