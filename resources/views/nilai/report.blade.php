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
        canvas {
            margin: 0;
            padding: -5;
        }
        @media print {
            .print{
                break-inside: avoid;
            }
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
        <script>
            var nilai = @json($report[$i-1]['nilai']);
        </script>

        <div class="text-center">
        <h1 class="text-xl  font-bold">PROFIL KOMPETENSI SARJANA PSIKOLOGI</h1>
        <h3 class="text-lg  font-semibold">FAKULTAS PSIKOLOGI UNIVERSITAS KATOLIK SOEGIJAPRANATA</h3>
        </div>
        
        <!-- Data Diri -->
        <div class="flex mt-4">
            <div class="flex-1">
                <p>NAMA MAHASISWA&emsp;: {{ $details['mahasiswa']->nama }}</p>
                <p>NIM&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $details['mahasiswa']->nim }}</p>
                <p>TEMPAT LAHIR&emsp;&emsp;&emsp;&nbsp;&nbsp;: {{ explode(',', $details['mahasiswa']->ttl)[0] }}</p>
                <p>TANGGAL LAHIR&emsp;&emsp;&ensp;&nbsp;: {{ substr($details['mahasiswa']->ttl, -10, 10) }}</p>
            </div>
            <div>
                <p>NIRL&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;: {{ $details['mahasiswa']->nirl }}</p>
                <p>TAHUN MASUK&emsp;&ensp;&nbsp;: {{ $details['mahasiswa']->tahun_masuk }}</p>
                <p>TANGGAL LULUS&emsp;&nbsp;: {{ $details['mahasiswa']->tanggal_lulus }}</p>
                <p>KURIKULUM&emsp;&emsp;&emsp;&nbsp;: {{ $kurikulum }}</p>
            </div>
        </div>

        <!-- Kompetensi -->
        <div class="flex">
            <div class="mt-10">
                <table class="border-collapse border border-slate-500"> 
                    <tbody>
                        <tr>
                            <th class="border text-sm border-slate-600  bg-slate-400 ">KOMPETENSI</th>
                            <th class="border text-sm border-slate-600  bg-slate-400">KURANG KOMPETEN</th>
                            <th class="border text-sm border-slate-600  bg-slate-400">GRAFIK</th>
                            <th class="border text-sm border-slate-600  bg-slate-400">SANGAT KOMPETEN</th>
                        </tr>

                    

                        <?php $j=0; $col = count($details['kompetensi']);?>
                        @forelse ($details['kompetensi'] as $detail)
                            <tr class="print">
                                <td class="tracking-tight text-xs text-justify border border-slate-700 p-2 h-36"><p class="print tracking-tight text-xs text-justify font-bold">{{ $detail->profil }}</p><br>
                                    {{ $detail->deskripsi }} </td>
                                <td class="tracking-tight text-justify text-xs border border-slate-700 p-2 h-36">Kurang menguasai pengetahuan dan kurang terampil sebagai {{ $detail->profil }}</td>
                                <td class="tracking-tight text-xs border border-slate-700 h-36"><canvas class="h-full" id='myChart{{$i-1}}{{$j}}' width="200px" ></canvas></td> <!-- style="border:1px solid #000000;" -->
                                <td class="tracking-tight text-justify border text-xs border-slate-700 p-2 h-36">Sangat menguasai pengetahuan dan terampil sebagai {{ $detail->profil }}</td>
                            </tr> 
                            <script>
                                var c{{$j}} = document.getElementById("myChart{{$i-1}}{{$j}}");
                                var ctx = c{{$j}}.getContext("2d");
                                if ({{ $j }} == 0) {

                                }else{
                                    ctx.lineTo(nilai[{{ $j }}-1]/4*200, -72);
                                }
                                ctx.lineTo({{ $detail->presentase }}/4*200, 72);
                                ctx.font = "12px Arial";
                                ctx.fillText({{ $detail->presentase }}, {{ $detail->presentase }}/4*200+5, 72);
                                ctx.fillRect({{ $detail->presentase }}/4*200-1, 72,3,3);
                                ctx.lineTo(nilai[{{ $j }}+1]/4*200, 216);
                                ctx.stroke();
                            </script> 
                            <?php $j++; ?>
                        @empty
                        
                        @endforelse
                    </tbody>
                </table>
            </div>  
        </div>    
        <br> <br> <br>
        <div class="print grid grid-cols-2">
            <div class="justify-self-end mr-6">
                <div class="box-border h-[9.3rem] w-[7rem] p-4 border-2 border-slate-600 ml-36 justify-self-end text-center">
                    <p class="mt-8">Foto</p>
                    <p>3 X 4</p>
                </div>
            </div>
            <div class="justify-self-start"> 
                <p>Semarang, <?php echo tgl_indo(date('Y-m-d'))?></p>
                <p>Dekan, </p>
                <br> <br> <br>
                <p>{{ $admin->nama }}</p>
            </div>
        </div>
        <br><br>
        <div class="page-break"></div>
    @empty
        
    @endforelse
    
</body>
</html>