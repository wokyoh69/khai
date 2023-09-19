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


$message = "*".$g_home_desc."* : Jumlah tunggakan yuran  *".$u_name."* ialah *RM".$jumlah."*. Dinasihatkan untuk menjelaskan yuran secara tunai atau atas talian melalui akaun ".$g_bankname." (".$g_bankaccount.") dan maklumkan kepada AJK sekiranya bayaran telah dibuat. Terima kasih.";

?>

<!--<a class="btn btn-success" href="http://www.wasap.my/+6<?php echo $u_phone; ?>/*<?php echo $g_home_title ?>*: Jumlah tunggakan yuran khairat <?php echo $u_name; ?> ialah *RM<?= number_format($total_amaun, 2); ?>*. Terima Kasih" target="_blank">Whatsapp</a>-->

<form role="form" action="<?php echo base_url() ?>whatsappSend" method="post" id="reminder" role="form">
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
                        <input class="form-control"  type="text" name="phone" id="phone" value="<?php echo $u_phone; ?>">
                    </div>                                
                    <div class="form-group">
                    	<label>Mesej:</label>
                        <textarea class="form-control" rows="5" name="message" id="message" ><? echo $message ?></textarea> 
                    </div>    
                    <div class="form-group">
                    	<!--<button type="submit" name="submit" class="btn btn-sm btn-success" value="Send">Send</button>-->
                    	<a class="btn btn-success" href="" onclick="submitMe('phone','message');" target="_blank"><i class="fa fa-envelope"></i> SEND</a>

                    	<!--<a class="btn btn-info" href="<?php echo base_url().'editUsers/'.$userid; ?>" title="Edit"><i class="fa fa-user"></i> Maklumat Ahli</a>
                    	<button onclick="submitMe('test')" id="testButton" >Submit Response</button>-->
                   	</div>
                </div>
            </div>
        	<div class="row">
        		<div class="col-md-12">
        			<small><b>Nota : Sila ubahsuai mesej peringatan jika perlu</b></small>
        		</div>
        	</div>
        </div>

	</div>

</form>

<script type="text/javascript">

function submitMe(phone,message) {
    var ph = document.getElementById(phone).value;
    var ms = document.getElementById(message).value;

    var urlwithvalue = 'http://www.wasap.my/+6'+ph+'/'+ms;


    //alert(value);
    window.open(urlwithvalue);
}

</script>