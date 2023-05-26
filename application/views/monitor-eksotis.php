<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor</title>    
    <link rel="icon" type="image/png" href="<?php echo base_url('asset/img/icon.png'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/dist/css/adminlte.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/fontawesome-free/css/all.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/mine/css/antrian.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/mine/css/monitor.css'); ?>">
    <style>
        .card {
            height: 60vh;
        }
        table {
            top: 0;
        }
    </style>
    
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-title text-center" style="background: #03a9f4; color:white;">
                            <h2>EKSOTIS</h2>
                        </div>
                        <div class="card-body">
                            <table id="dt_eksotis" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="color: black;">Nomor Antrian Selanjutnya</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-title text-center" style="background: #7cff02; color:white;">
                            <h2>POSBAKUM</h2>
                        </div>
                        <div class="card-body">
                            <table id="dt_posbakum" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="color: black;">Nomor Antrian Selanjutnya</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>           
        </div>
    </div>
    <!-- jQuery -->
    <script src="<?php echo base_url('asset/js/jquery/jquery.min.js'); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js'); ?>"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url('asset/plugin/datatables/jquery.dataTables.min.js'); ?>"></script>
    <!-- mine -->
    <script src="<?php echo base_url('asset/mine/js/jam.js?'); ?>"></script>
    <script src="<?php echo base_url('asset/mine/js/monitor-cpr.js?').time(); ?>"></script>
    <script>const base_url = "<?php echo base_url(); ?>";</script>    
    <script src="<?php echo base_url('asset/mine/js/monitor-eksotis.min.js?').time(); ?>"></script>
        
</body>
</html>