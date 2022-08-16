@extends('bahan.layout.main')


  @section('container')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div id="chart1"></div>
        </div>
        <div class="col-md-6">
          <div id="chart2"></div>
        </div>
        <div class="col-md-6">
          <div id="chart3"></div>
        </div>
        <div class="col-md-6">
          <div id="chart4"></div>
        </div>
      </div>
    </main>
  </div>
</div>
@endsection

@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
// Build the chart
Highcharts.chart('chart1', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Jumlah stok Bahan Habis Pakai 2022'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.y}</b> stok',
                distance: -50,
                filter: {
                    property: 'percentage',
                    operator: '>',
                    value: 4
                }
            }
        }
    },
    series: [{
      name: 'Stok',
      data: [
          <?php foreach($materials as $material): ?>
            { name: {!!json_encode($material["name_material"])!!}, 
            y: {!!json_encode($material["stok"])!!}, },
        <?php endforeach; ?>
        ]
    }]
});

/////////// CHART 2 ///////////////////

// Build the chart
Highcharts.chart('chart2', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Jumlah Stok Bahan Habis Pakai 2022'
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
              name: "pcs", y: {{$pcs_bhpAll}},
            },
            {
              name: "liter", y:{{$liter_bhpAll}},
            },
            {
              name: "meter", y:{{$meter_bhpAll}},
            },
        ]
    }]
});
/////////// CHART 3 ///////////////////

// Build the chart
Highcharts.chart('chart3', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Jumlah Stok Masuk Bahan Habis Pakai 2022'
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
              name: "pcs", y: {{$pcs_in}}
          
            },
            {
              name: "liter", y:{{$liter_in}},
            },
            {
              name: "meter", y:{{$meter_in}},
            }
        ]
    }]
});
/////////// CHART 4 ///////////////////

// Build the chart
Highcharts.chart('chart4', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Jumlah Stok Keluar Bahan Habis Pakai 2022'
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
              name: "pcs", y: {{$pcs_out}}
          
            },
            {
              name: "liter", y:{{$liter_out}},
            },
            {
              name: "meter", y:{{$meter_out}},
            }
        ]
    }]
});


</script>
@endsection

    