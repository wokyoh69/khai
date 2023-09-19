
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i>Whatsapp_message  Management
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Whatsapp_message  Details</li>
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
	    <tr><td>Userid</td><td><?php echo $userid; ?></td></tr>
	    <tr><td>Phone</td><td><?php echo $phone; ?></td></tr>
	    <tr><td>Messageid</td><td><?php echo $messageid; ?></td></tr>
	    <tr><td>Message</td><td><?php echo $message; ?></td></tr>
	    <tr><td>CreateDtm</td><td><?php echo $createDtm; ?></td></tr>
	    <tr><td>CreatedBy</td><td><?php echo $createdBy; ?></td></tr>
	</table>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo site_url('whatsapp') ?>" class="btn btn-default">Cancel</a>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      </section>
</div>