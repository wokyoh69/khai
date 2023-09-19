
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i> About Management
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">About</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">


        <div class="row" style="margin-bottom: 10px">
            <!--<div class="col-md-4">
                <?php echo anchor(site_url('about/create'),'Create', 'class="btn btn-primary"'); ?>
            </div> -->
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <!--
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('about/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('about'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        -->
        </div>
         <div class="box-body table-responsive no-padding">
        <table class="table table-bordered table-striped table-hover" style="margin-bottom: 10px">
      
            <tr>
                <th>No</th>
		<th>Title1 & Description1</th>
		<!--<th>Desc1</th>-->
		<th>Title2 & Description2</th>
		<!--<th>Desc2</th>-->
		<th>Note</th>
		<th>Action</th>
            </tr><?php
            foreach ($about_data as $about)
            {
                ?>
                <tr>
			<td width="50px"><?php echo ++$start ?></td>
			<td><b><?php echo $about->ab_title1 ?></b><br><?php echo $about->ab_desc1 ?></td>
			<!--<td></td>-->
			<td><b><?php echo $about->ab_title2 ?></b><br><?php echo $about->ab_desc2 ?></td>
			<!--<td></td>-->
			<td><?php echo $about->ab_note ?></td>
			<td style="text-align:center" width="100px">
				 <a class="btn btn-sm btn-primary" href="<?= base_url().'about/read/'.$about->ab_id; ?>" title="Read Detail"><i class="fa fa-info-circle"></i></a>
				 <a class="btn btn-sm btn-info" href="<?= base_url().'about/update/'.$about->ab_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
				 <!--<a class="btn btn-sm btn-danger deleteUser" href="<?= base_url().'about/delete/'.$about->ab_id; ?>" title="Delete" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash"></i></a> -->
			</td>
		</tr>
            <?php
            }
            ?>
        </table>
         </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>


    </section>
</div>