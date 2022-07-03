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
    $("#btnJamtutupUbah").click(function(){
        $("#btnJamtutupSimpan").show();
        $(this).hide();
        $("input[name='jam_tutup']").attr("readonly",false);
    });
    $("#btnJamtutupSimpan").click(function(){
        let data = $("input[name='jam_tutup']").val();
        $.ajax({
            url: base_url+'setting/save_text/jam_tutup',
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
                $("#btnJamtutupSimpan").hide();
                $("#btnJamtutupUbah").show();
                $("input[name='jam_tutup']").attr("readonly",true);
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