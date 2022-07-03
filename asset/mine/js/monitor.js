$(document).ready(function(){
    var dt_pengaduan;
    var dt_pendaftaran;
    var dt_produk;
    var dt_ecourt;
    var dt_kasir;
    var dt_posbakum;
    var dt_bank;
    var dt_pos;
    dt_pengaduan = $("#dt_pengaduan").DataTable({
        ajax: {
            url: base_url+'antrian/antrian/pengaduan',
            dataSrc: ""
        },
        columns: [{
            data: "no"
        }],
        paging: false,
        ordering: false,
        info: false,
        searching: false,
        language: {
            emptyTable: "Tidak ada antrian"
        }
    });
    dt_pendaftaran = $("#dt_pendaftaran").DataTable({
        ajax: {
            url: base_url+'antrian/antrian/pendaftaran',
            dataSrc: ""
        },
        columns: [{
            data: "no"
        }],
        paging: false,
        ordering: false,
        info: false,
        searching: false,
        language: {
            emptyTable: "Tidak ada antrian"
        }
    });
    dt_produk = $("#dt_produk").DataTable({
        ajax: {
            url: base_url+'antrian/antrian/produk',
            dataSrc: ""
        },
        columns: [{
            data: "no"
        }],
        paging: false,
        ordering: false,
        info: false,
        searching: false,
        language: {
            emptyTable: "Tidak ada antrian"
        }
    });
    dt_ecourt = $("#dt_ecourt").DataTable({
        ajax: {
            url: base_url+'antrian/antrian/ecourt',
            dataSrc: ""
        },
        columns: [{
            data: "no"
        }],
        paging: false,
        ordering: false,
        info: false,
        searching: false,
        language: {
            emptyTable: "Tidak ada antrian"
        }
    });
    dt_kasir = $("#dt_kasir").DataTable({
        ajax: {
            url: base_url+'antrian/antrian/kasir',
            dataSrc: ""
        },
        columns: [{
            data: "no"
        }],
        paging: false,
        ordering: false,
        info: false,
        searching: false,
        language: {
            emptyTable: "Tidak ada antrian"
        }
    });
    dt_posbakum = $("#dt_posbakum").DataTable({
        ajax: {
            url: base_url+'antrian/antrian/posbakum',
            dataSrc: ""
        },
        columns: [{
            data: "no"
        }],
        paging: false,
        ordering: false,
        info: false,
        searching: false,
        language: {
            emptyTable: "Tidak ada antrian"
        }
    });
    dt_bank = $("#dt_bank").DataTable({
        ajax: {
            url: base_url+'antrian/antrian/bank',
            dataSrc: ""
        },
        columns: [{
            data: "no"
        }],
        paging: false,
        ordering: false,
        info: false,
        searching: false,
        language: {
            emptyTable: "Tidak ada antrian"
        }
    });
    dt_pos = $("#dt_pos").DataTable({
        ajax: {
            url: base_url+'antrian/antrian/pos',
            dataSrc: ""
        },
        columns: [{
            data: "no"
        }],
        paging: false,
        ordering: false,
        info: false,
        searching: false,
        language: {
            emptyTable: "Tidak ada antrian"
        }
    });
    setInterval(() => {
        dt_pengaduan.ajax.reload();
        dt_pendaftaran.ajax.reload();
        dt_produk.ajax.reload();
        dt_ecourt.ajax.reload();
        dt_kasir.ajax.reload();
        dt_posbakum.ajax.reload();
        dt_bank.ajax.reload();
        dt_pos.ajax.reload();
    }, 10000);
});