<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> <?php echo $pageTitle ?>
        <small>&nbsp;</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active"> <?php echo $pageTitle ?></li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
         <div class="col-xs-12" align="right">
            <a class="btn btn-primary" href="<?php echo base_url(); ?>addNew"><i class="fa fa-plus"></i> Daftar Ahli</a>&nbsp;
            <a class="btn btn-success" href="<?php echo base_url(); ?>userListing">Senarai Ahli Aktif</a>
          </div>
        </div>
        &nbsp;
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">&nbsp;</h3> 
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>inActive" method="POST" id="searchList">
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
                      <th>Status</th>
                      <th class="text-center">Kemaskini</th>
                    </tr>
                    <?php
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr>
                      <!--<td><?php echo $record->userId;?><?php echo sprintf('%04d',$record->userId);?></td>-->
                      <td><?php echo $record->noAhli ?></td>
                      <td width="300"><?php echo strtoupper($record->name); ?> </td>
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
                      <td width="200"><?php echo $record->SurauName;  ?></td>
                       <td>
                        <?php 
                          if($record->phone){ ?>
                            <a href="http://www.wasap.my/+6<?php echo $record->phone; ?>/eKhairat:"><?php echo $record->phone; ?></a>
                          <?php } else {
                            echo "-";
                          }
                        ?>
                      </td>
                      <td><?php echo $record->status ?></td>
                      <!--<td><?php echo $record->role ?></td>-->
                      <td class="text-center">
                          <!--<a class="btn btn-sm btn-primary" href="<?= base_url().'login-history/'.$record->userId; ?>" title="Login history"><i class="fa fa-history"></i></a> | -->
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'editUsers/'.$record->userId; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                          <!--<a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->userId; ?>" title="Delete"><i class="fa fa-trash"></i></a>-->
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
            jQuery("#searchList").attr("action", baseURL + "inActive/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
