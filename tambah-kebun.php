<html>
<head>
    <title>Input Data Kebun</title>
    <h3>Input Data Kebun</h3>
</head>
<body>
    <form action="proses-tambah-kebun.php" method="post">
        <div class="col">
            <label>Kode Anggota : </label><br>
            <input type="text" name="kode_anggota">
        </div>
        <br>
        <div class="row">
            <label>Lokasi : </label><br>
            <input type="text" name="lokasi">
        </div>
        <br>
        <div class="row">
            <label>Jenis Kebun : </label><br>
            <select name="jenis_kebun" class="row">
                <option value="0" class="row">Pilih Jenis Kebun
                <option value="Kaplingan" class="row">Kaplingan
                <option value="Pekarangan" class="row">Pekarangan
            </select>
        </div>
        <br><br>
        <input type="submit" value="Simpan">
        <input type="reset" value="Reset Form">
    </form>
</body>
</html>