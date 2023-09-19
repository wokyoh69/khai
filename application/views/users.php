<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Senarai Ahli
        <small>&nbsp;</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Senarai Ahli</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
         <div class="col-xs-12" align="right">
            <a class="btn btn-primary" href="<?php echo base_url(); ?>addNew"><i class="fa fa-plus"></i> Daftar Ahli</a>&nbsp;
            <a class="btn btn-danger" href="<?php echo base_url(); ?>inActive">Senarai Ahli Tidak Aktif</a>
          </div>
        </div>
        &nbsp;

        <form action="<?php echo base_url() ?>userListing" method="POST" id="searchList">
        <div class="row">
          <div class="col-md-12"> 
                <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">CARIAN AHLI</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-success" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button> 
                    </div>
                </div>
                <div class="box-body"> 

                    <div class="row"> 
                        <div class="col-md-4">
                          <div class="form-group">
                              <div class="radio">
                              <?php if ($ahlikhairat == "N") { ?>
                                <label>
                                  <input type="radio" name="ahli_khairat" id="ahli_khairat" value="N" checked>
                                  AHLI QARYAH
                                </label>&nbsp;&nbsp;&nbsp;
                                <label>
                                  <input type="radio" name="ahli_khairat" id="ahli_khairat" value="Y">
                                  PESERTA KHAIRAT  
                                </label>
                              <?php } else { ?>
                                <label>
                                  <input type="radio" name="ahli_khairat" id="ahli_khairat" value="N">
                                  AHLI QARYAH
                                </label>&nbsp;&nbsp;&nbsp;
                                <label>
                                  <input type="radio" name="ahli_khairat" id="ahli_khairat" value="Y" checked>
                                  PESERTA KHAIRAT  
                                </label>

                              <?php } ?>
                              </div>
                            </div> 
                        </div>
                        <div class="col-md-4"> 
                          <div class="form-group">
                              <select class="form-control" id="surau" name="surau">
                                  <option value="0">SEMUA ZON</option>
                                  <?php
                                  if(!empty($surau))
                                  {
                                      foreach ($surau as $sr)
                                      {
                                          ?>
                                          <option value="<?php echo $sr->id ?>" <?php if($sr->id == $surau_id) {echo "selected=selected";} ?>><?php echo $sr->name ?></option>
                                          <?php
                                      }
                                  }
                                  ?>
                              </select>
                          </div>
                        </div>
                        <div class="col-md-4"> 
                          <div class="form-group">
                            <!--<input type="text" class="form-control input-sm pull-right" name="searchText" value="<?php echo $searchText; ?>"  style="width: 150px;" placeholder="Carian"/>-->
                            <input type="text" class="form-control" id="searchText" name="searchText" value="<?php echo $searchText; ?>" placeholder="MASUKKAN MAKLUMAT CARIAN">
                          </div>
                        </div>
                    </div>

                </div>
                 <div class="box-footer">  
                 <button class="btn btn-sm btn-success searchList"><i class="fa fa-search"></i></button> 
                </div>
                </div>       
          </div> <!-- end right column-->
        </div>
        </form>


        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">&nbsp;</h3> 
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>userListing" method="POST" id="searchList">
                            <div class="input-group"> 
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Carian"/>
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
                      <!--<th>ID</th>-->
                      <th>No Ahli</th>
                      <th>Nama</th>
                      <th>No IC</th>
                      <th>Alamat</th>
                      <th>Lokasi/Taman</th>
                      <th>Telefon</th>
                       <!--<th>Pakej</th>-->
                      <th>Status</th>
                      <th class="text-center">Kemaskini</th>
                      <th>Tunggakan</th>
                    </tr>
                    <?php
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr>
                      <!--<td><?php echo $record->userId;?><?php echo sprintf('%04d',$record->userId);?></td>-->
                      <td width="100"><?php echo $record->noAhli ?></td>
                      <td width="250"><?php echo strtoupper($record->name); ?> &nbsp;
                        <?php 
                          foreach($newFamily as $nf)
                          {
                            if($nf->userid == $record->userId)
                            { ?>
                              <span class="btn btn-xs btn-danger"><i class="fa fa-user"></i></span>
                         <?php
                            }
                          }
                          ?>
                      </td>
                      <td>
                        <?php 
                          if($record->icno){
                            echo $record->icno;
                          } else {
                            echo "-";
                          }
                        ?>
                      </td>
                     <td><?php echo $record->address ?><?php //echo $record->SurauName ?></td>
                     <td ><?php echo $record->SurauName;  ?></td>
                      <td>
                        <?php 
                          if($record->phone){ ?>
                            <a href="http://www.wasap.my/+6<?php echo $record->phone; ?>/eKhairat:"><?php echo $record->phone; ?></a>
                          <?php } else {
                            echo "-";
                          }
                        ?>
                      </td>
                     <!-- <td><?php echo $record->pakej ?></td>-->
                      <td><?php echo $record->status ?></td>
                      <td class="text-center">
                          <!--<a class="btn btn-sm btn-primary" href="<?= base_url().'login-history/'.$record->userId; ?>" title="Login history"><i class="fa fa-history"></i></a> | -->
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'editUsers/'.$record->userId; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                          <!--<a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->userId; ?>" title="Delete"><i class="fa fa-trash"></i></a>-->
                      </td>
                      <td class="text-center">
                          <?php 
                          $unpaid = 0;
                          foreach($unpaidPaymentlist as $upl)
                          {
                            if($upl->userid == $record->userId)
                            { 
                              $unpaid++;
                            }
                          }
                          if($unpaid >= 1) {
                            //echo $unpaid; ?>
                            <a class="btn btn-sm btn-warning" href="<?= base_url().'payment/warning/'.$record->userId; ?>">
                            <i class="fa  fa-exclamation-circle"></i>
                              <!--<img src="<?php echo base_url(); ?>assets/images/whatsapp.png" alt="" class="img-fluid">--></a>
                        <?php
                          }
                        ?>
                      </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?> 
                    <a href="#" class="btn btn-primary">Jumlah Rekod : <?php echo $rows ?></a>
                    <br>&nbsp;<br>
                    <span class="btn btn-xs btn-danger"><i class="fa fa-user"></i></span>&nbsp; Perlu Pengesahan

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
            jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
