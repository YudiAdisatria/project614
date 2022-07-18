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
    <!-- <link rel="stylesheet" href="{{ public_path('\css\app.css') }}"> -->
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
    
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ mix('chart.js/chart.js') }}"></script>
</head>
<body>
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
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>SANGAT KOMPETEN</th>
                </tr>
            </thead>
            
            <tbody>
                @forelse ($details['kompetensi'] as $detail)
                    <tr>
                        <td>{{ $detail->profil }}: <br>
                            {{ $detail->deskripsi }} </td>
                        <td style="color:red;">Kurang menguasai pengetahuan dan kurang terampil sebagai {{ $detail->profil }}</td>
                        <td colspan="4">{{ round($detail->presentase, 2) }}</td>
                        <td>Sangat menguasai pengetahuan dan terampil sebagai {{ $detail->profil }}</td>
                    </tr> 
                @empty
                
                @endforelse
            </tbody>
        </table>
        <canvas id="myChart" width="400px" height="400px"></canvas>
        <br> <br> <br>
        <p>Semarang, <?php echo tgl_indo(date('Y-m-d'))?></p>
        <p>Dekan, </p>
        <br> <br> <br> <br> <br>
        <p>{{ $admin->nama }}</p>
        <br><br>
        <div class="page-break"></div>
    @empty
        
    @endforelse
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['', '', '', '', '', ''],
                datasets: [{
                    axis: 'y',
                    // label: 'My First Dataset',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    fill: false,
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                x: {
                    beginAtZero: true
                }
                }
            }
        });
    </script>
</body>
</html>