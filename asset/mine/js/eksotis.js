var dt_antrian;
var nomor_dipanggil;
var nomor_dipanggil_tanpa_kode;
var id_dipanggil;
let isPrioritas;
let toast_show = false;
$(document).ready(function(){
    $("#sidebar_antrian").addClass("active");
    dt_antrian = $("#dt_antrian").DataTable({
        dom: 'Bfrtip',
        ordering: false,
        searching: false,
        ajax: {
            type: 'post',
            url: base_url + 'antrian/antrian/' + layanan,
            data: {layanan:layanan},
            dataSrc: ''
        },
        columns: [
            {
                data: 'id'
            },
            {
                data: null, sortable: false, render: function(data,type,row,meta){
                    return berurut ? kode+row['no'] : row['no'];
                }
            },
            {
                data: 'status', sortable:false,
            },
            {
                data: 'catatan',
            },
            {
                data: 'ke'
            },
            {
                data: 'layanan'
            },
            {
                data: null, sortable: false, render: function(data,type,row,meta){
                    let isPrior = 0;
                    if(row['layanan'] == 'prioritas')
                    {
                        isPrior = 1;
                    }
                    return "<a href='#' onclick='panggil(" + row['id'] + "," + row['no'] + "," + isPrior + ")' class='btn btn-primary'><i class='fas fa-phone'></i> Panggil</a>";
                }
            }
        ],
        columnDefs: [
            {
                targets: [0,4],
                visible: false
            },
            {
                targets: '_all',
                className: 'text-center',
                orderable: false
            }
        ],
        createdRow: (row,data,dataIndex,cells) => {
            if(data.layanan == 'prioritas')
            {
                $(row).addClass('prioritas');
                ada_prioritas(data.no);
            }
            // cek_prioritas();
        },
        responsive: true,
        autoWidth: false
    });
    setInterval(() => {
        dt_antrian.ajax.reload(null,false);
    }, 5000);
    dt_antrian.on('draw', function(){
        cek_prioritas();
    });
    $("#btn_pengumuman").click(function() {
        $("#pengumumanModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
    $("#modal_pengumuman").click(function(){
        let pengumuman = $("#text_pengumuman").val();
        $.ajax({
            type: 'POST',
            url: base_url+'antrian/panggil',
            data: {
                no: 0,
                layanan: 'pengumuman',
                pengumuman: pengumuman,
            },
            dataType: 'json',
            beforeSend: function()
            {
                $('.loader2').show();
            },
            success: function(respon)
            {
                if(respon.success == 1)
                {
                    cek_panggilan_pengumuman(respon.id);
                }
                else
                {
                    $('.loader2').hide();
                    alert('Gagal memanggil, silahkan coba lagi');
                }
            },
            error: function(err)
            {
                console.log(err.responseText);
                $('.loader2').hide();
                alert('Gagal memanggil, silahkan coba lagi');
            }
        });
    });
});
const panggil = (id,no,isPrior) => {
    nomor_dipanggil_tanpa_kode = no;
    no = berurut ? kode+no : no;
    isPrioritas = isPrior;
    $.ajax({
        type: 'post',
        url: base_url+'antrian/panggil',
        data: {
            no: no,
            layanan: loket,
            prioritas: isPrior
        },
        dataType: 'json',
        beforeSend: function()
        {
            $('.loader2').show();
        },
        success: function(respon)
        {
            if(respon.success == 1)
            {
                nomor_dipanggil = no;
                id_dipanggil = id;
                cek_panggilan(respon.id)
            }
            else
            {
                $(".loader2").hide();
                alert("gagal memanggil, silahkan coba lagi");
            }
        },
        error: function(err)
        {
            console.log(err.responseText);
            $('.loader2').hide();
            alert("gagal memanggil, silahkan coba lagi");
        }
    });
}

const panggil_lagi = () =>
{
    panggil(id_dipanggil,nomor_dipanggil_tanpa_kode,isPrioritas);
}

const cek_panggilan = (id) =>
{
    let terpanggil = false;
    $.ajax({
        type: 'post',
        url: base_url+'antrian/cek_panggilan',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(respon)
        {
            if(respon.efek != 1)
            {
                terpanggil = true;
            }
        },
        complete: function()
        {
            if(terpanggil)
            {
                $('#modal-title').text('Nomor Antrian ' + nomor_dipanggil);
                $('#alasanTunda').val('');
                $("#modal").modal({
                    backdrop: 'static',
                    keyboard: false
                });
                if(berurut==false)
                {
                    ke();
                }
                else
                {
                    $(".loader2").hide();
                }
            }
            else
            {
                setTimeout(() => {
                    cek_panggilan(id);
                }, 3000);
            }
        }
    });
}

const cek_panggilan_pengumuman = (id) =>
{
    let terpanggil = false;
    $.ajax({
        type: 'post',
        url: base_url+'antrian/cek_panggilan',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(respon)
        {
            if(respon.efek != 1)
            {
                terpanggil = true;
            }
        },
        complete: function()
        {
            if(terpanggil)
            {
                $(".loader2").hide();
            }
            else
            {
                setTimeout(() => {
                    cek_panggilan_pengumuman(id);
                }, 3000);
            }
        }
    })
}

const ke = () => 
{
    let opt_ke = $("#ke");
    const empatLoket = isNaN(loket); // if true berarti loket posbakum kasir bank pos
    $.ajax({
        type: 'post',
        url: base_url+'setting/data_layanan',
        data: {
            loket: empatLoket
        },
        dataType: 'json',
        success: function(data)
        {
            $("#ke").empty();
            for(let i=0;i<data.length;i++)
            {
                let obj = data[i];
                $("#ke").append("<option value=" + obj.layanan + ">" + obj.nama_layanan + "</option>");
            }            
        },
        error: function(err)
        {
            console.log(err.responseText);
        },
        complete: function()
        {
            $(".loader2").hide();
        }
    });
}

const arahkan = () =>
{
    const ke = $("#ke").val();
    const ke_nama_layanan = $("#ke option:selected").text();
    const alasanTunda = $("#alasanTunda").val().trim();
    $.ajax({
        type: 'post',
        url: base_url+'antrian/ubah',
        data: {id:id_dipanggil,ke:ke,alasan:alasanTunda},
        dataType: 'json',
        beforeSend: function()
        {
            $(".loader2").show();
        },
        success: function(respon)
        {
            if(respon.success==1)
            {
                $("#modal").modal('toggle');
                toast_show = false;
                dt_antrian.ajax.reload();
                $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'><strong>Selamat</strong> Antrian berhasil diarahkan ke "+ke_nama_layanan+"</div>");
                $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
            }
            else
            {
                alert("maaf ada kesalahan, mohon coba kembali");
            }
        },
        error: function(err)
        {
            console.log(err.responseText);
        },
        complete: function()
        {
            $(".loader2").hide();
        }
    });
}

const tunda = () =>
{
    const ke = "tunda";
    const alasanTUnda = $("#alasanTunda").val().trim();
    if(alasanTUnda == '')
    {
        alert('Silahkan isi alasan menunda antrian');
        return;
    }
    $.ajax({
        type: 'post',
        url: base_url+'antrian/ubah',
        data: {
            id: id_dipanggil,
            ke: ke,
            alasan: alasanTUnda
        },
        dataType: 'json',
        beforeSend: function()
        {
            $(".loader2").show();
        },
        success: function(respon)
        {
            if(respon.success==1)
            {
                $("#modal").modal('toggle');
                toast_show = false;
                dt_antrian.ajax.reload();
                $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'><strong>Selamat</strong> Antrian berhasil ditunda</div>");
                $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
            }
            else
            {
                alert("maaf ada kesalahan, mohon coba kembali");
            }
        },
        error: function(err)
        {
            console.log(err.responseText);
        },
        complete: function()
        {
            $(".loader2").hide();
        }
    });
}

const hapus = () =>
{
    $.ajax({
        type: 'post',
        url: base_url+'antrian/hapus',
        data: {id:id_dipanggil},
        dataType: 'text',
        beforeSend: function()
        {
            $(".loader2").show();
        },
        success: function(respon)
        {
            if(respon==1)
            {
                $("#modal").modal('toggle');
                toast_show = false;
                dt_antrian.ajax.reload();
                $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'><strong>Selamat</strong> Antrian berhasil dihapus</div>");
                $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
            }
            else
            {
                alert("maaf ada kesalahan, mohon coba kembali");
            }
        },
        error: function(err)
        {
            console.log(err.responseText);
        },
        complete: function()
        {
            $(".loader2").hide();
        }
    });
}

const ada_prioritas = (no) =>
{
    if(toast_show == false)
    {
        $(".toast-body").html(`Nomor antrian <span style="color: red;">${no}</span> adalah prioritas, mohon untuk segera dipanggil`);
        $('#toast_ku').toast('show');
        toast_show = true;
    }
}

const cek_prioritas = () =>
{    
    if(!dt_antrian.rows('.prioritas').any())
    {
        $('#toast_ku').toast('hide');
    }
}