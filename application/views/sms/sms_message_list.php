
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i> SMS
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> SMS</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">

         <div class="row"><!-- row 1-->
            <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
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

                <?php  
                    $warning = $this->session->flashdata('warning');
                    if($warning)
                    {
                ?>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('warning'); ?>
                </div>
                <?php } ?>
            </div>
        </div>

<!-- Info boxes -->
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-dollar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">BAKI KREDIT SMS</span>
              <span class="info-box-number"><?php echo number_format($credit_balance) ?></span> 
              <!--<a href="#" target="_blank"><span class="badge bg-red"> + TAMBAH KREDIT SMS</span></a> &nbsp;-->

              <button id="userId" data-id="<?php echo $userid; ?>" type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#searchModal">+ TAMBAH KREDIT SMS</button> 

              <!--<small>1 kredit = 1 SMS</small>-->
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-android-textsms"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">STATUS SMS</span>
              <span class="info-box-number"><?php echo number_format($total_sms_sent) ?></span>
              <small>mesej telah dihantar</small>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-android-textsms"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">HANTAR SMS</span>
              <a class="btn btn-warning" href="" id="smsId" data-id="<?php echo $userid; ?>" title="Message" data-toggle="modal" data-target="#smsModal"><i class="ion ion-android-textsms"></i> SMS</a><br>
              <small>klik untuk hantar SMS </small>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
      </div>
      <!-- /.row -->
    
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
                    <th>Kod</th>
                    <th>Penerangan</th>
                    <th>Mesej</th>
                    <th>Kos</th>
                    <th>Tarikh Hantar</th>
                    <!--<th>Oleh</th>
                    <th>&nbsp;</th>-->
                </tr>
                </thead>
                <tbody>
                    <?php
                    $bil = 0;
                    foreach ($sms_records as $sms)
                    {
                        ?>
                    <tr>
                      <td><?php echo ++$bil; ?>.</td>
                      <!--<td><?php echo $sms->userid ?></td>-->
                      <td><?php echo $sms->phone ?></td>
                      <td><?php echo $sms->sms_code ?></td>
                      <td><?php echo $sms->sms_desc ?></td>
                      <td><?php echo $sms->message ?></td>
                      <td><?php echo $sms->sms_cost ?></td>
                      <td  style="text-align:center" width="200px"><?php echo $sms->createDtm ?></td>
                      <!--<td><?php echo $sms->createdBy ?></td>
                      <td>

                         <a class="btn btn-sm btn-danger deleteUser" href="<?= base_url().'sms/delete/'.$sms->wm_id; ?>" title="Delete" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash"></i></a>
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

        <div class="row">
        <div class="col-md-12"><!-- Maklumat Bayaran Maklumat Ahli-->
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Rekod Tambahan Kredit SMS</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-default" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i>
                    </button> 
                  </div>
                </div>

                <div class="box-body"> 
                <div class="row"><!-- row 3-->
                    <div class="col-md-12">
                        <div class="box-body table-responsive no-padding">
                          <table class="table table-condensed table-striped table-hover" >
                            <tr>
                              <td><b>Tarikh</b></td>
                              <td><b>Resit</b></td>
                              <td><b>Catatan</b></td>
                              <td><b>Oleh</b></td>
                              <td align="right"><b>Jumlah (RM)</b></td>
                            </tr>

                            <?php
                                $total_amaun = 0;
                                if(!empty($smspaymentrecord))
                                {
                                    
                                    foreach ($smspaymentrecord as $smsp)
                                    {
                                        $total_amaun = $total_amaun + $smsp->amaun;
                                        ?>
                                        <tr>
                                          <td><?php echo $smsp->smsp_date; ?></td>
                                          <td>
                                              <?php 
                                                if (!empty($smsp->pg_billcode)) { ?>
                                                  <a href="<?php echo $pg_defaulturl.$smsp->pg_billcode; ?>" target="_blank">
                                                    <span class="badge bg-blue">Resit FPX: <?php echo $smsp->pg_billcode;?></span>
                                                  </a>
                                              <?php } ?>  
                                          </td>
                                          <td> <?php echo $smsp->catatan; ?></td>
                                          <td><?php echo $smsp->name."<br>".$smsp->createDtm; ?></td>
                                          <td align="right"><?php echo $smsp->amaun; ?></td>
                                        </tr>
                                        <?php
                                    }

                                }
                            ?>
                            <tr> 
                              <td colspan="4" align="right"><b>Jumlah Bayaran</b></td>
                              <td align="right"><b><?= number_format($total_amaun, 2); ?></b></td>
                            </tr>
                            
                          </table>
                          </div>
                    </div>
                </div><!-- end row3 -->
                </div>
            </div>
        </div>
        </div> <!-- end row -->

    </section>
</div>

 <!-- MODAL WINDOW START -->
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <div class="modal-title" id="searchModalLabel">
                  <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>-->
                   <!--<div class="section-title mb-12" align="center"> -->
                    <BIG><strong>TAMBAH KREDIT SMS </strong></BIG>                               
                  <!--</div>-->
                </div>
                
              </div>
              <div class="modal-body">
                  <div id="modal-loader" style="display: none; text-align: center;"></div>         
                  <div id="dynamic-content"></div>
                  <div id="dynamic-name"></div>
              </div>
             <div class="modal-footer">
                    <button class="btn btn-info" data-dismiss="modal">Tutup</button>
              </div>
              
            </div>
          </div>
        </div>
<!-- MODAL WINDOW -->

<!-- MODAL SMS  -->
        <div class="modal fade" id="smsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <div class="modal-title" id="searchModalLabel2">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                   </button>
                   <div class="section-title mb-10"> 
                   <BIG><strong>HANTAR SMS </strong></BIG>                                 

                  </div>
                </div>
                
              </div>
              <div class="modal-body">
                  <div id="modal-loader" style="display: none; text-align: center;"></div>         
                  <div id="dynamic-content2"></div>
                  <div id="dynamic-name"></div>
              </div>
              
              <!--<div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Tutup</button>
              </div>-->
            </div>
          </div>
        </div>
        <!-- MODAL WINDOW -->

<!-- MODAL JSCRIPT -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>
    <script>
      $(document).ready(function(){
        
        $(document).on('click', '#userId', function(e){
          
          e.preventDefault();
          
          var uid = $(this).data('id');   // it will get id of clicked row
          
          $('#dynamic-content').html(''); // leave it blank before ajax call
          $('#modal-loader').show();      // load ajax loader
          
          $.ajax({
            //url: '<?php echo base_url() ?>checkDetail',
            url: '<?php echo base_url() ?>smsEwalletDetail',
            type: 'POST',
            data: 'id='+uid,
            dataType: 'html'
          })
          .done(function(data){
            console.log(data);  
            $('#dynamic-content').html('');    
            $('#dynamic-content').html(data); // load response 
            $('#modal-loader').hide();      // hide ajax loader 
          })
          .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
          });
          
        });
        
      });
    </script>

<!-- MODAL JSCRIPT SMS-->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>
    <script>
      $(document).ready(function(){
        $(document).on('click', '#smsId', function(e){
          e.preventDefault();
          var usid = $(this).data('id');   // it will get id of clicked row

          
          $('#dynamic-content2').html(''); // leave it blank before ajax call
          $('#smsModal').show();      // load ajax loader
          
          $.ajax({
            url: '<?php echo base_url() ?>smsDetail_open',
            type: 'POST',
            data: 'uid='+usid,
            dataType: 'html'
          })
          .done(function(data){
            console.log(data);  
            $('#dynamic-content2').html('');    
            $('#dynamic-content2').html(data); // load response 
            $('#smsModal').hide();      // hide ajax loader 
          })
          .fail(function(){
            $('#dynamic-content2').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#smsModal').hide();
          });
          
        });
        
      });
    </script>