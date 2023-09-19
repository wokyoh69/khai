
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <img src="<?= site_url().'assets/images/toyyibpay.png'; ?>">
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Toyyibpay </li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">

         <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">API Reference</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i></button> 
          </div>
        </div>
        <div class="box-body">
        
        <table class="table table-bordered">
	    <tr><td><b>Default URL</b></td><td><?php echo $pg_url; ?></td></tr>
	    <tr><td><b>Secretkey</b></td><td><?php echo $pg_secretkey; ?></td></tr>
	    <tr><td><b>Catcode</b></td><td><?php echo $pg_catcode; ?></td></tr>
	    <tr><td><b>Billname</b></td><td><?php echo $pg_billname; ?></td></tr>
	    <tr><td><b>Returnurl</b></td><td><?php echo $pg_returnurl; ?></td></tr>
      <tr><td><b>Returnurl Public</b></td><td><?php echo $pg_returnurl_public; ?></td></tr>
	    <tr><td><b>Callbackurl</b></td><td><?php echo $pg_callbackurl; ?></td></tr>
	    <tr><td><b>Createbill</b></td><td><?php echo $pg_createbill; ?></td></tr>
	</table>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
           <!--<a href="<?= base_url().'toyyibpay/update/'.$pg_id; ?>" class="btn btn-primary" title="Update" disabled>Update</a>-->
         <a href="<?php echo site_url('toyyibpay') ?>" class="btn btn-default">Cancel</a>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      </section>
</div>