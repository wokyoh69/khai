
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i> Whatsapp
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Whatsapp</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">

    <div class="row"><!-- row 1-->
            <div class="col-md-6">

                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>

            </div>
        </div>

    <!-- Info boxes -->
      <div class="row">
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">No. Telefon Pentadbir</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url() ?>saveAdminPhone" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="wa_phone2" class="col-sm-3 control-label">Pentadbir 1</label>
                  <div class="col-sm-5">
                    <input type="number" class="form-control" id="wa_phone2" name="wa_phone2" value="<?= $wa_phone2; ?>" required>
                  </div>
                </div>
                <!--<div class="form-group">
                  <label for="wa_phone4" class="col-sm-3 control-label">Pentadbir 2</label>
                  <div class="col-sm-5">
                    <input type="number" class="form-control" id="wa_phone4" name="wa_phone4" value="<?= $wa_phone4; ?>" required>
                  </div>
                </div>-->
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>

        <div class="col-md-6">
          <!-- Horizontal Form -->

            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <ul> <b>Nota : </b>
                    <li>Hanya satu (1) nombor telefon pentadbir dibenarkan untuk menerima notifikasi whatsapp. </li>
                    <li>Pentadbir akan menerima notifikasi whatsapp dari host e-khairat - 01113000403</li>
                    <li>Pentadbir hendaklah 'save contact' nombor host e-khairat ke dalam 'address book' telefon masing-masing.</li>
                </ul>
            </div>

        </div>
      </div>
      <!-- /.row -->
<!--
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('whatsapp/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('whatsapp/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('whatsapp'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-striped" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Userid</th>
		<th>Phone</th>
		<th>Messageid</th>
		<th>Message</th>
		<th>CreateDtm</th>
		<th>CreatedBy</th>
		<th>Action</th>
            </tr><?php
            foreach ($whatsapp_data as $whatsapp)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $whatsapp->userid ?></td>
			<td><?php echo $whatsapp->phone ?></td>
			<td><?php echo $whatsapp->messageid ?></td>
			<td><?php echo $whatsapp->message ?></td>
			<td><?php echo $whatsapp->createDtm ?></td>
			<td><?php echo $whatsapp->createdBy ?></td>
			<td style="text-align:center" width="200px">
				 <a class="btn btn-sm btn-primary" href="<?= base_url().'whatsapp/read/'.$whatsapp->wm_id; ?>" title="Read Detail"><i class="fa fa-info-circle"></i></a>
				 <a class="btn btn-sm btn-info" href="<?= base_url().'whatsapp/update/'.$whatsapp->wm_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
				 <a class="btn btn-sm btn-danger deleteUser" href="<?= base_url().'whatsapp/delete/'.$whatsapp->wm_id; ?>" title="Delete" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
            <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    -->
    
        <div class="box">
            <!--<div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>-->
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <small>
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>Bil</th>
                    <!--<th>Ahli</th>-->
                    <th>Telefon</th>
                    <th>IDMesej</th>
                    <th>Kandungan Mesej</th>
                    <th>Tarikh Hantar</th>
                    <!--<th>Oleh</th>
                    <th>&nbsp;</th>-->
                </tr>
                </thead>
                <tbody>
                    <?php
                    $bil = 0;
                    foreach ($whatsapp_records as $whatsapp)
                    {
                        ?>
                    <tr>
                      <td><?php echo ++$bil; ?>.</td>
                      <!--<td><?php echo $whatsapp->userid ?></td>-->
                      <td><?php echo $whatsapp->phone ?></td>
                      <td><?php echo $whatsapp->messageid ?></td>
                      <td><?php echo $whatsapp->message ?></td>
                      <td  style="text-align:center" width="200px"><?php echo $whatsapp->createDtm ?></td>
                      <!--<td><?php echo $whatsapp->createdBy ?></td>
                      <td>

                         <a class="btn btn-sm btn-danger deleteUser" href="<?= base_url().'whatsapp/delete/'.$whatsapp->wm_id; ?>" title="Delete" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash"></i></a>
                    </td>-->
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
</div>