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
        .tulisan{
            font-size: 0.75rem;
        }
        .inline {
            display: inline;
        }
        @media print {
            .print{
                break-inside: avoid;
            }
        }
    </style>
    
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <!-- <script src="{{ mix('chart.js/chart.js') }}"></script>
    <script src="{{ mix('chart.js/chartjs-plugin-datalabels.js') }}"></script> -->
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
        <script>
            var nilai = @json($report[$i-1]['nilai']);
        </script>

        <div class="text-center">
            <h1 class="text-xxl font-bold">PROFIL KOMPETENSI SARJANA PSIKOLOGI</h1>
            <h3 class="text-xl font-semibold">FAKULTAS PSIKOLOGI UNIVERSITAS KATOLIK SOEGIJAPRANATA</h3>
        </div>
        
        <!-- Data Diri -->
        <div class="flex mt-2">
            <div class="flex-1">
                <p class="text-lg">NAMA MAHASISWA&emsp;: {{ $details['mahasiswa']->nama }}</p>
                <p class="text-lg">NIM&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $details['mahasiswa']->nim }}</p>
                <p class="text-lg">TEMPAT LAHIR&emsp;&emsp;&emsp;&nbsp;&nbsp;: {{ explode(',', $details['mahasiswa']->ttl)[0] }}</p>
                <p class="text-lg">TANGGAL LAHIR&emsp;&emsp;&ensp;&nbsp;: {{ substr($details['mahasiswa']->ttl, -10, 10) }}</p>
            </div>
            <div>
                <p class="text-lg">NIRL&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;: {{ $details['mahasiswa']->nirl }}</p>
                <p class="text-lg">TAHUN MASUK&emsp;&ensp;&nbsp;: {{ $details['mahasiswa']->tahun_masuk }}</p>
                <p class="text-lg">TANGGAL LULUS&emsp;&nbsp;: {{ $details['mahasiswa']->tanggal_lulus }}</p>
                <p class="text-lg">KURIKULUM&emsp;&emsp;&emsp;&nbsp;: {{ $kurikulum }}</p>
            </div>
        </div>

        <!-- Kompetensi -->
        <div class="flex">
            <div class="mt-2">
                <table class="border-collapse border border-slate-500" id="table-grafik" style="width: 1050px;"> 
                    <tbody>
                        <tr>
                            <th class="border text-sm border-slate-600 w-5/12 bg-slate-400">KOMPETENSI</th>
                            <th class="border text-sm border-slate-600 w-2/12 bg-slate-400">KURANG KOMPETEN</th>
                            <th class="border text-sm border-slate-600 w-3/12 bg-slate-400">GRAFIK</th>
                            <th class="border text-sm border-slate-600 w-2/12 bg-slate-400">SANGAT KOMPETEN</th>
                        </tr>

                        <?php $j=0; $col = count($details['kompetensi']); $panjang=0; $pan=0;?>           
                        @forelse ($details['kompetensi'] as $detail)
                            <tr class="print">
                                <td style="font-size: 0.7;" class="tracking-tight text-justify border border-slate-700 p-0.5"><p class="print tracking-tight font-bold">{{ $detail->profil }}</p>
                                    {{ $detail->deskripsi }} </td>
                                <td style="font-size: 0.7;" class="tracking-tight text-center border border-slate-700 p-0.5">Kurang menguasai pengetahuan dan terampil sebagai {{ $detail->profil }}</td>
                                <script>
                                    var tbl = document.getElementById('table-grafik').rows[{{ $j }}+1].offsetHeight;

                                </script>
                                <?php 
                                    $panjang = "<script>document.write(tbl)</script>";
                                ?>
                                
                                <td style="font-size: 0.7;" class="tracking-tight border border-slate-700"><canvas id='myChart{{$i-1}}{{$j}}' width="315px" height="102px"></canvas></td> <!-- style="border:1px solid #000000;" -->
                                <td style="font-size: 0.7;" class="tracking-tight text-center border border-slate-700 p-0.5">Sangat menguasai pengetahuan dan terampil sebagai {{ $detail->profil }}</td>
                            </tr> 
                            <script>
                                var c{{$j}} = document.getElementById("myChart{{$i-1}}{{$j}}");
                                var ctx = c{{$j}}.getContext("2d");
                                var height = 53; //h-24 = 96px :2
                                var width = 315-20;

                                // Start Point
                                if ({{ $j }} == 0) {

                                }else{
                                    // If there is before
                                    ctx.lineTo(nilai[{{ $j }}-1]/4*width, -height);
                                }
                                // Point of value
                                ctx.lineTo({{ $detail->presentase }}/4*width, height);
                                ctx.font = "bold 12px Arial";
                                
                                // Text di kanan atau kiri
                                if({{ $detail->presentase }} > 3.55){
                                    ctx.fillText({{ $detail->presentase }}, {{ $detail->presentase }}/4*width-30, height);
                                }else{
                                    ctx.fillText({{ $detail->presentase }}, {{ $detail->presentase }}/4*width+6, height+5);
                                }
                                ctx.fillRect({{ $detail->presentase }}/4*width-1, height-2,3,3);
                                // Next point
                                ctx.lineTo(nilai[{{ $j }}+1]/4*width, height*3);
                                ctx.stroke();
                            </script> 
                            <?php $j++; ?>
                        @empty
                        
                        @endforelse
                    </tbody>
                </table>
            </div>  
        </div>    
        <br>
        <div class="print grid grid-cols-2">
            <div class="justify-self-end mr-6 mt-3">
                <div class="box-border h-[9.3rem] w-[7rem] p-4 border-2 border-slate-600 ml-36 justify-self-end text-center">
                    <p class="mt-3 text-base">Foto</p>
                    <p>3 X 4</p>
                </div>
            </div>
            <div class="justify-self-start text-base"> 
                <p>Semarang, <?php echo tgl_indo(date('Y-m-d'))?></p>
                <p>Dekan, </p>
                <br> <br> <br> <br>
                <p>{{ $admin->nama }}</p>
            </div>
        </div>
        <div class="page-break"></div>
    @empty
        
    @endforelse
    
</body>
</html>