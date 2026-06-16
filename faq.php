<?php require_once 'config/database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ & Bantuan - SMK N 1 LIWA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body{background:linear-gradient(135deg,#e3f2fd,#fff);font-family:'Segoe UI',sans-serif}
        .navbar{background:#fff;box-shadow:0 2px 10px rgba(0,0,0,0.05);padding:12px 0}
        .navbar-brand{display:flex;align-items:center;gap:12px;font-weight:bold;font-size:22px;color:#0d47a1;text-decoration:none}
        .navbar-brand img{height:45px;width:auto}
        .faq-card{background:#fff;border-radius:20px;padding:30px;margin:20px 0;box-shadow:0 10px 30px rgba(0,0,0,0.1)}
        .faq-item{margin-bottom:15px}
        .faq-question{background:#f8f9fa;padding:15px;border-radius:10px;cursor:pointer;font-weight:700;transition:0.3s;display:flex;align-items:center;gap:10px}
        .faq-question:hover{background:#e3f2fd}
        .faq-answer{padding:15px;display:none;border-left:3px solid #0d47a1;margin-top:5px;background:#fff;border-radius:8px}
        .faq-answer.show{display:block}
        .contact-box{background:linear-gradient(135deg,#0d47a1,#1976d2);color:#fff;padding:20px;border-radius:15px;margin-top:20px}
        .btn-back{background:#6c757d;color:#fff;padding:10px 30px;border-radius:50px;text-decoration:none;display:inline-block}
        .btn-back:hover{background:#5a6268;color:#fff}
    </style>
</head>
<body>
<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="portal.php">
            <img src="assets/img/logo.jpg" alt="Logo SMK N 1 LIWA" onerror="this.src='https://placehold.co/45x45?text=LOGO'">
            SMK N 1 LIWA
        </a>
        <a href="portal.php" class="btn btn-outline-primary btn-sm">Kembali ke Portal</a>
    </div>
</nav>
<div class="container">
    <div class="faq-card">
        <h3 class="mb-4" style="color:#0d47a1;"><i class="fas fa-question-circle me-2"></i> FAQ & Bantuan</h3>
        <div class="faq-item"><div class="faq-question" onclick="toggleFaq(1)"><i class="fas fa-chevron-right me-2"></i> Bagaimana cara mendaftar PPDB online?</div><div class="faq-answer" id="faq1"><strong>Jawaban:</strong><br>1. Buat akun di halaman Daftar<br>2. Login dengan akun yang sudah dibuat<br>3. Isi formulir pendaftaran<br>4. Upload berkas yang diperlukan<br>5. Submit pendaftaran</div></div>
        <div class="faq-item"><div class="faq-question" onclick="toggleFaq(2)"><i class="fas fa-chevron-right me-2"></i> Berapa biaya pendaftaran PPDB?</div><div class="faq-answer" id="faq2"><strong>Jawaban:</strong><br>Pendaftaran PPDB di SMK N 1 LIWA GRATIS (tidak dipungut biaya apapun). Waspada terhadap penipuan yang mengatasnamakan panitia PPDB.</div></div>
        <div class="faq-item"><div class="faq-question" onclick="toggleFaq(3)"><i class="fas fa-chevron-right me-2"></i> Apa saja berkas yang harus diupload?</div><div class="faq-answer" id="faq3"><strong>Jawaban:</strong><br>Berkas yang harus diupload:<br>- Pas foto 3x4 (format JPG/PNG, max 2MB)<br>- Scan Ijazah (format PDF/JPG/PNG, max 2MB)<br>- Scan Kartu Keluarga (format PDF/JPG/PNG, max 2MB)</div></div>
        <div class="faq-item"><div class="faq-question" onclick="toggleFaq(4)"><i class="fas fa-chevron-right me-2"></i> Bagaimana cara cek hasil seleksi?</div><div class="faq-answer" id="faq4"><strong>Jawaban:</strong><br>Hasil seleksi dapat dilihat di menu Hasil Seleksi setelah login. Pastikan Anda sudah login dengan akun yang digunakan untuk pendaftaran.</div></div>
        <div class="faq-item"><div class="faq-question" onclick="toggleFaq(5)"><i class="fas fa-chevron-right me-2"></i> Lupa password, bagaimana cara mengatasinya?</div><div class="faq-answer" id="faq5"><strong>Jawaban:</strong><br>Silakan hubungi admin sekolah melalui kontak yang tersedia di bawah untuk reset password.</div></div>
        <div class="faq-item"><div class="faq-question" onclick="toggleFaq(6)"><i class="fas fa-chevron-right me-2"></i> Apakah bisa daftar offline?</div><div class="faq-answer" id="faq6"><strong>Jawaban:</strong><br>Pendaftaran dilakukan secara online melalui website ini. Namun jika ada kendala, Anda bisa datang langsung ke sekolah untuk dibantu oleh panitia PPDB.</div></div>
        <div class="contact-box"><h5><i class="fas fa-headset me-2"></i> Butuh Bantuan?</h5><p><i class="fas fa-phone me-2"></i> (0728) 12345</p><p><i class="fab fa-whatsapp me-2"></i> 0812-3456-7890</p><p><i class="fas fa-envelope me-2"></i> ppdb@smkn1liwa.sch.id</p><p><i class="fas fa-clock me-2"></i> Senin - Jumat, 08:00 - 15:00 WIB</p></div>
        <div class="text-center mt-4"><a href="portal.php" class="btn-back"><i class="fas fa-arrow-left me-2"></i> Kembali ke Portal</a></div>
    </div>
</div>
<script>function toggleFaq(id){document.getElementById('faq'+id).classList.toggle('show');}</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>