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
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
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

        <div class="text-center mt-7">
        <h1 class="text-2xl  font-bold">PROFIL KOMPETENSI SARJANA PSIKOLOGI</h1>
        <h3 class="text-lg  font-semibold">FAKULTAS PSIKOLOGI UNIVERSITAS KATOLIK SOEGIJAPRANATA</h3>
        </div>
        
        <!-- Data Diri -->
        <div class="flex mt-4 p-12">
            <div class="flex-1 w-56 text-lg">
                <p>NAMA MAHASISWA   : {{ $details['mahasiswa']->nama }}</p>
                <p>NIM              : {{ $details['mahasiswa']->nim }}</p>
                <p>TEMPAT LAHIR     : {{ explode(',', $details['mahasiswa']->ttl)[0] }}</p>
                <p>TANGGAL LAHIR    : {{ substr($details['mahasiswa']->ttl, -10, 10) }}</p>
            </div>
            <div>
                <p>NIRL             : {{ $details['mahasiswa']->nirl }}</p>
                <p>TAHUN MASUK      : {{ $details['mahasiswa']->tahun_masuk }}</p>
                <p>TANGGAL LULUS    : {{ $details['mahasiswa']->tanggal_lulus }}</p>
                <p>KURIKULUM        : {{ $kurikulum }}</p>
            </div>
        </div>

        <!-- Kompetensi -->
        <div class="p-12 flex">
            <div class="w-1/3">
                <table class="border-collapse border border-slate-500"> 
                    <thead>
                        <tr>
                            <th class="border border-slate-600 bg-slate-400 ">KOMPETENSI</th>
                            <th class="border border-slate-600  bg-slate-400">KURANG KOMPETEN</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @forelse ($details['kompetensi'] as $detail)
                            <tr>
                                <td class="tracking-tight text-justify border border-slate-700 p-2 h-64">{{ $detail->profil }}: <br>
                                    {{ $detail->deskripsi }} </td>
                                <td  class="tracking-tight  border border-slate-700 p-2 h-64">Kurang menguasai pengetahuan dan kurang terampil sebagai {{ $detail->profil }}</td>
                            </tr> 
                        @empty
                        
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="w-1/3">
                <canvas class="h-full" id='myChart{{$i-1}}'></canvas>
            </div>

            <div class="w-1/3">
                <table class="border-collapse border border-slate-500">
                    <thead>
                        <tr>
                            <th class="border border-slate-600 bg-slate-400 ">SANGAT KOMPETEN</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @forelse ($details['kompetensi'] as $detail)
                            <tr>
                                <td class="tracking-tight text-center border border-slate-700 p-2 h-64">Sangat menguasai pengetahuan dan terampil sebagai {{ $detail->profil }}</td>
                            </tr> 
                        @empty
                        
                        @endforelse
                    </tbody>
                </table>
            </div>
            
        </div>
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
        <br> <br> <br>
        <div class="grid grid-cols-2">
            <div class="justify-self-end mr-6">
                <div class="box-border h-[13rem] w-[10rem] p-4 border-2 border-slate-600 ml-36 justify-self-end text-center">
                    <p class="mt-12">Foto</p>
                    <p>3 X 4</p>
                </div>
            </div>
            <div class="justify-self-start"> 
                <p>Semarang, <?php echo tgl_indo(date('Y-m-d'))?></p>
                <p>Dekan, </p>
                <br> <br> <br> <br> <br>
                <p>{{ $admin->nama }}</p>
            </div>
        </div>
        <br><br>
        <div class="page-break"></div>
    @empty
        
    @endforelse
    
</body>
</html>