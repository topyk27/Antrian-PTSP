<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
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
                            <h1>Tambah Pengguna</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo base_url('setting/user'); ?>">Pengguna</a></li>
                                <li class="breadcrumb-item active">Tambah</li>
                            </ol>
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
                                    <h3 class="card-title">Formulir Tambah Pengguna</h3>
                                </div>
                                <form role="form" method="post" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" class="form-control <?php echo form_error('nama') ? 'is-invalid':'' ?>" value="<?php echo set_value('nama'); ?>" placeholder="Nama Pengguna" required>
                                            <div class="invalid-feedback">
                                                <?php echo form_error('nama'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" class="form-control <?php echo form_error('username') ? 'is-invalid':'' ?>" value="<?php echo set_value('username'); ?>" placeholder="Username digunakan untuk login" required>
                                            <div class="invalid-feedback">
                                                <?php echo form_error('username'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control <?php echo form_error('password') ? 'is-invalid':'' ?>" value="<?php echo set_value('password'); ?>" placeholder="Password digunakan untuk login" required>
                                            <div class="invalid-feedback">
                                                <?php echo form_error('password'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="layanan">Layanan</label>
                                            <select name="layanan" class="form-control <?php echo form_error('layanan') ? 'is-invalid':'' ?>">
                                                <option value="">Pilih</option>
                                                <?php 
                                                    foreach($data_ruang as $key => $val) :
                                                ?><option value="<?php echo($val->id); ?>" <?php echo set_select('layanan','$val->id'); ?>><?php echo $val->nama_layanan; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?php echo form_error('layanan'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="<?php echo base_url("setting/user"); ?>" class="btn btn-danger">Batal</a>
                                    </div>
                                </form>
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
    <!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
	<script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
    <script type="text/javascript">
		$(document).ready(function(){
			$("#sidebar_setting").addClass("active");
			$("#sidebar_setting_user").addClass("active");
		});
	</script>
</body>
</html>