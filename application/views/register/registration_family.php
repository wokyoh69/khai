
<pre style="font-size: 12px; font-family: arial;">
<?php //echo $g_policy; ?>
<?php //echo $this->session->userdata('tempUser'); ?> 
</pre>

<form role="form" action="<?php echo base_url() ?>regFamilyAdd" method="post" id="regFamilyAdd" role="form">
<div class="row">
  <div class="col-sm-12">
    <div class="form-group">
          <input type="text" class="form-control" id="f_name" placeholder="Nama" name="f_name" maxlength="128" required>  
    </div> 
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="form-group">
          <input type="text" class="form-control" id="f_icno" placeholder="cth: 888888105678" name="f_icno" value="" maxlength="12">
      </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
      <div class="form-group">
         <select class="form-control" name="f_pertalian" id="f_pertalian">
            <?php
                foreach ($pertalian as $fy)
                {
                    ?>
                    <option value="<?php echo $fy->yf_name; ?>"><?php echo $fy->yf_name ?></option>
                    <?php
                }
            ?>
        </select>
       <!--
          <select name="f_pertalian" id="f_pertalian" class="form-control required" >
            <option value="" selected="selected"> Pertalian </option>
            <option value="ISTERI"> ISTERI </option>
            <option value="SUAMI"> SUAMI </option>
            <option value="ANAK"> ANAK </option>
            <option value="IBU KANDUNG"> IBU KANDUNG </option>
            <option value="BAPA KANDUNG"> BAPA KANDUNG </option>
            <option value="IBU MERTUA"> IBU MERTUA </option>
            <option value="BAPA MERTUA"> BAPA MERTUA </option>
            <option value="LAIN-LAIN"> LAIN-LAIN </option>
          </select>-->
      </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="form-group">
      <input type="text" class="form-control" id="f_catatan" placeholder="catatan" name="f_catatan">
      </div>
  </div>
</div>
<input type="hidden" name="regId" value="<?php echo $this->session->userdata('tempUser'); ?>">
<input type="submit" class="btn btn-primary" value="Simpan" />
</form>



