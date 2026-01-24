# Setup Hướng Dẫn Clone và Chạy Test trên Docker

## Yêu cầu
- Docker Desktop (hoặc Docker + Docker Compose)
- Git

## Bước 1: Clone project
```bash
git clone <your-repo-url>
cd WEB_LONG_LOZ
```

## Bước 2: Chuẩn bị Backend

### Copy file .env
```bash
cp khoa_22_be/khoa_22_be/.env.example khoa_22_be/khoa_22_be/.env
```

### Cài đặt dependencies (nếu chạy local)
```bash
cd khoa_22_be/khoa_22_be
composer install
php artisan key:generate
cd ../../
```

## Bước 3: Chuẩn bị Frontend

### Copy file .env (nếu có)
```bash
# Nếu cần, tạo file .env cho frontend
# cp khoa_22_fe/.env.example khoa_22_fe/.env
```

## Bước 4: Chạy Docker Compose

```bash
docker-compose up --build
```

Hoặc chạy ở background:
```bash
docker-compose up -d --build
```

### Kiểm tra services đã chạy chưa
```bash
docker-compose ps
```

## Bước 5: Chạy Migration Database

Khi MySQL đã ready, migration sẽ tự chạy. Nếu cần chạy lại:
```bash
docker-compose exec backend php artisan migrate --force
```

## Bước 6: Chạy Tests

### Chạy unit tests
```bash
docker-compose exec backend php artisan test --testsuite=Unit
```

### Chạy feature tests
```bash
docker-compose exec backend php artisan test --testsuite=Feature
```

### Chạy tất cả tests
```bash
docker-compose exec backend php artisan test
```

### Chạy tests với coverage
```bash
docker-compose exec backend php artisan test --coverage
```

## Bước 7: Truy cập ứng dụng

- **Backend API**: http://localhost:8000
- **Frontend**: http://localhost:5174
- **MySQL**: localhost:3308 (username: khoa_22_user, password: khoa_22_pass)

## Dừng Docker Compose

```bash
# Dừng services
docker-compose down

# Dừng và xóa volumes (reset database)
docker-compose down -v
```

## Troubleshooting

### Port đã được sử dụng
Nếu port 8000, 5174, hoặc 3308 đã được sử dụng, chỉnh sửa `docker-compose.yml`:
```yaml
ports:
  - "8001:8000"  # Thay đổi port ngoài
```

### MySQL connection error
Kiểm tra MySQL đã sẵn sàng:
```bash
docker-compose logs mysql
```

### Frontend không kết nối được backend
Kiểm tra `VITE_API_URL` trong docker-compose.yml phù hợp với backend URL

## Một số lệnh hữu ích

```bash
# Xem logs
docker-compose logs -f backend
docker-compose logs -f frontend
docker-compose logs -f mysql

# Truy cập backend container
docker-compose exec backend bash

# Chạy artisan commands
docker-compose exec backend php artisan <command>

# Chạy npm commands
docker-compose exec frontend npm run dev
```
