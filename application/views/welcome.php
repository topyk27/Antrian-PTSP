<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian PTSP</title>
    <?php $this->load->view("_partials/css.php") ?>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view("_partials/navbar.php") ?>
		<?php $this->load->view("_partials/sidebar_container.php") ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <h1>Antrian PTSP Pengadilan Agama <?php echo $this->session->userdata('nama_pa'); ?></h1>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title" id="title_statistik"></h3>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="barChart" style="min-height: 250px; max-height: 250px; max-width: 100%"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view("_partials/numpang.php") ?>
            </section>
        </div>
        <?php $this->load->view("_partials/footer.php") ?>
		<?php $this->load->view("_partials/loader.php") ?>
        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>
    <!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
    <!-- ChartJS -->
	<script src="<?php echo base_url('asset/plugin/chart.js/Chart.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
    <!-- Moment -->
	<script src="<?php echo base_url('asset/plugin/moment/moment-with-locales.min.js') ?>"></script>
    <!-- AdminLTE App -->
	<script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
    <script>const base_url = "<?php echo base_url(); ?>";</script>
    <script>
        var now = new Date();
		var tahun = now.getFullYear();
		var bulan = now.getMonth()+1;
		moment.locale('id');
		var nama_bulan = moment().format('MMMM');
        var tkn = "<?php echo $this->session->userdata('antrian_ptsp_tkn'); ?>";
		var nama_pa = "<?php echo $this->session->userdata('nama_pa'); ?>";
		var nama_pa_pendek = "<?php echo $this->session->userdata('nama_pa_pendek'); ?>";
		function jumlah_hari(bulan, tahun) {
			return new Date(tahun,bulan,0).getDate();
		}
        $(document).ready(function(){
            $("#title_statistik").text("Statistik Pengunjung Bulan "+nama_bulan);
			$("#sidebar_home").addClass("active");
            $.ajax({
                url : base_url+'antrian/statistik',
                method: 'get',
                dataType: 'json',
                success: function(data)
                {
                    var hari = jumlah_hari(bulan,tahun);
					var label = [];
                    var ant_val = [];
                    var ketemu = false;
                    var antrian = data.antrian;
                    for(var aa=1; aa<=hari; aa++)
                    {
                        let a_ketemu = false;
                        for(var a in antrian)
                        {
                            if(aa==antrian[a].tanggal)
                            {
                                ant_val.push(parseInt(antrian[a].total));
                                a_ketemu = true;
                                break;
                            }
                            else
                            {
                                a_ketemu = false;
                            }
                        }
                        if(!a_ketemu)
                        {
                            ant_val.push(0);
                        }
                    }
                    for(var i =1; i<=hari; i++)
                    {
                        label.push(i);
                    }

                    var areaChartData = {
                        labels  : label,
                        datasets: [
                            {
								label : 'Pengunjung',
								backgroundColor : 'rgba(0,255,255,1)',
								borderColor : 'rgba(0,255,255,0.8)',
								pointRadius : false,
								pointColor : '#3b8bba',
								pointStrokeColor : 'rgba(60,141,188,1)',
								pointHighlightFill : '#fff',
								pointHighlightStroke : 'rgba(60,141,188,1)',
								data : ant_val,

							},
                        ]
                    }
                    var barChartCanvas = $('#barChart').get(0).getContext('2d')
                    var barChartData = jQuery.extend(true, {}, areaChartData);
                    var temp0 = areaChartData.datasets[0];
                    barChartData.datasets[0] = temp0;
                    var barChartOptions = {
					  responsive              : true,
					  maintainAspectRatio     : false,
					  datasetFill             : false,
					  scales : {
					  	yAxes : [{
					  	    	ticks: {
					  	    		stepSize: 1,
					  	    	}
					  	    }],
					  },
					  tooltips : {
					  	enabled : true,
					  	mode : 'single',
					  	callbacks: {
					  		title: function(tooltipItems, data){
					  			return tooltipItems[0].xLabel + ' ' + moment().format('MMMM');
					  		}
					  	}
					  }
					}
                    var barChart = new Chart(barChartCanvas, {
					  type: 'bar', 
					  data: barChartData,
					  options: barChartOptions
					});
                }
            });
        });
    </script>
</body>
</html>