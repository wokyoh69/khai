<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
        
    <small><B><?php echo $pageTitle; ?></B></small>
      
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <!--<li class="active">Dashboard</li>-->
      </ol>
    </section>


      <!-- Content Header (Page header) -->
   
    <?php if($role == 1 ) { ?>
    <section class="content">
         <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <font size="5"><b><?= number_format($total_payment, 2); ?></b></font>
              <p>PENERIMAAN (RM) <br> <font size="1">Bayaran selesai</font></p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
             <a href="<?php echo base_url(); ?>paymentListing" class="small-box-footer">Lihat Perincian <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <font size="5"><b><?= number_format($total_tunggakan, 2); ?></b></font>

              <p>TUNGGAKAN (RM) <br> <font size="1">Bayaran belum selesai</font></p>
            </div>
             <div class="icon">
                  <i class="ion ion-cash"></i>
            </div>
                <a href="<?php echo base_url(); ?>paymentListing" class="small-box-footer">Lihat Perincian <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <font size="5"><b><?= number_format($total_perbelanjaan, 2); ?></b></font>
              <p>PERBELANJAAN (RM)<br> <font size="1">Permohonan secara online</font></p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <!--<a href="#" class="small-box-footer">Lihat Perincian <i class="fa fa-arrow-circle-right"></i></a>-->&nbsp;
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <font size="5"><b><?= number_format($currentbalance, 2); ?></b></font>

              <p>BAKI SEMASA AKAUN <br>
                <font size="1"><?php echo $g_bankname." - ".$g_bankaccount; ?></font>
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
                <!--<a href="#" class="small-box-footer">Lihat Perincian <i class="fa fa-arrow-circle-right"></i></a>-->&nbsp;
          </div>
        </div>
        <!-- ./col -->
        
      </div> <!-- end row -->

      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-home-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">TAMAN/LORONG</span>
              <span class="info-box-number"><?php echo $total_lokasi; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">AHLI QARYAH</span>
              <span class="info-box-number"><?php echo $total_members; ?> Aktif<br><small><?php echo $total_members_tidak_aktif; ?> ahli Tidak Aktif</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-person-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PESERTA KHAIRAT</span>
              <span class="info-box-number"><?php echo $total_khairat; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">TANGGUNGAN</span>
              <span class="info-box-number"><?php echo $total_tanggungan; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->



         <div class="row">
          <div class="col-md-12">
           <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Pendaftaran Online </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
              </div>
            </div>
            <div class="box-body table-responsive">

              <table class="table table-hover">
                    <tr>
                      <th>Tarikh Daftar</th>
                      <th>Nama</th>
                      <th>Kategori</th>
                      <th>Lokasi/Taman</th>
                      <th>Peserta Khairat</th>
                      <th>Telefon</th>

                      
                      <th class="text-center">&nbsp;</th>
                    </tr>
                    <?php
                    if(!empty($userApply))
                    {
                        foreach($userApply as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo date("d-m-Y", strtotime($record->regdate)); ?></td>
                      <td><?php echo $record->name ?> <span class="badge bg-green"> baru !</span></td>
                      <td><span class="badge bg-orange"><?php echo $record->pakej ?></span></td>
                      <td>
                        <?php
                                if(!empty($surauInfo))
                                {
                                    foreach ($surauInfo as $sr)
                                    {
                                        if($sr->id == $record->surau) {
                                          echo $sr->name.", ".$sr->desc;
                                        }  
                                    }
                                }
                                ?>
                          <?php //echo $record->surau ?></td>
                      <td>
                        <?php
                          /*
                                if(!empty($roles))
                                {
                                    foreach ($roles as $rl)
                                    {
                                        if($rl->roleId == $record->roleId) {
                                          echo $rl->role;
                                        }  
                                    }
                                }*/
                                ?>
                          <?php 
                          if($record->ahli_khairat == "Y"){
                            echo "Ya";
                          }  else {
                            echo "Tidak";
                          }?></td>
                      <td><?php echo $record->phone ?></td>
                      
                      <td class="text-center">
                        <?php $record->userId; ?>
                          <!--<a class="btn btn-sm btn-primary" href="<?= base_url().'login-history/'.$record->userId; ?>" title="Login history"><i class="fa fa-history"></i></a> | -->
                          <button id="userId" data-id="<?php echo $record->userId; ?>" type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#applicantModal"> <i class="fa fa-search"></i></button>
                          <!--<button id="familyId" data-id="<?php echo $record->userId; ?>" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#applicantFamily"> <i class="fa fa-users"></i></button>
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'editOld/'.$record->userId; ?>" title="Edit"><i class="fa fa-pencil"></i></a>-->
                          <!--<a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->userId; ?>" title="Delete"><i class="fa fa-trash"></i></a>-->
                      </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
              <!--<div class="chart" id="line-chart" style="height: 50px;"></div>
              <div class="chart" id="line-chart" style="height: 50px;"></div>-->

              
            </div>
            <!-- /.box-body -->
          </div>
          </div>
        </div>
        
        <!--start row 3
        <div class="row"> 
          <div class="col-md-12"> 

          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Graf Pendaftaran Permohonan Ahli</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
          </div>

          </div>
        </div> 
        end row 3-->

    </section>

    <!-- MODAL WINDOW START -->
        <div class="modal fade" id="applicantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <div class="modal-title" id="searchModalLabel">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                   </button>
                   <div class="section-title mb-10">                                
                    &nbsp; <!--<b>MAKLUMAT PEMOHON </b>-->
                  </div>
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

    <?php } else if($role == 2) { ?>
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

       <div class="row">
        <div class="col-md-12">
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3><?php echo $namaUser; ?></h3>
              <p>No. <?php echo $norumah; ?>, Lorong <?php echo $namaLorong; ?>, <?php echo $namaTaman; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-home"></i>
            </div>
             <!--<a href="<?php echo base_url(); ?>payment" class="small-box-footer">Penyata Bayaran <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= number_format($total_payment, 2); ?></h3>
              <p>Jumlah Bayaran (RM)</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
             <!--<a href="<?php echo base_url(); ?>payment" class="small-box-footer">Penyata Bayaran <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>
        <!-- ./col -->
        
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= number_format($total_tunggakan, 2); ?></h3>

              <p>Jumlah Tunggakan (RM)</p>
            </div>
             <div class="icon">
                  <i class="ion ion-card"></i>
            </div>
                <!--<a href="<?php echo base_url(); ?>feedback" class="small-box-footer">Jom Bayar! <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>
        <!-- ./col -->

        <!-- 
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $total_family; ?></h3>
              <p>Jumlah Ahli Keluarga </p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= number_format($total_khairat, 2); ?></h3>

              <p>Jumlah Terima Khairat (RM)</p>
            </div>
            <div class="icon">
              <i class="ion ion-medkit"></i>
            </div>
          </div>
        </div>
         -->
      </div> <!-- end row -->

      <div class="row">
        <div class="col-md-12">
           <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Rekod Bayaran</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
              </div>
            </div>
            
            <!-- /.box-body -->

             <div class="box-body"> 
                <div class="row"><!-- row 3-->
                    <div class="col-md-12">
                      <div class="box-body table-responsive"> <!-- start table A -->

                      <form role="form" id="payUser" action="<?php echo base_url(); ?>paymentUser" method="post">
                      <table class="table table-striped table-hover" style="margin-bottom: 10px">
                            <tr>
                             
                              <td width="25%"><b>Yuran</b></td>
                              <td><b>Catatan</b></td>
                              <td width="200"><b>Status</b></td>
                              <td align="right"><b>Jumlah (RM)</b></td>
                              <td>#</td>
                            </tr>

                            <?php
                                $total_amaun = 0;
                                if(!empty($paymentrecord))
                                {
                                    
                                    foreach ($paymentrecord as $pr)
                                    {
                                        $total_amaun = $total_amaun + $pr->total_amaun;
                                        ?>
                                        <tr>
                                        
                                       
                                            <td>
                                              <?php if ($pr->status == "Belum Selesai"){ ?>
                                              <font color="red"><?php echo $pr->y_title; ?></font>
                                              <?php } else { 
                                                echo $pr->y_title; 
                                              }?>

                                            </td>

                                          <td> 
                                            <?php 
                                            if ($pr->status == "Selesai") { ?>
                                                <font color="blue"><?php echo $pr->catatan;?></font>
                                            <? } else if ($pr->status == "Belum Selesai") { ?>
                                                -
                                            <? } ?>
                                          </td>
                                          
                                          <td width="400"> 
                                            <?php 
                                            if ($pr->status == "Selesai") { ?>
                                                <span class="badge bg-green">Selesai</span>
                                                <span class="badge bg-yellow">Resit : <?php echo sprintf('%05d',$pr->p_id);?>
                                                </span>
                                                <?php 
                                                if (!empty($pr->pg_billcode)) { ?>
                                                <a href="<?php echo $pg_defaulturl.$pr->pg_billcode; ?>" target="_blank">
                                                  <span class="badge bg-blue">Resit FPX: <?php echo $pr->pg_billcode;?></span>
                                                </a>
                                              <?php } ?>

                                            <? } else if ($pr->status == "Belum Selesai") { ?>
                                                <span class="badge bg-red">Belum Selesai</span>
                                                <!--<button type="submit" name="fpx" class="btn btn-sm btn-primary" value="">Bayar </button>-->
                                            <? } ?>
                                            
                                          </td>
                                          

                                          
                                            <td align="right">
                                              <?php if ($pr->status == "Belum Selesai"){ ?>
                                              <font color="red"><?php echo $pr->total_amaun; ?></font>
                                              <?php } else { 
                                                echo $pr->total_amaun; 
                                              }?>
                                            </td>
                                            <td align="right">
                                              <?php 
                                              if ($pr->status == "Belum Selesai") { ?>
                                                <!--<button type="submit" name="fpx" class="btn btn-sm btn-danger" value="<?= $pr->total_amaun; ?>">Bayar </button>-->
                                                <input type="hidden" name="userid" value="<?= $userid; ?>" /> 
                                                <input type="hidden" name="p_id" value="<?php echo $pr->p_id; ?>" /> 
                                              <? } ?>
                                              <button id="paymentId" data-id="<?php echo $pr->p_id; ?>" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#viewPayment"> <i class="fa fa-search"></i></button>
                                              &nbsp;
                                              
                                            
                                            </td>
                                        </tr>
                                        
                                        <?php
                                    }

                                }
                            ?>
                            <tr> 
                              <td colspan="3" align="right"><b>Jumlah Bayaran</b></td>
                              <td align="right"><?= number_format($total_amaun, 2); ?></td>
                              <td>&nbsp;</td>
                            </tr>
                          </table>
                            
                          </form>
                          </div>

                             

                    </div>
                </div><!-- end row3 -->

                <div class="row">
                  <div class="col-md-12">
                  <?php if($ahli_khairat == "Y") { ?>
                    <?php if($g_payment =="Y") { ?>
                      <form role="form" id="payUserPublic" action="<?php echo base_url(); ?>FPXPayment" method="post">
                      <div class="row">
                        <div class="col-sm-12 invoice-col">
                        <div align="center">
                          <img src="<?php echo base_url(); ?>assets/images/toyyibpay_button.png" alt="" class="img-fluid"><br>&nbsp;<br>
                           <input type="hidden" name="userid" value="<?= $userid; ?>" /> 
                           <button type="submit" name="submit" class="btn btn-md btn-danger" value="Submit">Bayar Sekarang</button>
                        </div>
                        </div>
                      </div>
                      </form>
                       <?php } else { ?>
                        <div align="center" class="alert alert-warning alert-dismissable">
                            <?php echo $g_payment_text; ?>     
                        </div>
                      <?php } ?>
                  <?php }  else { ?>
                      <div align="center" class="alert alert-success alert-dismissable">
                            Anda masih belum mendaftar dengan khairat kematian. Klik <a href="<?php echo base_url(); ?>loadPolicy">pautan</a> untuk melihat syarat dan polisi.    
                        </div>
                  <? } ?>                  
                </div>
                </div>

                <div class="row"><!-- row 3-->
                    <div class="col-md-12">

                         <form role="form" action="<?php echo base_url() ?>loadWarning" method="post" id="loadWarning" role="form">
                                    <!--amaran -->
                                   <?php if($unpaidcount >= 1) { ?>
                                    <a class="btn btn-danger" href="<?= base_url().'loadWarning'; ?>">Surat Peringatan </a>
                                    <br><font color="red">Nota : Surat Peringatan akan dijana jika terdapat <b>tiga (3)</b> dan lebih yuran berstatus <b>BELUM SELESAI</b> </font>
                                   <?php } ?>
                                   <!-- amaran end --> 
                                   <input type="hidden" value="<?php echo $userid; ?>" name="userid" id="userid" /> 
                                   <?php //echo $userid; ?>
                                </form>
                    </div>
                </div>
                </div>
        </div>


      <!-- MODAL 2 -->
      <div class="modal fade" id="viewPayment" tabindex="-1" role="dialog" aria-labelledby="examModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <div class="modal-title" id="searchModalLabel">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                   </button>
                   <div class="section-title mb-10">                                
                    &nbsp; <b>Payment Detail </b>
                  </div>
                </div>
                
              </div>
              <div class="modal-body">
                  <div id="modal-loader2" style="display: none; text-align: center;"></div>         
                  <div id="dynamic-content2"></div>
                  <div id="dynamic-name2"></div>
              </div>
              
              <div class="modal-footer">
                    <button class="btn btn-info" data-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>
        <!-- END MODAL -->
        
      <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Rekod Penerimaan Sumbangan Khairat</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
              </div>
            </div>
            
            <!-- /.box-body -->

             <div class="box-body"> 
      <div class="row"><!-- start row khairat-->
        <div class="col-md-12">
          <table class="table table-striped">
            <tr>
              <td><b>Tarikh</b></td>
              <td><b>Catatan</b></td>
              <!--<td><b>Kemaskini Oleh</b></td>-->
              <td align="right"><b>Jumlah (RM)</b></td>
            </tr>

            <?php
                $total_sumbangan = 0;
                if(!empty($khairatrecord))
                {
                    
                    foreach ($khairatrecord as $kh)
                    {
                        $total_sumbangan = $total_sumbangan + $kh->k_amaun;
                        ?>
                        <tr>
                        
                            <td>
                              <?php echo date("d-m-Y", strtotime($kh->k_date)); ?>
                            </td>
                            <td> 
                                <?php echo $kh->k_catatan; ?>
                            </td>
                            <!--
                            <td>
                              <?php echo $kh->name."<br>".$kh->updatedDtm; ?>
                           </td>-->
                           
                            <td align="right">
                              <?php echo $kh->k_amaun;?>
                            </td>
                            
                        </tr>
                        
                        <?php
                    }

                }
            ?>
            <tr> 
              <td colspan="2" align="right"><b>Jumlah Sumbangan Khairat</b></td>
              <td align="right"><?= number_format($total_sumbangan, 2); ?></td>
            </tr>   
          </table>
        </div>
      </div> <!-- end row khairat-->
    </div>
        

      </div>


    </div>

    </section>


    <?php } ?>
</div>

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
            url: '<?php echo base_url() ?>applicantDetail',
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

    <script>
      $(document).ready(function(){
        $(document).on('click', '#paymentId', function(e){
          e.preventDefault();
          var uid = $(this).data('id');   // it will get id of clicked row
          $('#dynamic-content2').html(''); // leave it blank before ajax call
          $('#modal-loader2').show();      // load ajax loader
          $.ajax({
            url: '<?php echo base_url() ?>paymentDetail',
            type: 'POST',
            data: 'id='+uid,
            dataType: 'html'
          })
          .done(function(data){
            console.log(data);  
            $('#dynamic-content2').html('');    
            $('#dynamic-content2').html(data); // load response 
            $('#modal-loader2').hide();      // hide ajax loader 
          })
          .fail(function(){
            $('#dynamic-content2').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader2').hide();
          });
          
        });
        
      });
    </script>