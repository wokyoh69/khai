
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-calculator" aria-hidden="true"></i> Senarai Bayaran
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Senarai Bayaran</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">


        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('payment/create'),'Tambah', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <font color="red"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></font>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">

                <!--
                <form action="<?php echo site_url('payment/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('payment'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Carian</button>
                        </span>
                    </div>
                </form>
                -->


                <form action="<?php echo base_url() ?>paymentListing" method="POST" id="searchList">
                    <div class="input-group">
                      <input type="text" name="searchText" value="<?php //echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Carian"/>
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="box-body table-responsive no-padding">
        <table class="table table-bordered table-hover table-striped" style="margin-bottom: 10px">
        <tr>
            <!--<th>No. Resit</th>-->
    		<th>Tarikh Bayaran</th>
    		<th>Nama [No.Ahli]</th>
    		<th>Yuran Tahun</th>
            <th>Amaun</th>
    		<!--<th>Attachment</th>-->
    		<th>Status</th>
    		<!--<th>Catatan</th>-->
    		<th>Action</th>
        </tr><?php
            foreach ($payment_data as $payment)
            {
                ?>
                <tr>
			<!--<td width="80px"><?php echo sprintf('%05d', $payment->p_id);?></td>-->
            <!--<td width="80px"><?php echo $payment->p_id;?></td>-->
			<td><?php echo date("d-m-Y", strtotime($payment->p_date)); ?></td>
			<td>
                <?php //echo sprintf('%04d',$payment->userid);?>
                <?php 
                foreach ($user_data as $user): 
                  if ($user->userId == $payment->userid)
                    //echo $venue['v_name'] ;
                    echo "<a href=".base_url().'editUsers/'.$user->userId.">".$user->name." [".sprintf('%04d', $user->userId)."] </a>";
                    //echo $training->venue_id;
                endforeach ?>
            </td>
			<td>
                <?php //echo $payment->yid ?>
                <?php 
                foreach ($yuran_data as $yuran): 
                  if ($yuran->yid == $payment->yid)
                    //echo $venue['v_name'] ;
                    echo $yuran->y_tahun;
                    //echo $training->venue_id;
                endforeach ?>
            </td>
            <td><?php echo $payment->amaun ?></td>
			<!--<td><?php echo $payment->attachment ?></td>-->
			<td>
                <?php
                if($payment->status == "Selesai") { ?>
                    <span class="label label-success">Selesai</span>
                <?php } else if($payment->status == "Belum Selesai") {  ?>
                    <span class="label label-danger">Belum Selesai</span>
                <? } ?>
            </td>
			<!--<td><?php echo $payment->catatan ?></td>-->
			<td style="text-align:center" width="200px">
                <?php
                if($payment->status == "Selesai") { ?>
                    <a class="btn btn-sm btn-primary" href="<?= base_url().'payment/read/'.$payment->p_id; ?>" title="Resit"><i class="fa fa-info-circle"></i></a>
                <?php } else if($payment->status == "Belum Selesai") {  ?>
                    &nbsp;
                <? } ?>

				 <a class="btn btn-sm btn-info" href="<?= base_url().'payment/update/'.$payment->p_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
				 <!--<a class="btn btn-sm btn-danger deleteUser" href="<?= base_url().'payment/delete/'.$payment->p_id; ?>" title="Delete" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash"></i></a>-->
			</td>
		</tr>
            <?php
            }
            ?>
        </table>
    </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Jumlah Rekod : <?php echo $total_rows ?></a>
		<!--<?php echo anchor(site_url('payment/excel'), 'Excel', 'class="btn btn-primary"'); ?>-->
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>


    </section>
</div>