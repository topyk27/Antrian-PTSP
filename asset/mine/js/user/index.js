var dt_user;
function hapusData(id)
{
    $.ajax({
        url: base_url+'setting/user_hapus/'+id,
        dataType: "text",
        success: function(respon)
        {
            if(respon==1)
            {
                dt_user.ajax.reload();
                $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'><strong>Selamat</strong> Data berhasil dihapus</div>")
                $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
            }
            else
            {
                $("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'><strong>Maaf</strong> Data gagal dihapus. Silahkan coba lagi.</div>")
                $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
            }
        }
    });
}
$(document).ready(function(){
    $("#sidebar_setting").addClass("active");
    $("#sidebar_setting_user").addClass("active");
    dt_user = $("#dt_user").DataTable({
        dom: 'Bfrtip',
        order: [[1, "asc"]],
        ajax: {
            url: base_url+'user/data_user',
            dataSrc: "",
        },
        columns: [
            {data: 'id'},
            {data: null, "sortable" : false, render: function(data,type,row, meta){
                return meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "username"},
            {data: "nama"},
            {data: "nama_layanan"},
            {data: null, "sortable" : false, render: function(data,type,row,meta){                
                return "<a href='"+base_url+"setting/user/ubah/"+row['id']+"' class='btn btn-warning'><i class='fas fa-edit'></i>Ubah</a>";                
            }},
            {data: null, "sortable" : false, render: function(data,type,row,meta){
                return "<a href='#' class='btn btn-danger deleteButton'><i class='fas fa-trash'></i>Hapus</a>";
            }}
        ],
        columnDefs: [
            {targets: 0, visible: false}
        ],
        responsive : true,
        autoWidth: false,
    });
    $("#dt_user tbody").on('click', 'tr .deleteButton', function(e){
        e.preventDefault();
        var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
        var data = $("#dt_user").DataTable().row(currentRow).data();
        $('#hapusModal').modal('show');
        $('#hapusModal').find('.modal-body').html("<p>Apakah anda ingin menghapus data "+data['nama']+"? Data ini tidak bisa dipulihkan kembali.");
        $('#hapusModal').find('#deleteButton').attr("onclick", "hapusData("+data['id']+")");
    });
});