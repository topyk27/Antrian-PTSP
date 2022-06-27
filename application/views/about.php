<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me</title>
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
                        <div class="col-sm-6">
                            <h1>About</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">About</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
								<div class="card-body box-profile">
									<div class="text-center">
										<img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('asset/img/karasuma.jpg'); ?>" alt="Taufik">
									</div>
									<h3 class="profile-username text-center">Taufik Dwi Wahyu Putra</h3>
									<p class="text-muted text-center">Software Engineer</p>
									<ul class="list-group list-group-unbordered mb-3">
										<li class="list-group-item">
											<b>Followers</b>
											<a class="float-right">1684</a>
										</li>
										<li class="list-group-item">
											<b>Following</b>
											<a class="float-right">234</a>
										</li>
									</ul>
									<a href="https://www.instagram.com/topyk27/" class="btn btn-primary btn-block">
										<b>Follow</b>
									</a>
								</div>
							</div>
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">About Me</h3>
								</div>
								<div class="card-body">
									<strong>
										<i class="fas fa-book mr-1"></i>
										Education
									</strong>
									<p class="text-muted">
										Sarjana Komputer dari Universitas Mulawarman
									</p>
									<hr>
									<strong>
										<i class="fas fa-map-marker-alt mr-1"></i>
										Location
									</strong>
									<p class="text-muted">
										Kutai Kartanegara, Indonesia
									</p>
									<hr>
									<strong>
										<i class="fas fa-pencil-alt mr-1"></i>
										Skills
									</strong>
									<p class="text-muted">
										Android Studio, CodeIgniter, Java, Javascript, MySql, PHP
									</p>
									<hr>
									<strong>
										<i class="far fa-file-alt mr-1"></i>
										Motto
									</strong>
									<p class="text-muted">
										Berusaha untuk menerapkan keahlian dalam rekayasa perangkat lunak untuk mengambil peran dengan tim yang berkembang
									</p>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view("_partials/numpang.php") ?>
            </section>
        </div>
        <?php $this->load->view("_partials/footer.php") ?>		
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
        $(document).ready(function(){
			$("#sidebar_about").addClass("active");
		});
    </script>    
</body>
</html>