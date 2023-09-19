<?php


	
	foreach ($family_data as $fy)
  { 
	 $display_id =  $fy->f_id;
	 $display_nama =  $fy->f_name;
	 $display_icno = $fy->f_icno;
   $display_phone =  $fy->f_phone;
   //$display_jantina =  $fy->f_jantina;
   //$display_pasangan =  $fy->f_pasangan;
	 $display_pertalian =  $fy->f_pertalian;
   $deathStatus =  $fy->deathStatus;
   $deathDtm =  $fy->deathDtm;
   $userId = $fy->userid; 
 	} 
	
?>

<!--<section class="invoice">-->
      <form role="form" action="<?php echo base_url() ?>updateFamilyMembers" method="post" id="updateFamilyMembers" role="form">
       <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-12 invoice-col">
          <p class="lead"><b>MAKLUMAT TANGGUNGAN AHLI</b></p>
           <table class="table table-striped">
            <tr><td width="150"><b>Nama</b></td><td>:</td><td><?php echo strtoupper($display_nama); ?></td></tr>
            <tr><td><b>Kad Pengenalan</b></td><td>:</td>
                <td><input type="text" class="form-control" id="fy_icno" placeholder="cth: 888888105678" name="fy_icno" value="<?php echo $display_icno; ?>" maxlength="12"></td>
            </tr>
            <!--<tr><td><b>Jantina</b></td><td>:</td><td><?php echo $display_jantina; ?></td></tr>-->
            <tr>
              <td><b>Pasangan</b></td>
              <td>:</td>
              <td><?php echo $display_pertalian; ?></td>
            </tr>
            <!--<tr><td><b>Pertalian Keluarga</b></td><td>:</td>
                 <td><select class="form-control" id="fy_pertalian" name="fy_pertalian" disabled>
                      <option value="">Sila Pilih</option>
                      <?php
                      if(!empty($pertalian))
                      {
                          foreach ($pertalian as $pl)
                          {
                              ?>
                              <option value="<?php echo $pl->yf_name; ?>" <?php if($pl->yf_name == $display_pertalian) {echo "selected=selected";} ?>>
                              <?php echo $pl->yf_name;?>
                              </option>
                              <?php
                          }
                      }
                      ?>
                  </select>
                </td>
            </tr>-->
            <tr><td><b>Telefon</b></td><td>:</td>
              <td>
                <input type="text" class="form-control" id="phone" placeholder="cth: 0134567890" name="phone" value="<?php echo $display_phone; ?>" maxlength="11">
              </td>
            </tr>
            <tr>
              <td><b>Status Kematian</b></td>
              <td>:</td>
              <td><?php echo $deathStatus; ?></td>
            </tr>
            <tr>
              <td><b>Tarikh Kematian</b></td><td>:</td>
              <td><?php echo $deathDtm; ?>
              </td>
            </tr>
          </table>
        </div>

        </div> 
      </div>
     <!-- <?php if($userId != 0){ echo "disabled"; }?>-->

     <input type="hidden" value="<?php echo $display_id; ?>" name="familyId" id="familyId" />
     <input type="hidden" value="<?php echo $display_pertalian; ?>" name="fy_pertalian" id="fy_pertalian" />  
      <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />
   
      <input type="submit" class="btn btn-primary" value="Kemaskini" />
 
       </form>
     

      <br>
      <!-- /.row -->

       <!--<p><b>Adakah permohonan ini diluluskan ?</b></p>
          <a href="<?= base_url().'user/applicantApprove/'.$display_id; ?>" class="btn btn-primary" onclick="javasciprt: return confirm('Lulus ?')">Lulus</a>
          <a href="<?= base_url().'user/applicantReject/'.$display_id; ?>" class="btn btn-danger" onclick="javasciprt: return confirm('Tolak ?')">Tidak</a>
          <a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->userId; ?>" title="Delete"><i class="fa fa-trash"></i></a>-->

      <!-- this row will not appear when printing -->
<!--</section>-->

<script>
  $(document).ready(function(){
    var deathDtm=$('input[name="deathDtm"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    deathDtm.datepicker({
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    })

   
  })
</script>
