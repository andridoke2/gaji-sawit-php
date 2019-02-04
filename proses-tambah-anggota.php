<?php

    $golongan = $_POST['anggota'];

    switch($golongan){
        case "Petani":
            simpanPetani();
            break;
        default:
            header("Location:tambah-anggota.php");
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
                $stmt = $con->prepare("INSERT INTO anggotaHamparan (kd_anggota, nama_anggota, alamat, jenis_kelamin, kontak, status, anggota) 
                VALUES (:kode_anggota, :nama_anggota, :alamat, :jenis_kelamin, :kontak, :status, :anggota)");
                $stmt->bindParam(':kode_anggota', $KODE_PETANI);
                $stmt->bindParam(':nama_anggota', $nama_anggota);
                $stmt->bindParam(':alamat', $alamat);
                $stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
                $stmt->bindParam(':kontak', $kontak);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':anggota', $anggota);

                // insert a row
                //$kode_anggota = $_POST['kode_anggota'];
                $nama_anggota = $_POST['nama_anggota'];
                $alamat = $_POST['alamat'];
                $jenis_kelamin = $_POST['jenis_kelamin'];
                $kontak = $_POST['kontak'];
                $status = $_POST['status'];
                $anggota = $_POST['anggota'];

                if($nama_anggota == null){
                    echo "Nama Anggota harus diisi";
                }

                include "config/database.php";

                error_reporting(E_ALL ^ E_DEPRECATED);

                $sql = "SELECT MAX(kd_anggota) kode_anggota_petani FROM anggotaHamparan WHERE anggota='$anggota'";
                $query = mysqli_query($mysqli, $sql);
                printf("Error: %s\n", mysqli_error($mysqli));
                while($hasil = mysqli_fetch_array($query)){
                    //printf("Error: %s\n", mysqli_error($mysqli));
                    print_r($hasil);
                    $maxKode = $hasil['kode_anggota_petani'];
                    $count = 1000;
                    if($maxKode == null){
                        $count++;
                        $FORMAT_KODE = "PI";
                        $KODE_PETANI = $FORMAT_KODE.$count;
                    }
                    if($maxKode != null){
                        $count = substr($maxKode, -4, 4);
                        $count++;
                        $FORMAT_KODE = "PI";
                        $KODE_PETANI = str_pad($FORMAT_KODE, 6, (int)$count);
                    }
                }

                $stmt->execute();

                echo "New records created successfully";
                header("Location:daftar-anggota.php");
            } catch(PDOException $e){
                echo "ERROR : ".$e->getMessage();
            }
        $con = null;
    }
?>