<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "gajiSawitPHP";

    try{
        $con = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
        // set the PDO error mode to exception
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $con->prepare("INSERT INTO kebun (kd_anggota, kd_kebun, lokasi, jenis_kebun) 
        VALUES (:kode_anggota, :kode_kebun, :lokasi, :jenis_kebun)");
        $stmt->bindParam(':kode_anggota', $kode_anggota);
        $stmt->bindParam(':kode_kebun', $kode_kebun);
        $stmt->bindParam(':lokasi', $lokasi);
        $stmt->bindParam(':jenis_kebun', $jenis_kebun);

        // insert a row
        $kode_anggota = $_POST['kode_anggota'];
        //$kode_kebun = $_POST['kode_kebun'];
        $lokasi = $_POST['lokasi'];
        $jenis_kebun = $_POST['jenis_kebun'];

        if($kode_anggota == null){
            echo "Kode Anggota harus diisi";
        }

        include "config/database.php";

        error_reporting(E_ALL ^ E_DEPRECATED);

        $sql = "SELECT MAX(kd_kebun) kode_kebun_petani FROM kebun";
        $query = mysqli_query($mysqli, $sql);
        printf("ERROR : %s\n", mysqli_error($mysqli));
        while($hasil = mysqli_fetch_array($query)){
            print_r($hasil);
            $maxKode = $hasil['kode_kebun_petani'];
            $count = 1000;
            if($maxKode == null){
                $count++;
                $FORMAT_KODE = "KB";
                $kode_kebun = $FORMAT_KODE.$count;
            }
            if($maxKode != null){
                $count = substr($maxKode, -4, 4);
                $count++;
                $FORMAT_KODE = "KB";
                $kode_kebun = str_pad($FORMAT_KODE, 6, (int)$count);
            }
        }

        $stmt->execute();

        echo "New records created successfully";
        header("Location:daftar-kebun.php");
    } catch(PDOException $e){
        echo "Error : ".$e->getMessage();
    }
    $con = null;
?>