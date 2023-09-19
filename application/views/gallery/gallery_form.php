<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-square" aria-hidden="true"></i> Gallery Management
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="activ">Gallery Informations</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">

    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Image Informations</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"> <i class="fa fa-minus"></i>
            </button>   
          </div>
        </div>
        
        <div class="box-body">
	    <!--<div class="form-group">
            <label for="date">Date <?php echo form_error('gallery_date') ?></label>
            <input type="text" class="form-control" name="gallery_date" id="gallery_date" placeholder="Gallery Date" value="<?php echo $gallery_date; ?>" />
        </div>-->

        <div class="form-group">  
        <label for="date">Date <?php echo form_error('gallery_date') ?></label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
          <input class="form-control" id="gallery_date" name="gallery_date" placeholder="YYYY/MM/DD" type="text" value="<?php echo $gallery_date; ?>"/>
          </div>
        </div>

	    <div class="form-group">
            <label for="varchar">Title <?php echo form_error('gallery_title') ?></label>
            <input type="text" class="form-control" name="gallery_title" id="gallery_title" placeholder="Gallery Title" value="<?php echo $gallery_title; ?>" />
        </div>
	    
	    <!--<div class="form-group">
            <label for="enum">Status <?php echo form_error('gallery_status') ?></label>
            <input type="text" class="form-control" name="gallery_status" id="gallery_status" placeholder="Gallery Status" value="<?php echo $gallery_status; ?>" />
        </div>-->
        <div class="form-group">
           <label for="enum">Status <?php echo form_error('gallery_status') ?></label>
             <!--<input type="text" class="form-control" name="news_status" id="news_status" placeholder="News Status" value="<?php echo $news_status; ?>" />
            -->
            <select name="gallery_status" id="gallery_status" class="form-control" >
              <?php 
                if ($gallery_status == "Active")
                  { ?>
                          <option value="Active" selected="selected"> Active </option>
                          <option value="Not Active"> Not Active </option>
                <?php } else if ($gallery_status == "Not Active") {?> 
                          <option value="Active"> Active </option>
                          <option value="Not Active" selected="selected"> Not Active</option>
                <?php } else { ?> 
                          <option value="Active"> Active </option>
                          <option value="Not Active" selected="selected"> Not Active</option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="varchar">Upload Image <font color="red"> (Please resize image to width=1024px & height = 683px before upload)</font><?php echo form_error('userfile') ?></label>
            <input type="file" name="userfile" size="20" class="form-control" />
        </div>


	    <input type="hidden" name="gallery_id" value="<?php echo $gallery_id; ?>" />
      <input type="hidden" name="gallery_image" value="<?php echo $gallery_image; ?>" />
        </div>

        <!-- /.box-body -->
        <div class="box-footer">

       
          <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
          <a href="<?php echo site_url('gallery') ?>" class="btn btn-default">Cancel</a>
        </div>


      <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      </form>

    </section>
</div>

<script>
  $(document).ready(function(){
    var gallery_date=$('input[name="gallery_date"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    gallery_date.datepicker({
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    })

   
  })
</script>