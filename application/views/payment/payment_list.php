
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-calculator" aria-hidden="true"></i> Senarai Yuran
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Bayaran</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">
        <!--<div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addNew"><i class="fa fa-plus"></i> Daftar Ahli</a>
                </div>
            </div>
        </div>-->
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">&nbsp;</h3> 
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>paymentListing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Carian Nama"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Tarikh Bayaran</th>
                      <th>Nama</th>
                      <th>Yuran Tahun</th>
                      <th>Amaun</th>
                      <th>Status</th>
                      
                    </tr>
                    <?php
                    if(!empty($paymentRecords))
                    {
                        foreach($paymentRecords as $payment)
                        {
                    ?>
                    <tr>
                      <td><?php echo date("d-m-Y", strtotime($payment->p_date)); ?></td>
                      <td>
                        <?php //echo $payment->name ?>
                        <a href="<?= base_url().'editUsers/'.$payment->userId; ?>"><?php echo $payment->name;?></a>
                      </td>
                      <td><?php echo $payment->y_title ?><!--<?php echo $payment->y_tahun ?>--></td>
                      <td><?php echo $payment->total_amaun ?></td>
                      <td>
                        <?php //echo $payment->statusBayar ?>
                        <?php 
                          if ($payment->statusBayar == "Selesai") { ?>
                              <span class="badge bg-green">Selesai</span>
                              <a href="<?= base_url().'payment/read/'.$payment->p_id; ?>" title="Resit"><span class="badge bg-yellow">Resit : <?php echo sprintf('%05d',$payment->p_id);?></span></a>

                              <?php 
                               //echo $pg_defaulturl;
                                if (!empty($payment->pg_billcode)) { ?>
                                <a href="<?php echo $pg_defaulturl.$payment->pg_billcode; ?>" target="_blank">
                                  <span class="badge bg-blue">Resit FPX: <?php echo $payment->pg_billcode;?></span>
                                </a>
                               <?php } ?>
                              
                          <?php } else if ($payment->statusBayar  == "Belum Selesai") { ?>
                              <!--<span class="badge bg-red">Belum Selesai</span> -->
                              <a  href="<?= base_url().'payment/update/'.$payment->p_id; ?>" title="Edit"><span class="badge bg-red">Belum Selesai</span></a>
                          <?php } ?>

                      </td>
                     
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?> <a href="#" class="btn btn-primary">Jumlah Rekod : <?php echo $rows ?></a>
                </div>

              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "paymentListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>