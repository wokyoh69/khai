<?php 
if(!empty($generalinfo)){ 
  foreach ($generalinfo as $info)
  { 
    $pageTitle = $info->g_home_title;
    $g_home_desc = $info->g_home_desc;
    $g_email = $info->g_email;
    $g_phone = $info->g_phone;
    $g_bankname = $info->g_bankname;
    $g_bankaccount = $info->g_bankaccount;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Reset Katalaluan <?php echo $pageTitle;?> </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
<div>
<p>
	Assalamualaikum <b><?php echo $userName;?></b>,<br>
	Kataluan baru anda ialah
</p>

	<table>
		<!--<tr><td>Yuran Pendaftaran</td><td>:</td><td>RM 60.00  <br> (Yuran Pendaftaran = RM30, Yuran Tahunan = RM30.00)</td><tr>
		<tr><td widht="100" valign="top">Pendaftaran</td><td>:</td><td>RM 30.00</td></tr>
		<tr><td widht="100" valign="top">Yuran Tahunan</td><td>:</td><td>RM 30.00</td></tr>
		<tr><td widht="100" valign="top"><b>Jumlah </b></td><td>:</td><td><b>RM 60.00</b></td></tr>-->
		<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
		<tr><td widht="100" valign="top">Password</td><td>:</td><td><?php echo $phone;?></td><tr>
		<!--<tr><td widht="100" valign="top">No Akaun</td><td>:</td><td><?php echo $g_bankaccount;?></td><tr>
		<tr><td widht="100" valign="top">Bank</td><td>:</td><td><?php echo $g_bankname;?></td><tr>-->
	</table>


<p> 
    <!--
	Untuk pertanyaan lanjut sila emel <b><?php echo $g_email;?></b> atau <a href="http://www.wasap.my/+6<?php echo $g_phone; ?>/">Whatsapp</a>-->

	<br>
	Terima Kasih.
	<P>&nbsp;</P>

	Pentadbir<br>
	<?php echo $g_home_desc; ?>
</p>
</div>
</body>
</html>