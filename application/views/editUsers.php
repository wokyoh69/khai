<?php
//include ("functions.php");

$userId = '';
$noAhli = '';
$name = '';
$email = '';
$phone = '';
$icno = '';
$regdate = '';
$status = '';
$catatan = '';
$roleId = '';
$address = '';
$age ='';
$surau = '';
$pakej = '';
$ahli_khairat = '';

$yuran = 0;

if(!empty($userInfo))
{
    foreach ($userInfo as $uf)
    {
        $userId = $uf->userId;
        $noAhli = $uf->noAhli;
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
        $ahli_khairat = $uf->ahli_khairat;
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Kemaskini Ahli
        <small>&nbsp;</small>
      </h1>
       <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>userListing">Senarai Ahli</a></li>
        <li class="Aktif">Kemaskini Ahli</li>
      </ol>
    </section>
    
    <section class="content">
        
        <div class="row"><!-- row 1-->
            <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>

                <?php  
                    $warning = $this->session->flashdata('warning');
                    if($warning)
                    {
                ?>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('warning'); ?>
                </div>
                <?php } ?>

                <?php
                   /*() if(!empty($message)){
                        echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".$message."</div>";
                    }
                    if(!empty($message_error)){
                        echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".$message_error."</div>";
                    }
                     if(!empty($message_warning)){
                        echo "<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".$message_warning."</div>";
                    }*/
                    
                ?>

            </div>
        </div>

        <div class="row"><!-- Maklumat Ahli-->
            <div class="col-md-12">
                <form role="form" action="<?php echo base_url() ?>editUser" method="post" id="editUser" role="form">
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Maklumat Peribadi  <!--<strong>[No. Ahli : <?php echo sprintf('%04d',$userId);?>]</strong>--></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-default" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button> 
                    </div>
                </div>
                <div class="box-body"> 
                    <div class="row"><!-- row 2-->
                        <!-- left column -->
                        <div class="col-md-4">                                
                            <div class="form-group">
                                <label for="fname">Nama Penuh</label>
                                <input type="text" class="form-control" id="fname" placeholder="Full Name" name="fname" value="<?php echo strtoupper($name); ?>" maxlength="128">
                                <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />    
                            </div>    
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="icno">No Kad Pengenalan</label>
                                <input type="text" class="form-control" id="icno" placeholder="cth: 888888105678" name="icno" value="<?php echo $icno; ?>" maxlength="12">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email">Emel</label>
                                <!--<input type="email" class="form-control" id="email" placeholder="cth: ahli@mail.com" name="email" value="<?php echo $email; ?>" maxlength="128">-->
                                <input type="email" class="form-control" id="email_acc" placeholder="cth: ahli@mail.com" name="email_acc" value="<?php echo $email; ?>" maxlength="128" required>
                            </div>
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="phone">Telefon</label>
                                <input type="text" class="form-control" id="phone" placeholder="cth: 0134567890" name="phone" value="<?php echo $phone; ?>" maxlength="11">
                            </div>
                        </div>
                         
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Katalaluan <span class="float-right text-sm text-danger"><i class="fa fa-info-circle"></i></span> </label>
                                <input type="password" class="form-control" id="password" placeholder="******" name="password" maxlength="20">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cpassword">Sahkan Katalaluan <span class="float-right text-sm text-danger"><i class="fa fa-info-circle"></i></span> </label>
                                <input type="password" class="form-control" id="cpassword" placeholder="******" name="cpassword" maxlength="20">
                            </div>
                        </div>
                    </div>
                    <div class="row"><!-- row 2-->
                        <div class="col-md-8">                                
                            <div class="form-group">
                                <label for="address">No. Rumah @ Alamat</label>
                                <input type="text" class="form-control" id="address" placeholder="Sila masukkan alamat terkini" name="address" value="<?php echo strtoupper($address); ?>">  
                            </div>    
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="role">Lokasi/Taman </label>
                                <select class="form-control" id="surau" name="surau">
                                    <option value="0">Pilih Lokasi/Taman</option>
                                    <?php
                                    if(!empty($surauInfo))
                                    {
                                        foreach ($surauInfo as $sr)
                                        {
                                            ?>
                                            <option value="<?php echo $sr->id; ?>" <?php if($sr->id == $surau) {echo "selected=selected";} ?>>
                                                <?php echo $sr->name.", ".$sr->desc; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> 
                    </div>
                    <div class="row">  
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="noAhli">No Ahli</label>
                                <input type="text" class="form-control" id="noAhli" placeholder="" name="noAhli" value="<?php echo $noAhli; ?>" maxlength="128">
                            </div>
                        </div> 
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="role">Peranan Ahli</label>
                                <select class="form-control" id="role" name="role">
                                    <!--<option value="0">Select Role</option>-->
                                    <?php
                                    if(!empty($roles))
                                    {
                                        foreach ($roles as $rl)
                                        {
                                            ?>
                                            <option value="<?php echo $rl->roleId; ?>" <?php if($rl->roleId == $roleId) {echo "selected=selected";} ?>><?php echo $rl->role ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-2">
                            <div class="form-group">
                               <label for="enum">Status Ahli</label>
                                
                                <select name="status" id="status" class="form-control" >
                                  <?php 
                                    if ($status == "Aktif")
                                      { ?>
                                              <option value="Aktif" selected="selected"> Aktif </option>
                                              <option value="Tidak Aktif"> Tidak Aktif </option>
                                    <?php } else if ($status == "Tidak Aktif") {?> 
                                              <option value="Aktif"> Aktif </option>
                                              <option value="Tidak Aktif" selected="selected"> Tidak Aktif</option>
                                    <?php } else { ?> 
                                              <option value="Aktif"> Aktif </option>
                                              <option value="Tidak Aktif" selected="selected"> Tidak Aktif</option>
                                    <?php } ?>
                                </select>
                            </div> 
                        </div> 
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="pakej">Kategori Ahli </label>
                                <select class="form-control" id="pakej" name="pakej">
                                  <?php 
                                    if ($pakej == "Keluarga")
                                      { ?>
                                              <option value="Keluarga" selected="selected"> Keluarga </option>
                                              <option value="Bujang"> Bujang </option>
                                    <?php } else if ($pakej == "Bujang") {?> 
                                              <option value="Keluarga"> Keluarga </option>
                                              <option value="Bujang" selected="selected"> Bujang</option>
                                    <?php } else { ?> 
                                              <option value="Keluarga" selected> Keluarga </option>
                                              <option value="Bujang"> Bujang</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                               <label for="enum" class="text-danger">Khairat Kematian</label>

                                
                                <select name="ahli_khairat" id="ahli_khairat" class="form-control" >
                                  <?php 
                                    if ($ahli_khairat == "Y")
                                      { ?>
                                              <option value="Y" selected="selected"> Ya </option>
                                              <option value="N"> Tidak </option>
                                    <?php } else if ($ahli_khairat == "N") {?> 
                                              <option value="Y"> Ya</option>
                                              <option value="N" selected="selected"> Tidak</option>
                                    <?php } else { ?> 
                                              <option value="Y"> Ya </option>
                                              <option value="N" selected="selected"> Tidak </option>
                                    <?php } ?>
                                </select>
                            </div> 
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="regDate"> Tarikh Daftar </label>                     
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                  <input class="form-control" id="regDate" name="regDate" placeholder="YYYY/MM/DD" type="text" value="<?php echo $regdate; ?>"/>
                                  </div>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                               <label for="catatan">Catatan</label>
                                <textarea class="form-control" rows="2" name="catatan" id="catatan" placeholder="Catatan"><?php echo $catatan; ?></textarea>
                                                    
                            </div> 
                        </div>
                    </div>  
                    <div class="row"><!-- row 2-->
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="role">Tags </label><br>
                            <?php
                            //echo $checked_arr;
                            foreach ($tagsUser as $tugs)
                            {
                                //echo $tugs->tags_id;
                                $checked_arr = explode(",",$tugs->tags_id);
                            }

                            //if(!empty($tagsInfo))
                            {
                                
                                foreach ($tagsInfo as $tg)
                                {   
                                    $checked = "";
                                    foreach ($tagsUser as $tugs)
                                        {
                                            if($tg->id == $tugs->tags_id){
                                            //echo "checked";
                                            $checked = "checked";
                                            }
                                        }
                                    //echo $tg->id;
                                    //if(in_array($tg->id,$checked_arr)){
                                    //    $checked = "checked";
                                    //} ?>
                                <input type="checkbox" name="tags[]" value="<?php echo $tg->id; ?>" <?php echo $checked;?> > <?php echo $tg->name;?> &nbsp;&nbsp;
                                <?php }
                            }
                            ?>
                            </div>
                        </div> 
                    </div>   
                </div>
                 <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="Simpan" />
                        <br>
                        <span class="float-right text-sm text-danger"><i class="fa fa-info-circle"></i></span> : <small> Isi sekiranya ingin menukar katalaluan sahaja.</small>
                        <!--<input type="reset" class="btn btn-default" value="Reset" />-->
                </div>
                </div>
                </form><!-- left column -->
            </div>

            <div class="col-md-12"> <!-- Rekod Tanggungan -->
                <form role="form" action="<?php echo base_url() ?>addFamily" method="post" id="addFamily" role="form">
                <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Tanggungan</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-default" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button> 
                    </div>
                </div>
                <div class="box-body"> 
                    <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                                <label for="fy_name">Nama Tanggungan</label>
                                <input type="text" class="form-control" id="fy_name" placeholder="Nama" name="fy_name" value="" maxlength="128" required>
                                <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />    
                            </div> 
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                                <label for="fy_icno">No. KP / Sijil Lahir</label>
                                <input type="text" class="form-control" id="fy_icno" placeholder="cth: 888888105678" name="fy_icno" value="" maxlength="12">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                              <label for="role">Pertalian Keluarga</label>
                                <select class="form-control" id="fy_pertalian" name="fy_pertalian" required>
                                    <option value="">Sila Pilih</option>
                                    <?php
                                    if(!empty($pertalian))
                                    {
                                        foreach ($pertalian as $pl)
                                        {
                                            ?>
                                            <option value="<?php echo $pl->yf_name; ?>"><?php echo $pl->yf_name;?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="fy_phone">Telefon</label>
                                <input type="text" class="form-control" id="fy_phone" placeholder="cth: 0134567890" name="fy_phone" value="" maxlength="12">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="submit">&nbsp;</label><br>
                                <input type="submit" class="btn btn-success" value="Tambah" />
                            </div>
                        </div>
                    </div>
                    </form>
                    <form role="form" action="<?php echo base_url() ?>deleteFamily" method="post" id="deleteFamily" role="form">
                            <div class="box-body table-responsive no-padding">
                              <table class="table table-condensed table-striped table-hover" >
                                <tr>
                                  <th>#</th>
                                  <!--<th>&nbsp;</th>-->
                                  <th>Nama</th>
                                  <!--<th>Pasangan</th>-->
                                  <th>Pertalian</th>
                                  <th>No. KP </th>
                                  <th>Telefon </th>
                                  <th>Umur </th>
                                  <th><span class="float-right text-sm text-warning"><i class="fa fa-info-circle"></i></span>&nbsp;Yuran</th>
                                  <th>&nbsp;</th>
                                </tr>
                                <?php 
                                $num = 1;
                                if(!empty($familyInfo))
                                    {
                                    foreach ($familyInfo as $fy)
                                        {
                                        
                                        ?>
                                        <tr>
                                         
                                          <td width="40">
                                          <?php if ($fy->deathStatus !="Y"){ 
                                                if ($fy->approval !="Y") { ?>
                                                <input type="checkbox" name="checked_id[]" value="<?php echo $fy->f_id; ?>"> &nbsp;
                                            <?php } else { ?>
                                                <span class="float-right text-sm text-success">
                                                 <i class="fa fa-check"></i>
                                                </span>
                                            <?php } 
                                            } else { ?>
                                            <span class="float-right text-sm text-danger">
                                                <i class="fa fa-exclamation-triangle"></i>
                                            </span>
                                        <?php } ?>
                                            <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />    
                                          </td>
                                          <!--<td><?php //echo $num++; ?>.</td>-->
                                          <td><?php echo $num++; ?>. <?php echo strtoupper($fy->f_name); ?></td>
                                          <!--<td><?php echo strtoupper($fy->f_pasangan); ?></td>-->
                                          <td><?php echo strtoupper($fy->f_pertalian); ?></td>
                                          <td><?php echo str_replace(' ', '', $fy->f_icno); ?></td>
                                          <td><?php echo $fy->f_phone; ?></td>
                                          <td>
                                            <?php 
                                            if($fy->f_icno != "") {
                                              $no_ic = str_replace(' ', '', $fy->f_icno);
                                              $age = umur($no_ic); 
                                              echo $age;
                                            } else {
                                              $age = 0;
                                              echo $age;
                                            }
                                            ?>
                                          </td>
                                          <td align="center">
                                            <?php 
                                            //echo $age;
                                            echo yuran ($fy->f_pertalian, $age);
                                            /*
                                            if($fy->f_pasangan != "Y") {
                                              if($age > 21) {
                                                echo $yuran_tanggungan = number_format("5", 2); 
                                                $yuran = $yuran + $yuran_tanggungan;                                       
                                              } else {
                                                echo "0.00";
                                              }
                                            } else {
                                                echo "0.00";
                                            }*/
                                              ?>
                                          </td>
                                          <td>
                                            <a class="btn btn-xs btn-info" href="" id="familyId" data-id="<?php echo $fy->f_id; ?>" title="Lihat" data-toggle="modal" data-target="#familyModal"><i class="fa fa-search"></i></a>&nbsp;
                                            <!--<a class="btn btn-sm btn-danger" href="<?php echo base_url().'user/deleteFamily/'.$fy->f_id; ?>" onclick="javasciprt: return confirm('Adakah anda pasti untuk padam ?')" title="Padam"><i class="fa fa-trash"></i></a>-->
                                          </td>
                                        </tr>
                                        <?php
                                        }

                                    }
                                ?>
                                <tr>
                                  <td colspan="6">
                                    <!--<span class="float-right text-sm text-warning"><i class="fa fa-info-circle"></i></span>-->
                                    &nbsp;
                                  </td>
                                  
                                  <td align="center"><?php //echo number_format($yuran, 2); ?></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="8"><input type="submit" class="btn btn-danger" value="Padam" /><br>&nbsp;<p>
                                    <span class="float-right text-sm text-danger"><i class="fa fa-exclamation-triangle"></i></span> : <small> Ahli keluarga yang telah meninggal dunia</small>
                                    <br>
                                    <span class="float-right text-sm text-success"><i class="fa fa-check"></i></span>
                                    : <small> Tanggungan yang diluluskan</small>
                                    <br>
                                    <span class="float-right text-sm text-warning"><i class="fa fa-info-circle"></i></span>
                                    : <small> Yuran </small>
                                  </td>
                                </tr>
                              </table>
                            </div> 
                            </form>
                </div>
                 <div class="box-footer">
                        
                </div>
                </div>       
            </div> <!-- end right column-->
        </div>

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

        <div class="row">
        <div class="col-md-12"><!-- Maklumat Bayaran Maklumat Ahli-->
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Maklumat Bayaran Ahli</h3> <span class="badge bg-yellow"> <?php echo $pakej; ?></span> 
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-default" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i>
                    </button> 
                  </div>
                </div>

                <div class="box-body"> 
                <form role="form" action="<?php echo base_url() ?>addPayment" method="post" id="addPayment" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                            <label for="int">Jenis Yuran</label>
                            <select class="form-control" id="yid" name="yid" required>
                                  <option value="">Pilih Yuran</option>
                                  <?php
                                      foreach ($yuranlist as $yu)
                                      {
                                        if ($yu->status == "Aktif"){
                                          ?>
                                          <option value="<?php echo $yu->yid ?>">
                                                <?php echo $yu->y_title; ?> 
                                          </option>
                                          <?php
                                        }
                                      }
                                  ?>

                              </select>   
                        </div> 
                    </div>
                    <div class="col-md-6"> 
                      <div class="form-group">
                          <label for="submit">&nbsp;</label><br>
                          <?php if ($ahli_khairat == "Y") { ?>
                            <input type="submit" class="btn btn-success" value="Tambah" />
                          <?php } else { ?> 
                            <input type="submit" class="btn btn-success" value="Tambah" disabled />
                            <label class="text-success">&nbsp;<small>Tambahan yuran hanya untuk peserta khairat sahaja.</small></label>
                         <?php } ?>
                          <input type="hidden" value="<?php echo $pakej; ?>" name="pakej" id="pakej" /> 
                          <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />  
                      </div>
                    </div>
                </div>
                </form>


                <div class="row"><!-- row 3-->
                    <div class="col-md-12">
                        <div class="box-body table-responsive no-padding">
                          <table class="table table-condensed table-striped table-hover" >
                            <tr>
                             
                              <td><b>Keterangan</b></td>
                              <td><b>Status</b></td>
                              <td><b>Catatan Resit</b></td>
                              <td><b>Kemaskini Oleh</b></td>
                              <td align="right"><b>Jumlah (RM)</b></td>
                              <td><b>&nbsp;</b></td>
                            </tr>

                            <?php
                                $total_amaun = 0;
                                if(!empty($paymentrecord))
                                {
                                    
                                    foreach ($paymentrecord as $pr)
                                    {
                                        $total_amaun = $total_amaun + $pr->total_amaun;
                                        ?>
                                        <tr>
                                        
                                            <td>
                                              <?php if ($pr->status == "Belum Selesai"){ ?>
                                              <font color="red"><?php echo $pr->y_title; ?></font>
                                              <?php } else { 
                                                echo $pr->y_title; 
                                              }?>
                                            </td>
                                          
                                          <td>
                                            <?php 
                                            if ($pr->status == "Selesai") { ?>
                                              <span class="badge bg-green">Selesai</span>
                                              <a href="<?php echo base_url().'payment/read/'.$pr->p_id; ?>" title="Resit">
                                                <span class="badge bg-yellow">
                                                    Resit : <?php echo sprintf('%05d',$pr->p_id);?>
                                                </span>
                                              </a>
                                              <?php 
                                                if (!empty($pr->pg_billcode)) { ?>
                                                  <a href="<?php echo $pg_defaulturl.$pr->pg_billcode; ?>" target="_blank">
                                                    <span class="badge bg-blue">Resit FPX: <?php echo $pr->pg_billcode;?></span>
                                                  </a>
                                              <?php } ?>

                                            <?php } else if ($pr->status == "Belum Selesai") { ?>
                                                <!--<span class="badge bg-red">Belum Selesai</span> -->
                                                <a  href="<?php echo base_url().'payment/update/'.$pr->p_id; ?>" title="Edit"><span class="badge bg-red">Belum Selesai</span></a>
                                            <?php } ?>
                                            <?php 
                                            if ((!empty($pr->attachment)) AND ($pr->attachment != "default.jpg")) {?>
                                                <a href="<?php echo site_url().'upload/'.$pr->attachment; ?>" target="_blank"><span class="badge bg-blue"><i class="fa fa-paperclip"></i></span></a>
                                            <?php }?>
                                            
                                          </td>
                                          <td> <?php echo $pr->catatan; ?>
                                          </td>
                                          
                                          <td>
                                              <?php 
                                                echo $pr->name."<br>".$pr->updatedDtm; 
                                              ?>
                                           </td>

                                            <td align="right">
                                              <?php if ($pr->status == "Belum Selesai"){ ?>
                                              <font color="red"><?php echo $pr->total_amaun; ?></font>
                                              <?php } else { 
                                                echo $pr->total_amaun; 
                                              }?>
                                            </td>
                                            <td align="center">
                                            <?php 
                                            if ($pr->status == "Belum Selesai") { ?>
                                                <!--<span class="badge bg-red">Belum Selesai</span> -->
                                               <!--<a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->userId; ?>" title="Delete"><i class="fa fa-trash"></i></a>-->
                                                <a class="btn btn-sm btn-primary" href="<?php echo base_url().'payment/update/'.$pr->p_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-sm btn-danger" href="<?php echo base_url().'payment/delete/'.$pr->p_id; ?>" onclick="javasciprt: return confirm('Adakah anda pasti untuk padam ?')" title="Delete"><i class="fa fa-trash"></i></a>
                                            <?php } ?>
                                            
                                          </td>
                                        </tr>
                                        
                                        <?php
                                    }

                                }
                            ?>
                            <tr> 
                              <td colspan="4" align="right"><b>Jumlah Bayaran</b></td>
                              <td align="right"><?php echo number_format($total_amaun, 2); ?></td>
                              <td align="right">&nbsp;</td>
                            </tr>
                            
                          </table>
                          </div>
                          <span class="badge bg-blue"><i class="fa fa-paperclip"></i></span> - attachment
                    </div>
                </div><!-- end row3 -->
                </div>
                <div class="box-footer">
                <!--<?php echo anchor(site_url('payment/create/'),'Tambah', 'class="btn btn-primary"'); ?>
               <a class="btn btn-primary" href="<?php echo base_url().'payment/create/'.$userId; ?>">Tambah Bayaran</a> -->  

                   <!--amaran -->
               <?php if($unpaidcount >= 1) { ?>
                <a class="btn btn-danger" href="<?php echo base_url().'payment/warning/'.$userId; ?>">Surat Peringatan </a>
                <br><font color="red">Nota : Surat Peringatan akan dijana jika terdapat <b>tiga (3)</b> dan lebih yuran berstatus <b>BELUM SELESAI</b> </font>
               <?php } ?>
               <!-- amaran end --> 
                </div>
            </div>
        </div>

        <div class="col-md-12"> <!-- Rekod Bayaran Khairat -->
            <div class="box box-info collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Terima Sumbangan</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-default" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-plus"></i>
                        </button> 
                    </div>
                </div>
                <div class="box-body"> 
                <form role="form" action="<?php echo base_url() ?>khairat/create_action" method="post">
                <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                            <label for="k_date"> Tarikh Sumbangan </label>                     
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                                <input class="form-control" id="k_date" name="k_date" placeholder="YYYY/MM/DD" 
                                type="text" value="<?php echo date('Y-m-d') ?>"/>
                            </div>  
                        </div> 
                    </div>
                     <div class="col-md-2"> 
                        <div class="form-group">
                        <label for="double">Jumlah</label>
                        <input type="text" class="form-control" name="k_amaun" id="k_amaun" placeholder="0.00" value="" />
                        </div>
                    </div>
                     <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="k_catatan">Catatan</label>
                            <textarea class="form-control" rows="1" name="k_catatan" id="k_catatan" placeholder=""></textarea>
                        </div>
                    </div>
                    <div class="col-md-2"> 
                      <div class="form-group">
                          <label for="submit">&nbsp;</label><br>
                          <input type="submit" class="btn btn-success" value="Tambah" />
                          <input type="hidden" value="<?php echo $userId; ?>" name="userid" id="userid" />  
                      </div>
                    </div>
                </div>
                </form>

                    <div class="row"><!-- row 3-->
                        <div class="col-md-12">
                              <table class="table table-striped table-hover table-responsive">
                                <tr>
                                  <td width="200"><b>Tarikh</b></td>
                                  <td><b>Catatan</b></td>
                                  <!--<td><b>Kemaskini Oleh</b></td>-->
                                  <td align="right"><b>Jumlah (RM)</b></td>
                                </tr>

                                <?php
                                    $total_sumbangan = 0;
                                    if(!empty($khairatrecord))
                                    {
                                        
                                        foreach ($khairatrecord as $kh)
                                        {
                                            $total_sumbangan = $total_sumbangan + $kh->k_amaun;
                                            ?>
                                            <tr>
                                            
                                                <td>
                                                  <?php echo date("d-m-Y", strtotime($kh->k_date)); ?>
                                                </td>
                                                <td> 
                                                    <?php echo $kh->k_catatan; ?>
                                                </td>
                                                <!--
                                                <td>
                                                  <?php echo $kh->name."<br>".$kh->updatedDtm; ?>
                                               </td>-->
                                               
                                                <td align="right">
                                                  <?php echo $kh->k_amaun;?>
                                                </td>
                                                
                                            </tr>
                                            
                                            <?php
                                        }

                                    }
                                ?>
                                <tr> 
                                  <td colspan="2" align="right"><b>Jumlah Khairat</b></td>
                                  <td align="right"><?php echo number_format($total_sumbangan, 2); ?></td>
                                </tr>   
                              </table>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <!--<?php echo anchor(site_url('payment/create/'),'Tambah', 'class="btn btn-primary"'); ?>-->
                    <!--<?php echo anchor(site_url('khairat/create'),'Tambah', 'class="btn btn-primary"'); ?>-->
                   <!--<a class="btn btn-primary" href="<?php echo base_url().'khairat/create/'?>">Tambah Sumbangan</a>-->
                </div>
            </div>
        </div>

        <div class="col-md-12"> <!-- Upload Dokumen -->
                
                <div class="box box-info collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Muatnaik Dokumen</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-default" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-plus"></i></button> 
                    </div>
                </div>
                <div class="box-body"> 
                    <form role="form" action="<?php echo base_url() ?>addDocument" method="post" id="addDocument" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                                <label for="doc_name">Tajuk Dokumen</label>
                                <input type="text" class="form-control" id="doc_name" placeholder="Tajuk" name="doc_name" value="" maxlength="128" required>
                                <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />    
                            </div> 
                        </div>
                        <div class="col-md-4"> 
                          <div class="form-group">
                              <label for="attachment">Jenis Dokumen <font color="red"> <small>(JPG, PNG, GIF, PDF)</small></font><?php echo form_error('userfile') ?></label>
                              <input type="file" name="userfile" size="20" class="form-control"  required />
                          </div>
                        </div>
                        <div class="col-md-2"> 
                          <div class="form-group">
                              <label for="submit">&nbsp;</label><br>
                              <input type="submit" class="btn btn-success" value="Tambah" />
                          </div>
                        </div>
                    </div>
                    </form>
                    <form role="form" action="<?php echo base_url() ?>deleteDocument" method="post" id="deleteDocument" role="form">
                            <div class="box-body table-responsive no-padding">
                              <table class="table table-condensed table-striped table-hover" >
                                <tr>
                                  <th>#</th>
                                  <th>Tajuk Dokumen</th> 
                                  <td>Tarikh Muatnaik</td>                                
                                  <th>&nbsp;</th>
                                </tr>
                                <?php 
                                $num = 1;
                                if(!empty($documentInfo))
                                    {
                                    foreach ($documentInfo as $doc)
                                        {
                                        
                                        ?>
                                        <tr>
                                          <td width="40">
                                            <input type="checkbox" name="checked_id[]" value="<?php echo $doc->doc_id; ?>"> &nbsp;
                                            <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />    
                                          </td>
                                          <td><?php echo $num++; ?>. <?php echo strtoupper($doc->doc_title); ?></td>
                                          <td><?php echo $doc->createDtm; ?></td>
                                          <td>
                                            <a class="btn btn-sm btn-info" href="<?php echo site_url().'documents/'.$doc->attachment; ?>" id="docId" title="Lihat" target="_blank"><i class="fa fa-search"></i></a>&nbsp;
                                            <!--<a class="btn btn-sm btn-success" href="" id="docId" data-id="<?php echo $doc->doc_id; ?>" title="Lihat" ><i class="fa fa-download"></i></a>&nbsp;
                                            <a class="btn btn-sm btn-danger" href="<?php echo base_url().'user/deleteDocument/'.$doc->doc_id;?>" onclick="javasciprt: return confirm('Adakah anda pasti untuk padam ?')" title="Padam"><i class="fa fa-trash"></i></a>-->
                                          </td>
                                        </tr>
                                        <?php
                                        }

                                    }
                                ?>
                                <tr>
                                  <td colspan="4"><input type="submit" class="btn btn-danger" onclick="javasciprt: return confirm('Adakah anda pasti untuk padam ?')" value="Padam" /><br>&nbsp;<p>
                                    <span class="float-right text-sm text-warning"><i class="fa fa-exclamation-triangle"></i></span> : <small> Saiz setiap file adalah tidak melebihi 5MB</small>
                                    <br>
                                    
                                  </td>
                                </tr>
                              </table>
                            </div> 
                            </form>
                </div>
                 <div class="box-footer">   
                </div>
                </div>       
        </div> <!-- end right column-->

         <div class="col-md-12"> <!-- Delete All Records -->  
                <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Padam Keseluruhan Rekod Ahli</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-default" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button> 
                    </div>
                </div>
                <div class="box-body"> 
                    <form role="form" action="<?php echo base_url() ?>deleteAllRecords" method="post" id="deleteAllRecords">
                    <div class="row">
                        <div class="col-md-12"> 
                          <div class="form-group">
                              <input type="hidden" name="userId" value="<?php echo $userId;?>">
                              <input type="submit" class="btn btn-danger" value="PADAM REKOD AHLI" onclick="javasciprt: return confirm('Adakah anda pasti untuk padam keseluruhan rekod ahli ?')" /><br>
                              <label class="text-danger"><small>Semua maklumat ahli, yuran, sumbangan dan dokumen berkaitan ahli akan dipadam.</small></label>
                          </div>
                        </div>
                    </div>
                    </form>
                </div>
                 <div class="box-footer">   
                </div>
                </div>       
        </div> <!-- end right column-->
        
        </div> <!-- end row-->

    </section>

</div>

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>
<script>
  $(document).ready(function(){
    var regDate=$('input[name="regDate"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    regDate.datepicker({
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    })

   
  })
</script>

<script>
  $(document).ready(function(){
    var k_date=$('input[name="k_date"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    k_date.datepicker({
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    })

   
  })
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

   