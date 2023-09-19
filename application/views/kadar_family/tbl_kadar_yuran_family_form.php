<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i> <?= $pageTitle?>
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="activ"> <?= $pageTitle?> </li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">

    <form action="<?php echo $action; ?>" method="post">
    <div class="row">
      <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Kemaskini</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i>
            </button>   
          </div>
        </div>
        
        <div class="box-body">
	    <div class="form-group">
            <label for="varchar">Pertalian <?php echo form_error('yf_name') ?></label>
            <input type="text" class="form-control" name="yf_name" id="yf_name" placeholder="Yf Name" value="<?php echo $yf_name; ?>" disabled />
        </div>
	    <div class="form-group">
            <label for="int">Had Umur <?php echo form_error('yf_agelimit') ?></label>
            <input type="number" class="form-control" name="yf_agelimit" id="yf_agelimit" placeholder="Yf Agelimit" value="<?php echo $yf_agelimit; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Keterangan <?php echo form_error('yf_desc') ?></label>
            <input type="text" class="form-control" name="yf_desc" id="yf_desc" placeholder="Yf Desc" value="<?php echo $yf_desc; ?>" />
        </div>
	    <div class="form-group">
            <label for="double"> Yuran Bulanan <?php echo form_error('yf_jumlah') ?></label>
            <input type="number" class="form-control" name="yf_jumlah" id="yf_jumlah" placeholder="Yf Jumlah" value="<?php echo $yf_jumlah; ?>" />
        </div>
	    <input type="hidden" name="yf_id" value="<?php echo $yf_id; ?>" />
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
          <a href="<?php echo site_url('kadar_family') ?>" class="btn btn-default">Cancel</a>
        </div>


      <!-- /.box-footer-->
      </div>
      <!-- /.box -->
          </div>
        </div> <!-- end row -->
      </form>

    </section>
</div>