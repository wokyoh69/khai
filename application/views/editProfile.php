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
        <i class="fa fa-user"></i> Kemaskini Ahli
        <small>&nbsp;</small>
      </h1>
       <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <!--<li><a href="<?php echo base_url(); ?>userListing">Senarai Ahli</a></li>-->
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
                
                    if(!empty($message)){
                        echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".$message."</div>";
                    }
                    if(!empty($message_error)){
                        echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".$message_error."</div>";
                    }
                     if(!empty($message_warning)){
                        echo "<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".$message_warning."</div>";
                    }
                
                ?>

            </div>
        </div>


        
    <div class="row"><!-- Box Maklumat Ahli-->
        <div class="col-md-12">
        <form role="form" action="<?php echo base_url() ?>editProfile" method="post" id="editProfile" role="form">
        <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo $name; ?> <strong>[<?php echo $noAhli; ?>]</strong></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button> 
            </div>
        </div>
        <div class="box-body"> 
            <div class="row"><!-- row 1-->
                <!-- left column -->
                <div class="col-md-4">                                
                    <div class="form-group">
                        <label for="fname">Nama Penuh</label>
                        <input type="text" class="form-control" id="fname" placeholder="Full Name" name="fname" value="<?php echo $name; ?>" maxlength="128">
                        <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />    
                    </div>    
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="phone">No Kad Pengenalan</label>
                        <input type="text" class="form-control" id="icno" placeholder="cth: 888888105678" name="icno" value="<?php echo $icno; ?>" maxlength="12" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="email">Emel</label>
                        <!--<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $email; ?>" maxlength="128">-->
                        <input type="email" class="form-control" id="email_acc" placeholder="cth: ahli@mail.com" name="email_acc" value="<?php echo $email; ?>" maxlength="128" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="phone">Telefon</label>
                        <input type="text" class="form-control" id="phone" placeholder="cth: 0134567890" name="phone" value="<?php echo $phone; ?>" maxlength="11">
                    </div>
                </div>
            </div>
            <!--<div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Katalaluan</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" maxlength="20">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cpassword">Masukkan Semula Katalaluan</label>
                        <input type="password" class="form-control" id="cpassword" placeholder="Sahkan Password" name="cpassword" maxlength="20">
                    </div>
                </div>
            </div> -->
            <div class="row"><!-- row 2-->
                <div class="col-md-6">                                
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control" id="address" placeholder="Sila masukkan alamat terkini" name="address" value="<?php echo $address; ?>">  
                    </div>    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="role">Blok </label>
                        <select class="form-control" id="surau" name="surau">
                            <option value="0">Pilih Blok</option>
                            <?php
                            if(!empty($surauInfo))
                            {
                                foreach ($surauInfo as $sr)
                                {
                                    ?>
                                    <option value="<?php echo $sr->id; ?>" <?php if($sr->id == $surau) {echo "selected=selected";} ?>><?php echo $sr->name.", ".$sr->desc ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>    
            </div>
            <div class="row"> 
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="role">Jenis Ahli</label> 
                        <select class="form-control" id="role" name="role" disabled>
                            <option value="0">Select Role</option>
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
                <div class="col-md-3">
                    <div class="form-group">
                       <label for="enum">Status Ahli</label>
                        
                        <select name="status" id="status" class="form-control" disabled >
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
                        <label for="pakej">Kategori Ahli</label>
                        <select class="form-control" id="pakej" name="pakej" disabled>
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

                        
                        <select name="ahli_khairat" id="ahli_khairat" class="form-control" disabled >
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
                          <input class="form-control" id="regDate" name="regDate" type="text" value="<?php echo $regdate; ?>" disabled/>
                          </div>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                       <label for="catatan">Catatan</label>
                        <textarea class="form-control" rows="3" name="catatan" id="catatan" placeholder="Catatan"><?php echo $catatan; ?></textarea>
                    </div> 
                </div>
            </div>     
        </div>
         <div class="box-footer">
                <input type="submit" class="btn btn-primary" value="Simpan" />
                <!--<input type="reset" class="btn btn-default" value="Reset" />-->
                
        </div>
        </div>
        </form>
    </div>

    <div class="col-md-12"> <!-- right column-->
            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>

                <form role="form" action="<?php echo base_url() ?>addFamilyProfile" method="post" id="addFamilyProfile" role="form">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Senarai Tanggungan</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button> 
                        </div>
                    </div>
                    <div class="box-body"> 
                        <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                    <label for="fy_name">Nama Tanggungan</label>
                                    <input type="text" class="form-control" id="fy_name" placeholder="Nama Tanggungan" name="fy_name" value="" maxlength="128" required>
                                    <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />    
                                </div> 
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                    <label for="fy_icno">No. KP </label>
                                    <input type="text" class="form-control" id="fy_icno" placeholder="" name="fy_icno" value="" maxlength="12" required>
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
                                    <input type="text" class="form-control" id="fy_phone" placeholder="cth: 0134567890" name="fy_phone" value="" maxlength="11">
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
                    </div>
                     <div class="box-footer">
                            <!--<input type="submit" class="btn btn-primary" value="Tambah" />&nbsp; <small>*Isi maklumat tanggungan kemudian klik 'Tambah'</small>-->
                            <br>&nbsp;<br>


                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                <form role="form" action="<?php echo base_url() ?>deleteFamilyProfile" method="post" id="deleteFamilyProfile" role="form">

                                  <table class="table table-condensed table-striped table-hover">
                                    <tr>
                                      <th>#</th>
                                      <th>Nama</th>
                                      <th>Pertalian</th>
                                      <th>No.KP</th>
                                      <th>Telefon</th>
                                      <th>Umur</th>
                                      <th>Yuran</th>
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
                                              <td>
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
                                              <td><?php echo $fy->f_name; ?></td>
                                              <td><?php echo $fy->f_pertalian; ?></td>
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
                                                
                                                <a class="btn btn-sm btn-info" href="" id="familyId" data-id="<?php echo $fy->f_id; ?>" title="Lihat" data-toggle="modal" data-target="#familyModal"><i class="fa fa-search"></i></a>
                                                
                                                    
                                                
                                                <!--<a class="btn btn-sm btn-danger" href="<?= base_url().'user/deleteFamily/'.$fy->f_id; ?>" onclick="javasciprt: return confirm('Adakah anda pasti untuk padam ?')" title="Padam"><i class="fa fa-trash"></i></a>-->
                                              </td>
                                            </tr>
                                            <?php
                                            }

                                        }
                                    ?>
                                    <tr>
                                      <td colspan="8"><input type="submit" class="btn btn-danger" value="Padam" /><br>&nbsp;<p>
                                        <span class="float-right text-sm text-danger"><i class="fa fa-exclamation-triangle"></i></span> : <small> Ahli keluarga yang telah meninggal dunia</small>
                                        <br>
                                        <span class="float-right text-sm text-success"><i class="fa fa-check"></i></span>
                                        : <small> Tanggungan yang diluluskan</small>
                                      </td>
                                    </tr>
                                    
                                  </table>

                                </form>
                                </div>
                                <!-- /.box-body -->            
                    </div>
                </div>
    </div> <!-- end right column-->

    <div class="col-md-12"> <!-- Upload Dokumen -->
                
                <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Muatnaik Dokumen</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-default" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button> 
                    </div>
                </div>
                <div class="box-body"> 
                    <form role="form" action="<?php echo base_url() ?>addDocumentUser" method="post" id="addDocumentUser" enctype="multipart/form-data">
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
                    <p>&nbsp;
                    <form role="form" action="<?php echo base_url() ?>deleteDocumentUser" method="post" id="deleteDocumentUser" role="form">
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
                                            <a class="btn btn-sm btn-info" href="<?= site_url().'documents/'.$doc->attachment; ?>" id="docId" title="Lihat" target="_blank"><i class="fa fa-search"></i></a>&nbsp;
                                            <!--<a class="btn btn-sm btn-success" href="" id="docId" data-id="<?php echo $doc->doc_id; ?>" title="Lihat" ><i class="fa fa-download"></i></a>&nbsp;
                                            <a class="btn btn-sm btn-danger" href="<?= base_url().'user/deleteDocument/'.$doc->doc_id;?>" onclick="javasciprt: return confirm('Adakah anda pasti untuk padam ?')" title="Padam"><i class="fa fa-trash"></i></a>-->
                                          </td>
                                        </tr>
                                        <?php
                                        }

                                    }
                                ?>
                                <tr>
                                  <td colspan="4"><input type="submit" class="btn btn-danger" onclick="javasciprt: return confirm('Adakah anda pasti untuk padam ?')" value="Padam" /><br>&nbsp;<p>
                                    <span class="float-right text-sm text-warning"><i class="fa fa-exclamation-triangle"></i></span> : <small> Saiz setiap file adalah tidak melebih 5MB</small>
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
    </div> <!-- end row-->


    </section>

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
              
              <div class="modal-footer">
                    <button class="btn btn-info" data-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>
        <!-- MODAL WINDOW -->

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
            url: '<?php echo base_url() ?>familyDetailMembers',
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