
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i> Payment Gateway Management
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payment Gateway</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">


        <div class="row" style="margin-bottom: 10px" >
            <div class="col-md-4">
                <?php //echo anchor(site_url('toyyibpay/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('toyyibpay/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('toyyibpay'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
              <div class="col-sm-12 table-responsive">

        <table class="table table-responsive table-bordered table-striped" style="margin-bottom: 10px">
            <tr>
                <th>ID</th>
                <th>Billname/Url</th>
                <th>Secretkey/Catcode</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($toyyibpay_data as $toyyibpay)
            {
                ?>
                <tr>
            <td width="50px"><?php echo $toyyibpay->pg_id ?></td>
            <td>
                <?php 
                echo "<b> ".$toyyibpay->pg_billname."</b><br>"; 
                echo "URL : ".$toyyibpay->pg_url."<br>"; 
                echo "Createbill : ".$toyyibpay->pg_createbill."<br>"; 
                echo "Returnurl : ".$toyyibpay->pg_returnurl."<br>"; 
                echo "Callbackurl : ".$toyyibpay->pg_callbackurl."<br>"; 
                ?>   
            </td>
            <td>
                <?php 
                echo "<b>Secretkey :</b> ".$toyyibpay->pg_secretkey."<br>"; 
                echo "<b>Catcode :</b> ".$toyyibpay->pg_catcode."<br>"; 
                ?>   
            </td>
            <td style="text-align:center" width="200px">
                 <a class="btn btn-sm btn-primary" href="<?= base_url().'toyyibpay/read/'.$toyyibpay->pg_id; ?>" title="Read Detail"><i class="fa fa-info-circle"></i></a>
                 <?php if($toyyibpay->pg_id != 3) { ?>
                 <a class="btn btn-sm btn-info" href="<?= base_url().'toyyibpay/update/'.$toyyibpay->pg_id; ?>" title="Edit" disabled><i class="fa fa-pencil"></i></a>
                 <?php } ?>
                 <?php if(($toyyibpay->pg_id == '1') || ($toyyibpay->pg_id == '2')) { ?>
                 <a class="btn btn-sm btn-success" href="#"><i class="fa fa-square"></i></a>
                <?php } ?>
                 <!--<a class="btn btn-sm btn-danger deleteUser" href="<?= base_url().'toyyibpay/delete/'.$toyyibpay->pg_id; ?>" title="Delete" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash"></i></a>-->
            </td>
        </tr>
            <?php
            }
            ?>
        </table>

    </div>
</div>

        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <table style="margin-bottom: 10px">
                    <tr>     
                        <td><a class="btn btn-sm btn-success" href="#"><i class="fa fa-square"></i></a></td>
                        <td>&nbsp; Toyyibpay Active API Code (1 & 2)</td>
                    </tr>
                </table>
            </div>
        </div>


    </section>
</div>