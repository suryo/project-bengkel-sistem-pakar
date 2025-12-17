# Sistem Informasi Bengkel & Sistem Pakar Diagnosa Kerusakan

Aplikasi manajemen bengkel berbasis web yang dilengkapi dengan fitur **Sistem Pakar** untuk mendiagnosa kerusakan kendaraan menggunakan metode _Forward Chaining_. Dibangun menggunakan **Laravel 10** dan **Bootstrap 5.3**.

## 🚀 Fitur Utama

### 🛠 Manajemen Bengkel

-   **Dashboard**: Statistik ringkas (Total Kategori, Sparepart, Servis, Transaksi).
-   **Manajemen Kategori**: Pengelompokan sparepart dan servis.
-   **Manajemen Sparepart**: Stok, harga, dan deskripsi suku cadang.
-   **Manajemen Jasa Servis**: Daftar harga jasa perbaikan.
-   **Transaksi (POS)**:
    -   Pencatatan transaksi pelanggan.
    -   Support input **Sparepart** dan **Jasa** dalam satu nota.
    -   Pengurangan stok otomatis.
    -   Cetak Invoice sederhana.

### 🤖 Sistem Pakar (Expert System)

-   **Metode**: Forward Chaining (Gejala ➔ Aturan ➔ Diagnosa).
-   **Diagnosa Mandiri**: User memilih gejala yang dialami kendaraan.
-   **Hasil Analisa**: Menampilkan kemungkinan kerusakan terbesar beserta persentase keyakinan dan solusinya.
-   **Basis Pengetahuan**: Admin dapat mengelola Gejala (Symptoms) dan Diagnosa (Diagnoses) melalui database seeder (saat ini).

## 💻 Teknologi

-   **Backend**: Laravel 10 (PHP ^8.1)
-   **Frontend**: Bootstrap 5.3 (via Laravel UI)
-   **Database**: MySQL
-   **Tooling**: Vite, Composer

## ⚙️ Instalasi

Ikuti langkah-langkah berikut untuk menjalankan project di lokal:

1. **Clone Repository**

    ```bash
    git clone https://github.com/username/project-bengkel-sistem-pakar.git
    cd project-bengkel-sistem-pakar
    ```

2. **Install Dependencies**

    ```bash
    composer install
    npm install && npm run build
    ```

3. **Setup Environment**

    - Copy file `.env.example` menjadi `.env`.
    - Sesuaikan konfigurasi database di `.env`.

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Migrasi & Seeding Database**
   Langkah ini penting untuk membuat tabel dan mengisi data awal (Admin, Kategori, Layanan, Sparepart, Rules Sistem Pakar).

    ```bash
    php artisan migrate:fresh --seed
    ```

5. **Jalankan Server**
    ```bash
    php artisan serve
    ```
    Akses di browser: `http://localhost:8000`

## 🔑 Akun Login

Gunakan akun berikut untuk masuk ke sistem:

-   **Username**: `admin`
-   **Password**: `123456789`

## 📝 Struktur Project

-   `app/Models`: Model Eloquent (Category, Service, SparePart, Transaction, Symptom, Diagnosis).
-   `app/Http/Controllers`: Logika aplikasi (TransactionController, DiagnosisController, dll).
-   `database/seeders`: Data awal untuk aplikasi dan basis pengetahuan sistem pakar.
-   `resources/views`: Tampilan antarmuka menggunakan Blade & Bootstrap.

---

Dibuat untuk memenuhi kebutuhan manajemen bengkel modern yang efisien dan cerdas.
