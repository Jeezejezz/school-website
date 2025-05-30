# 🚀 Panduan Deploy Website Sekolah Laravel

## 📋 Persiapan Sebelum Deploy

### 1. **Optimasi Aplikasi**
```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Install dependencies production
composer install --optimize-autoloader --no-dev
```

### 2. **Setup Environment Production**
Buat file `.env.production`:
```env
APP_NAME="SMK SATRIA BHAKTI"
APP_ENV=production
APP_KEY=base64:vfSm49theE5RIYphJZlAPRb8XPqItYGvEOt7GVPla8w=
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database Production
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password

# Mail Configuration (untuk contact form)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

## 🌐 Pilihan Hosting

### **A. Shared Hosting Indonesia (Recommended untuk Pemula)**

#### **1. Niagahoster (Rp 20rb/bulan)**
- ✅ Support Laravel
- ✅ SSL Gratis
- ✅ cPanel mudah
- ✅ Support Indonesia

**Langkah Deploy:**
1. Beli hosting + domain
2. Upload file via File Manager
3. Import database via phpMyAdmin
4. Setup .env file

#### **2. Hostinger (Rp 25rb/bulan)**
- ✅ Performance bagus
- ✅ Support Laravel
- ✅ SSL Gratis

### **B. VPS (Untuk Advanced User)**

#### **1. DigitalOcean ($5/bulan)**
```bash
# Setup server
sudo apt update
sudo apt install nginx mysql-server php8.2-fpm php8.2-mysql php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Clone project
git clone your-repository.git
cd your-project
composer install --optimize-autoloader --no-dev
```

### **C. Platform Cloud (Gratis untuk Testing)**

#### **1. Railway (Recommended)**
```bash
# Install Railway CLI
npm install -g @railway/cli

# Login
railway login

# Deploy
railway init
railway up
```

#### **2. Vercel + PlanetScale**
```bash
# Install Vercel CLI
npm i -g vercel

# Deploy
vercel --prod
```

## 📁 Struktur Upload untuk Shared Hosting

```
public_html/
├── public/          # Isi folder public Laravel
│   ├── index.php
│   ├── css/
│   ├── js/
│   └── storage/
├── app/             # Folder aplikasi Laravel
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env
└── composer.json
```

## 🗄️ Setup Database

### **1. Export Database Lokal**
```bash
# Export dari phpMyAdmin atau command line
mysqldump -u root -p your_local_database > database_backup.sql
```

### **2. Import ke Hosting**
1. Buat database baru di cPanel
2. Import file SQL via phpMyAdmin
3. Update .env dengan kredensial database hosting

### **3. Jalankan Migration (jika perlu)**
```bash
php artisan migrate --force
php artisan db:seed --force
```

## ⚙️ Konfigurasi Server

### **1. Nginx Configuration**
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/html/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### **2. Apache .htaccess (untuk Shared Hosting)**
File sudah ada di `public/.htaccess`

## 🔒 Security Checklist

- [ ] Set `APP_DEBUG=false`
- [ ] Set `APP_ENV=production`
- [ ] Generate new `APP_KEY`
- [ ] Setup SSL Certificate
- [ ] Backup database secara berkala
- [ ] Update dependencies secara berkala

## 📞 Rekomendasi Hosting

### **Untuk Pemula:**
1. **Niagahoster** - Support Indonesia, mudah setup
2. **Hostinger** - Performance bagus, harga terjangkau

### **Untuk Advanced:**
1. **DigitalOcean** - VPS dengan kontrol penuh
2. **Railway** - Platform modern, easy deploy

### **Untuk Testing/Demo:**
1. **Railway** - Gratis dengan limitasi
2. **Vercel + PlanetScale** - Gratis untuk project kecil

## 🆘 Troubleshooting

### **Error 500:**
- Check file permissions (755 untuk folder, 644 untuk file)
- Check .env configuration
- Check error logs

### **Database Connection Error:**
- Verify database credentials
- Check database server status
- Ensure database exists

### **File Upload Issues:**
- Check storage permissions
- Verify upload_max_filesize in php.ini
- Check disk space

## 📱 Contact Support

Jika butuh bantuan deploy, bisa hubungi:
- Support hosting provider
- Laravel community
- Stack Overflow

---

**💡 Tips:** Mulai dengan shared hosting untuk kemudahan, upgrade ke VPS jika traffic tinggi.
