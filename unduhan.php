<?php
require_once 'config/database.php';

// Konten masing-masing dokumen
$documents = [
    'formulir' => [
        'title' => 'Formulir Pendaftaran PPDB',
        'filename' => 'Formulir_Pendaftaran_PPDB_SMKN1_Liwa.pdf',
        'content' => '<div style="margin-bottom:20px;"><strong>A. DATA PRIBADI</strong><br><br>Nama Lengkap: _________________________________<br>NISN: _________________________________<br>Tempat, Tgl Lahir: _________________________________<br>Alamat: _________________________________<br>No Telepon: _________________________________</div><div style="margin-bottom:20px;"><strong>B. DATA ORANG TUA</strong><br><br>Nama Ayah: _________________________________<br>Nama Ibu: _________________________________</div><div style="margin-top:40px; display:flex; justify-content:space-between;"><div>Calon Siswa,<br><br><br>(______________)</div><div>Orang Tua/Wali,<br><br><br>(______________)</div></div>'
    ],
    'panduan' => [
        'title' => 'Panduan Pendaftaran PPDB 2026',
        'filename' => 'Panduan_PPDB_2026_SMKN1_Liwa.pdf',
        'content' => '<h3>Persyaratan Pendaftaran</h3><ul><li>Ijazah SD/Sederajat</li><li>Akte Kelahiran</li><li>Kartu Keluarga</li><li>Pas foto 3x4</li></ul><h3>Cara Pendaftaran</h3><ol><li>Buat akun</li><li>Login</li><li>Isi formulir</li><li>Upload berkas</li><li>Submit</li></ol>'
    ],
    'surat' => [
        'title' => 'Surat Pernyataan Kesanggupan',
        'filename' => 'Surat_Pernyataan_Kesanggupan_SMKN1_Liwa.pdf',
        'content' => '<p>Saya yang bertanda tangan di bawah ini menyatakan sanggup mengikuti seluruh proses PPDB SMK N 1 Liwa 2026.</p><div style="margin-top:40px; display:flex; justify-content:space-between;"><div>Liwa, ______________ 2026</div><div>Yang membuat pernyataan,<br><br><br>(______________)</div></div>'
    ],
    'jadwal' => [
        'title' => 'Jadwal Lengkap PPDB 2026',
        'filename' => 'Jadwal_PPDB_2026_SMKN1_Liwa.pdf',
        'content' => '<table style="width:100%; border-collapse:collapse;"><tr><th>Kegiatan</th><th>Tanggal</th></tr><tr><td>Pendaftaran</td><td>1-30 Juni 2026</td></tr><tr><td>Seleksi</td><td>5-7 Juli 2026</td></tr><tr><td>Pengumuman</td><td>10 Juli 2026</td></tr><tr><td>Daftar Ulang</td><td>12-15 Juli 2026</td></tr></table>'
    ]
];

$logoPath = "assets/img/logo.jpg";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unduhan - SMK N 1 LIWA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        body{background:linear-gradient(135deg,#e3f2fd,#fff);font-family:'Segoe UI',sans-serif}
        .navbar{background:#fff;box-shadow:0 2px 10px rgba(0,0,0,0.05);padding:12px 0}
        .navbar-brand{display:flex;align-items:center;gap:12px;font-weight:bold;font-size:22px;color:#0d47a1;text-decoration:none}
        .navbar-brand img{height:45px;width:auto}
        .search-container{position:relative;width:300px}
        .search-container input{width:100%;padding:8px 15px 8px 40px;border-radius:50px;border:1px solid #ddd;outline:none}
        .search-container i{position:absolute;left:15px;top:11px;color:#999}
        .download-card{background:#fff;border-radius:20px;padding:30px;margin:20px 0;box-shadow:0 10px 30px rgba(0,0,0,0.1)}
        .download-item{display:flex;justify-content:space-between;align-items:center;padding:15px;border-bottom:1px solid #e9ecef;transition:0.3s}
        .download-item:hover{background:#f8f9fa}
        .download-item.hidden{display:none}
        .file-icon{font-size:30px;margin-right:15px;color:#0d47a1}
        .file-info h5{margin:0;font-size:16px;font-weight:600}
        .file-info small{color:#6c757d}
        .btn-download{background:linear-gradient(135deg,#0d47a1,#1976d2);color:#fff;padding:8px 25px;border-radius:50px;border:none;font-size:14px;transition:0.3s;display:inline-block}
        .btn-download:hover{transform:translateY(-2px);color:#fff;background:#0d47a1}
        .btn-back{background:#6c757d;color:#fff;padding:12px 30px;border-radius:50px;text-decoration:none;display:inline-block}
        .btn-back:hover{background:#5a6268;color:#fff}
        .search-info{margin-bottom:15px;color:#666;font-size:14px}
        .no-result{text-align:center;padding:40px;color:#999;display:none}
    </style>
</head>
<body>
<nav class="navbar">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand" href="portal.php">
                <img src="assets/img/logo.jpg" alt="Logo SMK N 1 LIWA" onerror="this.src='https://placehold.co/45x45?text=LOGO'">
                SMK N 1 LIWA
            </a>
            <div class="search-container">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Cari dokumen... (Formulir, Panduan, dll)">
            </div>
            <a href="portal.php" class="btn btn-outline-primary btn-sm">Kembali ke Portal</a>
        </div>
    </div>
</nav>
<div class="container">
    <div class="download-card">
        <h3 class="mb-4" style="color:#0d47a1;"><i class="fas fa-download me-2"></i> Unduhan Formulir & Dokumen</h3>
        
        <div id="searchInfo" class="search-info"></div>
        
        <div id="documentList">
            <div class="download-item" data-title="Formulir Pendaftaran PPDB">
                <div class="d-flex align-items-center">
                    <i class="fas fa-file-pdf file-icon"></i>
                    <div class="file-info">
                        <h5>Formulir Pendaftaran PPDB</h5>
                        <small>PDF, ~50 KB</small>
                    </div>
                </div>
                <button class="btn-download" data-doc="formulir"><i class="fas fa-download me-2"></i> Unduh PDF</button>
            </div>
            
            <div class="download-item" data-title="Panduan Pendaftaran PPDB 2026">
                <div class="d-flex align-items-center">
                    <i class="fas fa-file-pdf file-icon"></i>
                    <div class="file-info">
                        <h5>Panduan Pendaftaran PPDB 2026</h5>
                        <small>PDF, ~45 KB</small>
                    </div>
                </div>
                <button class="btn-download" data-doc="panduan"><i class="fas fa-download me-2"></i> Unduh PDF</button>
            </div>
            
            <div class="download-item" data-title="Surat Pernyataan Kesanggupan">
                <div class="d-flex align-items-center">
                    <i class="fas fa-file-pdf file-icon"></i>
                    <div class="file-info">
                        <h5>Surat Pernyataan Kesanggupan</h5>
                        <small>PDF, ~40 KB</small>
                    </div>
                </div>
                <button class="btn-download" data-doc="surat"><i class="fas fa-download me-2"></i> Unduh PDF</button>
            </div>
            
            <div class="download-item" data-title="Jadwal Lengkap PPDB 2026">
                <div class="d-flex align-items-center">
                    <i class="fas fa-file-pdf file-icon"></i>
                    <div class="file-info">
                        <h5>Jadwal Lengkap PPDB 2026</h5>
                        <small>PDF, ~45 KB</small>
                    </div>
                </div>
                <button class="btn-download" data-doc="jadwal"><i class="fas fa-download me-2"></i> Unduh PDF</button>
            </div>
        </div>
        
        <div id="noResult" class="no-result">
            <i class="fas fa-search fa-3x mb-3"></i><br>
            Tidak ada dokumen yang cocok dengan pencarian "<span id="searchKeyword"></span>"
        </div>
        
        <div class="text-center mt-4">
            <a href="portal.php" class="btn-back"><i class="fas fa-arrow-left me-2"></i> Kembali ke Portal</a>
        </div>
    </div>
</div>

<script>
    const documents = <?php echo json_encode($documents); ?>;
    const logoUrl = "<?php echo $logoPath; ?>";
    
    const searchInput = document.getElementById('searchInput');
    const searchInfo = document.getElementById('searchInfo');
    const noResult = document.getElementById('noResult');
    const searchKeyword = document.getElementById('searchKeyword');
    const documentItems = document.querySelectorAll('.download-item');
    
    function performSearch() {
        const keyword = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;
        
        documentItems.forEach(item => {
            const title = item.getAttribute('data-title').toLowerCase();
            if (keyword === '') {
                item.classList.remove('hidden');
                visibleCount++;
            } else if (title.includes(keyword)) {
                item.classList.remove('hidden');
                visibleCount++;
            } else {
                item.classList.add('hidden');
            }
        });
        
        if (keyword !== '') {
            if (visibleCount > 0) {
                searchInfo.innerHTML = `<i class="fas fa-search"></i> Menampilkan ${visibleCount} hasil untuk "${keyword}"`;
                searchInfo.style.display = 'block';
                noResult.style.display = 'none';
            } else {
                searchInfo.style.display = 'none';
                searchKeyword.innerText = keyword;
                noResult.style.display = 'block';
            }
        } else {
            searchInfo.style.display = 'none';
            noResult.style.display = 'none';
        }
    }
    
    searchInput.addEventListener('keyup', performSearch);
    
    function escapeHtml(str) {
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }
    
    function createPDFHtml(title, content) {
        return `
            <div style="padding: 30px; font-family: 'Times New Roman', serif;">
                <div style="display: flex; align-items: center; gap: 20px; border-bottom: 3px solid #f39c12; padding-bottom: 15px; margin-bottom: 25px;">
                    <div style="width: 70px; height: 70px; display: flex; align-items: center; justify-content: center;">
                        <img src="${logoUrl}" alt="Logo SMK N 1 Liwa" style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%;" onerror="this.src='https://placehold.co/70x70?text=SMK'">
                    </div>
                    <div>
                        <h2 style="margin: 0; color: #0d47a1; font-size: 22px;">SMK NEGERI 1 LIWA</h2>
                        <p style="margin: 5px 0 0; font-size: 12px; color: #555;">Jl. Pendidikan No. 1, Liwa, Lampung Barat</p>
                        <p style="margin: 0; font-size: 12px; color: #555;">Telp. (0728) 12345 | Email: info@smkn1liwa.sch.id</p>
                    </div>
                </div>
                <div style="text-align: center; font-size: 20px; font-weight: bold; margin: 20px 0; color: #1e5f4b;">${escapeHtml(title)}</div>
                <div style="font-size: 14px; line-height: 1.6;">${content}</div>
                <div style="margin-top: 40px; text-align: center; font-size: 11px; border-top: 1px solid #ccc; padding-top: 15px; color: #777;">
                    Dokumen resmi SMK N 1 Liwa - Sistem PPDB 2026
                </div>
            </div>
        `;
    }
    
    async function downloadPDF(docKey) {
        const doc = documents[docKey];
        if (!doc) {
            alert('Dokumen tidak ditemukan');
            return;
        }
        
        const pdfHtml = createPDFHtml(doc.title, doc.content);
        const wrapper = document.createElement('div');
        wrapper.style.position = 'fixed';
        wrapper.style.left = '-9999px';
        wrapper.style.top = '0';
        wrapper.innerHTML = pdfHtml;
        document.body.appendChild(wrapper);
        
        try {
            const element = wrapper.firstElementChild;
            const opt = {
                margin: [0.5, 0.5, 0.5, 0.5],
                filename: doc.filename,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2, letterRendering: true, useCORS: true },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
            };
            await html2pdf().set(opt).from(element).save();
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan: ' + error.message);
        } finally {
            document.body.removeChild(wrapper);
        }
    }
    
    document.querySelectorAll('.btn-download').forEach(btn => {
        btn.addEventListener('click', function() {
            const docType = this.getAttribute('data-doc');
            downloadPDF(docType);
        });
    });
</script>
</body>
</html>