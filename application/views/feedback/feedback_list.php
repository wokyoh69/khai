
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-envelope" aria-hidden="true"></i> Maklumbalas
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Maklumbalas</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">


        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <!--<?php echo anchor(site_url('feedback/create'),'Create', 'class="btn btn-primary"'); ?>-->&nbsp;
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('feedback/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('feedback'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
         <div class="box-body table-responsive no-padding">
        <table class="table table-bordered table-striped table-hover" style="margin-bottom: 10px">
    
            <tr>
                <th>No</th>
		<th>Tarikh</th>
		<th>Nama</th>
		<th>Emel</th>
		<th>Phone</th>
		<th>Maklumbalas</th>
		<th>Action</th>
            </tr><?php
            foreach ($feedback_data as $feedback)
            {
                ?>
                <tr>
			<td width="50px"><?php echo ++$start ?></td>
			<td width="100px"><?php echo $feedback->Date ?></td>
			<td><?php echo $feedback->Name ?></td>
			<td><?php echo $feedback->Email ?></td>
			<td><?php echo $feedback->Mobile ?></td>
			<td><?php echo $feedback->Comment ?></td>
			<td style="text-align:center" width="200px">
				 <a class="btn btn-sm btn-primary" href="<?= base_url().'feedback/read/'.$feedback->fb_id; ?>" title="Read Detail"><i class="fa fa-info-circle"></i></a>
				 <a class="btn btn-sm btn-info" href="<?= base_url().'feedback/update/'.$feedback->fb_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
				 <a class="btn btn-sm btn-danger deleteUser" href="<?= base_url().'feedback/delete/'.$feedback->fb_id; ?>" title="Delete" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash"></i></a>
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
		<?php echo anchor(site_url('feedback/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>


    </section>
</div>