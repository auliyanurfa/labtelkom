@extends('alat.layout.main')

@section('container')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div class="row">
    <div class="col-md-6">
      <div id="chart1"></div>
    </div>
@endsection

@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
Highcharts.chart('chart1', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Jumlah Peralatan Berdasarkan Kondisi'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.y}</b> {point.name}',
                distance: -50,
            }
        }
    },
    series: [{
        name: 'Share',
        data: [
            {
              name: "Baik", y: {{$baik_alat}},
            },
            {
              name: "Rusak", y:{{$rusak_alat}},
            },
            {
              name: "Dalam Perbaikan", y:{{$dalamperbaikan_alat}},
            },
        ]
    }]
});
</script>
@endsection
