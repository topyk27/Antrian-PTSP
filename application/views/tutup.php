<!DOCTYPE html>
<html lang="ID">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTSP | Tutup</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/mine/css/main.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/mine/css/util.css') ?>">
    <style>.rvNotification{position:fixed;background-color:#fff;text-align:center;font-family:-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;font-weight:400;line-height:1.5;box-shadow:0 4px 8px 0 rgba(0,0,0,.2),0 6px 20px 0 rgba(0,0,0,.19);z-index:10000;width:100vw;left:0;bottom:0;font-size:1rem;padding-bottom:.5em;padding-right:.5em}.rvButtonRow{padding-right:2em;padding-bottom:1em;text-align:right;font-size:medium}.rvButton{cursor:pointer;display:inline-block;margin-left:1em;padding:.8em 2em;border-radius:3px;font-size:small}.rvButtonAllow{border:none;background-color:#2b8cff;color:#fff}.rvButtonDeny{border:1px solid #2b8cff;color:#2b8cff;background-color:#fff}.rvTextRow{padding-top:1em;padding-bottom:2em}@media (min-width:576px){.rvNotification{width:60vw;left:20vw}}@media (min-width:768px){.rvNotification{width:50vw;left:25vw}}@media (min-width:992px){.rvNotification{width:40vw;left:30vw}}@media (min-width:1200px){.rvNotification{width:30vw;left:35vw}}</style>
</head>
<body>
    <div class="bg-g1 size1 flex-w flex-col-c-sb p-l-15 p-r-15 p-t-55 p-b-35 respon1">
        <span></span>
        <div class="flex-col-c p-t-50 p-b-50">
            <h3 class="l1-txt1 txt-center p-b-10">
                Pengambilan Nomor Antrian PTSP Tutup
            </h3>
            <p class="txt-center l1-txt2 p-b-60">
                Silahkan kembali lagi pada hari
            </p>
            <div class="flex-w flex-c cd100 p-b-82">
                <div class="flex-col-c-m size3 how-countdown">
                    <span class="s1-txt1">Hari</span>
                    <span class="l1-txt3 p-b-9 days" id="hari"></span>
                </div>
                <div class="flex-col-c-m size2 how-countdown">
                    <span class="s1-txt1">Tanggal</span>
                    <span class="l1-txt3 p-b-9 hours" id="tanggal"></span>
                </div>
                <div class="flex-col-c-m size2 how-countdown">
                    <span class="s1-txt1">Bulan</span>
                    <span class="l1-txt3 p-b-9 minutes" id="bulan"></span>
                </div>
                <div class="flex-col-c-m size how-countdown">
                    <span class="s1-txt1">Tahun</span>
                    <span class="l1-txt3 p-b-9 seconds" id="tahun"></span>
                </div>
            </div>
        </div>
        <span class="s1-txt3 txt-center">
        Copyright &copy; <?php echo date("Y"); ?> <a href="https://topyk27.github.io/" target="_blank" style="color:#43d8c9;">Taufik Dwi Wahyu Putra</a>
        </span>
        <div class="rvNotification"><div class="rvTextRow"><strong>Enable</strong> audio</div><div class="rvButtonRow"><div onclick="hilangkan();" class="rvButton rvButtonAllow">ALLOW</div></div></div>
    </div>
    <!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=0xxfQe7z"></script>
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
    <script>
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
        else
        {
            responsiveVoice.clickEvent();
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
			// cek_panggil();
			var nama_hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu'];
			var besok = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
			var tanggal = besok.getDate();
			var bulan = besok.getMonth() + 1;
			var tahun = besok.getFullYear();
			var hari = nama_hari[besok.getDay()];

			if (hari == "Sabtu") //berarti ngeceknya pas hari jumat
			{
				besok = new Date(new Date().getTime() + 72 * 60 * 60 * 1000);
				tanggal = besok.getDate();
				bulan = besok.getMonth() + 1;
				tahun = besok.getFullYear();
				hari = nama_hari[besok.getDay()];
			}
			else if(hari == "Minggu") //berarti ngeceknya pas hari sabtu
			{
				besok = new Date(new Date().getTime() + 48 * 60 * 60 * 1000);
				tanggal = besok.getDate();
				bulan = besok.getMonth() + 1;
				tahun = besok.getFullYear();
				hari = nama_hari[besok.getDay()];
			}
			
			$("#hari").text(hari);
			$("#tanggal").text(tanggal);
			$("#bulan").text(bulan);
			$("#tahun").text(tahun);			
		});
    </script>
	
</body>
</html>