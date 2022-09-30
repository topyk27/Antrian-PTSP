var dt_antrian;
var nomor_dipanggil;
var nomor_dipanggil_tanpa_kode;
var id_dipanggil;
let toast_show = false;
$(document).ready(function() {
    $("#sidebar_antrian").addClass("active");
    dt_antrian = $("#dt_antrian").DataTable({
        dom: 'Bfrtip',
        ordering: false,
        searching: false,
        ajax: {
            url: base_url + 'antrian/antrian/' + layanan,
            dataSrc: "",
        },
        columns: [{
                data: 'id'
            },
            // {
            //     data: null,
            //     "sortable": false,
            //     render: function(data, type, row, meta) {
            //         return meta.row + meta.settings._iDisplayStart + 1;
            //     }
            // },
            {
                data: null, sortable: false, render: function(data,type,row,meta)
                {
                    return berurut ? kode+row['no'] : row['no'];

                }
            },
            {
                data: 'status', sortable: false,
            },
            {
                data: 'layanan'
            },
            {
                data: null,
                "sortable": false,
                render: function(data, type, row, meta) {
                    return "<a href='#' onclick='panggil(" + row['id'] + "," + row['no'] + ")' class='btn btn-primary'><i class='fas fa-phone'></i> Panggil</a>";
                }
            },
        ],        
        columnDefs: [{
                targets: [0,3],
                visible: false
            },
            {
                targets: '_all',
                className: 'text-center',
                orderable: false,
            }            
        ],
        createdRow: (row,data,dataIndex,cells) => {
            if(data.layanan == "prioritas")
            {
                $(row).addClass('prioritas');
                ada_prioritas(data.no);
            }
            cek_prioritas();
        },
        responsive: true,
        autoWidth: false,
    });
    
    setInterval(() => {
        dt_antrian.ajax.reload(null,false);
    }, 5000);
    // pengumuman
    $("#btn_pengumuman").click(function() {
        $("#pengumumanModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
    $("#modal_pengumuman").click(function(){
        pengumuman = $("#text_pengumuman").val();
        $.ajax({
            type: 'post',
            url: base_url+"antrian/panggil",
            data: {
                no: 0,
                layanan: 'pengumuman',
                pengumuman: pengumuman
            },
            dataType: 'json',
            beforeSend: function()
            {
                // console.log('beforesend');
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
                    $(".loader2").hide();
                    alert("gagal memanggil, silahkan coba lagi");
                }
            },
            error: function(err)
            {
                console.log(err.responseText);
                $(".loader2").hide();
                alert("gagal memanggil, silahkan coba lagi");
            }
        });
    });
    // end pengumuman
});

function panggil(id, no) {
    nomor_dipanggil_tanpa_kode = no;
    no = berurut ? kode+no : no;
    $.ajax({
        type: 'post',
        url: base_url + 'antrian/panggil',
        data: {
            no: no,
            layanan: nama_layanan
        },
        dataType: 'json',
        beforeSend: function() {
            // console.log('beforesend');
            $('.loader2').show();
        },
        success: function(respon) {
            if (respon.success == 1) {
                nomor_dipanggil = no;
                id_dipanggil = id;
                cek_panggilan(respon.id);                        
                // console.log('nomor dipanggil = ' +nomor_dipanggil);
                // console.log('id_dipanggil = ' +id_dipanggil);
            } else {
                $(".loader2").hide();
                alert("gagal memanggil, silahkan coba lagi");
            }
        },
        error: function(err) {
            console.log(err.responseText);
            $(".loader2").hide();
            alert("gagal memanggil, silahkan coba lagi");
        }
    });
}

function panggil_lagi()
{
    panggil(id_dipanggil,nomor_dipanggil_tanpa_kode);
}

function cek_panggilan(id) {
    let terpanggil = false;
    $.ajax({
        type: 'post',
        url: base_url + 'antrian/cek_panggilan',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(respon) {
            if (respon.efek != 1) {
                terpanggil = true;
            }
        },
        complete: function() {
            if (terpanggil) {
                // $(".loader2").hide();
                $('#modal-title').text('Nomor Antrian ' + nomor_dipanggil);
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
            } else {
                setTimeout(() => {
                    cek_panggilan(id);
                }, 3000);
            }
        }
    });
}

function cek_panggilan_pengumuman(id)
{
    let terpanggil = false;
    $.ajax({
        type: 'post',
        url: base_url + 'antrian/cek_panggilan',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(respon) {
            if (respon.efek != 1) {
                terpanggil = true;
            }
        },
        complete: function() {
            if (terpanggil) {
                $(".loader2").hide();                        
            } else {
                setTimeout(() => {
                    cek_panggilan_pengumuman(id);
                }, 3000);
            }
        }
    });

}

function ke() {
    let opt_ke = $("#ke");
    $.ajax({
        type: 'get',
        url: base_url + 'setting/data_layanan',
        dataType: 'json',
        success: function(data) {
            $("#ke").empty();
            for (let i = 0; i < data.length; i++) {
                let obj = data[i];
                $("#ke").append("<option value=" + obj.layanan + ">" + obj.nama_layanan + "</option>");
            }
            switch (layanan) {
                case "pengaduan":
                    opt_ke.val("posbakum");
                    break;
                case "pendaftaran":
                    opt_ke.val("kasir");
                    break;
                case "produk":
                    opt_ke.val("kasir");
                    break;
                case "ecourt":
                    opt_ke.val("bank");
                    break;
                case "kasir":
                    opt_ke.val("pendaftaran");
                    break;
                case "posbakum":
                    opt_ke.val("pendaftaran");
                    break;
                case "bank":
                    opt_ke.val("ecourt");
                    break;
                case "pos":
                    opt_ke.val("pendaftaran");
                    break;
            }
        },
        error: function(err) {
            console.log(err.responseText);
        },
        complete: function() {
            $(".loader2").hide();
        }
    });

}        

function arahkan()
{
    let ke = $("#ke").val();
    let ke_nama_layanan = $("#ke option:selected").text();
    $.ajax({
        type: 'post',
        url: base_url+'antrian/ubah',
        data: {id:id_dipanggil,ke:ke},
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
                $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'><strong>Selamat</strong> Antrian berhasil diarahkan ke "+ke_nama_layanan+"</div>")
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

function tunda()
{
    let ke ="tunda";
    $.ajax({
        type: 'post',
        url: base_url+'antrian/ubah',
        data: {id:id_dipanggil,ke:ke},
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
                $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'><strong>Selamat</strong> Antrian berhasil ditunda</div>")
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

function hapus()
{
    $.ajax({
        type: 'post',
        url: base_url+'antrian/hapus',
        data: {id:id_dipanggil},
        dataType: 'text',
        success: function(respon)
        {
            if(respon==1)
            {
                $("#modal").modal('toggle');
                toast_show = false;
                dt_antrian.ajax.reload();
                $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'><strong>Selamat</strong> Antrian berhasil dihapus</div>")
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

function ada_prioritas(no) {
    if(toast_show == false)
    {
        $(".toast-body").html(`Nomor antrian <span style="color: red;">${no}</span> adalah prioritas, mohon untuk segera dipanggil`);
        $('#toast_ku').toast('show');
        toast_show = true;
    }
}
function cek_prioritas()
{
    if(!dt_antrian.rows('.prioritas').any())
    {
        $('#toast_ku').toast('hide');
    }
}