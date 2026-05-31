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

## Anggota Keluarga

Daftar perbaikan yang sengaja ditunda agar fokus pada penyelesaian fitur inti dan persiapan presentasi.

---

## 12. Rule Kepala Keluarga Tunggal

### Status

Belum diimplementasikan.

### Tujuan

Dalam satu keluarga hanya boleh terdapat satu anggota dengan hubungan:

* Kepala Keluarga

### Implementasi

Saat create atau update anggota:

* Jika sudah ada anggota dengan hubungan "Kepala Keluarga", opsi tersebut tidak boleh dipilih kembali.
* Validasi dilakukan di backend.

### Prioritas

Tinggi

---

## 13. Nomor Urut Otomatis

### Status

Masih diinput manual.

### Tujuan

Mengurangi kesalahan input dan menjaga urutan anggota keluarga.

### Implementasi

Saat menambah anggota baru:

```php
$nomorUrut =
    $keluarga
        ->anggotaKeluargas()
        ->max('nomor_urut') + 1;
```

Field nomor urut menjadi readonly atau dihilangkan dari form.

### Prioritas

Tinggi

---

## 14. Disable Field Berdasarkan Umur

### Status

Belum diimplementasikan.

### Tujuan

Menyesuaikan form dengan aturan kuesioner.

### Aturan

#### Usia ≥ 5 Tahun

Aktifkan:

* Partisipasi Sekolah
* Ijazah Tertinggi
* Rekening Digital

#### Usia ≥ 15 Tahun

Aktifkan:

* Profesi Utama
* Status/Kedudukan Pekerjaan

Jika umur belum memenuhi syarat:

* Field disabled
* Nilai tidak dikirim ke server

### Prioritas

Sedang

---

## 15. Validasi Umur

### Status

Belum diimplementasikan.

### Tujuan

Mencegah tanggal lahir tidak valid.

### Implementasi

```php
'tanggal_lahir' => [
    'required',
    'date',
    'before_or_equal:today',
]
```

Tambahan:

* Tidak boleh tanggal masa depan.
* Umur hasil perhitungan tidak boleh negatif.

### Prioritas

Sedang

---

## 16. Validasi NIK Unik

### Status

Belum diimplementasikan.

### Tujuan

Mencegah duplikasi data anggota.

### Implementasi

* NIK tidak boleh duplikat dalam keluarga yang sama.
* Panjang NIK harus sesuai standar.

Contoh:

```php
Rule::unique(
    'anggota_keluargas',
    'nik'
)
```

### Prioritas

Sedang

---

## 17. Polishing Tampilan Daftar Anggota

### Status

Belum diimplementasikan.

### Tujuan

Mempermudah identifikasi anggota keluarga.

### Improvement

* Badge khusus "Kepala Keluarga".
* Sorting berdasarkan nomor urut.
* Highlight visual untuk kepala keluarga.

Contoh:

```text
1 | Sukijan Lagi | [Kepala Keluarga]
2 | Siti Aminah | Istri
3 | Ahmad | Anak
```

### Prioritas

Rendah

