
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i> About  Management
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">About Details</li>
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
        
        <table class="table table-bordered">
	    <tr><td>Title1</td><td><?php echo $ab_title1; ?></td></tr>
	    <tr><td>Desc1</td><td><?php echo $ab_desc1; ?></td></tr>
	    <tr><td>Title2</td><td><?php echo $ab_title2; ?></td></tr>
	    <tr><td>Desc2</td><td><?php echo $ab_desc2; ?></td></tr>
	    <tr><td>Note</td><td><?php echo $ab_note; ?></td></tr>
	</table>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo site_url('about') ?>" class="btn btn-default">Cancel</a>
           <?php echo anchor(site_url('about/update/'.$ab_id),'Update', 'class="btn btn-default"'); ?>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

      <!-- Default box -->
      
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">About - (Guideline)</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i>
            </button>   
          </div>
        </div>
        <div class="box-body">
          <img src="<?php echo base_url(); ?>assets/images/webpage3.png" width="100%">

        </div>
      </div>
      <!-- /.box -->
      </section>
</div>