@echo off
echo ========================================
echo   PERSIAPAN DEPLOY PRODUCTION
echo ========================================
echo.

echo [1/6] Clearing cache...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo ✅ Cache cleared

echo.
echo [2/6] Optimizing for production...
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo ✅ Optimized

echo.
echo [3/6] Installing production dependencies...
composer install --optimize-autoloader --no-dev
echo ✅ Dependencies installed

echo.
echo [4/6] Creating production environment file...
copy .env .env.production
echo ✅ Environment file created

echo.
echo [5/6] Generating storage link...
php artisan storage:link
echo ✅ Storage linked

echo.
echo [6/6] Setting permissions...
echo ⚠️  Manual step: Set folder permissions to 755 and file permissions to 644
echo ⚠️  Make sure storage/ and bootstrap/cache/ are writable

echo.
echo ========================================
echo   PRODUCTION READY! 🚀
echo ========================================
echo.
echo Next steps:
echo 1. Edit .env.production with your hosting details
echo 2. Upload files to your hosting
echo 3. Import database
echo 4. Update .env on server
echo.
pause
