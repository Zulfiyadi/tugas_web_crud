# Setup dan Cara Menjalankan Website Laundry

Aplikasi Website Laundry sudah siap digunakan! Berikut adalah langkah-langkah untuk setup dan menjalankan aplikasi.

## Prasyarat

- PHP 8.0+
- MySQL/MariaDB
- Composer
- XAMPP atau web server lain

## Langkah Setup

### 1. Pastikan Database Sudah Dibuat
```bash
# Buat database baru di MySQL
mysql> CREATE DATABASE laundry_db;
```

### 2. Konfigurasi File .env

Jika belum ada file `.env`, salin dari `env` dan ubah nama:
```bash
cp env .env
```

Edit file `.env` dan pastikan konfigurasi database sudah benar:
```
database.default.hostname = localhost
database.default.database = laundry_db
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

### 3. Jalankan Composer Install (jika belum)
```bash
composer install
```

### 4. Jalankan Migration untuk Membuat Tabel

```bash
php spark migrate
```

### 5. (Optional) Jalankan Seeder untuk Data Default

```bash
# Buat user admin default (username: admin, password: admin123)
php spark db:seed UserSeeder

# Buat data paket layanan default
php spark db:seed PaketLayananSeeder
```

### 6. Jalankan Server Development

```bash
php spark serve
```

Aplikasi akan berjalan di `http://localhost:8080`

## Login

Setelah menjalankan seeder, gunakan kredensial default:
- **Username**: admin
- **Password**: admin123

Atau buat akun baru melalui menu Registrasi.

## Fitur Aplikasi

### 1. **Login/Logout**
- Autentikasi username dan password
- Validasi keamanan
- Session management

### 2. **Dashboard**
- Statistik total paket dan order
- Informasi paket terbaru
- Informasi order terbaru

### 3. **Paket Layanan (CRUD)**
- Tambah paket layanan baru
- Lihat semua paket
- Edit paket layanan
- Hapus paket layanan

### 4. **Order Laundry (CRUD)**
- Buat order baru
- Lihat semua order
- Edit status order
- Hapus order
- Harga otomatis dihitung berdasarkan paket dan berat

### 5. **Kontak**
- Informasi usaha laundry
- Alamat, telepon, email
- Jam operasional

## Struktur Folder

```
app/
├── Config/
│   └── Routes.php          # Konfigurasi routes
├── Controllers/
│   ├── BaseController.php  # Dengan override view()
│   ├── Home.php
│   ├── Auth.php
│   ├── Paket.php
│   └── Orders.php
├── Database/
│   ├── Migrations/         # File migration database
│   └── Seeds/             # File seeder
├── Models/
│   ├── User.php
│   ├── PaketLayanan.php
│   └── Order.php
└── Views/
    ├── layout.php         # Layout utama
    ├── auth/
    ├── home/
    ├── paket/
    └── orders/
```

## Database Schema

### Table: users
- id (INT, Primary Key)
- username (VARCHAR 50)
- password (VARCHAR 255)

### Table: paket_layanan
- id_paket (INT, Primary Key)
- nama_paket (VARCHAR 100)
- harga (INT)
- estimasi (VARCHAR 50)
- deskripsi (TEXT)

### Table: orders
- id_order (INT, Primary Key)
- nama_pelanggan (VARCHAR 100)
- no_hp (VARCHAR 20)
- id_paket (INT, Foreign Key)
- berat (DECIMAL 5,2)
- total_harga (INT)
- tanggal_masuk (DATE)
- tanggal_selesai (DATE)
- status (VARCHAR 30)

## Default Status Order

- **Proses**: Order sedang diproses
- **Selesai**: Order sudah selesai
- **Dibatalkan**: Order dibatalkan

## Troubleshooting

### Error "Database tidak ditemukan"
- Pastikan database `laundry_db` sudah dibuat
- Cek konfigurasi di file `.env`

### Error "Table tidak ditemukan"
- Jalankan perintah: `php spark migrate`
- Pastikan tidak ada error saat migration

### Login tidak berfungsi
- Pastikan seeder UserSeeder sudah dijalankan
- Atau buat user baru melalui halaman registrasi

### Session hilang setelah reload
- Pastikan session folder (`writable/session/`) ada dan writable
- Cek konfigurasi session di `app/Config/Session.php`

## Tips Pengembangan

1. Untuk menambah fitur baru, buat controller baru yang extends BaseController
2. Gunakan model untuk semua query database
3. Semua view otomatis membungkus dengan layout.php
4. Gunakan session untuk validasi login di setiap controller
5. Untuk rollback migration: `php spark migrate:rollback`

Selamat menggunakan Website Laundry!
