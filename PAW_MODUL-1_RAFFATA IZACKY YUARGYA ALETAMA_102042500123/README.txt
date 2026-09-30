# CIA Store - Praktikum PAW Modul 1

## Struktur
- index.php
- style.css

## Cara menjalankan dengan Laragon
1. Extract folder `cia-store`.
2. Pindahkan folder ke:
   `C:\laragon\www\`
3. Jalankan Laragon.
4. Klik **Start All**.
5. Buka:
   `http://localhost/cia-store/`

## Cara menjalankan dengan XAMPP
1. Extract folder `cia-store`.
2. Pindahkan folder ke:
   `C:\xampp\htdocs\`
3. Jalankan Apache dari XAMPP.
4. Buka:
   `http://localhost/cia-store/`

## Fitur yang sudah memenuhi studi kasus
- HTML + CSS + PHP Native
- Array PHP untuk seluruh data produk
- Minimal 6 produk
- foreach untuk menampilkan card
- Nama produk, kategori, harga, dan stok
- Status stok menggunakan percabangan
- Tombol beli dinonaktifkan jika stok 0
- Format harga Rupiah
- Jumlah produk dan total stok otomatis
- CSS Flexbox dan CSS Grid
- Responsive layout
- Hover effect
- Challenge diskon 10% untuk harga >= Rp1.000.000
- Harga setelah diskon dihitung menggunakan PHP, bukan ditulis manual
- Fungsi PHP sederhana untuk format harga dan perhitungan diskon

\n## Gambar Produk
Folder `images/` berisi ilustrasi SVG untuk 6 produk. File gambar dipanggil dari array PHP melalui key `gambar`, sehingga card tetap dibuat otomatis menggunakan `foreach`.
