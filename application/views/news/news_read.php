
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i> Makluman
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Makluman</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">

         <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"> Informations</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i></button> 
          </div>
        </div>
        <div class="box-body">
        
        <table class="table table-bordered">
	    <tr><td>Tajuk </td><td><?php echo $news_headline; ?></td></tr>
	    <tr><td>Makluman</td><td><?php echo $news_story; ?></td></tr>
	    <tr><td>Editor</td><td><?php echo $news_editor; ?></td></tr>
	    <!--<tr><td>News Email</td><td><?php echo $news_email; ?></td></tr>-->
	    <tr><td>Tarikh</td><td><!--<?php echo $news_timestamp; ?>--><?php echo date("d-m-Y", strtotime($news_timestamp)); ?></td></tr>
	    <tr><td>Status</td><td><?php echo $news_status; ?></td></tr>
	</table>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo site_url('news') ?>" class="btn btn-default">Cancel</a>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      </section>
</div>