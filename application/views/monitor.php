<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/mine/css/antrian.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/mine/css/monitor.css') ?>">
    
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-9">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="<?php echo base_url('asset/img/logo.png'); ?>" class="img-fluid logo">
                            </div>
                            <div class="col-md-10">
                                <h2>PENGADILAN AGAMA TENGGARONG</h2>
                                <h5>Jalan Pesut, Kelurahan Timbau, Kecamatan Tenggarong Kabupaten Kutai Kartanegara, Kalimantan Timur 75511</h5>
                                <div class="row">
                                    <div class="col-md-3">
                                        <span><i class="fas fa-phone"></i> 0541-6667063 </span>
                                    </div>
                                    <div class="col-md-3">
                                        <span><i class="fab fa-facebook"></i> PA Tenggarong </span>
                                    </div>
                                    <div class="col-md-3">
                                        <span><i class="fab fa-instagram"></i> pa_tenggarong </span>
                                    </div>
                                    <div class="col-md-3">
                                        <span><i class="fab fa-twitter"></i> PaTenggarong </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="header">
                        <div class="row">
                            <div class="datetime">
                                <div class="date">
                                    <!-- <span id="dayname">Day</span>, -->
                                    <span id="month">Month</span>
                                    <span id="daynum">00</span>,
                                    <span id="year">Year</span>
                                </div>
                                <div class="time">
                                    <span id="hour">00</span>:
                                    <span id="minutes">00</span>:
                                    <span id="seconds">00</span>
                                    <span id="period">AM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <table id="dt_pengaduan" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="circle satu">Pengaduan dan Informasi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <table id="dt_pendaftaran" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="circle dua">Pendaftaran</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <table id="dt_produk" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="circle tiga">Pengambilan Produk</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <table id="dt_ecourt" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="circle empat">E-Court</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <table id="dt_kasir" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="circle lima">Kasir</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <table id="dt_posbakum" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="circle enam">POSBAKUM</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <table id="dt_bank" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="circle tujuh">Bank</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <table id="dt_pos" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="circle delapan">Pos</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url('asset/plugin/datatables/jquery.dataTables.min.js') ?>"></script>
    <!-- mine -->
    <script src="<?php echo base_url('asset/mine/js/jam.js') ?>"></script>
    <script src="<?php echo base_url('asset/mine/js/monitor.js') ?>"></script>
    <script>
        $(document).ready(function(){
            var dt_pengaduan;
            var dt_pendaftaran;
            var dt_produk;
            var dt_ecourt;
            var dt_kasir;
            var dt_posbakum;
            var dt_bank;
            var dt_pos;
            dt_pengaduan = $("#dt_pengaduan").DataTable({
                ajax: {
                    url: "<?php echo base_url('antrian/antrian/pengaduan') ?>",
                    dataSrc: ""
                },
                columns: [{
                    data: "no"
                }],
                paging: false,
                ordering: false,
                info: false,
                searching: false,
                language: {
                    emptyTable: "Tidak ada antrian"
                }
            });
            dt_pendaftaran = $("#dt_pendaftaran").DataTable({
                ajax: {
                    url: "<?php echo base_url('antrian/antrian/pendaftaran') ?>",
                    dataSrc: ""
                },
                columns: [{
                    data: "no"
                }],
                paging: false,
                ordering: false,
                info: false,
                searching: false,
                language: {
                    emptyTable: "Tidak ada antrian"
                }
            });
            dt_produk = $("#dt_produk").DataTable({
                ajax: {
                    url: "<?php echo base_url('antrian/antrian/produk') ?>",
                    dataSrc: ""
                },
                columns: [{
                    data: "no"
                }],
                paging: false,
                ordering: false,
                info: false,
                searching: false,
                language: {
                    emptyTable: "Tidak ada antrian"
                }
            });
            dt_ecourt = $("#dt_ecourt").DataTable({
                ajax: {
                    url: "<?php echo base_url('antrian/antrian/ecourt') ?>",
                    dataSrc: ""
                },
                columns: [{
                    data: "no"
                }],
                paging: false,
                ordering: false,
                info: false,
                searching: false,
                language: {
                    emptyTable: "Tidak ada antrian"
                }
            });
            dt_kasir = $("#dt_kasir").DataTable({
                ajax: {
                    url: "<?php echo base_url('antrian/antrian/kasir') ?>",
                    dataSrc: ""
                },
                columns: [{
                    data: "no"
                }],
                paging: false,
                ordering: false,
                info: false,
                searching: false,
                language: {
                    emptyTable: "Tidak ada antrian"
                }
            });
            dt_posbakum = $("#dt_posbakum").DataTable({
                ajax: {
                    url: "<?php echo base_url('antrian/antrian/posbakum') ?>",
                    dataSrc: ""
                },
                columns: [{
                    data: "no"
                }],
                paging: false,
                ordering: false,
                info: false,
                searching: false,
                language: {
                    emptyTable: "Tidak ada antrian"
                }
            });
            dt_bank = $("#dt_bank").DataTable({
                ajax: {
                    url: "<?php echo base_url('antrian/antrian/bank') ?>",
                    dataSrc: ""
                },
                columns: [{
                    data: "no"
                }],
                paging: false,
                ordering: false,
                info: false,
                searching: false,
                language: {
                    emptyTable: "Tidak ada antrian"
                }
            });
            dt_pos = $("#dt_pos").DataTable({
                ajax: {
                    url: "<?php echo base_url('antrian/antrian/pos') ?>",
                    dataSrc: ""
                },
                columns: [{
                    data: "no"
                }],
                paging: false,
                ordering: false,
                info: false,
                searching: false,
                language: {
                    emptyTable: "Tidak ada antrian"
                }
            });
        });
    </script>
</body>
</html>