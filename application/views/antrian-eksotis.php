<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Antrian PTSP</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('asset/img/icon.png'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/mine/css/loader.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/mine/css/antrian.css') ?>">
    <style>.rvNotification{position:fixed;background-color:#fff;text-align:center;font-family:-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;font-weight:400;line-height:1.5;box-shadow:0 4px 8px 0 rgba(0,0,0,.2),0 6px 20px 0 rgba(0,0,0,.19);z-index:10000;width:100vw;left:0;bottom:0;font-size:1rem;padding-bottom:.5em;padding-right:.5em}.rvButtonRow{padding-right:2em;padding-bottom:1em;text-align:right;font-size:medium}.rvButton{cursor:pointer;display:inline-block;margin-left:1em;padding:.8em 2em;border-radius:3px;font-size:small}.rvButtonAllow{border:none;background-color:#2b8cff;color:#fff}.rvButtonDeny{border:1px solid #2b8cff;color:#2b8cff;background-color:#fff}.rvTextRow{padding-top:1em;padding-bottom:2em}@media (min-width:576px){.rvNotification{width:60vw;left:20vw}}@media (min-width:768px){.rvNotification{width:50vw;left:25vw}}@media (min-width:992px){.rvNotification{width:40vw;left:30vw}}@media (min-width:1200px){.rvNotification{width:30vw;left:35vw}}</style>
    <style>
        .card {
            height: 40vh;
        }
        .card .circle {
            width: 100%;
            height: 100%;
            clip-path: circle(125px at center 0);
            text-align: center;
        }
        .kecilkan {
            font-size: .7em;
        }
    </style>
</head>

<body onload="load_tutup();">
    <div class="wrapper">
        <div class="container">
            <div class="row mb-2 kecilkan">
                <div class="col-md-9">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="<?php echo base_url('asset/img/logo.png'); ?>" class="img-fluid logo">
                            </div>
                            <div class="col-md-10">
                                <h2>PENGADILAN AGAMA <span class="text-uppercase"><?php echo $setting->nama_pa; ?></span></h2>
                                <h5><?php echo $setting->alamat; ?></h5>
                                <div class="row">
                                    <?php if(!empty($setting->telepon)) : ?>
                                    <div class="col-md-3">
                                        <span><i class="fas fa-phone"></i> <?php echo $setting->telepon; ?> </span>
                                    </div>
                                    <?php endif; if(!empty($setting->facebook)) : ?>
                                    <div class="col-md-3">
                                        <span><i class="fab fa-facebook"></i> <?php echo $setting->facebook; ?> </span>
                                    </div>
                                    <?php endif; if(!empty($setting->instagram)) : ?>
                                    <div class="col-md-3">
                                        <span><i class="fab fa-instagram"></i> <?php echo $setting->instagram; ?> </span>
                                    </div>
                                    <?php endif; if(!empty($setting->twitter)) : ?>
                                    <div class="col-md-3">
                                        <span><i class="fab fa-twitter"></i> <?php echo $setting->twitter; ?> </span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <!-- <span><i class="fab fa-youtube"></i> Pengadilan Agama Tenggarong </span> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="header">
                        <div class="row justify-content-center align-items-center">
                            <div class="datetime">
                                <div class="date" style="font-size: 1.5rem;">
                                    <!-- <span id="dayname">Day</span>, -->
                                    <span id="month">Month</span>
                                    <span id="daynum">00</span>,
                                    <span id="year">Year</span>
                                </div>
                                <div class="time" style="font-size: 1.5rem;">
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
                <div class="col-md-12">
                    <div class="card" style="height: auto;">
                        <div class="card-body" style="font-size: 1.2em; text-align: center;">                            
                            <p><strong>EKSOTIS (Excellent One Treatment Service)</strong> adalah salah satu inovasi berupa layanan pada Pengadilan Agama Tenggarong.<br><strong>EKSOTIS</strong> memberikan layanan dalam satu loket.</p>                            
                            <ul class="list-group list-group-horizontal" style="display: flex; justify-content:center;">
                                <li class="list-group-item" style="background: #da2268;">Pengaduan & Informasi</li>
                                <li class="list-group-item" style="background: #ffaf00;">Pendaftaran</li>
                                <li class="list-group-item" style="background: #7cff02;">Pengambilan Produk</li>
                                <li class="list-group-item" style="background: #03a9f4;">E-Court</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="circle satu">
                            <h2>EKSOTIS</h2>
                        </div>
                        <div class="content satu">
                            <!-- <div class="row justify-content-center">
                                <div class="col-sm-6">
                                    <p style="text-align:center;">Pengaduan & Informasi</p>
                                </div>
                                <div class="col-sm-6">
                                    <p style="text-align:center;">Pendaftaran</p>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-6">
                                    <p style="text-align:center;">Pengambilan Produk</p>
                                </div>
                                <div class="col-sm-6">
                                    <p style="text-align:center;">E-Court</p>
                                </div>
                            </div> -->
                            <div class="text-center button">
                                <a href="#" onclick="ambil_antrian('pengaduan');">Ambil Antrian</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="circle empat">
                            <h2>Prioritas<br>Kaum Rentan</h2>
                        </div>
                        <div class="content empat">                            
                            <!-- <div class="row justify-content-center">
                                <div class="col-sm-6">
                                    <p style="text-align:center;">Disabilitas</p>
                                </div>
                                <div class="col-sm-6">
                                    <p style="text-align:center;">Wanita Hamil</p>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-6">
                                    <p style="text-align:center;">Ibu Menyusui</p>
                                </div>
                                <div class="col-sm-6">
                                    <p style="text-align:center;">Lansia</p>
                                </div>
                            </div> -->
                            <p class="text-center">Disabilitas, Wanita Hamil<br>Ibu Menyusui dan Lansia</p>
                            <div class="text-center button">
                                <a href="#" onclick="ambil_antrian('prioritas');">Ambil Antrian</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- kalo mau pakai kasir -->
                <!-- <div class="col-md-3">
                    <div class="card">
                        <div class="circle empat">
                            <h2>Kasir</h2>
                        </div>
                        <div class="content empat">
                            <ul>
                                <li>Pembayaran Perkara</li>
                                <li>Tambah Panjar</li>
                                <li>Pengembalian Sisa Panjar</li>
                            </ul>
                            <div class="text-center button">
                                <a href="#" onclick="ambil_antrian('kasir');">Ambil Antrian</a>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <!-- modal -->
        <div class="modal fade" id="modal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title w-100 text-center">nomor antrian anda </h4>
                    </div>
                    <div class="modal-body">
                        <p>Silahkan ambil struk anda, apabila struk tidak keluar harap diingat nomor antrian yang tampil pada layar</p>
                    </div>
                    <!-- <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- end modal -->
        <!-- loader -->
        <?php $this->load->view("_partials/loader.php") ?>
        <!-- end loader -->
        <div class="rvNotification"><div class="rvTextRow"><strong>Enable</strong> audio</div><div class="rvButtonRow"><div onclick="hilangkan();" class="rvButton rvButtonAllow">ALLOW</div></div></div>
    </div>
    <!-- jQuery -->
    <script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
    <!-- mine -->
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=0xxfQe7z"></script>
    <script src="<?php echo base_url('asset/mine/js/jam.min.js'); ?>"></script>
    <script>
        <?php
            $this->config->load('antrian_config',TRUE);
            $rsvc = $this->config->item('rsvc','antrian_config');
            $berurut = $this->config->item('berurut','antrian_config');
            $print = $this->config->item('print','antrian_config');
        ?>        
        var rsvc = <?php echo $rsvc; ?>;
        var berurut = <?php echo $berurut; ?>;
        const base_url = "<?php echo base_url(); ?>";
        const print = <?php echo $print; ?>;
        const voice = "Indonesian Male";
        
    </script>
    <script src="<?php echo base_url('asset/mine/js/antrian.js?').time(); ?>"></script>
</body>

</html>