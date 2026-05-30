# Technical Debt & Post-MVP Improvements

Dokumen ini berisi daftar perbaikan yang sengaja ditunda selama fase implementasi inti pendataan SIPETA.

## Modul Tempat

### 1. Hapus Kolom `metadata` pada Tabel Tempat

Status: Ditunda

Alasan:

* Merupakan sisa arsitektur lama sektor dinamis.
* Saat ini seluruh data kuisioner dipisahkan ke tabel keluarga, anggota_keluarga, dan usaha.
* Tidak lagi digunakan oleh controller maupun form.

Tindakan:

* Buat migration cleanup untuk menghapus kolom metadata.

---

### 2. Hapus Foto Lama Saat Update

Status: Ditunda

Alasan:

* Saat update foto bangunan, file lama masih tersimpan di storage.
* Belum berdampak signifikan pada fase development.

Tindakan:

* Tambahkan Storage::delete() sebelum menyimpan file baru.

---

### 3. Default Center Map Edit

Status: Ditunda

Alasan:

* Halaman create sudah menggunakan koordinat wilayah kerja.
* Halaman edit masih menggunakan koordinat default lama.

Tindakan:

* Samakan default center map create dan edit.

---

### 4. Status Geotagging

Status: Ditunda

Alasan:

* Latitude dan longitude sekarang nullable.
* Perlu indikator lokasi mana yang belum memiliki koordinat.

Tindakan:

* Tambahkan accessor geotag_completed.
* Tampilkan badge "Sudah Geotag" / "Belum Geotag".

---

### 5. Validasi Jenis Bangunan di Database

Status: Ditunda

Alasan:

* Saat ini validasi sudah dilakukan di level aplikasi.
* Kolom database masih nullable.

Tindakan:

* Ubah kolom jenis_bangunan menjadi NOT NULL.

---

### 6. Preview Foto Bangunan pada Halaman Detail

Status: Ditunda

Alasan:

* Belum ada halaman detail yang menampilkan foto secara optimal.

Tindakan:

* Tambahkan gallery atau image preview yang lebih baik.

---

## Dashboard

### 7. Visualisasi Statistik Tambahan

Status: Ditunda

Ide:

* Distribusi jenis bangunan.
* Status pendataan.
* Status geotagging.
* Progress pendataan per desa.

---

### 8. Optimasi Query Dashboard

Status: Ditunda

Tindakan:

* Review query agregasi ketika data sudah mencapai ribuan record.
* Tambahkan caching jika diperlukan.

---

## Public Map

---

### 9. Lazy Loading Marker

Status: Ditunda

Alasan:

* Belum diperlukan pada jumlah data saat ini.

Tindakan:

* Load marker berdasarkan viewport peta.

---

## UX & UI

### 10. Ganti Emoji dengan SVG Icon

Status: Ditunda

Alasan:

* Sebagian halaman masih menggunakan emoji.

Tindakan:

* Migrasi ke Heroicons atau Lucide Icons.

---

### 11. Konsistensi Aurora UI

Status: Ditunda

Alasan:

* Beberapa halaman sudah menggunakan style baru, sebagian belum.

Tindakan:

* Standarisasi seluruh halaman admin dan public.
