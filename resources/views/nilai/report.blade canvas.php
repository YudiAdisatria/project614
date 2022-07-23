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
            <div class="w-2/5 mt-10">
                <table class="border-collapse border border-slate-500"> 
                    <thead>
                        <tr>
                            <th class="border border-slate-600 bg-slate-400 ">KOMPETENSI</th>
                            <th class="border border-slate-600  bg-slate-400">KURANG KOMPETEN</th>
                            <th class="border border-slate-600  bg-slate-400">GRAFIK</th>
                            <th class="border border-slate-600  bg-slate-400">SANGAT KOMPETEN</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $j=0; $col = count($details['kompetensi']);?>
                        @forelse ($details['kompetensi'] as $detail)
                            <tr>
                                <td class="tracking-tight text-sm text-justify border border-slate-700 p-2 h-32">{{ $detail->profil }}: <br>
                                    {{ $detail->deskripsi }} </td>
                                <td  class="tracking-tight text-sm border border-slate-700 p-2 h-32">Kurang menguasai pengetahuan dan kurang terampil sebagai {{ $detail->profil }}</td>
                                @if ($j == 0)
                                <td  class="tracking-tight text-sm border border-slate-700 p-2 h-32" rowspan="{{$col}}"><canvas class="p-2" id='myChart{{$i-1}}' width="200" height="{{ $col * 200 }}px" style="border:1px solid #000000;"></canvas></td>
                                @endif
                                <td class="tracking-tight text-center border text-sm border-slate-700 p-2 h-32">Sangat menguasai pengetahuan dan terampil sebagai {{ $detail->profil }}</td>
                            </tr> 
                            <?php $j++; ?>
                        @empty
                        
                        @endforelse
                    </tbody>
                </table>
            </div>  
        </div>
            <script>
                var c = document.getElementById("myChart{{$i-1}}");
                var ctx = c.getContext("2d");
                ctx.moveTo(0, 0);
                ctx.lineTo(200, 100);
                ctx.lineTo(70, 200);
                ctx.stroke();
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