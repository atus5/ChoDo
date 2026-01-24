Write-Host "===============================================" -ForegroundColor Cyan
Write-Host "Setup project và chuẩn bị chạy trên Docker" -ForegroundColor Cyan
Write-Host "===============================================" -ForegroundColor Cyan

# Copy .env từ .env.example
Write-Host ""
Write-Host "📝 Tạo .env files..." -ForegroundColor Yellow

if (-not (Test-Path "khoa_22_be/khoa_22_be/.env")) {
    Copy-Item "khoa_22_be/khoa_22_be/.env.example" -Destination "khoa_22_be/khoa_22_be/.env"
    Write-Host "✓ Tạo backend .env file" -ForegroundColor Green
} else {
    Write-Host "✓ Backend .env đã tồn tại" -ForegroundColor Green
}

# Build và khởi động Docker
Write-Host ""
Write-Host "🐳 Khởi động Docker Compose..." -ForegroundColor Yellow
docker-compose up -d --build

Write-Host ""
Write-Host "⏳ Chờ MySQL sẵn sàng (15 giây)..." -ForegroundColor Yellow
Start-Sleep -Seconds 15

# Run migrations
Write-Host ""
Write-Host "🗄️  Chạy database migrations..." -ForegroundColor Yellow
docker-compose exec -T backend php artisan migrate --force

# Run tests
Write-Host ""
Write-Host "🧪 Chạy unit tests..." -ForegroundColor Yellow
docker-compose exec -T backend php artisan test --testsuite=Unit

Write-Host ""
Write-Host "✅ Setup hoàn tất!" -ForegroundColor Green
Write-Host ""
Write-Host "📍 Truy cập ứng dụng:" -ForegroundColor Cyan
Write-Host "  - Backend API: http://localhost:8000"
Write-Host "  - Frontend: http://localhost:5174"
Write-Host ""
Write-Host "📖 Xem logs:" -ForegroundColor Cyan
Write-Host "  docker-compose logs -f backend"
Write-Host "  docker-compose logs -f frontend"
Write-Host ""
Write-Host "⛔ Dừng services: docker-compose down" -ForegroundColor Gray
