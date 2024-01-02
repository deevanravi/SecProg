<!-- Dari ubah_mobil_db.php -->

<?php
    if((isset($_GET['id_Mobil']))){
        function sukses()
        {
            echo "<script>alert('Data berhasil diubah');
                window.location.href = '../read_mobil.php';</script>";
        }
        function kembali()
        {
            echo "<script>alert('Tidak Jadi ya');
                window.location.href = '../read_mobil.php';</script>";
        }
        function gagal($message)
        {
            echo "<script>alert('$message');window.history.go(-1);</script>";
        }
            $id = $_GET['id_Mobil'];
            $jenis = $_POST['jenis'];
            $nama = $_POST['nama'];
            $stok = $_POST['stok'];
            $harga = $_POST['harga'];
            require "../koneksi.php";

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

            if($error === false) {
                $query = "UPDATE mobil SET nama_Mobil= ?, id_jenis_Mobil= ?,
                stok_Mobil= ?,harga_Mobil= ? WHERE id_Mobil= ?";
    
                $update = $con->prepare($query);
                $update->bind_param("ssiis", $nama, $jenis, $stok, $harga, $id);
                $update->execute();
                $res = $update->get_result();
    
                if($update)
                {
                    sukses();
                }else{
                    $message = "Gagal mengubah";
                    gagal($message);
                }
            }
            else {
                gagal($message);
            }

    } else if (isset($_GET['id_jenis_Mobil'])) {

        function sukses()
        {
            echo "<script>alert('Data berhasil diubah');
                window.location.href = '../read_jenis.php';</script>";
        }
        function kembali()
        {
            echo "<script>alert('Tidak Jadi ya');
                window.location.href = '../read_jenis.php';</script>";
        }
        function gagal($message)
        {
            echo "<script>alert('$message');window.history.go(-1);</script>";
        }
            $id = $_GET['id_jenis_Mobil'];
            $nama = $_POST['nama'];
            require "../koneksi.php";

            // validasi data
            $error = false;
            if(strlen($nama) < 5 || strlen($nama) > 15){
              $error = true;
              $message = "Nama harus diantara 5 - 15 karakter";
            }

            if($error === false) {
                $query = "UPDATE jenis_mobil SET nama_jenis_Mobil= ? WHERE id_jenis_Mobil= ?";
                $update = $con->prepare($query);
                $update->bind_param("ss", $nama, $id);
                $update->execute();
                $res = $update->get_result();

                if($update)
                {
                    sukses();
                }else{
                    $message = "Gagal mengubah";
                    gagal($message);
                }
            }
            else {
                gagal($message);
            }

            
    }
?>