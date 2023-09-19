
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-gear" aria-hidden="true"></i> General  Management
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">General  Details</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">

         <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Informations</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i></button> 
          </div>
        </div>
        <div class="box-body">
        
        <table class="table table-bordered table-hover">
	    <tr><td width="100px">Theme</td><td><?php echo $g_theme_name; ?></td></tr>
	    <tr><td>Home-Title</td><td><?php echo $g_home_title; ?></td></tr>
	    <tr><td>Home-Desc</td><td><?php echo $g_home_desc; ?></td></tr>
	    <tr><td>System Short Name</td><td><?php echo $g_contact_info; ?></td></tr>
	    <tr><td>Address</td><td><?php echo $g_address; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $g_email; ?></td></tr>
	    <tr><td>Phone</td><td><?php echo $g_phone; ?></td></tr>
	    <tr><td>Facebook</td><td><?php echo $g_facebook; ?></td></tr>
      <tr><td>Web URL</td><td><?php echo $g_weburl; ?></td></tr>
	    <tr><td>Twitter</td><td><?php echo $g_twitter; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $g_status; ?></td></tr>
	</table>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo site_url('general') ?>" class="btn btn-default">Cancel</a>
          <?php echo anchor(site_url('general/update/'.$g_id),'Update', 'class="btn btn-default"'); ?>

        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

      <!-- Default box -->
      
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Home - (Guideline)</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i>
            </button>   
          </div>
        </div>
        <div class="box-body">
          <img src="<?php echo base_url(); ?>assets/images/webpage1.png" width="100%">

        </div>
      </div>
      <!-- /.box -->

      <!-- Default box -->
      
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Contact - (Guideline)</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i>
            </button>   
          </div>
        </div>
        <div class="box-body">
          <img src="<?php echo base_url(); ?>assets/images/webpage2.png" width="100%">

        </div>
      </div>
      <!-- /.box -->
      </section>
</div>