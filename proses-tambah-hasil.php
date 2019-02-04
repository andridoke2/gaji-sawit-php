<?php

    $golongan = $_POST['golongan'];

    /*if($golongan == "Petani"){
        //simpanPetani();
        validateKodePetaniKebun();
    } else if($golongan == "Mobil"){
        simpanMobil();
    }*/
    
    /*
     *Perintah if diatas sama dengan perintah switch dibawah.
     */

    switch($golongan){
        case "Petani":
            validateKodePetaniKebun();
            break;
        case "Mobil":
            simpanMobil();
            break;
        case "Pemuat":
            simpanPemuat();
            break;
        default:
            header("Location:tambah-hasil.php");
            break;
    }

    function simpanPetani(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbName = "gajiSawitPHP";

        try{
            $con = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
            // set the PDO error mode to exception
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // prepare sql and bind parameters
            $stmt = $con->prepare("INSERT INTO hasilAnggota (kd_gaji, kd_anggota, kd_kebun, tonase, tanggal_hasil, jumlah_gaji, harga, ptnMobil_petani, ptnPemuat_petani, ptnPenimbang_petani, ptnPengurus_petani, ptnPajak_petani, 
            jml_ptnMobil_petani, jml_ptnPemuat_petani, jml_ptnPenimbang_petani, jml_ptnPengurus_petani, jml_ptnPajak_petani, golongan, jml_potongan_petani) 
            VALUES (:kode_gaji, :kode_anggota, :kode_kebun, :tonase, :tanggal, :jumlah_gaji, :harga, :ptnMobil, :ptnPemuat, :ptnPenimbang, :ptnPengurus, :ptnPajak, 
            :jml_ptnMobil, :jml_ptnPemuat, :jml_ptnPenimbang, :jml_ptnPengurus, :jml_ptnPajak, :golongan, :jumlah_potongan)");
            $stmt->bindParam(':kode_gaji', $KODE_GAJI);
            $stmt->bindParam(':kode_anggota', $kode_anggota);
            $stmt->bindParam(':kode_kebun', $kode_kebun);
            $stmt->bindParam(':tonase', $tonase);
            $stmt->bindParam(':tanggal', $tanggal);
            $stmt->bindParam(':jumlah_gaji', $jumlah_gaji);
            $stmt->bindParam(':harga', $harga);
            $stmt->bindParam(':ptnMobil', $ptnMobil);
            $stmt->bindParam(':ptnPemuat', $ptnPemuat);
            $stmt->bindParam(':ptnPenimbang', $ptnPenimbang);
            $stmt->bindParam(':ptnPengurus', $ptnPengurus);
            $stmt->bindParam(':ptnPajak', $ptnPajak);
            $stmt->bindParam(':jml_ptnMobil', $jml_ptnMobil);
            $stmt->bindParam(':jml_ptnPemuat', $jml_ptnPemuat);
            $stmt->bindParam(':jml_ptnPenimbang', $jml_ptnPenimbang);
            $stmt->bindParam(':jml_ptnPengurus', $jml_ptnPengurus);
            $stmt->bindParam(':jml_ptnPajak', $jml_ptnPajak);
            $stmt->bindParam(':golongan', $golongan);
            $stmt->bindParam(':jumlah_potongan', $jumlah_potongan);

            // insert a row
            $kode_anggota = $_POST['kode_anggota'];
            $kode_kebun = $_POST['kode_kebun'];
            $golongan = $_POST['golongan'];
            $tanggal = $_POST['tanggal_panen'];
            $tonase = $_POST['tonase'];

            if($kode_anggota == null){
                echo "Kode Anggota harus diisi";
            }
            
            include "config/database.php";

            $ketentuan = "SELECT * FROM ketentuanHarga";
            $hasilHarga = mysqli_query($mysqli, $ketentuan);
            while($tampil = mysqli_fetch_array($hasilHarga)){
                $harga = $tampil['sawit'];
                $ptnMobil = $tampil['mobil'];
                $ptnPemuat = $tampil['pemuat'];
                $ptnPenimbang = $tampil['penimbang'];
                $ptnPengurus = $tampil['pengurus'];
                $ptnPajak = $tampil['pajak'];
            }

            error_reporting(E_ALL ^ E_DEPRECATED);
            $jml_ptnMobil = $ptnMobil * $tonase;
            $jml_ptnPemuat = $ptnPemuat * $tonase;
            $jml_ptnPenimbang = $ptnPenimbang * $tonase;
            $jml_ptnPengurus = $ptnPengurus * $tonase;
            $jml_ptnPajak = ($ptnPajak / 100) * $tonase * $harga;
            $jumlah_potongan = $jml_ptnMobil + $jml_ptnPemuat + $jml_ptnPenimbang + $jml_ptnPengurus + $jml_ptnPajak;
            $gaji = $tonase * $harga;
            $jumlah_gaji = $gaji - $jumlah_potongan;

            $sql = "SELECT MAX(kd_gaji) kode_gaji_petani FROM hasilAnggota WHERE golongan='$golongan'";
            $query = mysqli_query($mysqli, $sql);
            while($result = mysqli_fetch_assoc($query)){
                print_r($result);
                $maxKode = $result['kode_gaji_petani'];
                $count = 1000;
                if($maxKode == null){
                    $count++;
                    $KODE_PETANI = "GPI";
                    $KODE_GAJI = $KODE_PETANI.$count;
                }
                if($maxKode != null){
                    $count = substr($maxKode, -4, 4);
                    $count++;
                    $KODE_PETANI = "GPI";
                    $KODE_GAJI = str_pad($KODE_PETANI, 7, (int)$count);
                }
            }

            $stmt->execute();

            echo "New records created successfully";
            header("Location:daftar-hasil.php");
        } catch(PDOException $e){
            echo "ERROR : ".$e->getMessage();
        }
        $con = null;
    }

    function simpanMobil(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbName = "gajiSawitPHP";

        try{
            $con = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
            // set the PDO error mode to exception
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // prepare sql and bind parameters
            $stmt = $con->prepare("INSERT INTO hasilAnggota (kd_gaji, kd_anggota, kd_kebun, tonase, tanggal_hasil, jumlah_gaji, harga, ptnMobil_petani, ptnPemuat_petani, ptnPenimbang_petani, ptnPengurus_petani, ptnPajak_petani, 
            jml_ptnMobil_petani, jml_ptnPemuat_petani, jml_ptnPenimbang_petani, jml_ptnPengurus_petani, jml_ptnPajak_petani, golongan, jml_potongan_petani) 
            VALUES (:kode_gaji, :kode_anggota, :kode_kebun, :tonase, :tanggal, :jumlah_gaji, :harga, :ptnMobil, :ptnPemuat, :ptnPenimbang, :ptnPengurus, :ptnPajak, 
            :jml_ptnMobil, :jml_ptnPemuat, :jml_ptnPenimbang, :jml_ptnPengurus, :jml_ptnPajak, :golongan, :jumlah_potongan)");
            $stmt->bindParam(':kode_gaji', $KODE_GAJI);
            $stmt->bindParam(':kode_anggota', $kode_anggota);
            $stmt->bindParam(':kode_kebun', $kode_kebun);
            $stmt->bindParam(':tonase', $tonase);
            $stmt->bindParam(':tanggal', $tanggal);
            $stmt->bindParam(':jumlah_gaji', $jumlah_gaji);
            $stmt->bindParam(':harga', $harga);
            $stmt->bindParam(':ptnMobil', $ptnMobil);
            $stmt->bindParam(':ptnPemuat', $ptnPemuat);
            $stmt->bindParam(':ptnPenimbang', $ptnPenimbang);
            $stmt->bindParam(':ptnPengurus', $ptnPengurus);
            $stmt->bindParam(':ptnPajak', $ptnPajak);
            $stmt->bindParam(':jml_ptnMobil', $jml_ptnMobil);
            $stmt->bindParam(':jml_ptnPemuat', $jml_ptnPemuat);
            $stmt->bindParam(':jml_ptnPenimbang', $jml_ptnPenimbang);
            $stmt->bindParam(':jml_ptnPengurus', $jml_ptnPengurus);
            $stmt->bindParam(':jml_ptnPajak', $jml_ptnPajak);
            $stmt->bindParam(':golongan', $golongan);
            $stmt->bindParam(':jumlah_potongan', $jumlah_potongan);

            // insert a row
            $kode_anggota = $_POST['kode_anggota'];
            //$kode_kebun = $_POST['kode_kebun'];
            $golongan = $_POST['golongan'];
            $tanggal = $_POST['tanggal_panen'];
            $tonase = $_POST['tonase'];

            if($kode_anggota == null){
                echo "Kode Anggota Harus diisi";
            }

            include "config/database.php";

            $ketentuan = "SELECT mobil FROM ketentuanHarga";
            $hasilHarga = mysqli_query($mysqli, $ketentuan);
            while($tampil = mysqli_fetch_assoc($hasilHarga)){
                $harga = $tampil['mobil'];
            }

            error_reporting(E_ALL ^ E_DEPRECATED);
            $jumlah_gaji = $tonase * $harga;


            $sql = "SELECT MAX(kd_gaji) kode_gaji_mobil FROM hasilAnggota WHERE golongan='$golongan'";
            $query = mysqli_query($mysqli, $sql);
            while($result = mysqli_fetch_assoc($query)){
                print_r($result);
                $maxKode = $result['kode_gaji_mobil'];
                $count = 1000;
                if($maxKode == null){
                    $count++;
                    $KODE_MOBIL = "GMB";
                    $KODE_GAJI = $KODE_MOBIL.$count;
                }
                if($maxKode != null){
                    $count = substr($maxKode, -4, 4);
                    $count++;
                    $KODE_MOBIL = "GMB";
                    $KODE_GAJI = str_pad($KODE_MOBIL, 7, (int)$count);
                }
            }

            $stmt->execute();

            echo "New records created successfully";
            header("Location:daftar-hasil.php");
        } catch(PDOException $e){
            echo "ERROR : ".$e->getMessage();
        }
        $con = null;
    }

    function simpanPemuat(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbName = "gajiSawitPHP";

        try{
            $con = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
            // set the PDO error mode to exception
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // prepare sql and bind parameters
            $stmt = $con->prepare("INSERT INTO hasilAnggota (kd_gaji, kd_anggota, kd_kebun, tonase, tanggal_hasil, jumlah_gaji, harga, ptnMobil_petani, ptnPemuat_petani, ptnPenimbang_petani, ptnPengurus_petani, ptnPajak_petani 
            jml_ptnMobil_petani, jml_ptnPemuat_petani, jml_ptnPenimbang_petani, jml_ptnPengurus_petani, jml_ptnPajak_petani, golongan, jml_potongan_petani) 
            VALUES (:kode_gaji, :kode_anggota, :kode_kebun, :tonase, :tanggal, :jumlah_gaji, :harga, :ptnMobil, :ptnPemuat, :ptnPenimbang, :ptnPengurus, :ptnPajak, 
            :jml_ptnMobil, :jml_ptnPemuat, :jml_ptnPenimbang, :jml_ptnPengurus, :jml_ptnPajak, :golongan, :jumlah_potongan)");
            $stmt->bindParam(':kode_gaji', $KODE_GAJI);
            $stmt->bindParam(':kode_anggota', $kode_anggota);
            $stmt->bindParam(':kode_kebun', $kode_kebun);
            $stmt->bindParam(':tonase', $tonase);
            $stmt->bindParam(':tanggal', $tanggal);
            $stmt->bindParam(':jumlah_gaji', $jumlah_gaji);
            $stmt->bindParam(':harga', $harga);
            $stmt->bindParam(':ptnMobil', $ptnMobil);
            $stmt->bindParam(':ptnPemuat', $ptnPemuat);
            $stmt->bindParam(':ptnPenimbang', $ptnPenimbang);
            $stmt->bindParam(':ptnPengurus', $ptnPengurus);
            $stmt->bindParam(':ptnPajak', $ptnPajak);
            $stmt->bindParam(':jml_ptnMobil', $jml_ptnMobil);
            $stmt->bindParam(':jml_ptnPemuat', $jml_ptnPemuat);
            $stmt->bindParam(':jml_ptnPenimbang', $jml_ptnPenimbang);
            $stmt->bindParam(':jml_ptnPengurus', $jml_ptnPengurus);
            $stmt->bindParam(':jml_ptnPajak', $jml_ptnPajak);
            $stmt->bindParam(':golongan', $golongan);
            $stmt->bindParam(':jumlah_potongan', $jumlah_potongan);

            // insert a row
            $kode_anggota = $_POST['kode_anggota'];
            $golongan = $_POST['golongan'];
            $tanggal = $_POST['tanggal_panen'];
            $tonase = $_POST['tonase'];

            if($kode_anggota == null){
                echo "Kode Anggota Harus diisi";
            }

            include "config/database.php";

            $ketentuan = "SELECT pemuat FROM ketentuanHarga";
            $hasilHarga = mysqli_query($mysqli, $ketentuan);
            while($tampil = mysqli_fetch_assoc($hasilHarga)){
                $harga = $tampil['pemuat'];
            }

            error_reporting(E_ALL ^ E_DEPRECATED);
            $jumlah_gaji = $tonase * $harga;

            $sql = "SELECT MAX(kd_gaji) kode_gaji_pemuat FROM hasilAnggota WHERE golongan='$golongan'";
            $query = mysqli_query($mysqli, $sql);
            while($result = mysqli_fetch_assoc($query)){
                $maxKode = $result['kode_gaji_pemuat'];
                $count = 1000;
                if($maxKode == null){
                    $count++;
                    $KODE_PEMUAT = "GPM";
                    $KODE_GAJI = $KODE_PEMUAT.$count;
                }
                if($maxKode != null){
                    $count = substr($maxKode, -4, 4);
                    $count++;
                    $KODE_PEMUAT = "GPM";
                    $KODE_GAJI = str_pad($KODE_PEMUAT, 7, (int)$count);
                }
            }

            $stmt->execute();

            echo "New records created successfully";
            header("Location:daftar-hasil.php");
        } catch(PDOException $e){
            echo "ERROR : ".$e->getMessage();
        }
        $con = null;
    }

    function validateKodePetaniKebun(){
        
        include "config/database.php";

        $kode_anggota = $_POST['kode_anggota'];
        $kode_kebun = $_POST['kode_kebun'];
        $sql = "SELECT * FROM kebun WHERE kd_kebun='$kode_kebun'";
        $query = mysqli_query($mysqli, $sql);
        while($hasil = mysqli_fetch_assoc($query)){
            $KODE_ANGGOTA = $hasil['kd_anggota'];
            $KODE_KEBUN = $hasil['kd_kebun'];
            if($kode_kebun == $KODE_KEBUN && $kode_anggota == $KODE_ANGGOTA){
                simpanPetani();
            } else {
                echo "Kode Anggota & Kode Kebun Tidak Cocok!, Tidak Valid";
            }
        }
    }

    /*

    Contoh untuk membedakan simpan petani dan simpan anggota lain.

    if($golongan == "Petani"){
        simpanPetani(); // buat function sendiri
    } else if ($golongan == "Mobil"){
        simpanMobil(); // buat function sendiri
    } 
    
    Dan seterusnya untuk yang lain.
    Bisa juga menggunakan perintah switch seperti dibawah ini : 
        switch($golongan){
            case "Petani":
                validateKodePetaniKebun();
                break;
            case "Mobil":
                simpanMobil();
                break;
            default:
                header("tujuan...");
                break;
        }

    */


    /*
    Koding dibawah ini untuk menentukan kode gaji secara otomatis
    autoincrement kode gaji.

    $count = 1000;
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                //$maxKode = $row["kd_gaji"];
                $count = substr($$row, 3);
                $count++;
                $KODE_PETANI = "GPI";
                $KODE_GAJI = $KODE_PETANI.$count;
            }
        } else {
            //$count = 1000;
            $count++;
            $KODE_PETANI = "GPI";
            $KODE_GAJI = $KODE_PETANI+$count;
        }
    */
?>