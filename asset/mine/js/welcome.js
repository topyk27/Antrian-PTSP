var now = new Date();
var tahun = now.getFullYear();
var bulan = now.getMonth()+1;
moment.locale('id');
var nama_bulan = moment().format('MMMM');        
function jumlah_hari(bulan, tahun) {
    return new Date(tahun,bulan,0).getDate();
}
$(document).ready(function(){
    $("#title_statistik").text("Statistik Pengunjung Bulan "+nama_bulan);
    $("#sidebar_dashboard").addClass("active");
    $.ajax({
        url: "https://raw.githubusercontent.com/topyk27/Antrian-PTSP/main/asset/mine/token/token.json",
        method: 'GET',
        dataType: 'json',
        beforeSend: function(){
            $(".loader2").show();
        },
        success: function(data)
        {
            try
            {
                if(nama_pa==data[nama_pa_pendek][0].nama_pa && nama_pa_pendek==data[nama_pa_pendek][0].nama_pa_pendek && tkn==data[nama_pa_pendek][0].token)
                {

                }
                else
                {
                    location.replace(base_url+'setting/awal');
                }
            }
            catch(err)
            {
                location.replace(base_url+'setting/awal');
            }
            $(".loader2").hide();
        },
        error: function()
        {
            $.ajax({
                url: base_url+'asset/mine/token/token.json',
                method: "GET",
                dataType: 'json',
                success: function(lokal)
                {
                    if(nama_pa==lokal[nama_pa_pendek][0].nama_pa && nama_pa_pendek==lokal[nama_pa_pendek][0].nama_pa_pendek && tkn==lokal[nama_pa_pendek][0].token)
                    {

                    }
                    else
                    {
                        location.replace(base_url+'setting/awal');
                    }
                    $(".loader2").hide();
                },
                error: function(err)
                {
                    $(".loader2").hide();
                    alert('Gagal dapat data token, harap hubungi administrator');
                    location.replace(base_url+'setting/awal');
                }
            });
        }
    });
    $.ajax({
        url : base_url+'antrian/statistik',
        method: 'get',
        dataType: 'json',
        success: function(data)
        {
            var hari = jumlah_hari(bulan,tahun);
            var label = [];
            var ant_val = [];
            var ketemu = false;
            var antrian = data.antrian;
            for(var aa=1; aa<=hari; aa++)
            {
                let a_ketemu = false;
                for(var a in antrian)
                {
                    if(aa==antrian[a].tanggal)
                    {
                        ant_val.push(parseInt(antrian[a].total));
                        a_ketemu = true;
                        break;
                    }
                    else
                    {
                        a_ketemu = false;
                    }
                }
                if(!a_ketemu)
                {
                    ant_val.push(0);
                }
            }
            for(var i =1; i<=hari; i++)
            {
                label.push(i);
            }

            var areaChartData = {
                labels  : label,
                datasets: [
                    {
                        label : 'Pengunjung',
                        backgroundColor : 'rgba(0,255,255,1)',
                        borderColor : 'rgba(0,255,255,0.8)',
                        pointRadius : false,
                        pointColor : '#3b8bba',
                        pointStrokeColor : 'rgba(60,141,188,1)',
                        pointHighlightFill : '#fff',
                        pointHighlightStroke : 'rgba(60,141,188,1)',
                        data : ant_val,

                    },
                ]
            }
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = jQuery.extend(true, {}, areaChartData);
            var temp0 = areaChartData.datasets[0];
            barChartData.datasets[0] = temp0;
            var barChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                datasetFill             : false,
                scales : {
                yAxes : [{
                        ticks: {
                            stepSize: 1,
                        }
                    }],
                },
                tooltips : {
                enabled : true,
                mode : 'single',
                callbacks: {
                    title: function(tooltipItems, data){
                        return tooltipItems[0].xLabel + ' ' + moment().format('MMMM');
                    }
                }
                }
            }
            var barChart = new Chart(barChartCanvas, {
                type: 'bar', 
                data: barChartData,
                options: barChartOptions
            });
        }
    });
});