# Dokumentasi Struktur & Sistem Get Coffee

Dokumen ini memberikan penjelasan teknis mengenai struktur kode, arsitektur, dan fungsi sistem yang membangun platform web **Get Coffee**. Dokumentasi ini ditujukan untuk memberikan pemahaman menyeluruh kepada klien atau tim teknis terkait bagaimana sistem beroperasi.

## 1. Ikhtisar Proyek (Project Overview)
**Get Coffee** adalah platform web profil brand kopi premium yang dirancang dengan estetika modern (*premium dark roasted*) dan fungsionalitas tinggi. Platform ini fokus pada pengalaman pengguna yang halus, penyajian menu yang menarik, dan kemudahan akses untuk pemesanan.

- **Teknologi Utama:** HTML5, CSS3 (Vanilla), JavaScript (Vanilla).
- **Arsitektur:** Static Web Application (Cepat, Aman, dan SEO Friendly).

---

## 2. Struktur Folder & File
Berikut adalah struktur direktori dalam repositori ini:

```text
get-coffee/
├── index.html        # Halaman Utama (Landing Page)
├── menu.html         # Halaman Katalog Menu Lengkap
├── about.html        # Halaman Tentang Kami & Lokasi
├── css/
│   └── style.css     # Sistem Desain & Styling Global
├── js/
│   └── main.js      # Logika Interaktivitas & Animasi
└── images/           # Koleksi Aset Visual (Logo, Produk, Hero)
```

### Penjelasan Detail:
- **`index.html`**: Pintu gerbang utama yang memperkenalkan brand, menampilkan produk unggulan, dan ringkasan cerita brand.
- **`menu.html`**: Katalog produk terperinci yang dibagi menjadi kategori (Coffee, Non-Coffee, Meals) dengan tata letak visual yang dinamis.
- **`about.html`**: Memberikan konteks mendalam tentang filosofi brand dan fitur interaktif untuk menemukan lokasi gerai.
- **`css/style.css`**: Berisi seluruh aturan visual, variabel warna (Espresso & Gold), serta *media queries* untuk responsivitas perangkat.
- **`js/main.js`**: Mengelola seluruh efek visual seperti animasi saat *scroll*, menu navigasi mobile, dan integrasi peta interaktif.

---

## 3. Fitur Utama Sistem

### A. Design System Premium
Sistem menggunakan palet warna khusus:
- **Primary (#2d1e17):** Warna Espresso gelap untuk kesan premium.
- **Accent (#c9a050):** Warna Emas halus untuk menonjolkan elemen penting.
- **Glassmorphism:** Efek transparansi pada navigasi untuk memberikan kesan modern dan bersih.

### B. Responsivitas Perangkat (Mobile-First)
Sistem secara otomatis menyesuaikan tampilan untuk:
- **Desktop:** Tata letak grid multi-kolom yang luas.
- **Tablet:** Penyesuaian proporsi elemen visual.
- **Smartphone:** Menu navigasi *hamburger* dan tata letak satu kolom yang mudah di-*scroll*.

### C. Interaktivitas Pengguna
- **Scroll Reveal:** Elemen muncul perlahan saat pengguna melakukan *scroll* ke bawah, memberikan kesan website yang "hidup".
- **Tab Map Switching:** Pada halaman About, pengguna dapat berpindah antar lokasi gerai, dan peta (Google Maps) akan diperbarui secara instan.
- **Smooth Anchor Scrolling:** Navigasi antar bagian halaman yang halus tanpa jeda yang kasar.

### D. Integrasi Pemesanan (WhatsApp Order)
Fitur "Order Now" terintegrasi langsung dengan API WhatsApp, memudahkan konversi pengunjung menjadi pelanggan secara instan.

---

## 4. Alur Kerja Teknis (Technical Workflow)

1. **Pemuatan Halaman:** Browser memuat HTML dasar, kemudian memproses `style.css` untuk tata letak.
2. **Inisialisasi Skrip:** `main.js` dijalankan untuk mengaktifkan *Intersection Observer* (untuk animasi reveal) dan listener event (klik, scroll).
3. **Optimasi Gambar:** Gambar menggunakan atribut `loading="lazy"` untuk memastikan halaman dimuat lebih cepat dengan hanya memuat gambar yang terlihat di layar.
4. **Keamanan:** Form kontak dan link navigasi menggunakan standar keamanan modern untuk melindungi data pengguna.

---

## 5. Pemeliharaan (Maintenance)
Sistem ini dirancang untuk mudah diperbarui:
- Untuk mengubah harga menu, cukup perbarui teks di `menu.html`.
- Untuk mengganti warna tema, cukup perbarui variabel di bagian `:root` pada `style.css`.
- Untuk menambah lokasi, cukup tambahkan entri baru di list lokasi pada `about.html` dan koordinat peta di `main.js`.

---

## 6. Panduan Penggunaan (User Guide)

### Cara Mengakses Website
1.  **Lokal:** Buka folder proyek dan klik ganda pada file `index.html`. Website akan terbuka di browser default Anda.
2.  **Hosting:** Jika sudah di-upload ke server, akses melalui domain yang telah ditentukan (misal: `www.getcoffee.id`).
3.  **Perangkat:** Website dapat dibuka di PC/Laptop, Tablet, maupun Smartphone.

### Cara Melakukan Pemesanan
1.  Cari tombol **"Order Now"** di bagian navigasi (atas) atau tombol **"Pesan Sekarang"** di halaman Hero.
2.  Anda akan diarahkan secara otomatis ke aplikasi WhatsApp dengan pesan yang sudah terformat untuk memulai pemesanan dengan Admin Get Coffee.

---

## 7. Daftar Interaksi Sistem (Interaction List)

Sistem ini memiliki berbagai titik interaksi untuk meningkatkan pengalaman pengguna:

1.  **Navigasi Mobile (Hamburger Menu):**
    -   Klik ikon garis tiga di pojok kanan atas untuk membuka menu pada perangkat smartphone.
    -   Ikon akan bertransformasi menjadi simbol 'X' sebagai indikator menu aktif.
2.  **Animasi Muncul (Scroll Reveal):**
    -   Elemen teks dan gambar akan muncul perlahan saat pengguna menggulir halaman ke bawah.
3.  **Navigasi Halus (Smooth Scroll):**
    -   Klik pada link kategori menu akan menggeser layar secara halus ke bagian yang dituju.
4.  **Interaksi Peta (Map Switching):**
    -   Di halaman **About**, klik pada kartu lokasi gerai (misal: Pontianak Pusat).
    -   Peta digital di sampingnya akan otomatis berpindah titik koordinat sesuai lokasi yang diklik.
5.  **Efek Hover Interaktif:**
    -   Kartu menu akan sedikit terangkat (*lifting effect*) dan bayangan akan menebal saat kursor diarahkan ke sana.
    -   Gambar produk akan sedikit membesar (*zoom effect*) di dalam bingkainya.
6.  **Tombol WhatsApp Dinamis:**
    -   Tombol kontak di halaman About terhubung langsung ke nomor WhatsApp resmi perusahaan.

