# ✅ Tính Năng Check Login Khi Mua Hàng

## 🔐 Mô Tả Chức Năng

Khi người dùng chưa đăng nhập và cố gắng mua sản phẩm, hệ thống sẽ:
1. ❌ **Chặn** việc mở modal mua hàng
2. 🔔 Hiển thị **thông báo lỗi**: "Vui lòng đăng nhập để mua hàng!"
3. 📍 **Chuyển hướng tự động** sang trang đăng nhập (`/dang-nhap`)
4. ✅ Sau khi đăng nhập xong, user có thể **quay lại** và mua hàng

---

## 🎬 Luồng Hoạt Động (Chi Tiết)

### **Trước: (Cách cũ)**
```
User click "Mua khô gà" 
    ↓
Modal mở (dù chưa đăng nhập) ❌
    ↓
User nhập thông tin → submit
    ↓
API trả về lỗi "Unauthorized"
```

### **Sau: (Cách mới - Hiện tại)**
```
User click "Mua khô gà"
    ↓
checkLoginAndBuy() method chạy
    ↓
Kiểm tra localStorage.getItem('key_client')
    ↓
┌─ Nếu NULL (chưa đăng nhập):
│   ├─ Hiển thị toast "Vui lòng đăng nhập để mua hàng!"
│   └─ $router.push('/dang-nhap') ← Chuyển sang login ✅
│
└─ Nếu có token (đã đăng nhập):
    └─ Mở modal mua hàng ✅
```

---

## 📝 Code Chi Tiết

### **1. ChiTietPhim/index.vue - Thay đổi Nút**

**Trước:**
```html
<button class="btn btn-warning py-3 fw-bold" 
    data-bs-toggle="modal"
    data-bs-target="#buyTicketModal">
    <i class="fa-solid fa-ticket"></i> Mua khô gà
</button>
```

**Sau:**
```html
<button class="btn btn-warning py-3 fw-bold" 
    @click="checkLoginAndBuy()">
    <i class="fa-solid fa-ticket"></i> Mua khô gà
</button>
```

### **2. ChiTietPhim/index.vue - Thêm Method**

```javascript
checkLoginAndBuy() {
    // Kiểm tra xem user đã đăng nhập chưa
    const token = localStorage.getItem('key_client');
    
    if (!token) {
        // Chưa đăng nhập - chuyển sang trang đăng nhập
        this.$toast.error('Vui lòng đăng nhập để mua hàng!');
        this.$router.push('/dang-nhap');
        return;
    }
    
    // Đã đăng nhập - mở modal
    const buyModal = new window.bootstrap.Modal(
        document.getElementById('buyTicketModal')
    );
    buyModal.show();
}
```

### **3. DonHang/index.vue - Check Login Trong Mounted**

```javascript
mounted() {
    // Kiểm tra đăng nhập
    const token = localStorage.getItem('key_client');
    
    if (!token) {
        this.$toast.error('Bạn cần đăng nhập để tiếp tục!');
        this.$router.push('/dang-nhap');
        return;
    }
    
    this.loadOrderData();
}
```

---

## 🧪 Cách Test

### **Test Case 1: Chưa Đăng Nhập**
```
1. Mở Private/Incognito window (hoặc xóa localStorage)
2. Truy cập: http://localhost:5173/chi-tiet-phim/1
3. Click nút "🐔 Mua khô gà"
4. ✅ Kết quả mong đợi:
   - Thông báo đỏ: "Vui lòng đăng nhập để mua hàng!"
   - Chuyển sang trang /dang-nhap
   - Modal NOT mở
```

### **Test Case 2: Đã Đăng Nhập**
```
1. Đăng nhập trước (login vào app)
2. Truy cập: http://localhost:5173/chi-tiet-phim/1
3. Click nút "🐔 Mua khô gà"
4. ✅ Kết quả mong đợi:
   - Modal mở bình thường
   - Chọn sản phẩm → Thanh toán
```

### **Test Case 3: Truy Cập DonHang Khi Chưa Đăng Nhập**
```
1. Xóa localStorage (Logout)
2. Truy cập trực tiếp: http://localhost:5173/don-hang
3. ✅ Kết quả mong đợi:
   - Thông báo: "Bạn cần đăng nhập để tiếp tục!"
   - Chuyển sang /dang-nhap
```

---

## 🔍 Kiểm Tra localStorage

Để xem token đăng nhập:
```javascript
// Trong browser console
localStorage.getItem('key_client');

// Kết quả nếu đã đăng nhập:
// "9|2ByZEAHTLoPBusez5alYKTtJ5WdndtHpXPfkW7lL09f6fb77"

// Kết quả nếu chưa đăng nhập:
// null
```

Để logout (xóa token):
```javascript
localStorage.removeItem('key_client');
```

---

## 💡 Cơ Chế Hoạt Động

| Trang | Chức Năng | Check Login | Hành Động |
|-------|----------|------------|----------|
| **ChiTietPhim** | Click "Mua khô gà" | ✅ Có | Kiểm tra → Modal hoặc Redirect |
| **DonHang** | Truy cập trang | ✅ Có | Kiểm tra → Load dữ liệu hoặc Redirect |
| **Dang Nhap** | Đăng nhập | ❌ Không | Không cần kiểm tra |

---

## 🎯 Lợi Ích

✅ **Bảo mật**: Không user nào có thể mua hàng mà không đăng nhập  
✅ **UX tốt**: User biết ngay cần đăng nhập  
✅ **API sạch**: Không gửi request đến API mà token không hợp lệ  
✅ **Chuyển hướng tự động**: Seamless experience  
✅ **Flash message**: Toast thông báo rõ ràng

---

## 📊 Flow Diagram

```
┌─────────────────────────────────────────────┐
│  Người dùng truy cập chi tiết sản phẩm      │
└────────────────┬────────────────────────────┘
                 │
                 ↓
    ┌────────────────────────────┐
    │ Click "Mua khô gà"         │
    └────────┬───────────────────┘
             │
             ↓
    ┌────────────────────────────────────────┐
    │ checkLoginAndBuy() chạy                 │
    └────────┬───────────────────────────────┘
             │
             ↓
    ┌────────────────────────────┐
    │ Kiểm tra key_client        │
    │ trong localStorage          │
    └────────┬───────────────────┘
             │
      ┌──────┴──────┐
      │             │
      ↓             ↓
   ❌ NULL      ✅ TOKEN
      │             │
      ↓             ↓
  ┌─────────┐  ┌──────────┐
  │ Redirect │  │ Mở Modal │
  │ /dang-   │  │  Mua     │
  │ nhap     │  │ Hàng     │
  └─────────┘  └──────────┘
      ↓             ↓
   Đăng nhập   Chọn sản phẩm
      │             │
      └──────┬──────┘
             ↓
    ┌────────────────────────┐
    │ Trang Thanh Toán       │
    │ (/don-hang)            │
    └────────┬───────────────┘
             │
             ↓
    ┌────────────────────────┐
    │ Gửi đơn hàng & Thành   │
    │ công!                   │
    └────────────────────────┘
```

---

## ✨ Tóm Lại

| Điểm | Chi Tiết |
|------|---------|
| **Tính năng** | Bắt buộc login để mua hàng |
| **Nơi kiểm tra** | ChiTietPhim (click button) + DonHang (mounted) |
| **Token storage** | localStorage.getItem('key_client') |
| **Redirect** | this.$router.push('/dang-nhap') |
| **Thông báo** | this.$toast.error('...') |
| **Modal control** | window.bootstrap.Modal(...).show() |

---

🔐 **Hệ thống bảo mật đã hoạt động! Người dùng bắt buộc phải đăng nhập mới có thể mua hàng.** ✅
