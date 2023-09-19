<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-calculator" aria-hidden="true"></i> Tambah / Kemaskini Yuran
        <!--<small>"manage training locations"</small>-->
      </h1>
     <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>/kadar">Kadar Yuran Tahunan</a></li>
        <li class="active"> Tambah/Kemaskini</li>
      </ol>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">

    <form action="<?php echo $action; ?>" method="post">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Maklumat Yuran</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i>
            </button>   
          </div>
        </div>
        
        <div class="box-body">
       <div class="form-group">
            <label for="year">Tajuk <?php echo form_error('y_title') ?></label>
            <input type="text" class="form-control" name="y_title" id="y_title" placeholder="Tajuk" value="<?php echo $y_title; ?>" />
        </div>
	    <div class="form-group">
            <label for="year">Tahun <?php echo form_error('y_tahun') ?></label> <small>(Nota : Masukkan '0000' jika melibatkan semua ahli)</small>
            <input type="text" class="form-control" name="y_tahun" id="y_tahun" placeholder="Tahun" value="<?php echo $y_tahun; ?>" maxlength="4" />
        </div>
      <!--
       <div class="form-group">
              <label for="int">Tahun<?php echo form_error('y_tahun') ?></label> 
              <select class="form-control" id="y_tahun" name="y_tahun">
                  <option value="2017">2017</option>
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
              </select>
          </div>-->
      <div class="row">
        <div class="col-md-6">
  	    <div class="form-group">
              <label for="decimal">Yuran Keluarga <?php echo form_error('y_jumlah') ?></label>
              <input type="text" class="form-control" name="y_jumlah" id="y_jumlah" placeholder="Jumlah" value="<?php echo $y_jumlah; ?>" />
          </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
              <label for="decimal">Yuran Bujang <?php echo form_error('y_jumlah_bujang') ?></label>
              <input type="text" class="form-control" name="y_jumlah_bujang" id="y_jumlah_bujang" placeholder="Jumlah" value="<?php echo $y_jumlah_bujang; ?>" />
          </div>
        </div>
      </div>


      <div class="form-group">
           <label for="enum"> Status <?php echo form_error('status') ?></label>
             <!--<input type="text" class="form-control" name="news_status" id="news_status" placeholder="News Status" value="<?php echo $news_status; ?>" />
            -->
            <select name="status" id="status" class="form-control" >
              <?php 
                if ($status == "Aktif")
                  { ?>
                          <option value="Aktif" selected="selected"> Aktif </option>
                          <option value="Tidak Aktif"> Tidak Aktif </option>
                <?php } else if ($status == "Tidak Aktif") {?> 
                          <option value="Aktif"> Aktif </option>
                          <option value="Tidak Aktif" selected="selected"> Tidak Aktif</option>
                <?php } else { ?> 
                          <option value="Aktif"> Aktif </option>
                          <option value="Tidak Aktif" selected="selected"> Tidak Aktif</option>
                <?php } ?>
            </select>
        </div>

	    <input type="hidden" name="yid" value="<?php echo $yid; ?>" />
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
          <a href="<?php echo site_url('kadar') ?>" class="btn btn-default">Cancel</a>
        </div>


      <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      </form>

    </section>
</div>