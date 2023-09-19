<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i>&nbsp;Taman/Lokasi 
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="activ"> Blok</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">

    <form action="<?php echo $action; ?>" method="post">
    <div class="row">
      <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> Maklumat Taman/Lokasi</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i>
            </button>   
          </div>
        </div>
        
        <div class="box-body">
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('name') ?></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nama Taman/Lokasi" value="<?php echo $name; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('desc') ?></label>
            <input type="text" class="form-control" name="desc" id="desc" placeholder="Alamat" value="<?php echo $desc; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" />
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
          <a href="<?php echo site_url('surau') ?>" class="btn btn-default">Cancel</a>
        </div>


      <!-- /.box-footer-->
      </div>
      <!-- /.box -->
          </div>
        </div> <!-- end row -->
      </form>

    </section>
</div>