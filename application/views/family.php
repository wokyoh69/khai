<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Senarai Tanggungan
        <small>&nbsp;</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Senarai Tanggungan</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
           &nbsp;<span class="btn btn-xs btn-danger"><i class="fa fa-user"></i></span>&nbsp; Perlu Disahkan
         </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">&nbsp;</h3> 
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>familyListing" method="POST" id="searchList">
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
                      <th>Tarikh Daftar</th>
                      <th>Nama Tanggungan</th>
                      <th>Nama Ahli</th>
                      <th>Pertalian</th>
                      <th class="text-center">Kemaskini</th>
                    </tr>
                    <?php
                    if(!empty($familyRecords))
                    {
                        foreach($familyRecords as $records)
                        {
                    ?>
                    <tr>
                      <td><?php echo $records->createDtm ?></td>
                      <td>
                        
                        <?php if ($records->approval != 'Y') {?>
                        <span class="btn btn-xs btn-danger"><i class="fa fa-user"></i></span>
                      <?php } ?>
                        <?php echo strtoupper($records->f_name) ?>
                        </td>
                      <td><a href="<?php echo base_url().'editUsers/'.$records->userId; ?>" title="Edit"><?php echo strtoupper($records->name) ?></a>
                      </td>
                      <td><?php echo $records->f_pertalian ?> </td>
                      <td class="text-center">
                        
                        <a class="btn btn-sm btn-info" href="" id="familyId" data-id="<?php echo $records->f_id; ?>" title="Lihat" data-toggle="modal" data-target="#familyModal"><i class="fa fa-search"></i></a>
                     <!--
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'editUsers/'.$records->userId; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                          <a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $records->userId; ?>" title="Delete"><i class="fa fa-trash"></i></a>-->
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

    <!-- MODAL WINDOW START -->
        <div class="modal fade" id="familyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              
              <!--<div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Tutup</button>
              </div>-->
            </div>
          </div>
        </div>
        <!-- MODAL WINDOW -->
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "familyListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>


<!-- MODAL JSCRIPT -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>
    <script>
      $(document).ready(function(){
        
        $(document).on('click', '#familyId', function(e){
          
          e.preventDefault();
          
          var uid = $(this).data('id');   // it will get id of clicked row
          
          $('#dynamic-content').html(''); // leave it blank before ajax call
          $('#modal-loader').show();      // load ajax loader
          
          $.ajax({
            url: '<?php echo base_url() ?>familyDetail',
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
