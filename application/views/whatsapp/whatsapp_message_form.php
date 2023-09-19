<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i>Whatsapp_message Management
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="activ">Whatsapp_message Informations</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">

    <form action="<?php echo $action; ?>" method="post">
    <div class="row">
      <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">State Informations</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i>
            </button>   
          </div>
        </div>
        
        <div class="box-body">
	    <div class="form-group">
            <label for="int">Userid <?php echo form_error('userid') ?></label>
            <input type="text" class="form-control" name="userid" id="userid" placeholder="Userid" value="<?php echo $userid; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Phone <?php echo form_error('phone') ?></label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="<?php echo $phone; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Messageid <?php echo form_error('messageid') ?></label>
            <input type="text" class="form-control" name="messageid" id="messageid" placeholder="Messageid" value="<?php echo $messageid; ?>" />
        </div>
	    <div class="form-group">
            <label for="message">Message <?php echo form_error('message') ?></label>
            <textarea class="form-control" rows="3" name="message" id="message" placeholder="Message"><?php echo $message; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="datetime">CreateDtm <?php echo form_error('createDtm') ?></label>
            <input type="text" class="form-control" name="createDtm" id="createDtm" placeholder="CreateDtm" value="<?php echo $createDtm; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">CreatedBy <?php echo form_error('createdBy') ?></label>
            <input type="text" class="form-control" name="createdBy" id="createdBy" placeholder="CreatedBy" value="<?php echo $createdBy; ?>" />
        </div>
	    <input type="hidden" name="wm_id" value="<?php echo $wm_id; ?>" />
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
          <a href="<?php echo site_url('whatsapp') ?>" class="btn btn-default">Cancel</a>
        </div>


      <!-- /.box-footer-->
      </div>
      <!-- /.box -->
          </div>
        </div> <!-- end row -->
      </form>

    </section>
</div>