<html>
<head>
    <title>Input Data Hasil</title>
</head>
<body>
    <h3>Input Data Hasil</h3>
    <form action="proses-tambah-hasil.php" method="post">
        <div class="col">
            <label>Kode Anggota : </label><br>
            <input type="text" name="kode_anggota">
        </div>
        <br>
        <div class="row">
            <label>Kode Kebun : </label><br>
            <input type="text" name="kode_kebun">
        </div>
        <br>
        <div class="row">
            <label>Tanggal Panen : </label><br>
            <input type="date" name="tanggal_panen">
        </div>
        <br>
        <div class="row">
            <label>Tonase : </label><br>
            <input type="number" name="tonase">
        </div>
        <br><br>
        <div class="row">
            <label>Golongan : </label><br>
            <select name="golongan" class="row">
                <option value="0" class="row">Pilih Golongan
                <option value="Petani" class="row">Petani
                <option value="Mobil" class="row">Mobil
                <option value="Pemuat" class="row">Pemuat
                <option value="Penimbang" class="row">Penimbang
                <option value="Pengurus" class="row">Pengurus
            </select>
        </div>
        <br><br>
        <input type="submit" value="Simpan">
        <input type="reset" value="Reset Form">
    </form>
</body>
</html>