<?php
session_start();

$daftar_matkul = [
    'Algoritma dan Pemrograman',
    'Analisis dan Perancangan Sistem Informasi',
    'Arsitektur Enterprise',
    'Data Warehouse dan Business Intelligence',
    'Komputasi Awan',
    'Pemodelan Proses Bisnis',
    'Pengantar Sistem Informasi',
    'Pengembangan Aplikasi Bergerak',
    'Pengembangan Aplikasi Website',
    'Pengembangan UI Lanjut',
    'Proyek Perangkat Lunak',
    'Sistem Enterprise',
    'Sistem Informasi Akuntansi',
    'Sistem Operasi',
];

$values = [
    'nama_lengkap' => trim($_POST['nama_lengkap'] ?? ''),
    'no_whatsapp' => trim($_POST['no_whatsapp'] ?? ''),
    'email_institusi' => trim($_POST['email_institusi'] ?? ''),
    'pilihan_matkul' => trim($_POST['pilihan_matkul'] ?? ''),
    'motivasi' => trim($_POST['motivasi'] ?? ''),
];

$errors = [];
$mode = 'form';
$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';

if (isset($_GET['page']) && $_GET['page'] === 'id_card' && !empty($_SESSION['data_pendaftar'])) {
    $values = array_merge($values, $_SESSION['data_pendaftar']);
    $mode = 'id_card';
}

if ($submitted) {
    if ($values['nama_lengkap'] === '') {
        $errors['nama_lengkap'] = 'Nama lengkap wajib diisi.';
    } elseif (!preg_match('/^[a-zA-ZÀ-ÿ\s]+$/u', $values['nama_lengkap'])) {
        $errors['nama_lengkap'] = 'Nama hanya boleh berisi huruf dan spasi.';
    }

    $whatsapp = preg_replace('/[\s\-]+/', '', $values['no_whatsapp']);
    if ($whatsapp === '') {
        $errors['no_whatsapp'] = 'Nomor WhatsApp wajib diisi.';
    } elseif (!preg_match('/^(0|62)[0-9]+$/', $whatsapp)) {
        $errors['no_whatsapp'] = 'Nomor harus diawali 0 atau 62 dan hanya berisi angka.';
    } else {
        $values['no_whatsapp'] = $whatsapp;
    }

    if ($values['email_institusi'] === '') {
        $errors['email_institusi'] = 'Email institusi wajib diisi.';
    } elseif (!filter_var($values['email_institusi'], FILTER_VALIDATE_EMAIL)) {
        $errors['email_institusi'] = 'Format email tidak valid.';
    }

    if (!in_array($values['pilihan_matkul'], $daftar_matkul, true)) {
        $errors['pilihan_matkul'] = 'Pilih mata kuliah praktikum.';
    }

    if ($values['motivasi'] === '') {
        $errors['motivasi'] = 'Motivasi wajib diisi.';
    }

    if (!$errors) {
        $_SESSION['data_pendaftar'] = $values;
        $mode = 'id_card';
    }
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function old(string $key, array $values): string
{
    return e($values[$key] ?? '');
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LabPass — pendaftaran calon asisten praktikum berbasis PHP.">
    <title><?= $mode === 'id_card' ? 'Kartu Registrasi' : 'LabPass — Pendaftaran Asisten Praktikum'; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="ambient ambient-one" aria-hidden="true"></div>
    <div class="ambient ambient-two" aria-hidden="true"></div>

    <header class="topbar">
        <a class="wordmark" href="?page=form" aria-label="LabPass home">
            <span class="wordmark-mark">LP</span>
            <span>LabPass<span class="wordmark-dot">.</span></span>
        </a>
        <div class="topbar-meta"><span class="status-dot"></span><span>REGISTRATION WINDOW · 2026</span></div>
    </header>

    <main class="shell" id="top">
        <section class="intro-panel" aria-labelledby="page-title">
            <div class="intro-kicker"><span>01</span> EAD / PRACTICUM LAB</div>
            <h1 id="page-title">Make your<br><em>next move</em><br>count.</h1>
            <p class="intro-copy">Daftarkan diri sebagai calon asisten praktikum dan bantu mahasiswa lain memahami teknologi lewat pengalaman yang nyata.</p>
            <div class="signal-card">
                <div class="signal-top"><span>APPLICATION SIGNAL</span><span>● LIVE</span></div>
                <div class="signal-line"><span class="signal-value" id="signalValue">00</span><span class="signal-label">/ 05 FIELDS READY</span></div>
                <div class="progress-track"><span id="signalBar"></span></div>
                <p>Lengkapi data di sebelah kanan untuk mengaktifkan kartu registrasimu.</p>
            </div>
            <div class="intro-footer"><span>Powered by HTML · CSS · PHP</span><span>v1.0 / LABPASS</span></div>
        </section>

        <section class="workspace" aria-label="Pendaftaran calon asisten praktikum">
            <?php if ($mode === 'id_card'): ?>
                <div class="workspace-heading">
                    <div><p class="section-index">02 / REGISTRATION COMPLETE</p><h2>Registration card</h2></div>
                    <span class="required-note">VERIFIED INPUT</span>
                </div>
                <div class="success-banner" role="status"><span class="success-icon">✓</span><div><strong>Registration locked.</strong><span>Data pendaftaran telah diterima oleh sistem.</span></div></div>
                <div class="registration-card" id="registrationCard">
                    <div class="card-header"><span>LABPASS / REGISTRATION CARD</span><span>REG-<?= strtoupper(substr(md5($values['email_institusi'] . $values['nama_lengkap']), 0, 8)); ?></span></div>
                    <div class="card-body">
                        <div class="card-symbol">LP<span>✓</span></div>
                        <p class="card-label">CANDIDATE RECORD</p>
                        <h3><?= old('nama_lengkap', $values); ?></h3>
                        <div class="card-grid">
                            <div><span>NO. WHATSAPP</span><strong><?= old('no_whatsapp', $values); ?></strong></div>
                            <div><span>PLACEMENT</span><strong><?= old('pilihan_matkul', $values); ?></strong></div>
                            <div><span>EMAIL INSTITUSI</span><strong><?= old('email_institusi', $values); ?></strong></div>
                            <div><span>STATUS</span><strong>Pending review</strong></div>
                        </div>
                        <div class="card-intent"><span>MOTIVATION NOTE</span><p><?= nl2br(old('motivasi', $values)); ?></p></div>
                    </div>
                    <div class="card-footer"><span>PENDAFTARAN BERHASIL / SYSTEM GENERATED</span><span class="barcode">▌▌▌▌ ▌▌ ▌▌▌▌</span></div>
                </div>
                <div class="success-actions"><a href="?page=form" class="text-button">← Kembali ke form</a><button class="outline-button" type="button" onclick="window.print()">Print card <span>↗</span></button></div>
            <?php else: ?>
                <div class="workspace-heading">
                    <div><p class="section-index">02 / APPLICATION FORM</p><h2>Registration console</h2></div>
                    <span class="required-note"><b>*</b> wajib diisi</span>
                </div>
                <?php if ($submitted && $errors): ?><div class="error-banner" role="alert"><span class="error-icon">!</span><div><strong>Check the signal.</strong><span>Masih ada <?= count($errors); ?> bagian yang perlu diperbaiki.</span></div></div><?php endif; ?>

                <form method="post" action="<?= e($_SERVER['PHP_SELF']); ?>" id="applicationForm" novalidate>
                    <div class="form-section"><div class="section-marker">A</div><div class="form-section-content"><div class="form-section-title"><h3>Identity layer</h3><span>01—02</span></div><div class="field-grid">
                        <div class="field <?= isset($errors['nama_lengkap']) ? 'has-error' : ''; ?>"><label for="nama_lengkap"><span>01</span> Nama lengkap <b>*</b></label><input id="nama_lengkap" name="nama_lengkap" type="text" value="<?= old('nama_lengkap', $values); ?>" placeholder="Nama sesuai identitas" autocomplete="name" required><?php if (isset($errors['nama_lengkap'])): ?><small><?= e($errors['nama_lengkap']); ?></small><?php endif; ?></div>
                        <div class="field <?= isset($errors['no_whatsapp']) ? 'has-error' : ''; ?>"><label for="no_whatsapp"><span>02</span> Nomor WhatsApp <b>*</b></label><input id="no_whatsapp" name="no_whatsapp" type="tel" inputmode="numeric" value="<?= old('no_whatsapp', $values); ?>" placeholder="08xx atau 62xx" autocomplete="tel" required><?php if (isset($errors['no_whatsapp'])): ?><small><?= e($errors['no_whatsapp']); ?></small><?php endif; ?></div>
                    </div></div></div>
                    <div class="form-section"><div class="section-marker">B</div><div class="form-section-content"><div class="form-section-title"><h3>Placement layer</h3><span>03—04</span></div><div class="field-grid field-grid-wide">
                        <div class="field <?= isset($errors['email_institusi']) ? 'has-error' : ''; ?>"><label for="email_institusi"><span>03</span> Email institusi <b>*</b></label><input id="email_institusi" name="email_institusi" type="email" value="<?= old('email_institusi', $values); ?>" placeholder="nama@university.ac.id" autocomplete="email" required><?php if (isset($errors['email_institusi'])): ?><small><?= e($errors['email_institusi']); ?></small><?php endif; ?></div>
                        <div class="field <?= isset($errors['pilihan_matkul']) ? 'has-error' : ''; ?>"><label for="pilihan_matkul"><span>04</span> Pilihan mata kuliah <b>*</b></label><select id="pilihan_matkul" name="pilihan_matkul" required><option value="">Pilih mata kuliah praktikum</option><?php foreach ($daftar_matkul as $matkul): ?><option value="<?= e($matkul); ?>" <?= $values['pilihan_matkul'] === $matkul ? 'selected' : ''; ?>><?= e($matkul); ?></option><?php endforeach; ?></select><?php if (isset($errors['pilihan_matkul'])): ?><small><?= e($errors['pilihan_matkul']); ?></small><?php endif; ?></div>
                    </div></div></div>
                    <div class="form-section"><div class="section-marker">C</div><div class="form-section-content"><div class="form-section-title"><h3>Intent layer</h3><span>05 / FINAL</span></div><div class="field <?= isset($errors['motivasi']) ? 'has-error' : ''; ?>"><label for="motivasi"><span>05</span> Motivasi mendaftar <b>*</b></label><textarea id="motivasi" name="motivasi" rows="4" maxlength="500" placeholder="Tuliskan alasan kamu ingin menjadi asisten praktikum..." required><?= old('motivasi', $values); ?></textarea><div class="field-meta"><span class="field-hint">Wajib diisi</span><span id="charCount">0 / 500</span></div><?php if (isset($errors['motivasi'])): ?><small><?= e($errors['motivasi']); ?></small><?php endif; ?></div></div></div>
                    <div class="submit-row"><p>Dengan menekan submit, kamu menyatakan data yang dimasukkan sudah benar.</p><button class="submit-button" type="submit"><span>Daftar sekarang</span><span class="button-arrow">↗</span></button></div>
                </form>
                <?php if (!empty($_SESSION['data_pendaftar'])): ?><div class="saved-link"><a href="?page=id_card" class="text-button">Lihat data pendaftar tersimpan →</a></div><?php endif; ?>
            <?php endif; ?>
        </section>
    </main>
    <footer class="site-footer"><span>LABPASS / EAD PRACTICUM LAB</span><span>Built for a better first step.</span></footer>

    <script>
        const fields = [...document.querySelectorAll('#applicationForm input, #applicationForm select, #applicationForm textarea')];
        const signalValue = document.getElementById('signalValue');
        const signalBar = document.getElementById('signalBar');
        const charCount = document.getElementById('charCount');
        const motivation = document.getElementById('motivasi');
        function updateSignal() { if (!signalValue || !signalBar) return; const ready = fields.filter((field) => field.value.trim() !== '').length; signalValue.textContent = String(ready).padStart(2, '0'); signalBar.style.width = `${Math.min((ready / 5) * 100, 100)}%`; }
        function updateCharacters() { if (charCount && motivation) charCount.textContent = `${motivation.value.length} / 500`; }
        fields.forEach((field) => { field.addEventListener('input', updateSignal); field.addEventListener('change', updateSignal); }); motivation?.addEventListener('input', updateCharacters); updateSignal(); updateCharacters();
    </script>
</body>
</html>
