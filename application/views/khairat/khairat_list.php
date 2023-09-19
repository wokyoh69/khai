
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-dollar" aria-hidden="true"></i>&nbsp;Senarai Perbelanjaan 
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Khairat</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">


        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('khairat/create'),'Tambah', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <b><font color="blue"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></font></b>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('khairat/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('khairat'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Carian</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-striped" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Tarikh </th>
        <th>Jenis Perbelanjaan</th>
		<th>Penerima</th>
		<th>Jumlah</th>
		<th>Catatan</th>
		<!--<th>UpdatedBy</th>
		<th>UpdatedDtm</th>-->
		<th>Tindakan</th>
            </tr><?php
            foreach ($khairat_data as $khairat)
            {
                ?>
                <tr>
			<td width="40px"><?php echo ++$start ?></td>
			<td width="100px"><?php echo date("d-m-Y", strtotime($khairat->k_date)); ?></td>
            <td><?php echo $khairat->k_jenis ?></td>
			<td><?php echo $khairat->name ?></td>
			<td width="40px" align="right"><?php echo $khairat->k_amaun ?></td>
			<td width="*"><?php echo $khairat->k_catatan ?></td>
			<!--<td><?php echo $khairat->updatedBy ?></td>
			<td><?php echo $khairat->updatedDtm ?></td>-->
			<td style="text-align:center" width="200px">
                <?php if ($khairat->k_jenis == "SMS") { ?>
                <a class="btn btn-sm btn-warning" href="<?php echo base_url(); ?>sms"><i class="ion ion-android-textsms"></i> &nbsp;SMS</a>
                <?php } else { ?>
				 <a class="btn btn-sm btn-primary" href="<?= base_url().'khairat/read/'.$khairat->k_id; ?>" title="Read Detail"><i class="fa fa-info-circle"></i></a>
				 <a class="btn btn-sm btn-info" href="<?= base_url().'khairat/update/'.$khairat->k_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
				 <a class="btn btn-sm btn-danger deleteUser" href="<?= base_url().'khairat/delete/'.$khairat->k_id; ?>" title="Delete" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash"></i></a>
                <?php } ?>
			</td>
		</tr>
            <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Jumlah Rekod : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('khairat/excel'), '&nbsp;', 'class="btn btn-success fa fa-file-excel-o"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                 <table style="margin-bottom: 10px">
                     <tr>
                        <td><a class="btn btn-sm btn-danger" href="#"><i class="fa fa-trash"></i></a></td>
                        <td>&nbsp; Padam rekod sumbangan khairat</td>
                    </tr>
                    <tr>     
                        <td>&nbsp;</td>
                        <td>&nbsp; </td>
                    </tr>
                    <tr>
                        <td><a class="btn btn-sm btn-success" href="#"><i class="fa fa-file-excel-o"></i></a></td>
                        <td>&nbsp; Download Excel file </td>
                    </tr>
                </table>
                <!--
                 <a class="btn btn-sm btn-danger" href="#"><i class="fa fa-bullhorn"></i></a><br>
                 <small> - Bayaran akan dijana mengikut <b>tahun pendaftaran ahli</b>. 
                    <br>- Cth '2020' = Ahli yang berdaftar pada <b>2020 dan sebelumnya sahaja.</b>
                    <br>- '0000' = melibatkan <b>SEMUA</b> Ahli yang berdaftar.
                </small>
                -->
            </div>
        </div>


    </section>
</div>