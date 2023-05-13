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
            // console.log("before send");
            $(".loader2").show();
        },
        success: function(data) {
            
            if (data.success != 1) {
                alert("gagal ambil nomor antrian");
            } else {
                if (print) {
                    // console.log("jalankan fungsi cetak");
                    cetak(data.no,kode);
                } else {
                    $(".loader2").hide();
                    // console.log(data.no);
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

function cetak(no,kode) {
    let layanan;
    switch (kode) {
        case 'pengaduan':
            layanan = 'Pengaduan';
            break;
        case 'produk':
            layanan = 'Produk';
            break;
        case 'ecourt':
            layanan = 'E-Court'
            break;
        case 'prioritas':
            layanan = 'Prioritas';
            break;
        default:
            layanan = 'Entahlah';
            break;
    }
    // console.log('ini kode : ' + kode);
    // console.log('ini layanan : ' + layanan);
    $.ajax({
        type: 'POST',
        url: base_url + "antrian/cetak",
        data: {
            no: no,
            layanan: layanan,
        },
        dataType: 'json',
        beforeSend: function() {
            // console.log("nomor " + no);
        },
        success: function(respon) {
            // console.log(respon);
            if (respon.success == 1) {
                // console.log("berhasil kirim data ke printer");
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
function load_tutup()
{    
    $.ajax({
        type: 'GET',
        url: base_url+'setting/get_jam_tutup',
        dataType: 'TEXT',
        success: function(data)
        {
            cek_tutup(data);
        },
        error: function(err)
        {            
            if(confirm('Ada kesalahan, silahkan refresh'))
            {
                location.reload();
            }
        }
    });
}

function cek_tutup(data)
{
    try {
        var sekarang = new Date();
        var jam_tutup = new Date();
        var d = data.split(":");
        jam_tutup.setHours(d[0],d[1],0);
        if(jam_tutup.getHours() == sekarang.getHours())
        {
            if(jam_tutup.getMinutes() < sekarang.getMinutes())
            {
                if(!responsiveVoice.isPlaying())
                {
                    window.location.replace(base_url+'tutup');
                }
            }
        }
        else if(jam_tutup.getHours() < sekarang.getHours())
        {
            if(!responsiveVoice.isPlaying())
            {
                window.location.replace(base_url+'tutup');
            }
        }
    } catch (error) {        
        if(confirm('Ada kesalahan, silahkan refresh'))
        {
            location.reload();
        }
    }
    setTimeout(() => {
        cek_tutup(data);
    }, 30000);
}