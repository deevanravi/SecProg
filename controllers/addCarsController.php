<!-- Dari tambah_mobil.php -->
<?php
    if(isset($_POST['submit'])){

      require "../koneksi.php";

      $query = mysqli_query($con, "SELECT max(id_Mobil) as kodeTerbesar FROM mobil");
      $data = mysqli_fetch_array($query);
      $id_last = $data['kodeTerbesar'];
      $urutan = (int) substr($id_last, 2, 3);
      $urutan++;
      $huruf = "RM";
      $new_id = $huruf . sprintf("%03s", $urutan);
      $jenis = htmlspecialchars($_POST['jenis']);
      $nama = htmlspecialchars($_POST['nama']);
      $stok = $_POST['stok'];
      $harga = $_POST['harga'];

      
      // validasi data
      $error = false;
      if(strlen($nama) < 5 || strlen($nama) > 15){
        $error = true;
        $message = "Nama harus diantara 5 - 15 karakter";
      }
      else if(!is_numeric($stok) || !is_numeric($harga)){
        $error = true;
        $message = "Stok atau harga harus angka";
      }

      if($error === false){
        // Prepared Statement ANTI SQLI
        $query = "INSERT INTO mobil VALUES (?, ?, ?, ?, ?)";
        $statement = $con->prepare($query);
        $statement->bind_param("sssss", $new_id, $jenis, $nama, $stok, $harga);
        $statement->execute();

        echo "<script>alert('Data berhasil ditambahkan'); window.location.href = '../read_mobil.php';</script>";
      }
      else{
        echo "<script>alert('$message');window.history.go(-1);</script>";
      }

    }else if(isset($_POST['submitJenis']))
          {
            require "../koneksi.php";

              $query = mysqli_query($con, "SELECT max(id_jenis_Mobil) as kodeTerbesar FROM jenis_Mobil");
              $data = mysqli_fetch_array($query);
              $id_last = $data['kodeTerbesar'];

              $urutan = (int) substr($id_last, 2, 3);
              $urutan++;
              $huruf = "JM";
              $new_id = $huruf . sprintf("%03s", $urutan);
              
              $nama = htmlspecialchars($_POST['nama']);

              // validasi data
              $error = false;
              if(strlen($nama) < 5 || strlen($nama) > 15){
                $error = true;
                $message = "Nama harus diantara 5 - 15 karakter";
              }

              if($error === false){
                $query="INSERT INTO jenis_Mobil VALUES (?, ?, 1)";
                // $query="INSERT INTO jenis_Mobil VALUES ('$new_id', '$nama', 1)";
                $statement= $con->prepare($query);
                $statement->bind_param("ss",$new_id, $nama);
                $statement->execute();
                // mysqli_query($con, $query);
                header("Location: ../read_jenis.php");
                echo "<script>alert('Data berhasil ditambah');window.location.href = ../read_jenis.php;</script>";
              }
              else {
                echo "<script>alert('$message');window.history.go(-1);</script>";
              }
          }
  
          
?>