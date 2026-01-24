# Khô Gà Chộ Đó - Fullstack Application

Ứng dụng fullstack bán khô gà với Vue.js frontend + Laravel backend + MySQL database, được containerize với Docker.

## Tech Stack

- **Frontend**: Vue.js 3 + Vite (Port: 5174)
- **Backend**: Laravel 11 + PHP 8.2 (Port: 8000)
- **Database**: MySQL 8.0 (Port: 3308)
- **Container**: Docker & Docker Compose

## Yêu cầu

- Docker Desktop (hoặc Docker + Docker Compose)
- Ít nhất 2GB RAM khả dụng cho Docker

## Cài đặt & Chạy

### 1. Clone repository
```bash
git clone <your-repo-url>
cd WEB_LONG_LOZ
```

### 2. Cấu hình Laravel .env (Backend)

```bash
cp khoa_22_be/khoa_22_be/.env.example khoa_22_be/khoa_22_be/.env
```

File `.env.example` đã được cấu hình sẵn cho Docker. Bạn không cần thay đổi gì.

### 3. Build và Start Docker

```bash
# Xây dựng tất cả images
docker-compose build

# Khởi động tất cả services (MySQL, Laravel Backend, Vue Frontend)
docker-compose up -d
```

### 4. Khởi tạo Database

```bash
# Chạy migrations
docker-compose exec backend php artisan migrate --force

# (Optional) Chạy seeders để có dữ liệu mẫu
docker-compose exec backend php artisan db:seed
```

### 5. Truy cập ứng dụng

- **Frontend**: http://localhost:5174
- **Backend API**: http://localhost:8000
- **Database**: localhost:3308
  - Username: `khoa_22_user`
  - Password: `khoa_22_pass`
  - Database: `khoa_22`

## Các lệnh Docker hữu ích

### Quản lý services

```bash
# Xem tất cả logs
docker-compose logs -f

# Xem logs của service cụ thể
docker-compose logs -f backend
docker-compose logs -f frontend
docker-compose logs -f mysql

# Stop all services
docker-compose down

# Stop + remove volumes (xóa toàn bộ database)
docker-compose down -v

# Restart services
docker-compose restart
```

### Làm việc với Backend (Laravel)

```bash
# Chạy lệnh artisan
docker-compose exec backend php artisan <command>

# Ví dụ:
docker-compose exec backend php artisan tinker
docker-compose exec backend php artisan make:model Post
docker-compose exec backend composer require vendor/package

# Xem PHP info
docker-compose exec backend php -v
```

### Làm việc với Database

```bash
# Truy cập MySQL CLI
docker-compose exec mysql mysql -u khoa_22_user -p khoa_22

# Chạy lệnh SQL
docker-compose exec mysql mysql -u khoa_22_user -p khoa_22 -e "SHOW TABLES;"
```

### Làm việc với Frontend

```bash
# Cài thêm npm packages
docker-compose exec frontend npm install <package-name>

# Build production
docker-compose exec frontend npm run build
```

## Troubleshooting

### Port đã được sử dụng

Nếu port 5174, 8000 hoặc 3308 đã được sử dụng, chỉnh sửa `docker-compose.yml`:

```yaml
services:
  frontend:
    ports:
      - "5175:5174"  # Thay đổi port bên ngoài (5175)
  
  backend:
    ports:
      - "8001:8000"  # Thay đổi port bên ngoài (8001)
  
  mysql:
    ports:
      - "3309:3306"  # Thay đổi port bên ngoài (3309)
```

### Database không kết nối

```bash
# Kiểm tra MySQL container
docker-compose logs mysql

# Khởi động lại MySQL
docker-compose restart mysql

# Chạy lại migrations
docker-compose exec backend php artisan migrate --force
```

### Frontend không tải

```bash
# Xóa node_modules trong container
docker-compose exec frontend rm -rf node_modules

# Cài lại dependencies
docker-compose exec frontend npm install

# Restart frontend
docker-compose restart frontend
```

### Xóa toàn bộ & làm sạch

```bash
# Dừng tất cả containers
docker-compose down

# Xóa volumes (database)
docker-compose down -v

# Xóa images
docker rmi khoa_22_backend khoa_22_frontend

# Xóa tất cả unused resources
docker system prune -a
```

## File Structure

```
WEB_LONG_LOZ/
├── docker-compose.yml          # Orchestration file
├── khoa_22_fe - Copy/
│   └── khoan_22_fe - Copy/
│       ├── Dockerfile          # Vue.js Dockerfile
│       ├── .dockerignore        # Ignore patterns
│       ├── package.json
│       ├── vite.config.js
│       └── src/
├── khoa_22_be/
│   └── khoa_22_be/
│       ├── Dockerfile          # Laravel Dockerfile
│       ├── .dockerignore        # Ignore patterns
│       ├── .env.example         # Cấu hình mẫu
│       ├── composer.json
│       ├── app/
│       ├── routes/
│       ├── database/
│       └── ...
└── DOCKER_README.md             # File này
```

## Công thức build image cho từng service

### Frontend Image
```bash
docker build -t khoa_22_frontend ./khoa_22_fe\ -\ Copy/khoan_22_fe\ -\ Copy
```

### Backend Image
```bash
docker build -t khoa_22_backend ./khoa_22_be/khoa_22_be
```

## Notes

- Lần đầu chạy `docker-compose up` sẽ mất thời gian để download images, build containers, và chạy migrations
- Tất cả dữ liệu MySQL được lưu trong Docker volume `mysql_data` - dữ liệu sẽ được giữ ngay cả khi container dừng
- Frontend sử dụng Vite dev server với HMR (Hot Module Replacement)
- Backend tự động chạy migrations khi khởi động

## Support

Nếu gặp vấn đề, hãy:
1. Kiểm tra logs: `docker-compose logs`
2. Đảm bảo Docker daemon đang chạy
3. Kiểm tra port availability
4. Xóa cũ và build lại: `docker-compose down -v && docker-compose build`

---
**Last Updated**: January 25, 2026
