<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i> General Settings
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"></i> Home</a></li>
        <li class="activ"><a href="<?php echo base_url(); ?>/general">General</a></li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">

    <form action="<?php echo $action; ?>" method="post">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Informations</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse"> <i class="fa fa-minus"></i>
        </button>   
      </div>
    </div>
        
    <div class="box-body">
    <div class="row">
      <div class="col-md-4">
      <div class="form-group">
            <label for="varchar">Title <?php echo form_error('g_home_title') ?></label>
            <input type="text" class="form-control" name="g_home_title" id="g_home_title" placeholder="Home Title" value="<?php echo $g_home_title; ?>" />
        </div>
      </div>
      <div class="col-md-8">
      <div class="form-group">
            <label for="varchar">Description <?php echo form_error('g_home_desc') ?></label>
            <!--<textarea class="form-control" rows="3" name="g_home_desc" id="g_home_desc" placeholder="Desc"><?php echo $g_home_desc; ?></textarea>-->
            <input type="text" class="form-control" name="g_home_desc" id="g_home_desc" placeholder="Description" value="<?php echo $g_home_desc; ?>" />

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
      <div class="form-group">
            <label for="varchar">System Short Name<?php echo form_error('g_contact_info') ?></label>
            <input type="text" class="form-control" name="g_contact_info" id="g_contact_info" placeholder="Contact Info" value="<?php echo $g_contact_info; ?>" />
        </div>
      </div>
      <div class="col-md-8">
      <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('g_address') ?></label>
            <input type="text" class="form-control" name="g_address" id="g_address" placeholder="G Address" value="<?php echo $g_address; ?>" />
        </div>
       </div>
    </div>

    <div class="row">
      <div class="col-md-4">
      <div class="form-group">
            <label for="varchar">Emel <?php echo form_error('g_email') ?></label>
            <input type="text" class="form-control" name="g_email" id="g_email" placeholder="G Email" value="<?php echo $g_email; ?>" />
        </div>
      </div>
      <div class="col-md-4">
      <div class="form-group">
            <label for="varchar">Telefon <?php echo form_error('g_phone') ?></label>
            <input type="text" class="form-control" name="g_phone" id="g_phone" placeholder="G Phone" value="<?php echo $g_phone; ?>" />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
      <div class="form-group">
            <label for="varchar">Facebook <?php echo form_error('g_facebook') ?></label>
            <input type="text" class="form-control" name="g_facebook" id="g_facebook" placeholder="Facebook" value="<?php echo $g_facebook; ?>" />
        </div>
      </div>
      <div class="col-md-4">
      <div class="form-group">
            <label for="varchar">Web URL <?php echo form_error('g_facebook') ?></label>
            <input type="text" class="form-control" name="g_weburl" id="g_weburl" placeholder="Web URL" value="<?php echo $g_weburl; ?>" />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
      <div class="form-group">
            <label for="varchar">Nama Bank <?php echo form_error('g_bankname') ?></label>
            <input type="text" class="form-control" name="g_bankname" id="g_bankname" placeholder="Nama Bank" value="<?php echo $g_bankname; ?>" />
        </div>
       </div>
      <div class="col-md-4">
      <div class="form-group">
            <label for="varchar">Akaun Bank <?php echo form_error('g_bankaccount') ?></label>
            <input type="text" class="form-control" name="g_bankaccount" id="g_bankaccount" placeholder="Akaun Bank" value="<?php echo $g_bankaccount; ?>" />
        </div>
     </div>
    </div>

   

    <div class="row">
      <div class="col-md-4">
      <div class="form-group">
            <label for="varchar">Web Info 1 <?php echo form_error('g_info_1') ?></label>
            <input type="text" class="form-control" name="g_info_1" id="g_info_1" placeholder="Web Info 1" value="<?php echo $g_info_1; ?>" />
        </div>
       </div>
      <div class="col-md-4">
      <div class="form-group">
            <label for="varchar">Web Info 2 <?php echo form_error('g_info_2') ?></label>
            <input type="text" class="form-control" name="g_info_2" id="g_info_2" placeholder="Web Info 2" value="<?php echo $g_info_2; ?>" />
        </div>
     </div>
     <div class="col-md-4">
      <div class="form-group">
            <label for="varchar">Web Info 3 <?php echo form_error('g_info_3') ?></label>
            <input type="text" class="form-control" name="g_info_3" id="g_info_3" placeholder="Web Info 3" value="<?php echo $g_info_3; ?>" />
        </div>
     </div>
    </div>

    <div class="row">
    <div class="col-md-12">
      <div class="form-group">
            <label for="varchar">Polisi <?php echo form_error('g_policy') ?></label><br>
            <textarea class="form-control" rows="20" name="g_policy" id="g_policy" ><?php echo $g_policy; ?></textarea>
            <!--<input type="text" class="form-control" name="g_policy" id="g_policy" placeholder="Polisi" value="<?php echo $g_policy; ?>" />-->
        </div>
      <input type="hidden" name="g_id" value="<?php echo $g_id; ?>" />
    </div>
    </div>

       <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="varchar">Pendaftaran Ahli <?php echo form_error('g_registration') ?></label>
                
                <?php if($g_registration == "Y") { ?>
                    <input class="form-check-input" type="radio" name="g_registration" value="Y" checked>
                    <label class="form-check-label">Yes</label>
                    <input class="form-check-input" type="radio" name="g_registration" value="N">
                    <label class="form-check-label">No</label>
                <?php } else { ?>
                    <input class="form-check-input" type="radio" name="g_registration" value="Y">
                    <label class="form-check-label">Yes</label>
                    <input class="form-check-input" type="radio" name="g_registration" value="N" checked="">
                    <label class="form-check-label">No</label>
                <?php }?>
                <br>
                <label for="varchar">Nota Penutupan Pendaftaran :<?php echo form_error('g_registration_text') ?></label><br>
                <textarea class="form-control" rows="3" name="g_registration_text" id="g_registration_text" ><?php echo $g_registration_text; ?></textarea>
            </div>
        </div>
        </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
          <a href="<?php echo site_url('general') ?>" class="btn btn-default">Cancel</a>
        </div>


      <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      </form>

    </section>
</div>