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
                            <button type="button" class="btn btn-primary"><i class="fas fa-bullhorn"></i> Pengumuman</button>
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
                                            <th>#</th>
                                            <th>Antrian</th>
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
                </div>
            </div>
        </div>
    </div>
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
        const layanan = "<?php echo $this->session->userdata('layanan');?>"
    </script>
    <script>
        var dt_antrian;
        $(document).ready(function(){
            $("#sidebar_antrian").addClass("active");
            dt_antrian = $("#dt_antrian").DataTable({
                dom: 'Bfrtip',
                ajax: {
                    url: base_url+'antrian/antrian/'+layanan,
                    dataSrc: "",
                },
                columns: [
                    {data: 'id'},
                    {data: null, "sortable" : false, render: function(data,type,row, meta){
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    {data:'no'},
                    {data: null, "sortable" : false, render: function(data,type,row,meta){
                        return "<a href='#' onclick='panggil("+row['id']+")' class='btn btn-primary'><i class='fas fa-phone'></i> Panggil</a>";
                    }},
                ],
                columnDefs: [
                    {targets: 0, visible: false},
                    {targets: '_all', className: 'text-center'}
                ],
                responsive : true,
                autoWidth: false,
            });
        });
    </script>
</body>
</html>