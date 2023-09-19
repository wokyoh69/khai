<?php

$userId = '';
$name = '';
$email = '';
$phone = '';
$icno = '';
$regdate = '';
$status = '';
$catatan = '';
$roleId = '';
$address = '';
$surau = '';
$pakej = '';
$noAhli = '';
$ahli_khairat = '';

if(!empty($userInfo))
{
    foreach ($userInfo as $uf)
    {
        $userId = $uf->userId;
        $name = $uf->name;
        $email = $uf->email;
        $phone = $uf->phone;
        $icno = $uf->icno;
        $regdate = $uf->regdate;
        $status = $uf->status;
        $catatan = $uf->catatan;
        $roleId = $uf->roleId;
        $address = $uf->address;
        $surau = $uf->surau;
        $pakej = $uf->pakej;
        $noAhli = $uf->noAhli;
        $ahli_khairat = $uf->ahli_khairat;
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        &nbsp;
      </h1>
       <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <!--<li><a href="<?php echo base_url(); ?>userListing">Senarai Ahli</a></li>-->
        <li class="Aktif">Kemaskini Ahli</li>
      </ol>
    </section>

    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-user"></i> <?php echo $g_home_desc ?>
            <small class="pull-right"><?php //echo date("d-m-Y", strtotime($regdate)); ?>
            
            <span class="badge bg-green"><?php echo date("d-m-Y"); ?></span></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            <strong><?php echo $name ?></strong><br>
            <?php echo $g_address ?><br>
            <?php echo $g_phone ?><br>
            <?php echo $g_email ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          &nbsp;
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>PAKEJ : </b><?php echo $g_package ?> <br>
          <b>ID. AKAUN :</b> <?php echo $g_ekhairat_id ?> <br>
          <!--<b>Bayaran Berikutnya:</b> 2/22/2014<br>-->
          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Tarikh Mula</th>
              <th>Tarikh Tamat</th>
              <th>Invois</th>
              
              <th>Perkara</th>
              <th align="right">Jumlah</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $num = 1;
            if(!empty($invoiceInfo))
                {
                foreach ($invoiceInfo as $inv)
                    {     
                    ?>
                    <tr>
                      <td><?php echo date("d-m-Y", strtotime($inv->acc_date)); ?></td>
                      <td><?php echo date("d-m-Y", strtotime($inv->acc_expired)); ?></td>
                      <td>
                        <?php 
                        if (!empty($inv->acc_title)) {?>
                            <a href="<?= site_url().'documents/'.$inv->acc_invoice.'.pdf'; ?>" target="_blank"><span class="badge bg-blue"><i class="fa fa-paperclip"></i></span></a>
                        <?php }?>
                        <?php echo $inv->acc_invoice; ?>
                      </td>
                      <td><?php echo $inv->acc_title; ?></td>
                      <td ><?= number_format($inv->acc_amaun, 2); ?></td>
                      <td>
                        <?php 
                        if ($inv->status == "Selesai") { ?>
                           <span class="badge bg-green">Selesai</span>
                        <?php } else { ?>
                            <span class="badge bg-red">Belum Selesai</span>
                        <?php }  ?>
                      </td>
                    </tr>
            <?php }
              } ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          Disediakan Oleh : <br>
          <label class="text-primary">AMRI CREATIVE SOLUTIONS</label><br>
          CIMB Account : 8602080634 (AMRI CREATIVE)<br>
          Email : amzari@amricreative.net <br>
          Phone : 0139080721 <br>
          <p>&nbsp;</p>
          <a class="btn btn-sm btn-primary" href="" id="accountId" data-id="<?php echo $userId; ?>" title="Lihat" data-toggle="modal" data-target="#accountModal"><i class="fa fa-plus"></i> ADD INVOICE</a>
          
          <!--
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>-->
        </div>
      </div>
    </section>
    <!-- /.content -->

</div>

<!-- MODAL WINDOW START -->
<div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title" id="searchModalLabel">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
           </button>
           <div class="section-title mb-10">                                
            &nbsp; <b>UPLOAD INVOICE</b>
          </div>
        </div>
        
      </div>
      <div class="modal-body">
          <div id="modal-loader" style="display: none; text-align: center;"></div>         
          <div id="dynamic-content"></div>
          <div id="dynamic-name"></div>
      </div>
      
      <div class="modal-footer">
            <button class="btn btn-info" data-dismiss="modal">CLOSE</button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL WINDOW -->

<!-- MODAL JSCRIPT -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>
    <script>
      $(document).ready(function(){
        
        $(document).on('click', '#accountId', function(e){
          
          e.preventDefault();
          
          var uid = $(this).data('id');   // it will get id of clicked row
          
          $('#dynamic-content').html(''); // leave it blank before ajax call
          $('#modal-loader').show();      // load ajax loader
          
          $.ajax({
            url: '<?php echo base_url() ?>accountInvoice',
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