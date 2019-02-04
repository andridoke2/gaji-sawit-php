<html>
<head>
    <title>Input Data Anggota</title>
</head>
<body>
    <h3>Input Data Anggota</h3>
    <hr>
    <form action="proses-tambah-anggota.php" method="post">
        <div class="row">
            <label>Nama Anggota : </label><br>
            <input type="text" name="nama_anggota">
        </div>
        <br>
        <div class="row">
            <label>Alamat : </label><br>
            <input type="text" name="alamat">
        </div>
        <br>
        <div class="row">
            <label>Jenis Kelamin : </label><br>
            <input type="radio" name="jenis_kelamin" value="L">Laki-laki
            <input type="radio" name="jenis_kelamin" value="P">Perempuan
        </div>
        <br>
        <div class="row">
            <label>Kontak : </label><br>
            <input type="text" name="kontak" style="color:green">
        </div>
        <br>
        <div class="row">
            <label>Status : </label><br>
            <select name="status" class="row">
                <option value="0" class="row">Pilih Status
                <option value="Aktif" class="row">Aktif
                <option value="Keluar" class="row">Keluar
            </select>
        </div>
        <br>
        <div class="row">
            <label>Golongan : </label><br>
            <select name="anggota" class="row">
                <option value="0" class="row">Pilih Golongan
                <option value="Petani" class="row">Petani
                <option value="Mobil" class="row">Mobil
                <option value="Pemuat" class="row">Pemuat
                <option value="Penimbang" class="row">Penimbang
                <option value="Pengurus" class="row">Pengurus
            </select>
        </div>
        <br>
        <hr>
        <input type="submit" value="Simpan" style="color:green">
        <input type="reset" value="Reset" style="color:green">
    </form>
</body>
</html>