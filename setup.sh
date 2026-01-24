#!/bin/bash

echo "==============================================="
echo "Setup project và chuẩn bị chạy trên Docker"
echo "==============================================="

# Copy .env từ .env.example
echo "📝 Tạo .env files..."
if [ ! -f "khoa_22_be/khoa_22_be/.env" ]; then
    cp khoa_22_be/khoa_22_be/.env.example khoa_22_be/khoa_22_be/.env
    echo "✓ Tạo backend .env file"
else
    echo "✓ Backend .env đã tồn tại"
fi

# Build và khởi động Docker
echo ""
echo "🐳 Khởi động Docker Compose..."
docker-compose up -d --build

echo ""
echo "⏳ Chờ MySQL sẵn sàng..."
sleep 15

# Run migrations
echo ""
echo "🗄️  Chạy database migrations..."
docker-compose exec -T backend php artisan migrate --force

# Run tests
echo ""
echo "🧪 Chạy unit tests..."
docker-compose exec -T backend php artisan test --testsuite=Unit

echo ""
echo "✅ Setup hoàn tất!"
echo ""
echo "📍 Truy cập ứng dụng:"
echo "  - Backend API: http://localhost:8000"
echo "  - Frontend: http://localhost:5174"
echo ""
echo "📖 Xem logs:"
echo "  docker-compose logs -f backend"
echo "  docker-compose logs -f frontend"
echo ""
echo "Dừng services: docker-compose down"
