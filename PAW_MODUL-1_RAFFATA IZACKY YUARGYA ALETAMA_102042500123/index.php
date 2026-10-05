<?php
$products = [
    [
        'nama' => 'Keyboard Mechanical RGB',
        'kategori' => 'Aksesori Komputer',
        'harga' => 485000,
        'stok' => 12,
        'kode' => 'KB-001',
        'aksen' => 'mint',
    ],
    [
        'nama' => 'Mouse Wireless Ergonomis',
        'kategori' => 'Aksesori Komputer',
        'harga' => 275000,
        'stok' => 8,
        'kode' => 'MS-002',
        'aksen' => 'blue',
    ],
    [
        'nama' => 'Headset Noise Cancelling',
        'kategori' => 'Audio',
        'harga' => 695000,
        'stok' => 5,
        'kode' => 'HS-003',
        'aksen' => 'violet',
    ],
    [
        'nama' => 'Webcam Full HD 1080p',
        'kategori' => 'Perangkat Streaming',
        'harga' => 550000,
        'stok' => 0,
        'kode' => 'WC-004',
        'aksen' => 'coral',
    ],
    [
        'nama' => 'USB-C Hub 6-in-1',
        'kategori' => 'Konektivitas',
        'harga' => 329000,
        'stok' => 17,
        'kode' => 'HB-005',
        'aksen' => 'orange',
    ],
    [
        'nama' => 'Laptop Stand Aluminium',
        'kategori' => 'Workspace',
        'harga' => 399000,
        'stok' => 0,
        'kode' => 'LS-006',
        'aksen' => 'dark',
    ],
];

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function rupiah(int $amount): string
{
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

$totalProducts = count($products);
$totalStock = array_sum(array_column($products, 'stok'));
$availableProducts = count(array_filter($products, static fn (array $product): bool => $product['stok'] > 0));
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cia Store — katalog perangkat dan aksesori teknologi berbasis PHP Native.">
    <title>Cia Store — Katalog Teknologi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="noise" aria-hidden="true"></div>
    <header class="site-header">
        <a class="brand" href="#top" aria-label="Cia Store home">
            <span class="brand-mark">C</span>
            <span>Cia<span class="brand-accent">Store</span></span>
        </a>
        <nav class="nav-links" aria-label="Navigasi utama">
            <a class="active" href="#katalog">Katalog</a>
            <a href="#tentang">Tentang</a>
            <a href="#kontak">Kontak</a>
        </nav>
        <div class="header-chip"><span></span> Online store</div>
    </header>

    <main id="top">
        <section class="hero" aria-labelledby="hero-title">
            <div class="hero-copy">
                <p class="eyebrow">CIA STORE / TECHNOLOGY GOODS</p>
                <h1 id="hero-title">Tools for your<br><em>next idea.</em></h1>
                <p class="hero-description">Perangkat teknologi pilihan untuk membuat ruang kerja, belajar, dan berkarya terasa lebih siap.</p>
                <a class="hero-link" href="#katalog">Jelajahi katalog <span>↗</span></a>
            </div>
            <div class="hero-object" aria-label="Featured technology products">
                <div class="orb orb-large"></div>
                <div class="orb orb-small"></div>
                <div class="device-card device-back"><span>USB-C</span><strong>06</strong></div>
                <div class="device-card device-front"><span>FEATURED / 01</span><strong>WORK<br>BETTER.</strong><small>Curated tech for everyday momentum.</small></div>
                <div class="hero-index">01<span>/</span>06</div>
            </div>
        </section>

        <section class="stats" aria-label="Ringkasan katalog">
            <div><span>01</span><strong><?= $totalProducts; ?></strong><p>Total produk</p></div>
            <div><span>02</span><strong><?= $availableProducts; ?></strong><p>Produk tersedia</p></div>
            <div><span>03</span><strong><?= $totalStock; ?></strong><p>Total unit stok</p></div>
            <div class="stats-note">Semua data produk disimpan dalam <b>array PHP</b> dan ditampilkan otomatis dengan perulangan.</div>
        </section>

        <section class="catalog-section" id="katalog" aria-labelledby="catalog-title">
            <div class="section-heading">
                <div>
                    <p class="eyebrow">02 / PRODUCT CATALOG</p>
                    <h2 id="catalog-title">Find your<br><em>essential.</em></h2>
                </div>
                <p class="section-note">Katalog Cia Store menampilkan nama produk, kategori, harga, jumlah stok, dan status ketersediaan.</p>
            </div>

            <div class="product-grid">
                <?php foreach ($products as $index => $product): ?>
                    <?php $available = $product['stok'] > 0; ?>
                    <article class="product-card <?= $available ? '' : 'sold-out'; ?>">
                        <div class="product-visual <?= e($product['aksen']); ?>">
                            <span class="product-number">0<?= $index + 1; ?></span>
                            <span class="product-code"><?= e($product['kode']); ?></span>
                            <div class="product-glyph" aria-hidden="true">
                                <i></i><i></i><i></i>
                            </div>
                            <?php if (!$available): ?><span class="sold-label">STOK HABIS</span><?php endif; ?>
                        </div>
                        <div class="product-content">
                            <div class="product-meta"><span><?= e($product['kategori']); ?></span><span><?= $available ? 'READY' : 'SOLD OUT'; ?></span></div>
                            <h3><?= e($product['nama']); ?></h3>
                            <div class="product-details">
                                <div><span>Harga</span><strong><?= rupiah($product['harga']); ?></strong></div>
                                <div><span>Jumlah stok</span><strong><?= $product['stok']; ?> unit</strong></div>
                            </div>
                            <div class="product-action">
                                <span class="availability <?= $available ? 'is-ready' : 'is-empty'; ?>"><i></i><?= $available ? 'Tersedia' : 'Stok Habis'; ?></span>
                                <button type="button" <?= $available ? '' : 'disabled'; ?>><?= $available ? 'Beli Sekarang ↗' : 'Tidak Tersedia'; ?></button>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="about-section" id="tentang">
            <div><p class="eyebrow">03 / CIA STORE NOTE</p><h2>Small details.<br><em>Better days.</em></h2></div>
            <p>Cia Store adalah studi kasus katalog produk untuk latihan Pemrograman Aplikasi Web. Setiap kartu dirender dari data produk di PHP, sehingga produk tidak ditulis satu per satu secara manual pada HTML.</p>
        </section>
    </main>

    <footer class="site-footer" id="kontak"><span>CIA STORE / PHP NATIVE STUDY CASE</span><span>Built for better everyday tools.</span></footer>
</body>
</html>
