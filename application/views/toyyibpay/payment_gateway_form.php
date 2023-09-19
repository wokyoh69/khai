<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <img src="<?= site_url().'assets/images/toyyibpay.png'; ?>">
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="activ"> Toyyibpay </li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">

    <form action="<?php echo $action; ?>" method="post">
    <div class="row">
      <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">API Reference</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i>
            </button>   
          </div>
        </div>
        
        <div class="box-body">
	    <div class="form-group">
            <label for="varchar">Default Url <?php echo form_error('pg_url') ?></label>
            <input type="text" class="form-control" name="pg_url" id="pg_url" placeholder="Pg Url" value="<?php echo $pg_url; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Secretkey <?php echo form_error('pg_secretkey') ?></label>
            <input type="text" class="form-control" name="pg_secretkey" id="pg_secretkey" placeholder="Pg Secretkey" value="<?php echo $pg_secretkey; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Catcode <?php echo form_error('pg_catcode') ?></label>
            <input type="text" class="form-control" name="pg_catcode" id="pg_catcode" placeholder="Pg Catcode" value="<?php echo $pg_catcode; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Billname <?php echo form_error('pg_billname') ?></label>
            <input type="text" class="form-control" name="pg_billname" id="pg_billname" placeholder="Pg Billname" value="<?php echo $pg_billname; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Returnurl <?php echo form_error('pg_returnurl') ?></label>
            <input type="text" class="form-control" name="pg_returnurl" id="pg_returnurl" placeholder="Pg Returnurl" value="<?php echo $pg_returnurl; ?>" />
        </div>
       <div class="form-group">
            <label for="varchar">Returnurl Public<?php echo form_error('pg_returnurl_public') ?></label>
            <input type="text" class="form-control" name="pg_returnurl_public" id="pg_returnurl_public" placeholder="Pg Returnurl Public" value="<?php echo $pg_returnurl_public; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Callbackurl <?php echo form_error('pg_callbackurl') ?></label>
            <input type="text" class="form-control" name="pg_callbackurl" id="pg_callbackurl" placeholder="Pg Callbackurl" value="<?php echo $pg_callbackurl; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Createbill <?php echo form_error('pg_createbill') ?></label>
            <input type="text" class="form-control" name="pg_createbill" id="pg_createbill" placeholder="Pg Createbill" value="<?php echo $pg_createbill; ?>" />
        </div>
	    <input type="hidden" name="pg_id" value="<?php echo $pg_id; ?>" />
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
          <a href="<?php echo site_url('toyyibpay') ?>" class="btn btn-default">Cancel</a>
        </div>


      <!-- /.box-footer-->
      </div>
      <!-- /.box -->
          </div>
        </div> <!-- end row -->
      </form>

    </section>
</div>