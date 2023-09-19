
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
      <!--<h3 class="box-title">Informations :</h3>-->

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse"> <i class="fa fa-minus"></i>
        </button>   
      </div>
    </div>
        
    <div class="box-body">

    <h4><label class="text-success">A. MAKLUMAT UMUM</label></h4>
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

    <hr>
    <h4><label class="text-success">B. MAKLUMAT BANK</label></h4>
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
     <div class="col-md-4">
      <div class="form-group">
            <label for="varchar">Jumlah Baki (RM) :</label>
            <?php echo number_format($general->g_balance,2); ?>
        </div>
     </div>
    </div>

    <hr>
    <h4><label class="text-success">C. INFORMASI PORTAL</label></h4>
    <div class="row">
      <div class="col-md-4">
      <label class="text-success">KOTAK INFO #1(KIRI)</label>
      <div class="form-group">
            <label for="varchar">Icon :</label>
            <?php echo $general->g_icon_1 ?><br>
             <label for="varchar">Tajuk :</label>
            <?php echo $general->g_title_1 ?><br>
             <label for="varchar">Web Info 1 :</label><br>
            <?php echo $general->g_info_1 ?>
        </div>
       </div>

      <div class="col-md-4">
      <label class="text-success">KOTAK INFO #2 (TENGAH)</label>
      <div class="form-group">
            <label for="varchar">Icon :</label>
            <?php echo $general->g_icon_2 ?><br>
             <label for="varchar">Tajuk :</label>
            <?php echo $general->g_title_2 ?><br>
             <label for="varchar">Web Info 2 :</label><br>
            <?php echo $general->g_info_2 ?>
        </div>
     </div>

     <div class="col-md-4">
    <label class="text-success">KOTAK INFO #3(KANAN)</label>
      <div class="form-group">
            <label for="varchar">Icon :</label>
            <?php echo $general->g_icon_3 ?><br>
             <label for="varchar">Tajuk :</label>
            <?php echo $general->g_title_3 ?><br>
             <label for="varchar">Web Info 3 :</label><br>
            <?php echo $general->g_info_3 ?>
        </div>
     </div>
    </div>

    <hr>
    <h4><label class="text-success">D. SYARAT & POLISI</label></h4>
    <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <!--<label for="varchar">Syarat & Polisi :</label><br>-->
        <div class="color-palette-set">
          <div class="bg-gray disabled color-palette">
            <span>
              <div class="box-body table-responsive no-padding">
               <table class="table table-bordered table-striped" style="margin-bottom: 10px">
               <tr><td><?php echo nl2br($general->g_policy); ?></td></tr>
               </table>
              </div>
            </span>
          </div>
        </div>
      </div>
    </div>
    </div>
    <hr>
    <h4><label class="text-success">E. KAWALAN SISTEM</label></h4>
    <div class="row">
     <div class="col-md-12">
      <div class="form-group">
            <label for="varchar">Pendaftaran Ahli :</label>
            <?php if($general->g_registration =="Y") { ?>
              <span class="badge bg-green"><?php echo $general->g_registration ?></span>
            <?php } else { ?>
              <span class="badge bg-red"><?php echo $general->g_registration ?></span>
              <br>"<i><?php echo $general->g_registration_text; ?></i>"
            <?php } ?>
            
        </div>
      </div>
    </div>

    <div class="row">
     <div class="col-md-12">
      <div class="form-group">
            <label for="varchar">Bayaran Yuran :</label>     
            <?php if($general->g_payment =="Y") { ?>
              <span class="badge bg-green"><?php echo $general->g_payment ?></span>
            <?php } else { ?>
              <span class="badge bg-red"><?php echo $general->g_payment ?></span>
              <br>"<i><?php echo $general->g_payment_text; ?></i>"
            <?php } ?>
        </div>
      </div>
    </div>
      
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <a class="btn btn-sm btn-primary" href="<?= base_url().'general/update/'.$general->g_id; ?>" title="Edit"><i class="fa fa-pencil"></i> Kemaskini </a>
    </div>
  <!-- /.box-footer-->
  </div>
      <?php 
        } //end foreach
      ?>

    </section>
</div>