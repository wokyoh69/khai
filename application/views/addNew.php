<?php 

if(!empty($generalinfo)){ 
  foreach ($generalinfo as $info)
  { 
    $pageTitle = $info->g_home_title;
    $prefix = $info->g_contact_info;
  }
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Pendaftaran Ahli
        <small>&nbsp;</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>userListing">Senarai Ahli</a></li>
        <li class="active">Daftar Ahli</li>
      </ol>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
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
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Maklumat Peribadi Ahli</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url() ?>addNewUser" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Nama Penuh</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('fname'); ?>" id="fname" name="fname" maxlength="128">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Emel</label><?php $next_userID = $last_userID+1; ?>
                                        <input type="text" class="form-control required email" id="email" value="<?php echo set_value('email'); ?>" name="email" maxlength="128" placeholder="cth : nama@gmail.com">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Katalaluan</label> <small>(default : 'password')</small>
                                        <input type="password" class="form-control required" id="password" name="password" maxlength="20" value="password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Masukkan Semula Katalaluan</label> 
                                        <input type="password" class="form-control required equalTo" id="cpassword" name="cpassword" maxlength="20" value="password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="icno">No. Kad Pengenalan Baru</label>
                                        <input type="text" class="form-control" id="icno" value="<?php echo set_value('icno'); ?>" name="icno" maxlength="12" placeholder="cth : 888888105678">
                                        <!--<input type="text" class="form-control required digits" id="icno" value="<?php echo set_value('icno'); ?>" name="icno" maxlength="14" placeholder="000000000000">-->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Nombor Telefon</label>
                                        <input type="text" class="form-control" id="phone" value="<?php echo set_value('phone'); ?>" name="phone" maxlength="11" placeholder="cth: 0123456789">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="address">No. Rumah @ Alamat</label>
                                        <input type="text" class="form-control required" id="address" placeholder="" name="address" value="<?php echo set_value('address'); ?>">  
                                    </div>    
                                </div>
                            </div>
                            <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="regDate"> Tarikh Daftar </label>                     
                                          <div class="input-group">
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                          <input class="form-control" id="regDate" name="regDate" placeholder="YYYY/MM/DD" type="text" value=""/>
                                          </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noAhli">Nombor Keahlian</label>
                                        <input type="text" class="form-control" id="noAhli" value="<?php echo $prefix."-".sprintf('%04d',$last_userID+1); ?>" name="noAhli" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="role">Jenis Ahli</label>
                                        <select class="form-control required" id="role" name="role">
                                            <option value="0">Pilih Ahli</option>
                                            <?php
                                            if(!empty($roles))
                                            {
                                                foreach ($roles as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->roleId ?>" <?php if($rl->roleId == set_value('role')) {echo "selected=selected";} ?>><?php echo $rl->role ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>  

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="role">Pakej</label>
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

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="role">Lokasi/Taman </label>
                                        <select class="form-control" id="surau" name="surau">
                                            <option value="0">Pilih Lokasi/Taman</option>
                                            <?php
                                            if(!empty($surau))
                                            {
                                                foreach ($surau as $sr)
                                                {
                                                    ?>
                                                    <option value="<?php echo $sr->id ?>" <?php if($sr->id == set_value('surau')) {echo "selected=selected";} ?>><?php echo $sr->name.", ".$sr->desc ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>      
                                
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            
        </div>    
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>
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