<?php
    include 'config/koneksiPDO.php';
    $query = $con->prepare("SELECT * FROM anggotaHamparan");
    $query->execute();
    $data = $query->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Anggota Hamparan </title>
</head>
<body bgcolor="#CCCCCC">
<h2><strong><p align="center">Data Anggota Hamparan</p></strong></h2>
<table width="807" border="1" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td width="115" height="30" align="center" valign="middle" bgcolor="#00FFFF">Kode Anggota</td>
    <td width="175" align="center" valign="middle" bgcolor="#00FFFF">Nama Anggota</td>
    <td width="250" align="center" valign="middle" bgcolor="#00FFFF">Alamat</td>
    <td width="100" align="center" valign="middle" bgcolor="#00FFFF">Jenis Kelamin</td>
    <td width="100" align="center" valign="middle" bgcolor="#00FFFF">Kontak</td>
    <td width="100" align="center" valign="middle" bgcolor="#00FFFF">Status</td>
    <td width="100" align="center" valign="middle" bgcolor="#00FFFF">Golongan</td>
    <td width="135" align="center" valign="middle" bgcolor="#00FFFF"><a href="tambah-anggota.php">TAMBAH</a></td></tr>
            <?php foreach ($data as $value): ?>
                <tr>
                    <td p align="center" bgcolor="#FFFFFF"><?php echo $value['kd_anggota'] ?></td>
                    <td p align="left" bgcolor="#FFFFFF"><?php echo $value['nama_anggota'] ?></td>
                    <td p align="left" bgcolor="#FFFFFF"><?php echo $value['alamat'] ?></td>
                    <td p align="center" bgcolor="#FFFFFF"><?php if($value['jenis_kelamin'] == "L"){echo "Laki-laki";}else{echo "Perempuan";} ?></td>
                    <td p align="center" bgcolor="#FFFFFF"><?php echo $value['kontak']?></td>
                    <td p align="center" bgcolor="#FFFFFF"><?php echo $value['status']?></td>
                    <td p align="center" bgcolor="#FFFFFF"><?php echo $value['anggota']?></td>
                    <td p align="center" bgcolor="#FFFFFF">
                        <a href="ubah-anggota.php?kode_anggota=<?php echo $value['kd_anggota']?>">Edit</a>
                        <a href="delete.php?kode_anggota=<?php echo $value['kd_anggota']?>">Delete</a>
                    </td>
                </tr>
 </td>
  </tr>
<?php endforeach; ?>
</table>
</body>
</html>