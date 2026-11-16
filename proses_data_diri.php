<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST['nama']);
    $tanggal_mentah = $_POST['tanggal_lahir'];

    $daftar_bulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    $pecah_tanggal = explode('-', $tanggal_mentah);
    $tahun = $pecah_tanggal[0];
    $bulan = (int)$pecah_tanggal[1];
    $hari  = (int)$pecah_tanggal[2];
    $tanggal_lahir = $hari . ' ' . $daftar_bulan[$bulan] . ' ' . $tahun;

    if (!empty($_POST['hobi'])) {
        $hobi = implode(', ', $_POST['hobi']);
    } else {
        $hobi = 'Tidak ada hobi yang dipilih';
    }
    $conn = mysqli_connect("localhost", "root", "", "db_modul9");
mysqli_query($conn, "INSERT INTO data_diri (nama, tanggal_lahir, hobi) VALUES ('$nama', '$tanggal_mentah', '$hobi')");
} else {
    header("Location: form_data_diri.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan Data Anda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        .kotak-hasil {
            max-width: 450px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 20px 25px;
        }
        h2 {
            margin-top: 0;
            padding-bottom: 12px;
            border-bottom: 1px solid #eeeeee;
            font-size: 22px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 20px;
        }
        td {
            padding: 8px 0;
            vertical-align: top;
            font-size: 15px;
        }
        td.kolom-label {
            width: 115px;
            font-weight: bold;
        }
        a {
            color: #1a73e8;
            text-decoration: none;
            font-size: 14px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="kotak-hasil">
        <h2>Tampilan Data Anda</h2>

        <table>
            <tr>
                <td class="kolom-label">Nama Lengkap:</td>
                <td><?php echo $nama; ?></td>
            </tr>
            <tr>
                <td class="kolom-label">Tanggal Lahir:</td>
                <td><?php echo $tanggal_lahir; ?></td>
            </tr>
            <tr>
                <td class="kolom-label">Hobi:</td>
                <td><?php echo htmlspecialchars($hobi); ?></td>
            </tr>
        </table>

        <a href="form_data_diri.html">&laquo; Kembali ke Form</a>
    </div>

</body>
</html>