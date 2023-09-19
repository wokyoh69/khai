
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i> General Settings
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Settings</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">

    <?php
    foreach ($general_data as $general)
    {
      ?>

    <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Informations :</h3>

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
            <label for="varchar">Title :</label>
            <?php echo $general->g_home_title ?>
        </div>
      </div>
      <div class="col-md-8">
      <div class="form-group">
            <label for="varchar">Description :</label>
            <?php echo $general->g_home_desc ?>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
      <div class="form-group">
            <label for="varchar">System Short Name :</label>
            <?php echo $general->g_contact_info ?>
        </div>
      </div>
      <div class="col-md-8">
      <div class="form-group">
            <label for="varchar">Alamat :</label>
            <?php echo $general->g_address ?>
        </div>
       </div>
    </div>

    <div class="row">
      <div class="col-md-4">
      <div class="form-group">
            <label for="varchar">Emel :</label>
            <a href="mailto:<?php echo $general->g_email ?>"><?php echo $general->g_email ?></a>
        </div>
      </div>
      <div class="col-md-4">
      <div class="form-group">
            <label for="varchar">Telefon :</label>
            <?php echo $general->g_phone ?>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
      <div class="form-group">
            <label for="varchar">Facebook :</label>
            <a href="<?php echo $general->g_facebook ?>" target="_blank"><?php echo $general->g_facebook ?></a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
      <div class="form-group">
            <label for="varchar">Web URL :</label>
            <a href="<?php echo $general->g_weburl ?>" target="_blank"><?php echo $general->g_weburl ?></a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
      <div class="form-group">
            <label for="varchar">Nama Bank :</label>
            <?php echo $general->g_bankname ?>
        </div>
       </div>
      <div class="col-md-4">
      <div class="form-group">
            <label for="varchar">Akaun Bank :</label>
            <?php echo $general->g_bankaccount ?>
        </div>
     </div>
    </div>

    <div class="row">
      <div class="col-md-12">
      <div class="form-group">
            <label for="varchar">Web Info 1 :</label>
            <?php echo $general->g_info_1 ?>
        </div>
       </div>
    </div>
    <div class="row">
      <div class="col-md-12">
      <div class="form-group">
            <label for="varchar">Web Info 2 :</label>
            <?php echo $general->g_info_2 ?>
        </div>
     </div>
    </div>
    <div class="row">
     <div class="col-md-12">
      <div class="form-group">
            <label for="varchar">Web Info 3 :</label>
            <?php echo $general->g_info_3 ?>
        </div>
     </div>
    </div>

    <div class="row">
     <div class="col-md-12">
      <div class="form-group">
            <label for="varchar">Polisi :</label><br>
            <pre><?php echo $general->g_policy ?></pre>
        </div>
      </div>
    </div>

    <div class="row">
     <div class="col-md-12">
      <div class="form-group">
            <label for="varchar">Pendaftaran Ahli :</label>
            <?php echo $general->g_registration ?> - "<i><?php echo $general->g_registration_text; ?></i>"
        </div>
      </div>
    </div>
      
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <a class="btn btn-sm btn-info" href="<?= base_url().'general/update/'.$general->g_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
    </div>
  <!-- /.box-footer-->
  </div>
      <?php 
        } //end foreach
      ?>

    </section>
</div>