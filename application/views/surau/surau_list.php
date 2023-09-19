
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i> Taman/Lokasi  
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Taman/Lokasi</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">


        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('surau/create'),'Tambah', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('surau/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('surau'); ?>" class="btn btn-default">Reset</a>
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
                <th>Id.</th>
		<th>Taman/Lokasi</th>
		<th>Alamat</th>
		<th>&nbsp;</th>
            </tr><?php
            foreach ($surau_data as $surau)
            {
                ?>
                <tr>
			<td width="30px"><?php echo ++$start ?></td>
			<td><?php echo $surau->name ?></td>
			<td><?php echo $surau->desc ?></td>
			<td style="text-align:center" width="200px">
				 <!--<a class="btn btn-sm btn-primary" href="<?= base_url().'surau/read/'.$surau->id; ?>" title="Read Detail"><i class="fa fa-info-circle"></i></a>-->
				 <a class="btn btn-sm btn-info" href="<?= base_url().'surau/update/'.$surau->id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                 <?php if ($surau->id <> 0) { ?>
				 <a class="btn btn-sm btn-danger deleteUser" href="<?= base_url().'surau/delete/'.$surau->id; ?>" title="Delete" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash"></i></a>
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
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>


    </section>
</div>