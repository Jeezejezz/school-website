# 🇮🇩 Panduan Hosting Indonesia untuk Website Sekolah

## 🏆 Rekomendasi Hosting Terbaik

### **1. Niagahoster (⭐⭐⭐⭐⭐)**
- **Harga:** Rp 19.900/bulan
- **Features:** 
  - ✅ Support Laravel
  - ✅ SSL Gratis
  - ✅ cPanel Indonesia
  - ✅ Support 24/7 Bahasa Indonesia
  - ✅ Backup otomatis
- **Link:** https://www.niagahoster.co.id
- **Cocok untuk:** Pemula, sekolah dengan budget terbatas

### **2. Hostinger Indonesia (⭐⭐⭐⭐)**
- **Harga:** Rp 25.900/bulan
- **Features:**
  - ✅ Performance tinggi
  - ✅ Support Laravel
  - ✅ SSL Gratis
  - ✅ Website Builder
- **Link:** https://www.hostinger.co.id
- **Cocok untuk:** Website dengan traffic menengah

### **3. Jagoan Hosting (⭐⭐⭐⭐)**
- **Harga:** Rp 29.000/bulan
- **Features:**
  - ✅ Server Indonesia
  - ✅ Support Laravel
  - ✅ Backup harian
  - ✅ Support lokal
- **Link:** https://www.jagoanhosting.com
- **Cocok untuk:** Website sekolah dengan kebutuhan stabil

## 📋 Langkah Deploy ke Niagahoster (Step by Step)

### **Step 1: Beli Hosting & Domain**
1. Kunjungi https://www.niagahoster.co.id
2. Pilih paket "Bayi" atau "Pelajar" (cukup untuk website sekolah)
3. Pilih domain (contoh: smksatriabhakti.com)
4. Checkout dan bayar

### **Step 2: Akses cPanel**
1. Login ke member area Niagahoster
2. Klik "Kelola Hosting"
3. Klik "cPanel"

### **Step 3: Buat Database**
1. Di cPanel, clik "MySQL Databases"
2. Buat database baru: `smk_satria_bhakti`
3. Buat user database dengan password kuat
4. Assign user ke database dengan ALL PRIVILEGES

### **Step 4: Upload Files**
1. Di cPanel, klik "File Manager"
2. Masuk ke folder `public_html`
3. Upload semua file Laravel KECUALI folder `public`
4. Isi folder `public` Laravel upload ke `public_html`
5. Edit file `public_html/index.php`:

```php
// Ubah baris ini:
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

// Menjadi:
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
```

### **Step 5: Setup Environment**
1. Upload file `.env.production` ke root folder
2. Rename menjadi `.env`
3. Edit dengan kredensial database:

```env
DB_HOST=localhost
DB_DATABASE=username_smk_satria_bhakti
DB_USERNAME=username_dbuser
DB_PASSWORD=your_password
```

### **Step 6: Import Database**
1. Di cPanel, klik "phpMyAdmin"
2. Pilih database yang sudah dibuat
3. Klik "Import"
4. Upload file SQL backup dari localhost
5. Klik "Go"

### **Step 7: Set Permissions**
1. Di File Manager, klik kanan folder `storage`
2. Change Permissions → 755
3. Lakukan hal sama untuk `bootstrap/cache`

### **Step 8: Setup SSL (Gratis)**
1. Di cPanel, cari "SSL/TLS"
2. Klik "Let's Encrypt SSL"
3. Pilih domain dan klik "Issue"

## 🔧 Troubleshooting Umum

### **Error 500 Internal Server Error**
```bash
# Check di cPanel Error Logs
# Biasanya karena:
1. File permissions salah (set 755 untuk folder, 644 untuk file)
2. .env configuration salah
3. Missing dependencies
```

### **Database Connection Error**
```env
# Pastikan format database benar:
DB_HOST=localhost
DB_DATABASE=cpanelusername_databasename
DB_USERNAME=cpanelusername_dbuser
DB_PASSWORD=your_password
```

### **File Upload Error**
```bash
# Check php.ini settings:
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 300
```

## 💰 Estimasi Biaya Tahunan

### **Paket Ekonomis (Niagahoster Bayi)**
- Hosting: Rp 19.900 x 12 = Rp 238.800
- Domain .com: Rp 150.000
- **Total: Rp 388.800/tahun**

### **Paket Menengah (Niagahoster Pelajar)**
- Hosting: Rp 34.900 x 12 = Rp 418.800
- Domain .com: Rp 150.000
- **Total: Rp 568.800/tahun**

## 📧 Setup Email Sekolah

### **1. Buat Email di cPanel**
```
admin@smksatriabhakti.com
info@smksatriabhakti.com
kepala.sekolah@smksatriabhakti.com
```

### **2. Update .env untuk Email**
```env
MAIL_MAILER=smtp
MAIL_HOST=mail.smksatriabhakti.com
MAIL_PORT=587
MAIL_USERNAME=admin@smksatriabhakti.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=admin@smksatriabhakti.com
MAIL_FROM_NAME="SMK SATRIA BHAKTI"
```

## 🚀 Optimasi Performance

### **1. Enable Gzip Compression**
Tambah di `.htaccess`:
```apache
# Enable Gzip compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/plain
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/xml
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE application/xml
    AddOutputFilterByType DEFLATE application/xhtml+xml
    AddOutputFilterByType DEFLATE application/rss+xml
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE application/x-javascript
</IfModule>
```

### **2. Browser Caching**
```apache
# Browser Caching
<IfModule mod_expires.c>
    ExpiresActive on
    ExpiresByType text/css "access plus 1 year"
    ExpiresByType application/javascript "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
</IfModule>
```

## 📞 Support & Bantuan

### **Niagahoster Support:**
- Live Chat: 24/7
- WhatsApp: +62 804 1500 0000
- Email: support@niagahoster.co.id

### **Hostinger Support:**
- Live Chat: 24/7
- Email: support@hostinger.co.id

## ✅ Checklist Setelah Deploy

- [ ] Website dapat diakses via domain
- [ ] SSL certificate aktif (https://)
- [ ] Admin panel berfungsi
- [ ] Upload gambar berfungsi
- [ ] Contact form berfungsi
- [ ] Database terkoneksi
- [ ] Email notification berfungsi
- [ ] Backup database setup

---

**💡 Tips:** Pilih paket hosting yang sesuai kebutuhan. Untuk website sekolah biasa, paket "Bayi" Niagahoster sudah cukup untuk 1-2 tahun pertama.
