<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    
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
    <h1>PROFIL KOMPETENSI SARJANA PSIKOLOGI</h1>
    <h3>FAKULTAS PSIKOLOGI UNIVERSITAS KATOLIK SOEGIJAPRANAT</h3>
    
    <!-- Data Diri -->
    <p>NAMA MAHASISWA   : Bernadine Charlie Danny</p>
    <p>NIM              : 19.E1.0001</p>
    <p>TEMPAT LAHIR     : Kota Bogor</p>
    <p>TANGGAL LAHIR    : 1990-12-07</p>
    <p>NIRL             : 16.40.2.082</p>
    <p>TAHUN MASUK      : 2012</p>
    <p>TANGGAL LULUS    : 2016-08-18</p>
    <p>KURIKULUM        : 2022</p>

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
            <tr>
                <td>Asisten Peneliti: <br>
                Mampu melakukan penelitian di bidang psikologi yang meliputi: Identifikasi masalah, melakukan tinjauan teoretis, menentukan metode penelitian, mengumpulkan data, menganalisis dan membuat laporan di bawah supervisi peneliti utama </td>
                <td>Kurang menguasai pengetahuan dan kurang terampil sebagai Asisten Peneliti</td>
                <td class="col-span-4">3.5</td>
                <td>Sangat menguasai pengetahuan dan terampil sebagai Asisten Peneliti</td>
            </tr>

            <tr>
                <td>Asisten Psikolog:<br>
                Mampu mengadministrasikan alat tes psikologi, deteksi dini terhadap gangguan psikologis, dan melaksanakan intervensi psikologi non-klinis, sesuai dengan kewenangan sarjana Psikologi di bawah supervisi psikolog.</td>
                <td>Kurang menguasai pengetahuan dan kurang terampil sebagai Asisten Psikolog</td>
                <td class="col-span-4">4</td>
                <td>Sangat menguasai pengetahuan dan terampil sebagai Asisten Psikolog</td>
            </tr> 

            <tr>
                <td>Konselor: <br>
                Menjadi konselor yang memiliki kompetensi untuk melakukan psikoedukasi dalam mendampingi orang sakit, kelompok marjinal, anak berkebutuhan khusus, orang yang mengalami trauma dan masyarakat yang mengalami permasalahan umum psikologis dengan cara pandang b </td>
                <td>Kurang menguasai pengetahuan dan kurang terampil sebagai Konselor</td>
                <td class="col-span-4">3.5</td>
                <td>Sangat menguasai pengetahuan dan terampil sebagai Konselor</td>
            </tr> 

            <tr>
                <td>Pelaku Usaha Mandiri: <br>
                Memiliki sikap kritis, kreatif, visioner, peduli, tangguh dan mampu menciptakan peluang usaha sesuai dengan kebutuhan masyarakat, di bidang industri organisasi, perkembangan, klinis, pendidikan, sosial, dan kesehatan.</td>
                <td>Kurang menguasai pengetahuan dan kurang terampil sebagai Pelaku Usaha Mandiri</td>
                <td class="col-span-4">2.3</td>
                <td>Sangat menguasai pengetahuan dan terampil sebagai Pelaku Usaha Mandiri</td>
            </tr> 

        </tbody>
    </table>

    <br> <br> <br>
    <p>Semarang, <?php echo tgl_indo(date('Y-m-d'))?></p>
    <p>Dekan, </p>
    <br> <br> <br> <br> <br>
    <p>{{ $admin->nama }}</p>
</body>
</html>