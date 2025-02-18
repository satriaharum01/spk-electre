@extends('template.master')


@section('content')
<!-- awal isi halaman -->
<div class="app-title">
  <div>
    <h1><i class="bi bi-speedometer"></i> Dashboard</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
  </ul>
</div>
<div class="row">
  <div class="col-md-6 col-lg-3">
    <div class="widget-small primary coloured-icon">
      <i class="icon bi bi-people fs-1"></i>
      <div class="info">
        <h4>Kode Alternatif</h4>
        <p><b>{{$c_alternatif}}</b></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="widget-small info coloured-icon">
      <i class="icon bi bi-alphabet fs-1"></i>
      <div class="info">
        <h4>Kriteria</h4>
        <p><b>{{$c_kriteria}}</b></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="widget-small warning coloured-icon">
      <i class="icon bi bi-graph-up-arrow fs-1"></i>
      <div class="info">
        <h4>Terbaik</h4>
        <p><b>{{$c_max}}</b></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="widget-small danger coloured-icon">
      <i class="icon bi bi-graph-down-arrow  fs-1"></i>
      <div class="info">
        <h4>Terburuk</h4>
        <p><b>{{$c_min}}</b></p>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <h3 class="tile-title">Alternatif Chart</h3>
      <div class="ratio ratio-16x9">
        <canvas  id="alternatifChart"></canvas >
      </div>
    </div>
  </div>
</div>
<!-- end awal isi halaman -->
@endsection
@section('custom_script')
<script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('alternatifChart').getContext('2d');

            // Data dari Laravel
            var chartData = @json($chart); // Ambil data dari Laravel

            var labels = chartData.map(item => item.kode); // Ambil kode alternatif
            var totalNilai = chartData.map(item => parseFloat(item.total_nilai)); // Ambil total nilai
            var names = chartData.map(item => item.nama); // Ambil nama alternatif

            var data = {
                labels: labels,
                datasets: [{
                    label: 'Total Nilai',
                    data: totalNilai,
                    backgroundColor: 'rgba(255, 99, 132, 1)', // Warna merah transparan
                    borderColor: 'rgba(255, 0, 0, 1)', // Warna merah solid
                    borderWidth: 2,
                    hoverBackgroundColor: 'rgba(255, 0, 0, 0.8)'
                }]
            };

            var chartBar = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false
                            }
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Total Nilai',
                                fontSize: 14,
                                fontStyle: 'bold'
                            }
                        }]
                    },
                    interaction: {
                        mode: 'index', // Tooltip muncul di semua dataset pada sumbu X yang sama
                        intersect: false // Tooltip tetap muncul meski tidak tepat di atas batang
                    },
                    plugins: {
                        tooltip: {
                            enabled: true, // Pastikan tooltip diaktifkan
                            callbacks: {
                                label: function(context) {
                                    var index = context.dataIndex;
                                    var name = names[index]; // Nama alternatif
                                    var value = context.raw; // Nilai total
                                    return `${name}: ${value}`; // Tooltip teks
                                }
                            }
                        }
                    }
                }

            });
        });
    </script>
@endsection