# 🛒 Laravel Product & Category Inventory

Sistem CRUD manajemen product dengan relasi ke kategori. Dibangun dengan Laravel, Bootstrap, DataTables, dan jQuery AJAX.

## ✨ Fitur
- CRUD Data Produk
- Relasi One to Many (Category → Products)
- AJAX Form (tanpa reload)
- DataTables dengan sorting & pencarian
- Validasi server-side

## 🛠️ Teknologi
- Laravel 10
- Bootstrap 5
- jQuery & AJAX
- Yajra Laravel DataTables

## 🚀 Instalasi

```bash
git clone https://github.com/almaayunisaa/CRUD_ProductInventory_Laravel.git
cd praktikum
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## 🧱 Struktur Relasi
- Category → hasMany(Product)
- Product → belongsTo(Category)

## 🧪 Data Dummy

```bash
php artisan db:seed
```
