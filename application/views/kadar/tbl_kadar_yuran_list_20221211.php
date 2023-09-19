
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-calculator" aria-hidden="true"></i> Yuran
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Yuran</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">


        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('kadar/create'),'Tambah', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <font color="red"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></font>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('kadar/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('kadar'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Carian</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    <div class="box-body table-responsive no-padding">
        <table class="table table-bordered table-striped table-hover" style="margin-bottom: 10px">
        <tr>
        <th>Bil</th>
        <th>Tajuk</th>
		<th>Tahun</th>
		<th>Yuran Keluarga</th>
        <th>Yuran Bujang</th>
        <th>Status</th>
		<th>Tindakan</th>
        </tr>
            <?php
            foreach ($kadar_data as $kadar)
            { 
                     ?>
                <tr>
			<td width="40px"><?php echo ++$start ?></td>
            <td><?php echo $kadar->y_title ?></td>
			<td><?php echo $kadar->y_tahun ?></td>
			<td><?php echo $kadar->y_jumlah ?></td>
            <td><?php echo $kadar->y_jumlah_bujang ?></td>
            <td><?php echo $kadar->status ?></td>
			<td style="text-align:center" width="200px">
				 <!--<a class="btn btn-sm btn-primary" href="<?= base_url().'kadar/read/'.$kadar->yid; ?>" title="Read Detail"><i class="fa fa-info-circle"></i></a>-->
				 <!--<a class="btn btn-sm btn-danger deleteUser" href="<?= base_url().'kadar/delete/'.$kadar->yid; ?>" title="Delete" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash"></i></a>-->
                 <a class="btn btn-sm btn-info" href="<?= base_url().'kadar/update/'.$kadar->yid; ?>" title="Edit"><i class="fa fa-pencil"></i></a>

                 <?php
                 if($this->payment_model->checkYuran($kadar->yid) > 0) { ?>
                 <?php echo anchor(site_url('kadar/excel/'.$kadar->yid), '&nbsp;', 'class="btn btn-sm btn-success fa fa-file-excel-o"'); ?>
                 <?php } ?>
                 <?php 
                 if ($kadar->y_tahun >= date('Y')) { 
                    if ($kadar->status == "Aktif") { 
                    ?>
                 <a class="btn btn-sm btn-danger" href="<?= base_url().'kadar/generateFee/'.$kadar->yid; ?>" title="Generate Payment" onclick="javasciprt: return confirm('Adakah anda pasti untuk jana tuntutan yuran kepada semua ahli ?')"><i class="fa fa-bullhorn"></i></a>
                <?  } 
                 } ?>
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
	        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">

                 <!--<a class="btn btn-sm btn-danger" href="#"><i class="fa fa-bullhorn"></i></a><br>
                 <small> - Bayaran akan dijana mengikut <b>tahun pendaftaran ahli</b>. 
                    <br>- Cth '2017' = Ahli yang berdaftar pada <b>2017 dan sebelumnya sahaja.</b>
                    <br>- '0000' = melibatkan <b>SEMUA</b> Ahli yang berdaftar.
                </small> -->

                <table style="margin-bottom: 10px">
                    <tr>     
                        <td><a class="btn btn-sm btn-danger" href="#"><i class="fa fa-bullhorn"></i></a></td>
                        <td>&nbsp; Jana yuran kepada semua ahli </td>
                    </tr>
                    <tr>     
                        <td>&nbsp;</td>
                        <td>&nbsp; </td>
                    </tr>
                    <tr>
                        <td><a class="btn btn-sm btn-success" href="#"><i class="fa fa-file-excel-o"></i></a></td>
                        <td>&nbsp; Muat turun senarai bayaran ahli</td>
                    </tr>
                </table>
            </div>
        </div>


    </section>
</div>