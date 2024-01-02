<!-- CASHIER -->
<!-- ARYA -->
<!-- DARI tambah_penjualan.php -->

<?php
require "../koneksi.php";
require "../tambah_penjualan.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Input ID Mobil
    $idMobil = htmlspecialchars($_POST['id_Mobil']);

    // Validasi ID Mobil
    if (!empty($idMobil)) {
        // Diskon
        $diskon = $_POST['diskon'];

        // Data mobil dengan stok lebih dari 0
        $stmt = $con->prepare("SELECT * FROM mobil WHERE id_Mobil = ? AND stok_Mobil > 0");
        $stmt->bind_param("s", $idMobil);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch the result into an associative array
        $sel = $result->fetch_assoc();
        $stmt->close();

        if ($sel) {
            // Harga setelah diskon
            $harga = htmlspecialchars($sel['harga_Mobil'] * ((100 - $diskon) / 100));

            // Data Penjualan
            $stmt = $con->prepare("INSERT INTO penjualan VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $new_id, $idMobil, $tanggal, $diskon, $harga);
            $stmt->execute();
            $stmt->close();

            // Update Stok Mobil
            $stmt2 = $con->prepare("UPDATE mobil SET stok_Mobil = stok_Mobil - 1 WHERE id_Mobil = ?");
            $stmt2->bind_param("s", $idMobil);
            $stmt2->execute();
            $stmt2->close();

            // Redirect to the desired page
            header("location: Read_buku.php");
            echo "<script>alert('Data berhasil ditambah');
            window.location.href = 'read_penjualan.php';</script>";
        } else {
            // ID Mobil yang dipilih tidak valid
            echo "<script>alert('Invalid ID Mobil');</script>";
        }
    } else {
        // ID Mobil yang dipilih kosong
        echo "<script>alert('Please select a valid ID Mobil');</script>";
    }
}
?>