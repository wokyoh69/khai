<?php //include ($_SERVER['DOCUMENT_ROOT']."/buuv2/application/views/functions.php"); ?>
<?php //require APPPATH ."/views/functions.php"; ?>
<?php

if(!empty($applicant_family)){ 
    $num = 1;
    $jumlah = 0;
    $jumlah_ahli = 0;
    $total = 0;
    $ahli = "AHLI"; ?>
    <table class="table table-bordered table-striped table-hover" style="margin-bottom: 10px">
      <tr>
        <th>Bil.</th>
        <th>Nama</th>
        <th>Pertalian</th>
        <th>No. KP </th>
        <th>Umur</th>
        <th>Yuran *</th>
        <th>Jumlah **</th>
      </tr>
    <?php                         
        foreach ($applicant_family as $fy)
            {
            ?>
            <tr>
              <td><?php echo $num++; ?>.</td>
              <td width="30%"><?php echo strtoupper($fy->f_name); ?></td>
              <td><?php echo strtoupper($fy->f_pertalian); ?></td>
              <td><?php echo str_replace(' ', '', $fy->f_icno); ?></td>
              <td><?php echo $umur = umur($fy->f_icno);?></td>
              <td align="right"><?php echo $yuran = yuran($fy->f_pertalian, $umur); ?></td>
              <td align="right"><?php echo $jumlah_ahli = total_yuran_in_year(date('m'),$yuran); ?></td>
            </tr>
            <?php
            $total = $total + $jumlah_ahli;
            } 
    ?> 
<?php
    /*foreach ($aapf as $userr)
        { 
            $name =  $userr->f_name;
            $name =  $userr->f_name;
            $name =  $userr->f_name;
            $name =  $userr->f_name;
            $name =  $userr->f_name;
            $name =  $userr->f_name;


        }
*/
} else {
  echo "No Family Records";
}
?>
