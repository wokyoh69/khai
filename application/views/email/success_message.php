<?php 
if(!empty($generalinfo)){ 
  foreach ($generalinfo as $info)
  { 
    $pageTitle = $info->g_home_title;
    $g_home_desc = $info->g_home_desc;
    $g_email = $info->g_email;
    $g_phone = $info->g_phone;
    $g_weburl = $info->g_weburl;
    $g_bankname = $info->g_bankname;
    $g_bankaccount = $info->g_bankaccount;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Maklumat Keahlian <?php echo $pageTitle;?> </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
<div>
<p>
	Assalamualaikum <b><?php echo $userName;?></b>,<br>

	TAHNIAH ! <br>
	Permohonan anda telah <b>diluluskan</b>. Sila log masuk ke dalam sistem untuk melihat status bayaran & kemaskini maklumat tanggungan<br>
	<a href="<?php echo $g_weburl;?>"><?php echo $g_weburl;?></a>
</p>

	<table>
		<tr><td>Username</td><td>:</td><td><?php echo $icno;?></td><tr>
		<tr><td>Password</td><td>:</td><td><?php echo $phone;?></td><tr>
		<tr><td>Pakej Khairat</td><td>:</td><td><?php echo $pakej;?></td><tr>
	</table>

<p> 

	Sebarang pertanyaan lanjut sila hubungi <?php echo $g_email;?>  atau 
  <a href="http://www.wasap.my/+6<?php echo $g_phone; ?>/">Whatsapp</a>
  <br>
	Terima Kasih.
	<br>&nbsp;<br>

	PENTADBIR<br>
	<?php echo $g_home_desc;?>

</p>
</div>
</body>
</html>