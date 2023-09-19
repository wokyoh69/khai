<?php
if(!empty($user_data)){ 
	foreach ($user_data as $userr)
  { 
	 $display_id =  $userr->userId;
	 $display_nama =  $userr->name;
	 $display_email =  $userr->email;
	 $display_phone =  $userr->phone;
 	} 
}
?>

<form role="form" id="paySms" action="<?php echo base_url(); ?>paymentSms" method="post">
<div class="row">
  <div class="col-md-12">
     <table class="table table-striped">
          <tr>
            <td><b>EMEL</b></td><td>:</td>
            <td><input type="email" class="form-control" id="email" placeholder="cth: ahli@mail.com" name="email" value="<?php echo $display_email; ?>" maxlength="128" required>
            </td>
            
          </tr>
          <tr>
            <td><b>TELEFON</b></td><td>:</td>
            <td>
              <input type="phone" class="form-control" id="phone" placeholder="cth: 0134567890" name="phone" value="<?php echo $display_phone; ?>" maxlength="11" pattern="[0-9]{10,11}" required>
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <h5>
                <b>PILIH KREDIT SMS</b>
                <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" name="smscredit" id="smscredit" value="250" checked>
                      RM50.00 = 250 Kredit SMS
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="smscredit" id="smscredit" value="500">
                      RM100.00 = 500 Kredit SMS
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="smscredit" id="smscredit" value="1000">
                      RM200.00 = 1000 Kredit SMS
                    </label>
                  </div>
                </div>
                <div class="row"><div class="col-md-12"><small>Nota: RM0.20 = 1 Kredit SMS</small></div></div>
              </h4>
            </td>
          </tr>
          <tr>
            <td colspan="4" align="center">
              <img src="<?php echo base_url(); ?>assets/images/toyyibpay_button.png" alt="" class="img-fluid" width="50%"><br>&nbsp;<br>
              <input type="hidden" name="userid" value="<?php echo $display_id; ?>" /> 
              <button type="submit" name="submit" class="btn btn-sm btn-danger" value="Submit">Bayar Sekarang</button>       
            </td>
          </tr>
      </table>
  </div>
</div>
</form>