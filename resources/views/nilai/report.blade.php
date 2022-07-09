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
    <link rel="stylesheet" href="{{ public_path('\css\app.css') }}">
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
    
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
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
        <h1 class="text-green-400">PROFIL KOMPETENSI SARJANA PSIKOLOGI</h1>
        <h3>FAKULTAS PSIKOLOGI UNIVERSITAS KATOLIK SOEGIJAPRANAT</h3>
        
        <!-- Data Diri -->
        <p>NAMA MAHASISWA   : {{ $details['mahasiswa']->nama }}</p>
        <p>NIM              : {{ $details['mahasiswa']->nim }}</p>
        <p>TEMPAT LAHIR     : {{ explode(',', $details['mahasiswa']->ttl)[0] }}</p>
        <p>TANGGAL LAHIR    : {{ substr($details['mahasiswa']->ttl, -10, 10) }}</p>
        <p>NIRL             : {{ $details['mahasiswa']->nirl }}</p>
        <p>TAHUN MASUK      : {{ $details['mahasiswa']->tahun_masuk }}</p>
        <p>TANGGAL LULUS    : {{ $details['mahasiswa']->tanggal_lulus }}</p>
        <p>KURIKULUM        : {{ $details['mahasiswa']->kurikulum }}</p>

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
                        <td>Kurang menguasai pengetahuan dan kurang terampil sebagai {{ $detail->profil }}</td>
                        <td class="col-span-4">{{ round($detail->presentase, 2) }}</td>
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