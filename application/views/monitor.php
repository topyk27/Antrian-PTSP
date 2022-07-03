<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor</title>    
    <link rel="icon" type="image/png" href="<?php echo base_url('asset/img/icon.png'); ?>">
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
                                <h2 class="text-uppercase">PENGADILAN AGAMA <?php echo $setting->nama_pa; ?></h2>
                                <h5><?php echo $setting->alamat; ?></h5>
                                <div class="row">
                                    <?php if(!empty($setting->telepon)): ?>
                                    <div class="col-md-3">
                                        <span><i class="fas fa-phone"></i> <?php echo $setting->telepon; ?> </span>
                                    </div>
                                    <?php endif; if(!empty($setting->facebook)):?>
                                    <div class="col-md-3">
                                        <span><i class="fab fa-facebook"></i> <?php echo $setting->facebook; ?> </span>
                                    </div>
                                    <?php endif; if(!empty($setting->instagram)):?>
                                    <div class="col-md-3">
                                        <span><i class="fab fa-instagram"></i> <?php echo $setting->instagram; ?> </span>
                                    </div>
                                    <?php endif; if(!empty($setting->twitter)):?>
                                    <div class="col-md-3">
                                        <span><i class="fab fa-twitter"></i> <?php echo $setting->twitter; ?> </span>
                                    </div>
                                    <?php endif; ?>
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
    <script src="<?php echo base_url('asset/mine/js/monitor-cpr.js') ?>"></script>
    <script>const base_url = "<?php echo base_url(); ?>";</script>    
    <script src="<?php echo base_url('asset/mine/js/monitor.js'); ?>"></script>
</body>
</html>