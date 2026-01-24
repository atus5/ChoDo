# API Documentation - Authentication & User Profile

## Overview
API đã được cập nhật với các chức năng:
1. **Lưu mật khẩu an toàn** - Tất cả mật khẩu được hash tự động khi lưu vào database
2. **Chỉnh sửa thông tin user** - Có thể cập nhật thông tin cơ bản và mật khẩu

## Các endpoint chính

### 1. Đăng Ký Tài Khoản
**POST** `/api/client/dang-ky`

```json
{
  "ho_va_ten": "Nguyễn Văn A",
  "email": "user@example.com",
  "so_dien_thoai": "0912345678",
  "cccd": "123456789012",
  "ngay_sinh": "1990-01-01",
  "password": "password123",
  "re_password": "password123"
}
```

**Response (201):**
```json
{
  "status": true,
  "message": "Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.",
  "data": {
    "id": 1,
    "ho_va_ten": "Nguyễn Văn A",
    "email": "user@example.com",
    "is_active": 1,
    "is_block": 0,
    ...
  }
}
```

---

### 2. Đăng Nhập
**POST** `/api/client/dang-nhap`

```json
{
  "email": "user@example.com",
  "password": "password123"
}
```

**Response (200):**
```json
{
  "status": true,
  "message": "Đăng nhập thành công",
  "data": {
    "khach_hang": {
      "id": 1,
      "ho_va_ten": "Nguyễn Văn A",
      "email": "user@example.com",
      ...
    },
    "token": "1|abcdef123..."
  }
}
```

---

### 3. Lấy Thông Tin Profile
**GET** `/api/client/profile`

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "status": true,
  "data": {
    "id": 1,
    "ho_va_ten": "Nguyễn Văn A",
    "email": "user@example.com",
    "so_dien_thoai": "0912345678",
    "cccd": "123456789012",
    "ngay_sinh": "1990-01-01",
    "is_active": 1,
    "is_block": 0,
    ...
  }
}
```

---

### 4. Cập Nhật Thông Tin Profile (NEW!)
**POST** `/api/client/profile`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: application/json
```

**Body (Thông tin và/hoặc mật khẩu):**
```json
{
  "ho_va_ten": "Nguyễn Văn A Updated",
  "so_dien_thoai": "0987654321",
  "cccd": "123456789012",
  "ngay_sinh": "1990-01-01",
  "password": "newpassword123",
  "password_confirmation": "newpassword123"
}
```

**Note:** 
- Các trường `ho_va_ten`, `so_dien_thoai`, `cccd`, `ngay_sinh` là **bắt buộc**
- Trường `password` là **tùy chọn** - chỉ gửi nếu muốn thay đổi mật khẩu
- Nếu gửi `password`, phải gửi cả `password_confirmation` với giá trị giống nhau

**Response (200):**
```json
{
  "status": true,
  "message": "Cập nhật thông tin thành công",
  "data": {
    "id": 1,
    "ho_va_ten": "Nguyễn Văn A Updated",
    "so_dien_thoai": "0987654321",
    ...
  }
}
```

---

## Các cải tiến thực hiện

### 1. Model KhachHang
✅ Thêm `password` casting để tự động hash mật khẩu
✅ Thêm `hidden` để ẩn mật khẩu khi trả về JSON

**File:** `app/Models/KhachHang.php`

```php
protected $hidden = [
    'password',
    'remember_token',
];

protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
```

### 2. AuthController
✅ Cập nhật `dangKy()` - không cần `Hash::make()` nữa, model sẽ hash tự động
✅ Cập nhật `datLaiMatKhau()` - sử dụng model casts
✅ Cập nhật `updateProfile()` - hỗ trợ cập nhật mật khẩu

**Key Changes:**
- Password được hash tự động bởi model casting
- `updateProfile()` giờ có thể nhận `password` và `password_confirmation`

---

## Test Data

**Tài khoản test:**
```
Email: dung.pham@gmail.com
Password: 123456

Email: nguyenvan.a@gmail.com
Password: 123456

Email: tranthi.b@gmail.com
Password: 123456

Email: levan.c@gmail.com
Password: 123456
```

---

## Kiểm Tra Kỹ Thuật

✅ **Mật khẩu được hash:** Tất cả mật khẩu trong database được hash bằng bcrypt
✅ **Mật khẩu ẩn trong response:** Trường `password` không hiển thị khi trả về JSON
✅ **Lưu trữ persistent:** Mật khẩu được lưu an toàn trong database, reload web vẫn hoạt động
✅ **Cập nhật tài khoản:** Có thể cập nhật thông tin và mật khẩu qua API

---

## Notes

1. **Hash tự động:** Nhờ `'password' => 'hashed'` trong `casts()`, Laravel tự động hash mật khẩu khi:
   - Gán giá trị: `$user->password = 'plain-text'`
   - Gọi `create()`, `update()`, `save()`

2. **So sánh mật khẩu:** Sử dụng `Hash::check()` để so sánh mật khẩu trong hàm `dangNhap()`

3. **Validation:** Kiểm tra `password_confirmation` khớp với `password` trong request

