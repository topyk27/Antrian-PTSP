<!DOCTYPE html>
<html lang="ID">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Setting | Sistem</title>
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
							<h1>Sistem</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
								<li class="breadcrumb-item"><a href="#">Setting</a></li>
								<li class="breadcrumb-item active">Sistem</li>
							</ol>
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
								<div class="card-header">
									<h3 class="card-title">Setting</h3>
								</div>
								<div class="card-body">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <textarea class="form-control" name="textalamat" rows="3" readonly><?php echo $setting->alamat; ?></textarea>
                                            </div>
                                            <div class="col-md-2">
                                                <a href="#" id="btnAlamatUbah" class="btn btn-warning">Ubah</a>
                                                <a href="#" id="btnAlamatSimpan" class="btn btn-success" style="display: none;">Simpan</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="telepon">Telepon</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="telepon" value="<?php echo $setting->telepon; ?>" placeholder="Telepon" readonly>
                                            </div>
                                            <div class="col-md-2">
                                            <a href="#" id="btnTeleponUbah" class="btn btn-warning">Ubah</a>
                                                <a href="#" id="btnTeleponSimpan" class="btn btn-success" style="display: none;">Simpan</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="facebook">Facebook</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="facebook" value="<?php echo $setting->facebook; ?>" placeholder="Facebook" readonly>
                                            </div>
                                            <div class="col-md-2">
                                            <a href="#" id="btnFacebookUbah" class="btn btn-warning">Ubah</a>
                                                <a href="#" id="btnFacebookSimpan" class="btn btn-success" style="display: none;">Simpan</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="instagram">Instagram</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="instagram" value="<?php echo $setting->instagram; ?>" placeholder="Instagram" readonly>
                                            </div>
                                            <div class="col-md-2">
                                            <a href="#" id="btnInstagramUbah" class="btn btn-warning">Ubah</a>
                                                <a href="#" id="btnInstagramSimpan" class="btn btn-success" style="display: none;">Simpan</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="twitter">Twitter</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="twitter" value="<?php echo $setting->twitter; ?>" placeholder="Twitter" readonly>
                                            </div>
                                            <div class="col-md-2">
                                            <a href="#" id="btnTwitterUbah" class="btn btn-warning">Ubah</a>
                                                <a href="#" id="btnTwitterSimpan" class="btn btn-success" style="display: none;">Simpan</a>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
										<label for="logo">Logo</label>
										<div class="row">
											<form class="form-inline" method="post" enctype="multipart/form-data">
												<div class="col-sm-4">
													<img src="<?php echo base_url('asset/img/logo.png').'?'.time(); ?>" class="img-fluid mb-3">
												</div>
												<div class="col-sm-4">
													<input type="file" accept=".png" name="logo" class="form-control-file mb-3 <?php echo form_error('logo') ? 'is-invalid' : '' ?>">
													<div class="invalid-feedback">
														<?php echo form_error('logo'); ?>
													</div>
												</div>
												<div class="col-sm-4">
													<button type="submit" class="btn btn-warning btn-submit">Simpan</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view("_partials/footer.php") ?>
		<aside class="control-sidebar control-sidebar-dark"></aside>
	</div>
	<!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
	<script>
		const base_url = "<?php echo base_url(); ?>";
	</script>
	<!-- <script src="<?php echo base_url('asset/js/view/setting/sistem.min.js') ?>"></script> -->
    <script>
        $(document).ready(function(){
            $("#sidebar_setting").addClass("active");
            $("#sidebar_setting_sistem").addClass("active");
            $("#btnAlamatUbah").click(function(){
                $("#btnAlamatSimpan").show();
                $(this).hide();
                $("textarea[name='textalamat']").attr("readonly",false);
            });
            $("#btnAlamatSimpan").click(function(){
                let data = $("textarea[name='textalamat']").val();
                $.ajax({
                    url: base_url+'setting/save_text/alamat',
                    type: "POST",
                    data: {data: data},
                    dataType: "TEXT",
                    success: function(respon)
                    {
                        if(respon>0)
                        {
                            $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'>Data berhasil diubah</div>");
                            $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                        }
                        else
                        {
                            $("#respon").html("<div class='alert alert-info' role='alert' id='responMsg'>Data tidak ada perubahan</div>");
                            $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                        }
                        $("#btnAlamatSimpan").hide();
                        $("#btnAlamatUbah").show();
                        $("textarea[name='textalamat']").attr("readonly",true);
                    },
                    error: function(err)
                    {
                        console.log(err.responseText);
                        $("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah, mohon periksa jaringan internet anda.</div>");
                        $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                    }
                });
            });
            $("#btnTeleponUbah").click(function(){
                $("#btnTeleponSimpan").show();
                $(this).hide();
                $("input[name='telepon']").attr("readonly",false);
            });
            $("#btnTeleponSimpan").click(function(){
                let data = $("input[name='telepon']").val();
                $.ajax({
                    url: base_url+'setting/save_text/telepon',
                    type: "POST",
                    data: {data: data},
                    dataType: "TEXT",
                    success: function(respon)
                    {
                        if(respon>0)
                        {
                            $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'>Data berhasil diubah</div>");
                            $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                        }
                        else
                        {
                            $("#respon").html("<div class='alert alert-info' role='alert' id='responMsg'>Data tidak ada perubahan</div>");
                            $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                        }
                        $("#btnTeleponSimpan").hide();
                        $("#btnTeleponUbah").show();
                        $("input[name='telepon']").attr("readonly",true);
                    },
                    error: function(err)
                    {
                        console.log(err.responseText);
                        $("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah, mohon periksa jaringan internet anda.</div>");
                        $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                    }
                });
            });
            $("#btnFacebookUbah").click(function(){
                $("#btnFacebookSimpan").show();
                $(this).hide();
                $("input[name='facebook']").attr("readonly",false);
            });
            $("#btnFacebookSimpan").click(function(){
                let data = $("input[name='facebook']").val();
                $.ajax({
                    url: base_url+'setting/save_text/facebook',
                    type: "POST",
                    data: {data: data},
                    dataType: "TEXT",
                    success: function(respon)
                    {
                        if(respon>0)
                        {
                            $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'>Data berhasil diubah</div>");
                            $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                        }
                        else
                        {
                            $("#respon").html("<div class='alert alert-info' role='alert' id='responMsg'>Data tidak ada perubahan</div>");
                            $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                        }
                        $("#btnFacebookSimpan").hide();
                        $("#btnFacebookUbah").show();
                        $("input[name='facebook']").attr("readonly",true);
                    },
                    error: function(err)
                    {
                        console.log(err.responseText);
                        $("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah, mohon periksa jaringan internet anda.</div>");
                        $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                    }
                });
            });
            $("#btnInstagramUbah").click(function(){
                $("#btnInstagramSimpan").show();
                $(this).hide();
                $("input[name='instagram']").attr("readonly",false);
            });
            $("#btnInstagramSimpan").click(function(){
                let data = $("input[name='instagram']").val();
                $.ajax({
                    url: base_url+'setting/save_text/instagram',
                    type: "POST",
                    data: {data: data},
                    dataType: "TEXT",
                    success: function(respon)
                    {
                        if(respon>0)
                        {
                            $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'>Data berhasil diubah</div>");
                            $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                        }
                        else
                        {
                            $("#respon").html("<div class='alert alert-info' role='alert' id='responMsg'>Data tidak ada perubahan</div>");
                            $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                        }
                        $("#btnInstagramSimpan").hide();
                        $("#btnInstagramUbah").show();
                        $("input[name='instagram']").attr("readonly",true);
                    },
                    error: function(err)
                    {
                        console.log(err.responseText);
                        $("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah, mohon periksa jaringan internet anda.</div>");
                        $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                    }
                });
            });
            $("#btnTwitterUbah").click(function(){
                $("#btnTwitterSimpan").show();
                $(this).hide();
                $("input[name='twitter']").attr("readonly",false);
            });
            $("#btnTwitterSimpan").click(function(){
                let data = $("input[name='twitter']").val();
                $.ajax({
                    url: base_url+'setting/save_text/twitter',
                    type: "POST",
                    data: {data: data},
                    dataType: "TEXT",
                    success: function(respon)
                    {
                        if(respon>0)
                        {
                            $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'>Data berhasil diubah</div>");
                            $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                        }
                        else
                        {
                            $("#respon").html("<div class='alert alert-info' role='alert' id='responMsg'>Data tidak ada perubahan</div>");
                            $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                        }
                        $("#btnTwitterSimpan").hide();
                        $("#btnTwitterUbah").show();
                        $("input[name='twitter']").attr("readonly",true);
                    },
                    error: function(err)
                    {
                        console.log(err.responseText);
                        $("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah, mohon periksa jaringan internet anda.</div>");
                        $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                    }
                });
            });
        });
    </script>
</body>
</html>