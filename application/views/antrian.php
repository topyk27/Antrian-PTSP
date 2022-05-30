<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian PTSP</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/mine/css/loader.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/mine/css/antrian.css') ?>">
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
                                <!-- <span><i class="fab fa-youtube"></i> Pengadilan Agama Tenggarong </span> -->
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
                        <div class="circle satu">
                            <h2>Pengaduan<br>dan<br>Informasi</h2>
                        </div>
                        <div class="content satu">
                            <ul>
                                <li>Informasi Perkara</li>
                                <li>Informasi Pendaftaran</li>
                            </ul>
                            <div class="text-center button">
                                <a href="#" onclick="ambil_antrian('pengaduan');">Ambil Antrian</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="circle dua">
                            <h2>Pengambilan Produk</h2>
                        </div>
                        <div class="content dua">
                            <ul>
                                <li>Pengambilan Akta Cerai</li>
                                <li>Pengambilan Salinan Putusan</li>
                                <li>Pengambilan Salinan Penetapan</li>
                            </ul>
                            <div class="text-center button">
                                <a href="#" onclick="ambil_antrian('produk');">Ambil Antrian</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="circle tiga">
                            <h2>E-Court</h2>
                        </div>
                        <div class="content tiga">
                            <ul>
                                <li>Informasi E-Court</li>
                                <li>Pendaftaran E-Court</li>
                            </ul>
                            <div class="text-center button">
                                <a href="#" onclick="ambil_antrian('ecourt');">Ambil Antrian</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
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
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
    <script type="text/javascript">
		function updateClock(){
		      var now = new Date();
		      var dname = now.getDay(),
		          mo = now.getMonth(),
		          dnum = now.getDate(),
		          yr = now.getFullYear(),
		          hou = now.getHours(),
		          min = now.getMinutes(),
		          sec = now.getSeconds(),
		          pe = "AM";

		          if(hou >= 12){
		            pe = "PM";
		          }
		          if(hou == 0){
		            hou = 12;
		          }
		          if(hou > 12){
		            hou = hou - 12;
		          }

		          Number.prototype.pad = function(digits){
		            for(var n = this.toString(); n.length < digits; n = 0 + n);
		            return n;
		          }

		          var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
		          var week = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
		          // var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
		          var ids = ["month", "daynum", "year", "hour", "minutes", "seconds", "period"];
		          // var values = [week[dname], dnum.pad(2), months[mo], yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
		          var values = [dnum.pad(2), months[mo], yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
		          for(var i = 0; i < ids.length; i++)
		          document.getElementById(ids[i]).firstChild.nodeValue = values[i];
		    }

		    function initClock(){
		      updateClock();
		      window.setInterval("updateClock()", 1);
		    }
		    initClock();
	</script>
</body>
</html>