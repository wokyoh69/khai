<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Syarat & Polisi
        <!--<small>Tukar Katalaluan yang baru</small>-->
      </h1>
    </section>

<section class="content">

<?php if($ahli_khairat == "N") { ?>
  <div class="row">
    <div align="center" class="alert alert-success alert-dismissable">
        Anda masih belum mendaftar dengan khairat kematian. Sila rujuk syarat dan polisi.    
    </div>
  </div>
<?php } ?>

  <div class="row">
    <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-body table-responsive no-padding">
         <table class="table table-bordered table-striped" style="margin-bottom: 10px">
         <tr><td><?php echo nl2br($g_policy); ?></td></tr>
         </table>
      </div>

      <?php if($ahli_khairat == "N") { ?>
      <div class="footer">
      <form role="form" id="regKhairat" action="<?php echo base_url(); ?>regKhairat" method="post">
        <div class="row">
          <div class="col-sm-12">
              <div align="left">
                  <input type="hidden" name="userid" id="userid" value="<?= $userId; ?>" >
                  &nbsp;<input type="checkbox" value="Y" name="polisi" id="polisi" required>
                  <label class="text-success">&nbsp; <b>SAYA BERSETUJU UNTUK MENYERTAI KHAIRAT KEMATIAN.</b></label> <br>
                  &nbsp;<input type="submit" class="btn btn-success" value="SUBMIT" id="submit" />
                  <p>&nbsp</p>
              </div>
            </div>
        </div>
      </form>
      </div>
    <?php } ?>

    </div>


    </div>
  </div>



</section>
</div>

