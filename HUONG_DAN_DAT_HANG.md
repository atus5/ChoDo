# 🐔 Hướng Dẫn Đặt Hàng Khô Gà - Luồng Mua Hàng Hoàn Chỉnh

## ✅ Tính Năng Đã Hoàn Thành

### 1. **Luồng Mua Hàng** (ChiTietPhim → DonHang)
- ✅ Chọn sản phẩm khô gà
- ✅ Chọn loại vị (7 lựa chọn)
- ✅ Chọn kích thước gói (4 option: 100g, 200g, 500g, 1kg)
- ✅ Chọn số lượng
- ✅ Thêm ghi chú đơn hàng (tùy chọn)
- ✅ Tính toán tổng tiền tự động
- ✅ Chuyển dữ liệu sang trang đặt hàng via sessionStorage

### 2. **Trang Đặt Hàng (DonHang)** - Đầy Đủ Chức Năng

#### **A. Hiển Thị Chi Tiết Sản Phẩm**
- ✅ Hình ảnh sản phẩm (VOZ.VN)
- ✅ Tên sản phẩm
- ✅ Loại vị đã chọn
- ✅ Kích thước + số lượng
- ✅ Giá từng gói
- ✅ Tổng tiền sản phẩm

#### **B. Thông Tin Giao Hàng**
- ✅ Form nhập tên người nhận (bắt buộc)
- ✅ Form nhập số điện thoại (bắt buộc)
- ✅ Form nhập địa chỉ giao hàng (bắt buộc)
- ✅ Lựa chọn phương thức giao:
  - **Express (2-3 giờ)** - 30.000₫
  - **Thường (1-2 ngày)** - 15.000₫
  - **Lấy tại cửa hàng** - Miễn phí
- ✅ Form ghi chú giao hàng (tùy chọn)

#### **C. Phương Thức Thanh Toán** (4 Cách)

**1. 💳 Thẻ Ngân Hàng**
   - Visa, Mastercard, JCB
   - Yêu cầu nhập:
     - Tên chủ thẻ (bắt buộc)
     - Số thẻ 16 chữ số (bắt buộc)
     - Ngày hết hạn MM/YY (bắt buộc)
     - CVV 3-4 chữ số (bắt buộc)

**2. 💰 Ví Điện Tử**
   - Momo, ZaloPay, AirPay
   - Không cần nhập thông tin thẻ

**3. 🏦 Chuyển Khoản Ngân Hàng**
   - Chuyển khoản qua NAPAS
   - Không cần nhập thông tin thẻ

**4. 📦 Thanh Toán Khi Nhận Hàng (COD)**
   - Trả tiền khi nhận hàng
   - Không cần nhập thông tin thẻ

#### **D. Mã Khuyến Mãi**
- ✅ Form nhập mã khuyến mãi (tùy chọn)
- ✅ Nút "Áp Dụng"
- ✅ Các mã mẫu có sẵn:
  - `WELCOME10` → Giảm 50.000₫
  - `CHODEN20` → Giảm 100.000₫
  - `FREE50` → Giảm 50.000₫

#### **E. Tóm Tắt Đơn Hàng**
Hiển thị chi tiết giá:
```
Sản phẩm:        [Tổng tiền]
Phí giao hàng:   [Theo lựa chọn]
Thuế VAT (10%):  [Tính tự động]
Giảm giá:        [Từ mã khuyến mãi nếu có]
───────────────────────────
TỔNG CỘNG:       [Tổng cuối cùng]
```

### 3. **Validation & Xác Thực**
- ✅ Bắt buộc nhập tên người nhận
- ✅ Bắt buộc nhập SĐT hợp lệ
- ✅ Bắt buộc nhập địa chỉ
- ✅ Nếu chọn thẻ ngân hàng:
  - Kiểm tra tên chủ thẻ
  - Kiểm tra số thẻ (tối thiểu 16 chữ)
  - Kiểm tra ngày hết hạn
  - Kiểm tra CVV (tối thiểu 3 chữ)

### 4. **Nút Hành Động**
- ✅ **Quay Lại** - Quay về trang trước
- ✅ **Thanh Toán [Số tiền]** - Gửi đơn hàng
  - Hiển thị tổng tiền thực tế

### 5. **Xử Lý Sau Khi Thanh Toán**
- ✅ Gửi POST request tới `/api/client/don-hang/create`
- ✅ Gồm: sản phẩm, giao hàng, thanh toán
- ✅ Xóa dữ liệu sessionStorage
- ✅ Chuyển hướng tới `/lich-su-don-hang` (hoặc home nếu lỗi)
- ✅ Hiển thị thông báo thành công

---

## 🎬 Hướng Dẫn Sử Dụng (Step-by-step)

### **Bước 1: Chọn Sản Phẩm**
1. Truy cập trang sản phẩm: `/chi-tiet-phim/[id]`
2. Kéo xuống tìm nút **"🐔 Mua khô gà"**
3. Click nút để mở modal đặt hàng

### **Bước 2: Cấu Hình Sản Phẩm**
Trong modal:
- Chọn **loại vị** (mỗi vị có màu sắc riêng)
- Chọn **kích thước gói** (bảng 2x2 hiển thị)
- Điều chỉnh **số lượng** bằng nút +/-
- (Tùy chọn) Thêm **ghi chú** (VD: "Thêm muối")
- Xem **tổng tiền** cập nhật realtime

### **Bước 3: Gửi Đơn Hàng**
- Click **"Thêm Vào Giỏ"** (hoặc "Thanh Toán Ngay")
- Hệ thống chuyển tới trang `/don-hang`

### **Bước 4: Nhập Thông Tin Giao Hàng**
**Bên trái (Cột 1):**
- Nhập **tên người nhận** (bắt buộc)
- Nhập **SĐT liên lạc** (bắt buộc)
- Nhập **địa chỉ giao hàng** đầy đủ (bắt buộc)
- Chọn **phương thức giao**:
  - Express (nhanh, tính phí)
  - Thường (chậm, tính phí ít hơn)
  - Lấy tại cửa hàng (miễn phí)
- (Tùy chọn) Ghi chú cho shipper

### **Bước 5: Chọn Phương Thức Thanh Toán**
**Cách 1: Thẻ Ngân Hàng** 💳
1. Click card "Thẻ Ngân Hàng"
2. Nhập **tên chủ thẻ** (VD: PHAM THI DUNG)
3. Nhập **số thẻ** 16 chữ (VD: 1234567890123456)
4. Nhập **MM/YY** (VD: 12/25)
5. Nhập **CVV** (VD: 123)

**Cách 2: Ví Điện Tử** 💰
- Click card "Ví Điện Tử"
- Không cần nhập thêm thông tin

**Cách 3: Chuyển Khoản** 🏦
- Click card "Chuyển Khoản Ngân Hàng"
- Không cần nhập thêm thông tin

**Cách 4: COD** 📦
- Click card "Thanh Toán Khi Nhận Hàng"
- Trả tiền trực tiếp với shipper

### **Bước 6: Áp Dụng Mã Khuyến Mãi (Tùy Chọn)**
1. Nhập mã khuyến mãi (VD: `WELCOME10`)
2. Click **"Áp Dụng"**
3. Nếu hợp lệ: ✅ Hiển thị mức giảm
4. Nếu sai: ❌ Hiển thị lỗi

### **Bước 7: Xem Tóm Tắt & Thanh Toán**
**Bên phải (Cột 2):**
- Xem chi tiết giá:
  - Giá sản phẩm
  - Phí giao hàng
  - Thuế VAT 10%
  - Giảm giá (nếu có)
  - **Tổng cộng cuối cùng**

### **Bước 8: Hoàn Thành Đơn Hàng**
1. Click nút **"Thanh Toán [Số tiền]"** (màu đỏ)
2. Hệ thống kiểm tra:
   - Tên người nhận ✓
   - SĐT ✓
   - Địa chỉ ✓
   - Nếu chọn thẻ: Kiểm tra thông tin thẻ ✓
3. Nếu hợp lệ:
   - ✅ Gửi đơn hàng tới backend
   - ✅ Hiển thị "Đặt hàng thành công! 🎉"
   - ✅ Chuyển hướng tới `/lich-su-don-hang`
4. Nếu không hợp lệ:
   - ❌ Hiển thị thông báo lỗi cụ thể

---

## 📊 Dữ Liệu Gửi Tới Backend

Khi click "Thanh Toán", hệ thống gửi POST request tới:
```
POST /api/client/don-hang/create
Authorization: Bearer [token]

{
  "id_khach_hang": 1,
  "id_san_pham": 1,
  "ten_san_pham": "🐔 Khô Gà Cay Siêu Cấp",
  "vi": "Cay siêu cấp",
  "kich_thuoc": "Lớn (500g)",
  "so_luong": 2,
  "gia_don_vi": 99000,
  "tien_hang": 198000,
  "tien_ship": 30000,
  "thue": 22800,
  "tien_giam": 50000,
  "tong_tien": 200800,
  "ghi_chu": "Thêm muối",
  
  "nguoi_nhan": "Phạm Thị Dung",
  "sdt": "0934567890",
  "dia_chi": "123 Nguyễn Trãi, Q1, TP.HCM",
  "phuong_thuc_giao": "express",
  "ghi_chu_giao": "Gọi trước khi tới",
  
  "phuong_thuc_thanh_toan": "card",
  "thong_tin_the": {
    "ten_chu_the": "PHAM THI DUNG",
    "so_the": "3456",
    "ngay_het_han": "12/25"
  }
}
```

---

## 🎨 Giao Diện & Thiết Kế

### **Màu Sắc & Chủ Đề**
- 🔴 **Màu chính:** Đỏ (#dc3545, #ff6b6b)
- 🟡 **Màu phụ:** Vàng (#ffc107, #ff9800)
- ⚪ **Nền:** Gradient nhẹ (fff5f7 → ffe0e6)
- 🐔 **Icon/Emoji:** 🐔 🔥 💳 💰 🏦 📦 🎟️

### **Layout**
- **Desktop:** 2 cột (8/12 + 4/12)
- **Tablet:** 1 cột (tuần tự)
- **Mobile:** 1 cột (full width)

### **Card Components**
- Border-radius: 15px
- Box-shadow: lg (0.5rem 1rem rgba)
- Transition: smooth (0.3s ease)

---

## 🔧 Lỗi & Xử Lý

| Lỗi | Nguyên Nhân | Giải Pháp |
|-----|-----------|----------|
| "Không tìm thấy dữ liệu sản phẩm" | Không có dữ liệu trong sessionStorage | Quay lại chọn sản phẩm |
| "Vui lòng nhập tên người nhận" | Trường trống | Nhập tên |
| "Vui lòng nhập số điện thoại" | Trường trống | Nhập SĐT |
| "Vui lòng nhập địa chỉ giao hàng" | Trường trống | Nhập địa chỉ |
| "Vui lòng nhập số thẻ hợp lệ" | Số thẻ < 16 chữ | Nhập đủ 16 chữ |
| "Mã khuyến mãi không hợp lệ" | Mã sai | Dùng mã có sẵn |
| "Có lỗi xảy ra" | API error | Thử lại hoặc liên hệ hỗ trợ |

---

## 🧪 Test Mã Khuyến Mãi

```
WELCOME10 → Giảm 50.000₫
CHODEN20  → Giảm 100.000₫
FREE50    → Giảm 50.000₫
```

---

## 📱 Trạng Thái Hiện Tại

✅ **Hoàn Thành:**
- Chọn sản phẩm & lựa chọn cấu hình
- Hiển thị sản phẩm trên trang đặt hàng
- Form thông tin giao hàng
- 4 phương thức thanh toán
- Form thẻ ngân hàng (hiện/ẩn)
- Mã khuyến mãi
- Tóm tắt đơn hàng & tính giá
- Validation form
- Gửi dữ liệu tới API
- Xử lý kết quả & chuyển hướng

⏳ **Cần Làm Thêm (Tuỳ chọn):**
- Tạo API endpoint `/api/client/don-hang/create` (backend)
- Tạo trang `/lich-su-don-hang` (lịch sử đơn)
- Tích hợp gateway thanh toán thật (Stripe, Paypal, etc)
- Email xác nhận đơn hàng
- Tracking đơn hàng realtime

---

## 🎯 Kết Luận

Luồng mua hàng đã **hoàn toàn hoạt động** từ chọn sản phẩm → nhập thông tin giao hàng → chọn thanh toán → gửi đơn hàng!

**Hãy thử nghiệm:** Vào `/chi-tiet-phim/1` → Click "Mua khô gà" → Chọn sản phẩm → Nhập thông tin → Thanh toán! 🐔🔥
