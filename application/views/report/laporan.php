
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-home" aria-hidden="true"></i> Laporan
        <!--<small>"manage training locations"</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="activ">Laporan</li>
      </ol>
    </section>
      <!-- Content Header (Page header) -->
    <section class="content">
    	<body>

        <!--start row 3 -->
          <div class="row"> 
            <div class="col-md-12"> 

            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Senarai Keseluruhan Ahli & Tanggungan </h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="box-body">
                  <div class="chart-container">
              <div class="bar-chart-container">
                <a class="btn btn-primary" href="<?php echo base_url(); ?>downloadAll"><i class="fa fa-arrow-down"></i> DOWNLOAD</a> &nbsp; Muat turun semua senarai terkini ahli khairat dan tanggungan.
              </div>
            </div>
              </div>
            </div>

            </div>
          </div> 
          <!--end row 3-->
          
          <!--start row 3 -->
          <div class="row"> 
            <div class="col-md-12"> 

            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Pendaftaran Ahli Mengikut Lokasi/Taman</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="box-body table-responsive">
                  <div class="chart-container">
                    <div class="bar-chart-container">
                      <div align="center"><div id="barchart"></div></div>
                    </div>
                  </div>
              </div>
            </div>

            </div>
          </div> 
          <!--end row 3-->
          
	    	<!--start row 3 -->
	        <div class="row"> 
	          <div class="col-md-12"> 

	          <div class="box box-success">
	            <div class="box-header with-border">
	              <h3 class="box-title">Graf Pendaftaran Ahli <? echo date('Y'); ?></h3>

	              <div class="box-tools pull-right">
	                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
	                </button>
	              </div>
	            </div>
	            <div class="box-body">
		              <div class="chart-container">
					    <div class="bar-chart-container">
					      <canvas id="bar-chart"></canvas>
					    </div>
					  </div>
	            </div>
	          </div>

	          </div>
	        </div> 
	        <!--end row 3-->

		  
		 
		  <!-- javascript -->
		   
		</body>
    
    </section>
</div>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->

<script src="<?php echo base_url(); ?>assets/charts/Chart.js"></script>
<script src="<?php echo base_url(); ?>assets/charts/jquery-3.3.1.min.js"></script>

<script>
  $(function(){
      //get the bar chart canvas
      var cData = JSON.parse(`<?php echo $chart_data; ?>`);
      var ctx = $("#bar-chart");
 
      //bar chart data
      var data = {
        labels: cData.label,
        datasets: [
          {
            label: cData.label,
            data: cData.data,
            backgroundColor: [
              "#DEB887",
              "#A9A9A9",
              "#DC143C",
              "#F4A460",
              "#2E8B57",
              "#1D7A46",
              "#CDA776",
              "#CDA776",
              "#989898",
              "#CB252B",
              "#E39371",
            ],
            borderColor: [
              "#CDA776",
              "#989898",
              "#CB252B",
              "#E39371",
              "#1D7A46",
              "#F4A460",
              "#CDA776",
              "#DEB887",
              "#A9A9A9",
              "#DC143C",
              "#F4A460",
              "#2E8B57",
            ],
            borderWidth: [1, 1, 1, 1, 1,1,1,1, 1, 1, 1,1,1]
          }
        ]
      };
 
      //options
      var options = {
        responsive: true,
        title: {
          display: true,
          position: "top",
          text: "Monthly Registered Users Count",
          fontSize: 18,
          fontColor: "#111"
        },
        legend: {
          display: true,
          position: "bottom",
          labels: {
            fontColor: "#333",
            fontSize: 16
          }
        }
      };
 
      //create bar Chart class object
      var chart1 = new Chart(ctx, {
        type: "bar",
        data: data,
        options: options
      });
 
  });
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

              <script type="text/javascript">
              // Load google charts
              google.charts.load('current', {'packages':['corechart']});
              google.charts.setOnLoadCallback(drawChart);

              // Draw the chart and set the chart values
              function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Blok', 'Bilangan Ahli'], 
                <?php 
                      foreach ($surau as $rowe){
                         echo "['".$rowe['surauName']." (".$rowe['regNumber'].")',".$rowe['regNumber']."],";
                } ?>
              ]);

                // Optional; add a title and set the width and height of the chart
                var options = {'title':'Senarai Ahli Mengikut Lokasi/Taman', 'width':1000, 'height':500};

                // Display the chart inside the <div> element with id="piechart"
                var chart = new google.visualization.BarChart(document.getElementById('barchart'));
                chart.draw(data, options);
              }
              </script>



