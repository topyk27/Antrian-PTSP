<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian <?php echo $this->session->userdata('nama_layanan'); ?></title>
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
                            <h1>Antrian <?php echo $this->session->userdata('nama_layanan'); ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Antrian</a></li>
                                <li class="breadcrumb-item active"><?php echo $this->session->userdata('nama_layanan'); ?></li>
                            </ol>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-primary" id="btn_pengumuman"><i class="fas fa-bullhorn"></i> Pengumuman</button>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-12" id="respon"></div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <table id="dt_antrian" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <!-- <th>#</th> -->
                                            <th>Antrian</th>
                                            <th>Status</th>
                                            <th>Panggil</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
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
    <div class="modal fade" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                $this->config->load('antrian_config',TRUE);
                $berurut = $this->config->item('berurut','antrian_config');
                if($berurut=='false') :
                ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ke">Arahkan ke :</label>
                        <select name="ke" id="ke" class="form-control <?php echo form_error('layanan') ? 'is-invalid' : '' ?>">
                            
                        </select>
                        <div class="invalid-feedback">
                            <?php echo form_error('layanan'); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="modal-footer justify-content-between">
                    <?php if($berurut=='false'): ?>
                    <button id="btn_arahkan" type="button" class="btn btn-primary" onclick="arahkan()">Arahkan</button>
                    <?php endif; ?>
                    <button id="btn_tunda" type="button" class="btn btn-warning" onclick="tunda()">Tunda</button>
                    <button type="button" class="btn btn-success" onclick="panggil_lagi()">Panggil</button>
                    <button id="btn_hapus" type="button" class="btn btn-danger" onclick="hapus()">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <div id="pengumumanModal" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header flex-column">
					<div class="icon-box">
						<i class="material-icons">campaign</i>
					</div>
					<h4 class="modal-title w-100">Umumkan</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<textarea id="text_pengumuman" rows="3" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer justify-content-center">
					<button type="button" class="btn btn-success" data-dismiss="modal" id="modal_pengumuman">Umumkan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
    <?php $this->load->view("_partials/loader.php") ?>
    <!-- jQuery -->
    <script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
    <!-- datatables -->
    <script src="<?php echo base_url('asset/plugin/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('asset/plugin/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?php echo base_url('asset/plugin/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?php echo base_url('asset/plugin/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
    <script>
        const base_url = "<?php echo base_url(); ?>";
        const layanan = "<?php echo $this->session->userdata('layanan'); ?>";
        const nama_layanan = "<?php echo $this->session->userdata('nama_layanan'); ?>";
        const kode = "<?php echo $this->session->userdata('kode'); ?>";        
        var berurut = <?php echo $berurut; ?>;
    </script>
    <script src="<?php echo base_url('asset/mine/js/list.js'); ?>"></script>
</body>

</html>