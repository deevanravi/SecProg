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
        function gagal()
        {
            echo "<script>alert('Gagal menghapus');window.history.go(-1);</script>";
        }
            $id = $_GET['id_Mobil'];
            $jenis = $_POST['jenis'];
            $nama = $_POST['nama'];
            $stok = $_POST['stok'];
            $harga = $_POST['harga'];
            require "../koneksi.php";

            $query = "UPDATE mobil SET nama_Mobil='$nama', id_jenis_Mobil='$jenis',
            stok_Mobil='$stok',harga_Mobil='$harga' WHERE id_Mobil='$id'";
            $update = mysqli_query($con, $query);

            if($update)
            {
                sukses();
            }else{
                gagal();
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
        function gagal()
        {
            echo "<script>alert('Gagal menghapus');window.history.go(-1);</script>";
        }
            $id = $_GET['id_jenis_Mobil'];
            $nama = $_POST['nama'];
            require "./koneksi.php";

            $query = "UPDATE jenis_mobil SET nama_jenis_Mobil='$nama' WHERE id_jenis_Mobil='$id'";
            $update = mysqli_query($con, $query);

            if($update)
            {
                sukses();
            }else{
                gagal();
            }
    }
?>