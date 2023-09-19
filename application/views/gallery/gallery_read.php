
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i> Gallery  Management
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Gallery  Details</li>
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
	    <tr><td>Date</td><td><?php echo $gallery_date; ?></td></tr>
	    <tr><td>Title</td><td><?php echo $gallery_title; ?></td></tr>
      <tr><td>Status</td><td><?php echo $gallery_status; ?></td></tr>
	    <tr><td>Image</td><td><?php echo $gallery_image; ?> <br><img src="<?= site_url().'upload/'.$gallery_image; ?>" width="100%"></td></tr>

	</table>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo site_url('gallery') ?>" class="btn btn-default">Cancel</a>
          <?php echo anchor(site_url('gallery/update/'.$gallery_id),'Update', 'class="btn btn-default"'); ?>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      </section>
</div>