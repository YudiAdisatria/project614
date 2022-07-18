<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>

    <!-- Fonts -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> -->

    <!-- Styles -->
    <!-- <link rel="stylesheet" href="{{ mix('/css/app.css') }}"> -->
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
    
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ mix('chart.js/chart.js') }}"></script>
    <script src="{{ mix('chart.js/chartjs-plugin-datalabels.js') }}"></script>
</head>
<body>
    <?php
        $i  = 0;
    ?>
    <?php
        function tgl_indo($tanggal){
            $bulan = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecahkan = explode('-', $tanggal);
            
            // variabel pecahkan 0 = tanggal
            // variabel pecahkan 1 = bulan
            // variabel pecahkan 2 = tahun
        
            return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
        }
    ?>
    @forelse ($report as $details)
        <?php $i++;?>
        <h1>PROFIL KOMPETENSI SARJANA PSIKOLOGI</h1>
        <h3>FAKULTAS PSIKOLOGI UNIVERSITAS KATOLIK SOEGIJAPRANATA</h3>
        
        <!-- Data Diri -->
        <p>NAMA MAHASISWA   : {{ $details['mahasiswa']->nama }}</p>
        <p>NIM              : {{ $details['mahasiswa']->nim }}</p>
        <p>TEMPAT LAHIR     : {{ explode(',', $details['mahasiswa']->ttl)[0] }}</p>
        <p>TANGGAL LAHIR    : {{ substr($details['mahasiswa']->ttl, -10, 10) }}</p>
        <p>NIRL             : {{ $details['mahasiswa']->nirl }}</p>
        <p>TAHUN MASUK      : {{ $details['mahasiswa']->tahun_masuk }}</p>
        <p>TANGGAL LULUS    : {{ $details['mahasiswa']->tanggal_lulus }}</p>
        <p>KURIKULUM        : {{ $kurikulum }}</p>

        <!-- Kompetensi -->
        <table>
            <thead>
                <tr>
                    <th>KOMPETENSI</th>
                    <th>KURANG KOMPETEN</th>
                </tr>
            </thead>
            
            <tbody>
                @forelse ($details['kompetensi'] as $detail)
                    <tr>
                        <td>{{ $detail->profil }}: <br>
                            {{ $detail->deskripsi }} </td>
                        <td style="color:red;">Kurang menguasai pengetahuan dan kurang terampil sebagai {{ $detail->profil }}</td>
                        <!-- <td colspan="4">{{ round($detail->presentase, 2) }}</td> -->
                        <!-- <td colspan="4" rowspan="0"><canvas id="myChart" width="400px" height="1000px"></canvas></td> -->
                        <!-- <td>Sangat menguasai pengetahuan dan terampil sebagai {{ $detail->profil }}</td> -->
                    </tr> 
                @empty
                
                @endforelse
            </tbody>
        </table>
            <canvas id='myChart{{$i-1}}' width="50px" height="50px"></canvas>
            <script>
                var nilai = @json($report[$i-1]['nilai']);
                var ctx{{$i-1}} = document.getElementById('myChart{{$i-1}}').getContext('2d');
                var myChart{{$i-1}} = new Chart(ctx{{$i-1}}, {
                    type: 'line',
                    data: {
                        labels: new Array(nilai.length).fill(" "),
                        datasets: [{
                            axis: 'y',
                            label: 'Nilai',
                            data: nilai,
                            fill: false,
                            backgroundColor: 'rgba(0, 0, 0, 1)',
                            borderColor: 'rgba(0, 0, 0, 1)',
                            borderWidth: 1
                        }]
                    },
                    datalabels: {
                        align: 'start',
                        anchor: 'start'
                    },
                    options: {
                        indexAxis: 'y',
                        scales: {
                            x: {
                                max: 4,
                                min: 0,
                                ticks: {
                                    stepSize: 1
                                },
                                position: 'top'
                            }
                        },
                        plugins: {
                            datalabels: {
                                backgroundColor: function(context) {
                                    return context.dataset.backgroundColor;
                                },
                                borderRadius: 4,
                                color: 'white',
                                font: {
                                    weight: 'bold'
                                },
                                padding: 6
                            }
                        },

                        // Core options
                        aspectRatio: 5 / 3,
                        layout: {
                            padding: {
                                top: 32,
                                right: 16,
                                bottom: 16,
                                left: 8
                            }
                        },
                        elements: {
                            line: {
                                fill: false,
                                tension: 0.4
                            }
                        },
                    },
                    plugins: [ChartDataLabels]
                });
            </script>
        <table>
            <thead>
                <tr>
                    <th>SANGAT KOMPETEN</th>
                </tr>
            </thead>
            
            <tbody>
                @forelse ($details['kompetensi'] as $detail)
                    <tr>
                        <td>Sangat menguasai pengetahuan dan terampil sebagai {{ $detail->profil }}</td>
                    </tr> 
                @empty
                
                @endforelse
            </tbody>
        </table>
        
        <br> <br> <br>
        <p>Semarang, <?php echo tgl_indo(date('Y-m-d'))?></p>
        <p>Dekan, </p>
        <br> <br> <br> <br> <br>
        <p>{{ $admin->nama }}</p>
        <br><br>
        <div class="page-break"></div>
    @empty
        
    @endforelse
    
</body>
</html>