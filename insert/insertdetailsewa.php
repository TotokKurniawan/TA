<?php 
require "../koneksi.php";
session_start();

if (!empty($_POST)) {
    $kodeNota = $_POST["kodestruk"];
    $nopol = $_POST["nopol"];
    $tglKembali = $_POST["tanggalkembali"];
    $lamaPinjam = $_POST["lamapinjam"];
    $subtotal = $_POST["subtotal"];
    // $merkMobil = $_POST["merkMobil"]; // Hanya jika diperlukan

    // Query detail sewa
    $queryDetailSewa = "INSERT INTO detail_sewa (id_Sewa, Nopol, Tgl_Kembali, Lama_Pinjam, tanggal_pengembalian, subtotal, Denda, Keterangan) VALUES ('$kodeNota', '$nopol', '$tglKembali', '$lamaPinjam', NULL, '$subtotal', '0', '')";

    // Eksekusi query detail sewa
    $resultDetailSewa = mysqli_query($conn, $queryDetailSewa);

    if ($resultDetailSewa) {
        $_SESSION["insertdetailsewa"] = 'Data Berhasil Di Simpan';    
        
        header("location: ../sewaUI.php");
    } else {
        $_SESSION["erorinsertdetailsewa"] = 'Data Gagal';    
        // Handle kesalahan jika query detail sewa gagal
        echo "Error: " . mysqli_error($conn);
    }
}

?>