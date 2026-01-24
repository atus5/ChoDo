# 🚀 Hướng dẫn nhanh cho bạn bạn

Đơn giản hoá: 3 bước để chạy project

## Bước 1️⃣: Clone
```bash
git clone <link-repo>
cd WEB_LONG_LOZ
```

## Bước 2️⃣: Setup (chọn 1 trong 2)

**Option A - Tự động (Recommended):**
```bash
# Windows
.\setup.ps1

# Mac/Linux
bash setup.sh
```

**Option B - Thủ công:**
```bash
cp khoa_22_be/khoa_22_be/.env.example khoa_22_be/khoa_22_be/.env
docker-compose up -d --build
sleep 15
docker-compose exec backend php artisan migrate --force
docker-compose exec backend php artisan test
```

## Bước 3️⃣: Sử dụng
```bash
# Xem ứng dụng chạy
# Backend: http://localhost:8000
# Frontend: http://localhost:5174

# Chạy tests
docker-compose exec backend php artisan test

# Dừng
docker-compose down
```

---

## ❓ Nếu gặp lỗi
1. Kiểm tra Docker Desktop đang chạy không
2. Xem logs: `docker-compose logs -f`
3. Hoặc reset toàn bộ: `docker-compose down -v && docker-compose up -d --build`

## 📚 Chi tiết hơn
Xem [SETUP_DOCKER.md](./SETUP_DOCKER.md) hoặc [README_PUSH.md](./README_PUSH.md)
