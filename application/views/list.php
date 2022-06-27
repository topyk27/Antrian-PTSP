<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian <?php echo $this->session->userdata('nama_layanan'); ?></title>
    <?php $this->load->view("_partials/css.php") ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view("_partials/navbar.php") ?>
        <?php $this->load->view("_partials/sidebar_container.php") ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Antrian <?php echo $this->session->userdata('nama_layanan'); ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Antrian</a></li>
                                <li class="breadcrumb-item active"><?php echo $this->session->userdata('nama_layanan'); ?></li>
                            </ol>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-primary" id="btn_pengumuman"><i class="fas fa-bullhorn"></i> Pengumuman</button>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-12" id="respon"></div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <table id="dt_antrian" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <!-- <th>#</th> -->
                                            <th>Antrian</th>
                                            <th>Status</th>
                                            <th>Panggil</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view("_partials/numpang.php") ?>
            </section>
        </div>
        <?php $this->load->view("_partials/footer.php") ?>
        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>
    <div class="modal fade" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                $this->config->load('antrian_config',TRUE);
                $berurut = $this->config->item('berurut','antrian_config');
                if($berurut=='false') :
                ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ke">Arahkan ke :</label>
                        <select name="ke" id="ke" class="form-control <?php echo form_error('layanan') ? 'is-invalid' : '' ?>">
                            
                        </select>
                        <div class="invalid-feedback">
                            <?php echo form_error('layanan'); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="modal-footer justify-content-between">
                    <?php if($berurut=='false'): ?>
                    <button id="btn_arahkan" type="button" class="btn btn-primary" onclick="arahkan()">Arahkan</button>
                    <?php endif; ?>
                    <button id="btn_tunda" type="button" class="btn btn-warning" onclick="tunda()">Tunda</button>
                    <button type="button" class="btn btn-success" onclick="panggil_lagi()">Panggil</button>
                    <button id="btn_hapus" type="button" class="btn btn-danger" onclick="hapus()">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <div id="pengumumanModal" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header flex-column">
					<div class="icon-box">
						<i class="material-icons">campaign</i>
					</div>
					<h4 class="modal-title w-100">Umumkan</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<textarea id="text_pengumuman" rows="3" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer justify-content-center">
					<button type="button" class="btn btn-success" data-dismiss="modal" id="modal_pengumuman">Umumkan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
    <?php $this->load->view("_partials/loader.php") ?>
    <!-- jQuery -->
    <script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
    <!-- datatables -->
    <script src="<?php echo base_url('asset/plugin/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('asset/plugin/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?php echo base_url('asset/plugin/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?php echo base_url('asset/plugin/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
    <script>
        const base_url = "<?php echo base_url(); ?>";
        const layanan = "<?php echo $this->session->userdata('layanan'); ?>";
        const nama_layanan = "<?php echo $this->session->userdata('nama_layanan'); ?>";
        const kode = "<?php echo $this->session->userdata('kode'); ?>";        
        var berurut = <?php echo $berurut; ?>;
    </script>
    <script>
        var dt_antrian;
        var nomor_dipanggil;
        var nomor_dipanggil_tanpa_kode;
        var id_dipanggil;
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
                        data: null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            return "<a href='#' onclick='panggil(" + row['id'] + "," + row['no'] + ")' class='btn btn-primary'><i class='fas fa-phone'></i> Panggil</a>";
                        }
                    },
                ],
                columnDefs: [{
                        targets: 0,
                        visible: false
                    },
                    {
                        targets: '_all',
                        className: 'text-center',
                        orderable: false,
                    }
                ],
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
                        console.log('beforesend');
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
                    console.log('beforesend');
                    $('.loader2').show();
                },
                success: function(respon) {
                    if (respon.success == 1) {
                        nomor_dipanggil = no;
                        id_dipanggil = id;
                        cek_panggilan(respon.id);                        
                        console.log('nomor dipanggil = ' +nomor_dipanggil);
                        console.log('id_dipanggil = ' +id_dipanggil);
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
                        $('.modal-title').text('Nomor Antrian ' + nomor_dipanggil);
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
        </script>
</body>

</html>