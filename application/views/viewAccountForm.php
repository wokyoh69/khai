
<!--<section class="invoice">-->
      
      <form role="form" action="<?php echo base_url() ?>addInvoice" method="post" id="addInvoice" enctype="multipart/form-data">
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-12 invoice-col">
          <!--<p class="lead"><b>MAKLUMAT TANGGUNGAN</b></p>-->
           <table class="table table-striped">
            <tr>
              <td><b>Tarikh Invois</b></td><td>:</td>
              <td><input class="form-control" id="accDtm" name="accDtm" placeholder="YYYY/MM/DD" type="date" value="<?php echo date("Y-m-d"); ?>"/>
              </td>
            </tr>
            <tr>
              <td width="150">
              <?php

              $inv_title = "INVOICE_AC-";
              $inv_year = date('Y');
              $inv_num = "-XXX";
              $inv = $inv_title.$inv_year.$inv_num;

              ?>
              <b>Nombor Invois</b></td><td>:</td><td><input type="text" class="form-control" id="acc_invoice" placeholder="cth : Invoice_AC-2023-001" name="acc_invoice" value="<?php echo $inv?>" maxlength="128" required>
              </td>
            </tr>
            <tr>
              <td><b>Tajuk Invois</b></td><td>:</td>
              <td><input type="text" class="form-control" id="acc_title" name="acc_title" value="" placeholder="Cth : Pakej Ta'dil - One off payment" required></td>
            </tr>
          
            <tr><td><b>Jumlah</b></td><td>:</td>
              <td>
                <input type="number" class="form-control" id="acc_amaun" placeholder="0.00" name="acc_amaun" value="" >
              </td>
            </tr>
          
            <tr>
              <td><b>Status</b></td><td>:</td>
              <td> 
                <input type="radio" id="status" name="status" value="Selesai"> <label for="status">SELESAI</label>&nbsp;
                <input type="radio" id="status" name="status" value="Belum Selesai"> <label for="status">BELUM SELESAI</label>
              </td>
            </tr>

            <tr> 
              <td><b>Status</b></td><td>:</td>
              <td> 
                  <label for="attachment">Jenis Dokumen <font color="red"> <small>(JPG, PNG, GIF, PDF)</small></font><?php //echo form_error('userfile') ?></label>
                  <input type="file" name="userfile" size="20" class="form-control"  required />
              </td>
            </tr>

            <tr><td><b>e-KHAIRAT PASSCODE</b></td><td>:</td>
              <td>
                <input type="number" class="form-control" id="passcode" placeholder="untuk kegunaan Amri Creative sahaja" name="passcode" value="" required >
              </td>
            </tr>

          </table>
        </div>

        </div> 
      </div>
   
      <input type="submit" class="btn btn-primary" value="SUBMIT" />
 
       </form>

      <br>
      <!-- /.row -->

      
<!--</section>-->

<script>
  $(document).ready(function(){
    var accDtm=$('input[name="accDtm"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    accDtm.datepicker({
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    })

   
  })
</script>
