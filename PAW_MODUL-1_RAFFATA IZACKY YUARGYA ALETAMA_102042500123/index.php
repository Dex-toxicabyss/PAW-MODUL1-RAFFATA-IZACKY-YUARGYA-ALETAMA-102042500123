<?php
$subjects = [
    'Pengembangan Aplikasi Web',
    'Enterprise Systems',
    'Basis Data',
    'Pemrograman Berorientasi Objek',
];

$values = [
    'nama' => trim($_POST['nama'] ?? ''),
    'nim' => trim($_POST['nim'] ?? ''),
    'whatsapp' => trim($_POST['whatsapp'] ?? ''),
    'email' => trim($_POST['email'] ?? ''),
    'matkul' => trim($_POST['matkul'] ?? ''),
    'motivasi' => trim($_POST['motivasi'] ?? ''),
];

$errors = [];
$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';
$success = false;

if ($submitted) {
    if ($values['nama'] === '') {
        $errors['nama'] = 'Nama lengkap wajib diisi.';
    } elseif (strlen($values['nama']) < 3) {
        $errors['nama'] = 'Nama minimal terdiri dari 3 karakter.';
    }

    if ($values['nim'] === '') {
        $errors['nim'] = 'NIM wajib diisi.';
    } elseif (!preg_match('/^\d{8,15}$/', $values['nim'])) {
        $errors['nim'] = 'NIM harus berupa 8–15 angka.';
    }

    if ($values['whatsapp'] === '') {
        $errors['whatsapp'] = 'Nomor WhatsApp wajib diisi.';
    } elseif (!preg_match('/^(0|62)[0-9]{8,14}$/', preg_replace('/[\s\-]+/', '', $values['whatsapp']))) {
        $errors['whatsapp'] = 'Gunakan format yang dimulai dengan 0 atau 62.';
    }

    if ($values['email'] === '') {
        $errors['email'] = 'Email institusi wajib diisi.';
    } elseif (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Masukkan alamat email yang valid.';
    }

    if (!in_array($values['matkul'], $subjects, true)) {
        $errors['matkul'] = 'Pilih mata kuliah praktikum.';
    }

    if ($values['motivasi'] === '') {
        $errors['motivasi'] = 'Motivasi wajib diisi.';
    } elseif (strlen($values['motivasi']) < 20) {
        $errors['motivasi'] = 'Motivasi minimal terdiri dari 20 karakter.';
    }

    $success = count($errors) === 0;
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
    <meta name="description" content="LabPass — pendaftaran asisten praktikum berbasis PHP.">
    <title>LabPass — Pendaftaran Asisten Praktikum</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="ambient ambient-one" aria-hidden="true"></div>
    <div class="ambient ambient-two" aria-hidden="true"></div>

    <header class="topbar">
        <a class="wordmark" href="#top" aria-label="LabPass home">
            <span class="wordmark-mark">LP</span>
            <span>LabPass<span class="wordmark-dot">.</span></span>
        </a>
        <div class="topbar-meta">
            <span class="status-dot"></span>
            <span>REGISTRATION WINDOW · 2026</span>
        </div>
    </header>

    <main class="shell" id="top">
        <section class="intro-panel" aria-labelledby="page-title">
            <div class="intro-kicker"><span>01</span> EAD / PRACTICUM LAB</div>
            <h1 id="page-title">Make your<br><em>next move</em><br>count.</h1>
            <p class="intro-copy">Daftarkan diri sebagai asisten praktikum dan bantu mahasiswa lain memahami teknologi lewat pengalaman yang nyata.</p>

            <div class="signal-card">
                <div class="signal-top"><span>APPLICATION SIGNAL</span><span>● LIVE</span></div>
                <div class="signal-line"><span class="signal-value" id="signalValue">00</span><span class="signal-label">/ 06 FIELDS READY</span></div>
                <div class="progress-track"><span id="signalBar"></span></div>
                <p>Lengkapi data di sebelah kanan untuk mengaktifkan kartu registrasimu.</p>
            </div>

            <div class="intro-footer">
                <span>Powered by HTML · CSS · PHP</span>
                <span>v1.0 / LABPASS</span>
            </div>
        </section>

        <section class="workspace" aria-label="Form pendaftaran asisten praktikum">
            <div class="workspace-heading">
                <div>
                    <p class="section-index">02 / APPLICATION FORM</p>
                    <h2>Registration console</h2>
                </div>
                <span class="required-note"><b>*</b> wajib diisi</span>
            </div>

            <?php if ($success): ?>
                <div class="success-banner" role="status">
                    <span class="success-icon">✓</span>
                    <div><strong>Registration locked.</strong><span>Data kamu berhasil divalidasi dan kartu registrasi siap ditinjau.</span></div>
                </div>
            <?php elseif ($submitted && $errors): ?>
                <div class="error-banner" role="alert">
                    <span class="error-icon">!</span>
                    <div><strong>Check the signal.</strong><span>Masih ada <?= count($errors); ?> bagian yang perlu diperbaiki.</span></div>
                </div>
            <?php endif; ?>

            <?php if (!$success): ?>
            <form method="post" id="applicationForm" novalidate>
                <div class="form-section">
                    <div class="section-marker">A</div>
                    <div class="form-section-content">
                        <div class="form-section-title"><h3>Identity layer</h3><span>01—03</span></div>
                        <div class="field-grid">
                            <div class="field <?= isset($errors['nama']) ? 'has-error' : ''; ?>">
                                <label for="nama"><span>01</span> Nama lengkap <b>*</b></label>
                                <input id="nama" name="nama" type="text" value="<?= old('nama', $values); ?>" placeholder="Nama sesuai identitas" autocomplete="name" required>
                                <?php if (isset($errors['nama'])): ?><small><?= e($errors['nama']); ?></small><?php endif; ?>
                            </div>
                            <div class="field <?= isset($errors['nim']) ? 'has-error' : ''; ?>">
                                <label for="nim"><span>02</span> NIM <b>*</b></label>
                                <input id="nim" name="nim" type="text" inputmode="numeric" value="<?= old('nim', $values); ?>" placeholder="Contoh: 102042500123" required>
                                <?php if (isset($errors['nim'])): ?><small><?= e($errors['nim']); ?></small><?php endif; ?>
                            </div>
                            <div class="field <?= isset($errors['whatsapp']) ? 'has-error' : ''; ?>">
                                <label for="whatsapp"><span>03</span> WhatsApp <b>*</b></label>
                                <input id="whatsapp" name="whatsapp" type="tel" value="<?= old('whatsapp', $values); ?>" placeholder="08xx atau 62xx" autocomplete="tel" required>
                                <?php if (isset($errors['whatsapp'])): ?><small><?= e($errors['whatsapp']); ?></small><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="section-marker">B</div>
                    <div class="form-section-content">
                        <div class="form-section-title"><h3>Placement layer</h3><span>04—05</span></div>
                        <div class="field-grid field-grid-wide">
                            <div class="field <?= isset($errors['email']) ? 'has-error' : ''; ?>">
                                <label for="email"><span>04</span> Email aktif <b>*</b></label>
                                <input id="email" name="email" type="email" value="<?= old('email', $values); ?>" placeholder="nama@kampus.ac.id" autocomplete="email" required>
                                <?php if (isset($errors['email'])): ?><small><?= e($errors['email']); ?></small><?php endif; ?>
                            </div>
                            <div class="field <?= isset($errors['matkul']) ? 'has-error' : ''; ?>">
                                <label for="matkul"><span>05</span> Mata kuliah praktikum <b>*</b></label>
                                <select id="matkul" name="matkul" required>
                                    <option value="">Pilih penempatan</option>
                                    <?php foreach ($subjects as $subject): ?>
                                        <option value="<?= e($subject); ?>" <?= $values['matkul'] === $subject ? 'selected' : ''; ?>><?= e($subject); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($errors['matkul'])): ?><small><?= e($errors['matkul']); ?></small><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="section-marker">C</div>
                    <div class="form-section-content">
                        <div class="form-section-title"><h3>Intent layer</h3><span>06 / FINAL</span></div>
                        <div class="field <?= isset($errors['motivasi']) ? 'has-error' : ''; ?>">
                            <label for="motivasi"><span>06</span> Kenapa kamu ingin menjadi asisten? <b>*</b></label>
                            <textarea id="motivasi" name="motivasi" rows="4" maxlength="500" placeholder="Ceritakan cara kamu bisa membantu lab ini..." required><?= old('motivasi', $values); ?></textarea>
                            <div class="field-meta"><span class="field-hint">Minimal 20 karakter</span><span id="charCount">0 / 500</span></div>
                            <?php if (isset($errors['motivasi'])): ?><small><?= e($errors['motivasi']); ?></small><?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="submit-row">
                    <p>Dengan menekan submit, kamu menyatakan data yang dimasukkan sudah benar.</p>
                    <button class="submit-button" type="submit"><span>Generate card</span><span class="button-arrow">↗</span></button>
                </div>
            </form>
            <?php else: ?>
                <div class="registration-card" id="registrationCard">
                    <div class="card-header"><span>LABPASS / REGISTRATION CARD</span><span>2026—<?= date('md'); ?></span></div>
                    <div class="card-body">
                        <div class="card-symbol">LP<span>✓</span></div>
                        <p class="card-label">CANDIDATE RECORD</p>
                        <h3><?= old('nama', $values); ?></h3>
                        <div class="card-grid">
                            <div><span>NIM</span><strong><?= old('nim', $values); ?></strong></div>
                            <div><span>PLACEMENT</span><strong><?= old('matkul', $values); ?></strong></div>
                            <div><span>WHATSAPP</span><strong><?= old('whatsapp', $values); ?></strong></div>
                            <div><span>EMAIL</span><strong><?= old('email', $values); ?></strong></div>
                        </div>
                        <div class="card-intent"><span>MOTIVATION NOTE</span><p><?= old('motivasi', $values); ?></p></div>
                    </div>
                    <div class="card-footer"><span>VERIFIED INPUT / PENDING REVIEW</span><span class="barcode">▌▌▌▌ ▌▌ ▌▌▌▌</span></div>
                </div>
                <div class="success-actions"><a href="?" class="text-button">← Buat pendaftaran baru</a><button class="outline-button" type="button" onclick="window.print()">Print card <span>↗</span></button></div>
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

        function updateSignal() {
            if (!signalValue || !signalBar) return;
            const ready = fields.filter((field) => field.value.trim() !== '').length;
            signalValue.textContent = String(ready).padStart(2, '0');
            signalBar.style.width = `${Math.min((ready / 6) * 100, 100)}%`;
        }

        function updateCharacters() {
            if (charCount && motivation) charCount.textContent = `${motivation.value.length} / 500`;
        }

        fields.forEach((field) => field.addEventListener('input', updateSignal));
        fields.forEach((field) => field.addEventListener('change', updateSignal));
        motivation?.addEventListener('input', updateCharacters);
        updateSignal();
        updateCharacters();
    </script>
</body>
</html>
