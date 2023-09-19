<?php 
foreach ($userlist as $user): 
	if ($user->userId == $userid){
	  $u_name = $user->name;
	  $u_id = $user->userId;
	  $u_noAhli = $user->noAhli;
	  $u_address = $user->address;
	  $u_phone = $user->phone;
	  $u_icno = $user->icno;
	}
endforeach;

$total_amaun = 0;
foreach ($paymentrecord as $pr):
    $total_amaun = $total_amaun + $pr->total_amaun;
    $jumlah = number_format($total_amaun, 2);
endforeach;


$message = "*".$g_home_desc."* :SMS Jumlah tunggakan yuran  *".$u_name."* ialah *RM".$jumlah."*. Dinasihatkan untuk menjelaskan yuran secara tunai atau atas talian melalui akaun ".$g_bankname." (".$g_bankaccount.") dan maklumkan kepada AJK sekiranya bayaran telah dibuat. Terima kasih.";

$sms = strtoupper($g_home_title)." : Sila jelaskan tunggakan yuran anda berjumlah RM".$jumlah.". Hubungi pentadbir ".$g_phone." untuk info lanjut.";
$sms = str_replace("@","-",$sms);

$smslimit = 153; //reserved 4 character form 'RM0_' will automatically added by telco.

?>

<!--<a class="btn btn-success" href="http://www.wasap.my/+6<?php echo $u_phone; ?>/*<?php echo $g_home_title ?>*: Jumlah tunggakan yuran khairat <?php echo $u_name; ?> ialah *RM<?= number_format($total_amaun, 2); ?>*. Terima Kasih" target="_blank">Whatsapp</a>-->

<!--<form role="form" action="<?php echo base_url() ?>smsSend" method="post" id="reminder" role="form">-->
<form role="form" action="<?php echo base_url() ?>smsSend_bulk360" method="post" id="reminder" role="form">
	<div class="box box-success">
	    <!--<div class="box-header with-border">
	        <h3 class="box-title">Daripada : <?php echo $g_home_title ?></h3>
	    </div>-->

	    <div class="box-body"> 
            <div class="row"><!-- row 2-->
                <!-- left column -->
                <div class="col-md-12"> 
                	<div class="form-group">
                		<label>Nombor Telefon Penerima:</label>
                        <input class="form-control"  type="text" name="phone" id="phone" value="<?php echo $u_phone; ?>" pattern="[0-9]{10,11}" maxlength="11" placeholder="No. Telefon (cth:0129000123)" required>
                    </div>                                
                    <div class="form-group">
                    	<label>Mesej:</label>
                        <textarea class="form-control" onKeyUp="count_it()" maxlength="149" rows="5" name="message" id="message" autofocus required><? echo $sms ?></textarea><br>
                        <label>Jumlah Aksara:</label> 
                        <span id="counter"></span>
                        <!--<span id="current">0</span>-->
                        <span id="maximum">/149</span><br>
                        <label>Baki Kredit SMS:</label>&nbsp;<?php echo $credit_balance; ?> 

                    </div>    
                    <div class="form-group">
                    <?php if($credit_balance > 0) { ?> 
                        <input type="hidden" name="userid" id="userid" value="<?= $u_id?>">
                    	<button type="submit" name="submit" class="btn btn-success" value="Send">Send</button>
                    <?php } else { ?> 
                        <div align="center" class="alert alert-warning alert-dismissable">
                            <?php echo $credit_balance_reminder; ?>      
                        </div>
                        <center>
                        <a class="btn btn-danger" href="<?php echo base_url().'sms'; ?>"><i class="fa fa-user"></i> Tambah SMS eWallet </a>
                        </center>
                    <?php } ?> 
                    	<!--<a class="btn btn-success" href="" onclick="submitMe('phone','message');" target="_blank"><i class="fa fa-envelope"></i> SEND</a>-->

                    	<!--<a class="btn btn-info" href="<?php echo base_url().'editUsers/'.$userid; ?>" title="Edit"><i class="fa fa-user"></i> Maklumat Ahli</a>
                    	<button onclick="submitMe('test')" id="testButton" >Submit Response</button>-->
                   	</div>
                </div>
            </div>
        	<div class="row">
        		<div class="col-md-12">
        			<small>
                        <ul><strong>Nota : </strong>
                            <li>Sila <b>ubahsuai</b> mesej peringatan jika perlu</li>
                            <li>Teks bagi SMS terhad kepada <b>149 aksara</b> sahaja</li>
                            <li>Telco tidak membenarkan sebarang URL/Link bermula <b>1 Mei 2023</b>.</li>
                            <li>Kos bagi setiap SMS ialah <b>RM0.20 (1 kredit)</b></li>
                        </ul>
                        
                    </small>
        		</div>
        	</div>
        </div>

	</div>

</form>

<!-- send whatsapp thru ul -->
<script type="text/javascript">
function submitMe(phone,message) {
    var ph = document.getElementById(phone).value;
    var ms = document.getElementById(message).value;

    var urlwithvalue = 'http://www.wasap.my/+6'+ph+'/'+ms;


    //alert(value);
    window.open(urlwithvalue);
}
</script>


<!-- character count in textarea -->
<script type="text/javascript">
$('textarea').keyup(function() {
  
  var characterCount = $(this).val().length,
      current = $('#current'),
      maximum = $('#maximum'),
      theCount = $('#the-count');
    
  current.text(characterCount);
 
  
  /*This isn't entirely necessary, just playin around*/
  if (characterCount < 70) {
    current.css('color', '#666');
  }
  if (characterCount > 70 && characterCount < 90) {
    current.css('color', '#6d5555');
  }
  if (characterCount > 90 && characterCount < 100) {
    current.css('color', '#793535');
  }
  if (characterCount > 100 && characterCount < 120) {
    current.css('color', '#841c1c');
  }
  if (characterCount > 120 && characterCount < 139) {
    current.css('color', '#8f0001');
  }
  
  if (characterCount >= 140) {
    maximum.css('color', '#8f0001');
    current.css('color', '#8f0001');
    theCount.css('font-weight','bold');
  } else {
    maximum.css('color','#666');
    theCount.css('font-weight','normal');
  }
  
      
});
</script>

<script>
function count_it() {
    document.getElementById('counter').innerHTML = document.getElementById('message').value.length;
}
count_it();
</script>

