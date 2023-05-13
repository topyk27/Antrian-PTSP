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
                memanggil_antrian(respon.id,respon.no,respon.layanan,respon.prioritas,respon.pengumuman);
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
function memanggil_antrian(id,no,layanan,prioritas,pengumuman)
{
    let text;
    if(pengumuman != null)
    {
        text = pengumuman;
    }
    else if(prioritas == 1)
    {
        text = "Dipanggil antrian prioritas disabilitas dengan nomor antrian " + no + ". Silahkan ke loket " + layanan;
    }
    else
    {
        text = "Dipanggil nomor antrian " + no + ". Silahkan ke loket " + layanan;
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