<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-envelope" aria-hidden="true"></i> Maklumbalas
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Maklumat Maklumbalas</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">

    <form action="<?php echo $action; ?>" method="post">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Maklumat Malumbalas</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i>
            </button>   
          </div>
        </div>
        
        <div class="box-body">
	    <div class="form-group">
            <label for="date">Date <?php echo form_error('Date') ?></label>
            <input type="text" class="form-control" name="Date" id="Date" placeholder="Date" value="<?php echo $Date; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Name <?php echo form_error('Name') ?></label>
            <input type="text" class="form-control" name="Name" id="Name" placeholder="Name" value="<?php echo $Name; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Email <?php echo form_error('Email') ?></label>
            <input type="text" class="form-control" name="Email" id="Email" placeholder="Email" value="<?php echo $Email; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mobile <?php echo form_error('Mobile') ?></label>
            <input type="text" class="form-control" name="Mobile" id="Mobile" placeholder="Mobile" value="<?php echo $Mobile; ?>" />
        </div>
	   
	    <div class="form-group">
            <label for="Comment">Comment <?php echo form_error('Comment') ?></label>
            <textarea class="form-control" rows="3" name="Comment" id="Comment" placeholder="Comment"><?php echo $Comment; ?></textarea>
        </div>
	    <input type="hidden" name="fb_id" value="<?php echo $fb_id; ?>" />
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
          <a href="<?php echo site_url('feedback') ?>" class="btn btn-default">Cancel</a>
        </div>


      <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      </form>

    </section>
</div>