
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i>&nbsp;Senarai Perbelanjaan
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Maklumat</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">
       <div class="row">
          <!-- left column -->
         <div class="col-md-6">
         <!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?php 
              foreach ($userlist as $user): 
              if ($user->userId == $userid)
                echo "<strong>".$user->name."</strong>";
               //if ($user->userId == $userid)
              //  echo "Telefon :<strong>&nbsp;".$user->phone."</strong><br>";
              // if ($user->userId == $userid)
              //  echo "Email :<strong>&nbsp;".$user->email."</strong>";
              endforeach ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i></button> 
          </div>
        </div>
        <div class="box-body">
        
        <table class="table table-bordered">
	    <tr><td width="40%">Tarikh</td><td><?php echo date("d-m-Y", strtotime($k_date)); ?></td></tr>
	    <tr><td>No. Ahli</td>
          <td><?php //echo $userid; ?>
              <?php 
              foreach ($userlist as $user): 
              if ($user->userId == $userid)
                echo $user->noAhli;
              endforeach ?>
          </td>
      </tr>
	    <tr><td>Jumlah</td><td><?php echo $k_amaun; ?></td></tr>
	    <tr><td>Catatan</td><td><?php echo $k_catatan; ?></td></tr>
	    <tr><td>Kemaskini Oleh</td>
          <td><?php //echo $updatedBy; ?>
              <?php 
              foreach ($userlist as $user): 
              if ($user->userId == $updatedBy)
                 echo $user->name;
              endforeach ?>
          </td>
      </tr>
	    <tr><td>Tarikh Kemaskini</td><td><?php echo date("d-m-Y H:i:s", strtotime($updatedDtm)); ?></td></tr>
	</table>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo site_url('khairat') ?>" class="btn btn-default">Cancel</a>
          <a class="btn btn-info" href="<?php echo base_url().'editUsers/'.$userid; ?>" title="Edit"><i class="fa fa-user"></i> Maklumat Ahli</a>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

        </div>
      </div>
      </section>
</div>