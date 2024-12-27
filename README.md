# Yayah Make Up

Yayah Make Up adalah sebuah website wedding organizer yang menyediakan berbagai layanan untuk acara pernikahan, seperti sewa baju, sewa dekorasi, dan jasa make up. Proyek ini dibuat menggunakan [Laravel Livewire](https://laravel-livewire.com/), yang memadukan framework PHP Laravel dengan pendekatan interaktif dan real-time.

## Fitur Utama

- **Paket Acara Pernikahan**: 
  Menyediakan berbagai paket acara yang meliputi jasa make up, sewa dekorasi, dan sewa baju untuk akad maupun resepsi.

- **Sistem CRUD**:
  Membuat, membaca, memperbarui, dan menghapus data paket acara pernikahan dengan efisien.

- **Pilihan Gaun Akad & Resepsi**: 
  Fitur untuk memilih gaun sesuai kebutuhan acara akad dan resepsi, dengan batasan pilihan yang disesuaikan per paket.

- **Integrasi Pembayaran**: 
  Menggunakan Midtrans untuk sistem pembayaran, dengan opsi pembayaran penuh atau uang muka (50%).

- **Diskon Otomatis**: 
  Sistem diskon otomatis berdasarkan tanggal yang diatur pada database.

## Teknologi yang Digunakan

- **Framework**: Laravel 11 + Livewire 3
- **Frontend**: TailwindCSS, Alpine.js
- **Database**: MySQL
- **Payment Gateway**: Midtrans
- **Rich Text Editor**: Laravel Trix

## Instalasi dan Penggunaan

1. Clone repositori ini ke dalam folder lokal Anda:

   ```bash
   git clone https://github.com/username/yayah-make-up.git
   ```

2. Masuk ke folder proyek:

   ```bash
   cd yayah-make-up
   ```

3. Install semua dependensi menggunakan Composer:

   ```bash
   composer install
   ```

4. Install semua dependensi frontend:

   ```bash
   npm install && npm run dev
   ```

5. Copy file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda:

   ```bash
   cp .env.example .env
   ```

6. Jalankan migrasi database:

   ```bash
   php artisan migrate
   ```

7. Jalankan server lokal:

   ```bash
   php artisan serve
   ```

8. Akses website di browser Anda melalui alamat [http://localhost:8000](http://localhost:8000).

## Screenshot

![Tampilan Utama Website](https://raw.githubusercontent.com/anggarasa/wedding-organizer/refs/heads/main/public/imgs/logo/readme-photo.png)
