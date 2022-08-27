@extends('alat.layout.main')

@section('container')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <p>
            <h6>Halaman ini menyajikan informasi mengenai indikator utama dari aktivitas sistem informasi peminjaman dan
                pengembalian barang Laboratorium Telekomunikasi secara sekilas dalam layar tunggal</h6>
            </p>
        </div>
        <div class="card mb-2">
            <!-- /.row-->

            <div class="card-header">
                <div class="row text-center">
                    <div class="col-sm-12 col-md mb-sm-2 mb-0">
                        <h6>
                            <div class="text-muted">Jumlah Alat</div>
                        </h6>
                        <h5><strong>{{ $peralatans }}</strong>
                            <h5>
                    </div>
                    <div class="col-sm-12 col-md mb-sm-2 mb-0">
                        <h6>
                            <div class="text-muted">Jumlah Mahasiswa</div>
                        </h6>
                        <h5><strong>{{ $mahasiswas }}</strong></h5>
                    </div>
                    <div class="col-sm-12 col-md mb-sm-2 mb-0">
                        <h6>
                            <div class="text-muted">Alat Dipinjam</div>
                        </h6>
                        <h5><strong>{{ $pinjam_alat }}</strong></h5>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-6 col-12 py-4">
                    <div id="chart1"></div>
                </div>
                <div class="col-md-6 col-lg-6 col-12 py-4">
                    <div id="chart2"></div>
                </div>
                <div class="col-md-6 col-lg-6 col-12 py-4">
                    <div id="chart3"></div>
                </div>
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
                        name: 'Total',
                        data: [{
                                name: "Baik",
                                y: {{ $baik_alat }},
                            },
                            {
                                name: "Rusak",
                                y: {{ $rusak_alat }},
                            },
                            {
                                name: "Dalam Perbaikan",
                                y: {{ $dalamperbaikan_alat }},
                            },
                        ]
                    }]
                });
                Highcharts.chart('chart2', {
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
                        name: 'Total',
                        data: [
                            @foreach ($jumlahbyjenis as $key => $value)
                                {
                                    name: "{{ $key }}",
                                    y: {{ $value }},
                                },
                            @endforeach
                        ]
                    }]
                });
                Highcharts.chart('chart3', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Peminjaman Dan Pengembalian'
                    },
                    subtitle: {
                        text: 'By Week'
                    },
                    xAxis: {
                        categories: [
                            @foreach ($shortDataKembaliByWeek as $key => $value)
                                'Minggu ke {{$key}}',
                            @endforeach
                        ],
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Frekuensi Peminjaman'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.1f} Alat</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: 'Pinjam',
                        data: [
                            @foreach ($shortDataPinjamByWeek as $key => $value)
                                {{$value}},
                            @endforeach
                        ]

                    }, {
                        name: 'Kembali',
                        data: [
                            @foreach ($shortDataKembaliByWeek as $key => $value)
                                {{$value}},
                            @endforeach
                        ]

                    }]
                });
            </script>
        @endsection
