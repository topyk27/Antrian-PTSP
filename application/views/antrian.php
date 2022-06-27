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
                <div class="col-md-4">
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
                <div class="col-md-4">
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
                <div class="col-md-4">
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
    <script src="<?php echo base_url('asset/mine/js/jam.js') ?>"></script>
    <script>
        <?php
            $this->config->load('antrian_config',TRUE);
            $rsvc = $this->config->item('rsvc','antrian_config');
            $berurut = $this->config->item('berurut','antrian_config');
        ?>        
        var rsvc = <?php echo $rsvc; ?>;
        var berurut = <?php echo $berurut; ?>;
        const base_url = "<?php echo base_url(); ?>";
        const print = false;
        const voice = "Indonesian Male";
    </script>
    <script type="text/javascript">
        var msg = new SpeechSynthesisUtterance();
        var suara;
        var myTimeout;
        function myTimer()
        {
            speechSynthesis.pause();
            speechSynthesis.resume();
            myTimeout = setTimeout(myTimer, 10000);
        }
        if(rsvc==false)
        {
            setTimeout(() => {		
                suara = window.speechSynthesis.getVoices();		
                msg.voice = suara[11];	
                msg.lang = 'in-ID';
                msg.rate = 0.9;		
            }, 1000);
        }
        function ambil_antrian(kode) {
            $.ajax({
                type: 'get',
                url: base_url + "antrian/tambah/" + kode,
                dataType: 'json',
                beforeSend: function() {
                    console.log("before send");
                    $(".loader2").show();
                },
                success: function(data) {
                    
                    if (data.success != 1) {
                        alert("gagal ambil nomor antrian");
                    } else {
                        if (print) {
                            console.log("jalankan fungsi cetak");
                            cetak(data.no);
                        } else {
                            $(".loader2").hide();
                            $(".modal-title").text("Nomor antrian anda " + data.no);
                            $("#modal").modal('show');
                            setTimeout(() => {
                                $("#modal").modal('hide');
                            }, 5000);
                        }
                    }
                },
                error: function(err) {
                    console.log(err.responseText);
                    alert("ada kesalahan, harap refresh halaman");
                },
                complete: function() {
                    // $("#modal").modal('hide');
                }
            });
        }

        function cetak(no) {
            $.ajax({
                type: 'POST',
                url: base_url + "antrian/cetak",
                data: {
                    no: no
                },
                dataType: 'json',
                beforeSend: function() {
                    console.log("nomor " + no);
                },
                success: function(respon) {
                    console.log(respon);
                    if (respon.success == 1) {
                        console.log("berhasil kirim data ke printer");
                    } else {
                        alert("gagal kirim data ke printer");
                    }
                },
                error: function(err, jqXHR, exception) {
                    console.log(err);
                    console.log(jqXHR.status);
                    console.log(exception);
                    console.log(err.responseText);
                },
                complete: function() {
                    $(".loader2").hide();
                    $(".modal-title").text("Nomor antrian anda " + no);
                    $("#modal").modal('show');
                    setTimeout(() => {
                        $("#modal").modal('hide');
                    }, 5000);
                }
            });
        }

        function cek_panggil()
        {
            $.ajax({
                type: 'get',
                url: base_url+'antrian/panggil_antrian',
                dataType: 'json',
                success: function(respon)
                {
                    if(respon.success==1)
                    {
                        memanggil_antrian(respon.id,respon.no,respon.layanan,respon.pengumuman);
                    }
                    else
                    {
                        setTimeout(() => {
                            cek_panggil();
                        }, 3000);
                    }
                },
                error: function(err)
                {
                    console.log(err.responseText);
                }
            });
        }

        function memanggil_antrian(id,no,layanan,pengumuman)
        {
            let text;
            if(pengumuman != null)
            {
                text = pengumuman;
            }
            else
            {
                text = "Dipanggil nomor antrian " + no + ". Silahkan ke layanan " + layanan;
            }
            if(rsvc != false)
            {
                responsiveVoice.speak(text,voice, {rate: 0.9, onend: function(){
                    hapus_panggil_antrian(id)
                }});
            }
            else
            {
                myTimeout = setTimeout(myTimer, 10000);
                msg.text = text;
                msg.onend = function()
                {
                    hapus_panggil_antrian(id);
                }
                speechSynthesis.speak(msg);
            }
            // responsiveVoice.speak(text,voice, {
            //     rate: 0.9, onend: function(){
            //         setTimeout(function(){
            //             responsiveVoice.speak(text,voice, {rate: 0.9, onend: hapus_panggil_antrian(id)});
            //         },2000);
            //     }
            // });
        }

        function hapus_panggil_antrian(id)
        {
            $.ajax({
                type: 'post',
                url: base_url+'antrian/hapus_panggil_antrian',
                data: {id:id},
                dataType: 'json',
                success: function(respon)
                {
                    if(respon.success==1)
                    {
                        setTimeout(cek_panggil,3000);
                    }
                },
                complete: function()
                {
                    // setTimeout(cek_panggil,7000);
                }
            });
        }
        function hilangkan()
        {
            cek_panggil();
            $('.rvNotification').remove();
        }

        $(document).ready(function(){
            // if(confirm('pencet ok'))
            // {
            //     cek_panggil();
            // }
        });
    </script>
</body>

</html>