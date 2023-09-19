<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i> Makluman
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="activ"> Tambah</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">

    <form action="<?php echo $action; ?>" method="post">
    <div class="row">
      <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Informations</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i>
            </button>   
          </div>
        </div>
        
        <div class="box-body">
	    <div class="form-group">
            <label for="news_headline">Tajuk <?php echo form_error('news_headline') ?></label>
            <input type="text" class="form-control" name="news_headline" id="news_headline" placeholder=" " value="<?php echo $news_headline; ?>" />
        </div>
	    <div class="form-group">
            <label for="news_story">Makluman <?php echo form_error('news_story') ?></label>
            <textarea class="form-control" rows="3" name="news_story" id="news_story" placeholder=" "><?php echo $news_story; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Editor <?php echo form_error('news_editor') ?></label>
            <input type="text" class="form-control" name="news_editor" id="news_editor" placeholder="" value="<?php echo $news_editor; ?>" />
        </div>
<!--	    <div class="form-group">
            <label for="varchar">Email <?php echo form_error('news_email') ?></label>
            <input type="text" class="form-control" name="news_email" id="news_email" placeholder="" value="<?php echo $news_email; ?>" />
        </div>-->
	    <div class="form-group">
            <label for="date">Timestamp <?php echo form_error('news_timestamp') ?></label>
            <!--<input type="text" class="form-control" name="news_timestamp" id="news_timestamp" placeholder="" value="<?php echo $news_timestamp; ?>" />-->
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <input class="form-control" id="news_timestamp" name="news_timestamp" placeholder="YYYY/MM/DD" type="text" value="<?php echo date('Y-m-d'); ?>"/>
            </div>
        </div>
	    <div class="form-group">
            <label for="enum">Status <?php echo form_error('news_status') ?></label>
            <!--<input type="text" class="form-control" name="news_status" id="news_status" placeholder="" value="<?php echo $news_status; ?>" />-->
             <select name="news_status" id="news_status" class="form-control" >
              <?php 
                if ($status == "Aktif")
                  { ?>
                          <option value="Aktif" selected="selected"> Aktif </option>
                          <option value="Tidak Aktif"> Tidak Aktif </option>
                <?php } else if ($status == "Tidak Aktif") {?> 
                          <option value="Aktif"> Aktif </option>
                          <option value="Tidak Aktif" selected="selected"> Tidak Aktif</option>
                <?php } else { ?> 
                          <option value="Aktif" selected="selected"> Aktif </option>
                          <option value="Tidak Aktif"> Tidak Aktif</option>
                <?php } ?>
            </select>
        </div>
	    <input type="hidden" name="news_id" value="<?php echo $news_id; ?>" />
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
          <a href="<?php echo site_url('news') ?>" class="btn btn-default">Cancel</a>
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
    var payDate=$('input[name="news_timestamp"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    payDate.datepicker({
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    })

   
  })
</script>