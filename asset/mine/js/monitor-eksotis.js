$(document).ready(function(){
    var dt_eksotis;    
    dt_eksotis = $("#dt_eksotis").DataTable({
        ajax: {
            url: base_url+'antrian/antrian/pengaduan',
            type: 'post',
            data: {
                layanan: 'pengaduan',
                monitor: true
            },
            dataSrc: ""
        },
        columns: [{
            data: "no"
        },{data: "layanan"}],
        columnDefs: [
            {
                targets: 1,
                visible: false,
            }
        ],
        createdRow: (row,data,dataIndex,cells) => {
            if(data.layanan == "prioritas")
            {
                $(row).addClass('prioritas');
            }            
        },
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
            type: 'post',
            data: {
                layanan: 'posbakum',
                monitor: true
            },
            dataSrc: ""
        },
        columns: [{
            data: "no"
        },{data:"layanan"}],
        columnDefs: [
            {
                targets: 1,
                visible: false,
            }
        ],
        createdRow: (row,data,dataIndex,cells) => {
            if(data.layanan == "prioritas")
            {
                $(row).addClass('prioritas');
            }            
        },
        paging: false,
        ordering: false,
        info: false,
        searching: false,
        language: {
            emptyTable: "Tidak ada antrian"
        }
    });
    
    setInterval(() => {
        dt_eksotis.ajax.reload();        
        dt_posbakum.ajax.reload();        
    }, 10000);
});