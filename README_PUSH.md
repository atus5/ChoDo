# WEB_LONG_LOZ - Movie Theater Management System

Ứng dụng quản lý rạp chiếu phim với Backend Laravel + Frontend Vue.js chạy trên Docker.

## Tính năng chính
- Quản lý phim, phòng chiếu, suất chiếu
- Đặt vé online
- Quản lý khách hàng, nhân viên
- Hệ thống đánh giá phim
- Quản lý voucher, khuyến mãi
- Quản lý dịch vụ (bỏng, nước, ...)

## Tech Stack
- **Backend**: Laravel 11 + MySQL 8.0
- **Frontend**: Vue.js 3 + Vite
- **Docker**: Docker Compose

## Yêu cầu hệ thống
- Docker Desktop (hoặc Docker + Docker Compose)
- Git

## Quick Start

### 1. Clone project
```bash
git clone <your-repo-url>
cd WEB_LONG_LOZ
```

### 2. Chạy setup tự động

**Trên Windows (PowerShell):**
```powershell
.\setup.ps1
```

**Trên Mac/Linux (Bash):**
```bash
bash setup.sh
```

### 3. Setup thủ công (nếu script không hoạt động)

```bash
# Copy .env file
cp khoa_22_be/khoa_22_be/.env.example khoa_22_be/khoa_22_be/.env

# Khởi động Docker
docker-compose up -d --build

# Chờ MySQL sẵn sàng (khoảng 15 giây)

# Chạy migrations
docker-compose exec backend php artisan migrate --force

# Chạy tests
docker-compose exec backend php artisan test
```

## Sử dụng

### Khởi động services
```bash
docker-compose up -d
```

### Xem logs
```bash
# Tất cả logs
docker-compose logs -f

# Chỉ logs backend
docker-compose logs -f backend

# Chỉ logs frontend
docker-compose logs -f frontend

# Chỉ logs database
docker-compose logs -f mysql
```

### Truy cập ứng dụng
- **Backend API**: http://localhost:8000
- **Frontend**: http://localhost:5174
- **MySQL**: `localhost:3308`
  - Username: `khoa_22_user`
  - Password: `khoa_22_pass`

## Chạy Tests

```bash
# Tất cả tests
docker-compose exec backend php artisan test

# Unit tests
docker-compose exec backend php artisan test --testsuite=Unit

# Feature tests
docker-compose exec backend php artisan test --testsuite=Feature

# Với coverage report
docker-compose exec backend php artisan test --coverage
```

## Các lệnh hữu ích

```bash
# Truy cập bash trong backend container
docker-compose exec backend bash

# Chạy artisan command
docker-compose exec backend php artisan <command>

# Reset database (xóa dữ liệu)
docker-compose down -v
docker-compose up -d

# Xem tất cả containers
docker ps

# Dừng tất cả services
docker-compose down

# Xóa tất cả volumes (cảnh báo: sẽ mất database)
docker-compose down -v
```

## Troubleshooting

### Port đã được sử dụng
Chỉnh sửa `docker-compose.yml` - tìm section `ports` và thay đổi port ngoài:
```yaml
ports:
  - "8001:8000"  # Sử dụng port 8001 thay vì 8000
```

### MySQL connection error
```bash
# Xem chi tiết lỗi
docker-compose logs mysql

# Kiểm tra MySQL đã sẵn sàng chưa
docker-compose exec mysql mysqladmin -u khoa_22_user -p khoa_22_pass ping
```

### Frontend không kết nối được backend
Kiểm tra `VITE_API_URL` trong file `.env` frontend phù hợp với backend URL:
- Docker: `http://localhost:8000`
- Local: `http://127.0.0.1:8000`

### Node modules quá nặng hoặc build lâu
Xóa node_modules và rebuild:
```bash
docker-compose exec frontend rm -rf node_modules
docker-compose exec frontend npm install
```

## Cấu trúc dự án

```
WEB_LONG_LOZ/
├── khoa_22_be/
│   └── khoa_22_be/           # Laravel backend
│       ├── app/
│       ├── routes/
│       ├── database/
│       ├── tests/
│       └── ...
├── khoa_22_fe/               # Vue.js frontend
│   ├── src/
│   ├── public/
│   └── ...
├── docker-compose.yml        # Docker configuration
├── SETUP_DOCKER.md          # Chi tiết setup
├── setup.sh                 # Script setup cho Linux/Mac
├── setup.ps1                # Script setup cho Windows
└── README.md                # File này
```

## Tiếp theo
- Xem [SETUP_DOCKER.md](./SETUP_DOCKER.md) để chi tiết hơn
- Xem [API_AUTH_DOCS.md](./khoa_22_be/khoa_22_be/API_AUTH_DOCS.md) cho API documentation
- Xem [BUG_FIXES.md](./khoa_22_fe/BUG_FIXES.md) cho danh sách bug fixes

## Liên hệ
- 📧 Email: [your-email]
- 💬 Issues: [GitHub Issues]

---
**Status**: Active Development 🚀
