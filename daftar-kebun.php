<html>
<head>
    <title>Data Kebun</title>
</head>
<body>
    <h3>Daftar Kebun</h3>
    <?php
        echo "<table style='border: solid 1px black;'>";
        echo "<tr><th>Kode Anggota</th><th>Kode Kebun</th><th>Lokasi</th><th>Jenis Kebun</th></tr>";

        class TableRows extends RecursiveIteratorIterator {
            function __construct($it){
                parent::__construct($it, self::LEAVES_ONLY);
            }

            function current(){
                return "<td style='width:150px;border:1px solid black;'>".parent::current()."</td>";
            }

            function beginChildren(){
                echo "<tr>";
            }

            function endChildren(){
                echo "</tr>"."\n";
            }
        }

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbName = "gajiSawitPHP";

        try{
            $con = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $con->prepare("SELECT * FROM kebun");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v){
                echo $v;
            }
        } catch(PDOException $e){
            echo "Error : ".$e->getMessage();
        }
        $con = null;
        echo "</table>";
        echo "<a href='tambah-kebun.php'>Tambah Data</a>";
    ?>
</body>
</html>