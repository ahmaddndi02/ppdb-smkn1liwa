<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pendaftaran PPDB - SMK N 1 Liwa</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #e3f2fd, #fff);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }
        .logo {
            width: 100px;
            height: 100px;
            background: #0d47a1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        .logo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }
        h1 {
            color: #0d47a1;
            font-size: 28px;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #666;
            margin-bottom: 30px;
            border-bottom: 2px solid #f39c12;
            display: inline-block;
            padding-bottom: 5px;
        }
        .info-box {
            background: #f0f7ff;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            text-align: left;
        }
        .info-box p {
            margin: 10px 0;
            font-size: 16px;
        }
        .link-utbk {
            background: #0d47a1;
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            margin: 15px 0;
            font-weight: bold;
            transition: 0.3s;
        }
        .link-utbk:hover {
            background: #f39c12;
            transform: scale(1.02);
        }
        .link-ppdb {
            background: #1e5f4b;
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            margin: 15px 0;
            font-weight: bold;
            transition: 0.3s;
        }
        .link-ppdb:hover {
            background: #0f3e30;
            transform: scale(1.02);
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #999;
        }
        .btn-back {
            display: inline-block;
            margin-top: 20px;
            color: #0d47a1;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">
            <span style="font-size: 50px;">🏫</span>
        </div>
        <h1>SMK N 1 LIWA</h1>
        <div class="subtitle">PENERIMAAN PESERTA DIDIK BARU (PPDB) 2026</div>

        <div class="info-box">
            <p><strong>📢 Informasi Penting</strong></p>
            <p>Pendaftaran PPDB SMK N 1 Liwa Tahun Ajaran 2026/2027 telah dibuka!</p>
            <p>Calon siswa dapat mendaftar melalui link berikut:</p>
        </div>

        <!-- Contoh seperti link UTBK yang Anda kirim -->
        <a href="https://pendaftaran-ppdb.smkn1liwa.sch.id/" class="link-ppdb">
            🔗 https://pendaftaran-ppdb.smkn1liwa.sch.id/
        </a>

        <p style="margin: 15px 0; color: #666;">atau</p>

        <a href="register.php" class="link-utbk">
            📝 Klik di sini untuk mendaftar sekarang →
        </a>

        <div class="info-box" style="margin-top: 20px;">
            <p><strong>📋 Persyaratan:</strong></p>
            <p>✓ Ijazah SD/Sederajat</p>
            <p>✓ Akte Kelahiran</p>
            <p>✓ Kartu Keluarga</p>
            <p>✓ Pas foto 3x4</p>
        </div>

        <a href="portal.php" class="btn-back">← Kembali ke Portal</a>
        <div class="footer">
            &copy; 2026 SMK N 1 Liwa - Panitia PPDB
        </div>
    </div>
</body>
</html>