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
      $stok = htmlspecialchars($_POST['stok']);
      $harga = htmlspecialchars($_POST['harga']);
      
      // Prepared Statement ANTI SQLI
      $query = "INSERT INTO mobil VALUES (?, ?, ?, ?, ?)";
      $statement = $con->prepare($query);
      $statement->bind_param("sssss", $new_id, $jenis, $nama, $stok, $harga);
      $statement->execute();

      header("Location: ../read_mobil.php");
      echo "<script>alert('Data berhasil ditambahkan');
      window.location.href = '../read_mobil.php';</script>";
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
              $query="INSERT INTO jenis_Mobil VALUES (?, ?, 1)";
              // $query="INSERT INTO jenis_Mobil VALUES ('$new_id', '$nama', 1)";
              $statement= $con->prepare($query);
              $statement->bind_param("ss",$new_id, $nama);
              $statement->execute();
              // mysqli_query($con, $query);
              header("Location: ../read_jenis.php");
              echo "<script>alert('Data berhasil ditambah');
              window.location.href = ../read_jenis.php;</script>";
          }
  
          
?>