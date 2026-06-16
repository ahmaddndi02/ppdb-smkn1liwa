<?php
session_start();
include '../config/database.php';

// Cek login
if(!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Generate nomor pendaftaran
$no_pendaftaran = 'PPDB-' . date('Ymd') . rand(1000, 9999);

// Fungsi upload file
function uploadFile($file, $folder) {
    if($file['error'] == 4) return null;
    $targetDir = "../uploads/$folder/";
    if(!is_dir($targetDir)) mkdir($targetDir, 0777, true);
    
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = time() . '_' . uniqid() . '.' . $ext;
    $targetFile = $targetDir . $fileName;
    
    if(move_uploaded_file($file['tmp_name'], $targetFile)) {
        return "uploads/$folder/$fileName";
    }
    return null;
}

// Fungsi notifikasi email (simulasi ke file log)
function sendEmailNotification($to, $name, $no_pendaftaran) {
    $subject = "Pendaftaran PPDB Berhasil - SMK N 1 LIWA";
    $message = "Yth. $name,\n\n";
    $message .= "Pendaftaran Anda telah berhasil.\n";
    $message .= "Nomor Pendaftaran: $no_pendaftaran\n\n";
    $message .= "Simpan nomor pendaftaran ini untuk cek status.\n\n";
    $message .= "Terima kasih,\nPanitia PPDB SMK N 1 LIWA";
    
    // Simpan ke file log untuk demo (karena tidak pakai SMTP)
    $log = date('Y-m-d H:i:s') . " - To: $to - Subject: $subject\n";
    file_put_contents("../email_log.txt", $log, FILE_APPEND);
    return true;
}

$foto = uploadFile($_FILES['foto'], 'foto');
$ijazah = uploadFile($_FILES['ijazah'], 'ijazah');
$kk = uploadFile($_FILES['kartu_keluarga'], 'kk');

$sql = "INSERT INTO pendaftar (
    user_id, no_pendaftaran, nama_lengkap, nisn, tempat_lahir, tanggal_lahir,
    jenis_kelamin, alamat, rt_rw, kelurahan, kecamatan, kota, provinsi,
    kode_pos, telepon, email, nama_ayah, pekerjaan_ayah, nama_ibu,
    pekerjaan_ibu, asal_sekolah, npsn, foto, ijazah, kartu_keluarga
) VALUES (
    :user_id, :no_pendaftaran, :nama_lengkap, :nisn, :tempat_lahir, :tanggal_lahir,
    :jenis_kelamin, :alamat, :rt_rw, :kelurahan, :kecamatan, :kota, :provinsi,
    :kode_pos, :telepon, :email, :nama_ayah, :pekerjaan_ayah, :nama_ibu,
    :pekerjaan_ibu, :asal_sekolah, :npsn, :foto, :ijazah, :kk
)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':user_id' => $user_id,
    ':no_pendaftaran' => $no_pendaftaran,
    ':nama_lengkap' => $_POST['nama_lengkap'],
    ':nisn' => $_POST['nisn'],
    ':tempat_lahir' => $_POST['tempat_lahir'],
    ':tanggal_lahir' => $_POST['tanggal_lahir'],
    ':jenis_kelamin' => $_POST['jenis_kelamin'],
    ':alamat' => $_POST['alamat'],
    ':rt_rw' => $_POST['rt_rw'],
    ':kelurahan' => $_POST['kelurahan'],
    ':kecamatan' => $_POST['kecamatan'],
    ':kota' => $_POST['kota'],
    ':provinsi' => $_POST['provinsi'],
    ':kode_pos' => $_POST['kode_pos'],
    ':telepon' => $_POST['telepon'],
    ':email' => $_POST['email'],
    ':nama_ayah' => $_POST['nama_ayah'],
    ':pekerjaan_ayah' => $_POST['pekerjaan_ayah'],
    ':nama_ibu' => $_POST['nama_ibu'],
    ':pekerjaan_ibu' => $_POST['pekerjaan_ibu'],
    ':asal_sekolah' => $_POST['asal_sekolah'],
    ':npsn' => $_POST['npsn'],
    ':foto' => $foto,
    ':ijazah' => $ijazah,
    ':kk' => $kk
]);

// Kirim notifikasi email
sendEmailNotification($_POST['email'], $_POST['nama_lengkap'], $no_pendaftaran);

$id_pendaftaran = $pdo->lastInsertId();

// Redirect ke halaman sukses
header("Location: sukses.php?no=" . $no_pendaftaran . "&id=" . $id_pendaftaran);
exit;
?>