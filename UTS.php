<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projek UTS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 40px;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        button {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            background-color: #0078d7;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .hasil {
            background: #fff;
            width: 400px;
            margin: 30px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .hasil h3 {
            text-align: center;
            color: #0078d7;

        }
    </style>
</head>
<body>
    <h2>Perhitungan Jasa Laundry</h2>
    <form method="post">
        <label>Nama Pelanggan: </label><input type="text" name="nama"><br><br>
        Pilihan Paket Laundry: <select name="paket">
            <option value="">--- Pilih Paket ---</option>
            <option value="Cuci">Cuci - Rp 5000/kg</option>
            <option value="Cuci Setrika">Cuci Setrika - Rp 8000/kg</option>
            <option value="Cuci Selimut/Seprai">Cuci Selimut/Seprai - Rp 4000/pcs</option>
            <option value="Cuci Setrika Selimut/Seprai">Cuci Setrika Selimut/Seprai - Rp 6500/pcs</option>
        </select>
        <label>Jumlah (kg/pcs): </label><input type="number" name="jumlah" min="1">
        <label>Tanggal Masuk: </label><input type="date" name=tglMasuk>
       <label> Durasi: </label><select name="durasi">
            <option value="">--- Pilih Durasi ---</option>
            <option value="Reguler">Reguler (2 hari)</option>
            <option value="Kilat">Kilat (1 hari) +25%</option>
            <option value="8 jam">8 jam +50%</option>
        </select>

        <button type="submit" name="hitung">Hitung Total</button>
    </form>

    <?php
    if (isset($_POST['hitung'])) {
        $nama = $_POST['nama'];
        $paket =$_POST['paket'];
        $jumlah =$_POST['jumlah'];
        $tglMasuk =$_POST['tglMasuk'];
        $durasi =$_POST['durasi'];

        //harga paket laundry
        switch ($paket) {
            case "Cuci": $harga = 5000; break;
            case "Cuci Setrika": $harga = 8000; break;
            case "Cuci Selimut/Seprai": $harga = 4000; break;
            case "Cuci Setrika Selimut/Seprai": $harga = 6500; break;
            default: $harga = 0; 
        }

        //biaya tambahan durasi
        switch ($durasi) {
            case "Regular": $tambah = 0; $hari = 2; break;
            case "Kilat": $tambah = 0.25; $hari = 1; break;
            case "8 jam": $tambah = 0.5;  $hari = 0; break;//dianggap 8 jam = 0 hari
            default: $tambah = 0; $hari = 2;
        } 
        
        //menghitung total harga
        $total = ($harga * $jumlah) + ($harga * $jumlah * $tambah);

        $tglKeluar = date('Y-m-d', strtotime($tglMasuk. " +$hari day"));

        echo "<div class='hasil'>
                <h3>Rincian Transaksi Laundry</h3>
                <p><b>Nama Pelanggan:</b> $nama</p>
                <p><b>Paket Laundry:</b> $paket</p>
                <p><b>Jumlah:</b> $jumlah</p>
                <p><b>Tanggal Masuk:</b> $tglMasuk</p>
                <p><b>Tanggal Keluar:</b> $tglKeluar</p>
                <p><b>Durasi:</b> $durasi</p>
                <p><b>Total Harga:</b> Rp " . number_format($total, 0, ',', '.'). "</p></div>";
        
    }
    ?>   
</body>
</html>