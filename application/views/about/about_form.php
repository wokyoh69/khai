<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i> About Management
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="activ">About Informations</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">

    <form action="<?php echo $action; ?>" method="post">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">About Informations</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i>
            </button>   
          </div>
        </div>
        
        <div class="box-body">
	    <div class="form-group">
            <label for="varchar">Title1 <?php echo form_error('ab_title1') ?></label>
            <input type="text" class="form-control" name="ab_title1" id="ab_title1" placeholder="" value="<?php echo $ab_title1; ?>" />
        </div>
	    <div class="form-group">
            <label for="ab_desc1">Desc1 <?php echo form_error('ab_desc1') ?></label>
            <textarea class="form-control" rows="3" name="ab_desc1" id="ab_desc1" placeholder=""><?php echo $ab_desc1; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Title2 <?php echo form_error('ab_title2') ?></label>
            <input type="text" class="form-control" name="ab_title2" id="ab_title2" placeholder="" value="<?php echo $ab_title2; ?>" />
        </div>
	    <div class="form-group">
            <label for="ab_desc2">Desc2 <?php echo form_error('ab_desc2') ?></label>
            <textarea class="form-control" rows="3" name="ab_desc2" id="ab_desc2" placeholder=""><?php echo $ab_desc2; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Note <?php echo form_error('ab_note') ?></label>
            <input type="text" class="form-control" name="ab_note" id="ab_note" placeholder="" value="<?php echo $ab_note; ?>" />
        </div>
	    <input type="hidden" name="ab_id" value="<?php echo $ab_id; ?>" />
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
          <a href="<?php echo site_url('about') ?>" class="btn btn-default">Cancel</a>
        </div>


      <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      </form>

    </section>
</div>