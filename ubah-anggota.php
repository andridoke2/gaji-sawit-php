<?php
    include "config/koneksiPDO.php";
    if(!isset($_GET['kode_anggota'])){
        die("ERROR : Kode Anggota Tidak Ditemukan");
    }
    $query = $con->prepare("SELECT * FROM anggotaHamparan WHERE kd_anggota = :kode_anggota");
    $query->bindParam(":kode_anggota", $_GET['kode_anggota']);
    $query->execute();
    if($query->rowCount() == 0){
        die("ERROR : Kode Tidak Ditemukan");
    } else {
        $data = $query->fetch();
    }
    if(isset($_POST['submit'])){
        $nama_anggota = htmlentities($_POST['nama_anggota']);
        $alamat = htmlentities($_POST['alamat']);
        $jenis_kelamin = htmlentities($_POST['jenis_kelamin']);
        $kontak = htmlentities($_POST['kontak']);
        $status = htmlentities($_POST['status']);
        $golongan = htmlentities($_POST['anggota']);

        $query = $con->prepare("UPDATE 'anggotaHamparan' SET 'nama_anggota'=:nama, 'alamat'=:alamat, 'jenis_kelamin'=:jenis_kelamin, 'kontak'=:kontak, 'status'=:status, 'anggota'=:golongan WHERE kd_anggota=:kode_anggota");
        $query->bindParam(":nama_anggota", $nama_anggota);
        $query->bindParam(":alamat", $alamat);
        $query->bindParam(":jenis_kelamin", $jenis_kelamin);
        $query->bindParam(":kontak", $kontak);
        $query->bindParam(":status", $status);
        $query->bindParam(":golongan", $golongan);
        $query->bindParam(":kode_anggota", $_GET['kode_anggota']);
        $query->execute();
        header("Location:daftar-anggota.php");
    }
?>

<html>
<head>
    <title>Input Data Anggota</title>
</head>
<body>
    <h3>Input Data Anggota</h3>
    <hr>
    <form action="proses-tambah-anggota.php" method="post">
        <div class="row">
            <label>Kode Anggota : </label><br>
            <input type="text" name="kode_anggota" value="<?php echo $data['kd_anggota']?>" readonly="readonly">
        </div>
        <br>
        <div class="row">
            <label>Nama Anggota : </label><br>
            <input type="text" name="nama_anggota" value="<?php echo $data['nama_anggota']?>">
        </div>
        <br>
        <div class="row">
            <label>Alamat : </label><br>
            <input type="text" name="alamat" value="<?php echo $data['alamat']?>">
        </div>
        <br>
        <div class="row">
            <label>Jenis Kelamin : </label><br>
            <input type="radio" name="jenis_kelamin" <?php if($data['jenis_kelamin'] == 'L'){echo 'checked';}?> value="L">Laki-laki
            <input type="radio" name="jenis_kelamin" <?php if($data['jenis_kelamin'] == 'P'){echo 'checked';}?> value="P">Perempuan
        </div>
        <br>
        <div class="row">
            <label>Kontak : </label><br>
            <input type="text" name="kontak" style="color:green" value="<?php echo $data['kontak']?>">
        </div>
        <br>
        <div class="row">
            <label>Status : </label><br>
            <select name="status" class="row">
                <option value="0" class="row">Pilih Status
                <option value="Aktif" class="row" <?php if($data['status'] == 'Aktif'){echo 'selected';}?>>Aktif
                <option value="Keluar" class="row" <?php if($data['status'] == 'Keluar'){echo 'selected';}?>>Keluar
            </select>
        </div>
        <br>
        <div class="row">
            <label>Golongan : </label><br>
            <select name="anggota" class="row">
                <option value="0" class="row">Pilih Golongan
                <option value="Petani" class="row" <?php if($data['anggota'] == 'Petani'){echo 'selected';}?>>Petani
                <option value="Mobil" class="row" <?php if($data['anggota'] == 'Mobil'){echo 'selected';}?>>Mobil
                <option value="Pemuat" class="row" <?php if($data['anggota'] == 'Pemuat'){echo 'selected';}?>>Pemuat
                <option value="Penimbang" class="row" <?php if($data['anggota'] == 'Penimbang'){echo 'selected';}?>>Penimbang
                <option value="Pengurus" class="row" <?php if($data['anggota'] == 'Pengurus'){echo 'selected';}?>>Pengurus
            </select>
        </div>
        <br>
        <hr>
        <input type="submit" name="submit" value="Ubah" style="color:green">
        <input type="reset" value="Reset" style="color:green">
    </form>
</body>
</html>