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
    <script>
        const base_url = "<?php echo base_url(); ?>";
        var tkn = "<?php echo $this->session->userdata('antrian_ptsp_tkn'); ?>";
		var nama_pa = "<?php echo $this->session->userdata('nama_pa'); ?>";
		var nama_pa_pendek = "<?php echo $this->session->userdata('nama_pa_pendek'); ?>";
    </script>
    <script src="<?php echo base_url('asset/mine/js/welcome.js'); ?>"></script>
</body>
</html>