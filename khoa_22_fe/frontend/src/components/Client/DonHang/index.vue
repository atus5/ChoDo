<template>
    <!-- Main Content -->
    <div class="container py-5">
        <!-- Order Header with Gradient -->
        <div class="card mb-4 border-0 shadow-lg overflow-hidden" style="background: linear-gradient(135deg, #dc3545 0%, #ff6b6b 100%);">
            <div class="card-body text-white d-flex justify-content-between align-items-start p-4">
                <div>
                    <h2 class="h3 fw-bold mb-2">🐔 Chi Tiết Đơn Hàng Khô Gà</h2>
                    <p class="text-white-50 mb-0">ID đơn hàng: #KHO-GA-{{ generateOrderId() }}</p>
                </div>
                <div class="text-end">
                    <span class="badge bg-white text-danger px-4 py-2 fs-6 mb-2 d-inline-block" style="border-radius: 20px;">
                        <i class="fa-solid fa-circle-check me-2"></i>Chờ thanh toán
                    </span>
                    <p class="text-white-50 mb-0 mt-2">{{ formatDate(new Date()) }}</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Column - Product Details & Payment -->
            <div class="col-lg-8">
                <!-- Product Card -->
                <div class="card border-0 shadow-lg mb-4" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-4">
                            <i class="fa-solid fa-box-open text-danger me-2"></i>Chi Tiết Sản Phẩm
                        </h5>
                        
                        <!-- Product Item -->
                        <div class="d-flex gap-4 pb-4">
                            <img :src="orderData.hinh_anh || 'https://voz.vn/attachments/1000016571-jpg.3225622/'" 
                                class="rounded" alt="Khô Gà" 
                                style="width: 150px; height: 150px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-3">🐔 {{ orderData.ten_san_pham || 'Khô Gà Chộ Đó' }}</h6>
                                <ul class="list-unstyled text-muted small mb-3">
                                    <li class="mb-2"><i class="fa-solid fa-fire text-warning me-2"></i><strong>Vị:</strong> {{ orderData.vi }}</li>
                                    <li class="mb-2"><i class="fa-solid fa-box me-2"></i><strong>Kích thước:</strong> {{ orderData.kich_thuoc }}</li>
                                    <li class="mb-2"><i class="fa-solid fa-shopping-bag me-2"></i><strong>Số lượng:</strong> {{ orderData.so_luong }} gói</li>
                                    <li class="mb-2"><i class="fa-solid fa-tag me-2"></i><strong>Giá/gói:</strong> {{ formatVND(orderData.gia_don_vi) }}</li>
                                </ul>
                                <p class="text-muted small" v-if="orderData.ghi_chu"><strong>Ghi chú:</strong> {{ orderData.ghi_chu }}</p>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-danger fs-6">{{ formatVND(orderData.tong_tien) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Thông tin giao hàng -->
                <div class="card border-0 shadow-lg mb-4" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-4">
                            <i class="fa-solid fa-truck text-danger me-2"></i>Thông Tin Giao Hàng
                        </h5>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Người nhận:</label>
                                <input v-model="delivery.recipient" type="text" class="form-control" placeholder="Nhập tên người nhận">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Số điện thoại:</label>
                                <input v-model="delivery.phone" type="tel" class="form-control" placeholder="Nhập số điện thoại">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Địa chỉ giao hàng:</label>
                                <input v-model="delivery.address" type="text" class="form-control" placeholder="Nhập địa chỉ giao hàng">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phương thức giao:</label>
                                <select v-model="delivery.method" class="form-select">
                                    <option value="express">Express (2-3 giờ) - 30.000₫</option>
                                    <option value="standard">Thường (1-2 ngày) - 15.000₫</option>
                                    <option value="pickup">Lấy tại cửa hàng (Miễn phí)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Ghi chú giao hàng (Tùy chọn):</label>
                                <input v-model="delivery.notes" type="text" class="form-control" placeholder="VD: Gọi trước khi giao">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Thông tin thanh toán -->
                <div class="card border-0 shadow-lg" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-4">
                            <i class="fa-solid fa-credit-card text-danger me-2"></i>Chọn Phương Thức Thanh Toán
                        </h5>
                        
                        <!-- Payment Methods -->
                        <div class="row g-3">
                            <!-- Thẻ Ngân Hàng -->
                            <div class="col-12">
                                <div class="card border-2 cursor-pointer"
                                    :class="{ 'border-danger': paymentMethod === 'card', 'border-light': paymentMethod !== 'card' }"
                                    @click="paymentMethod = 'card'; showCardForm = true"
                                    style="cursor: pointer;">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <i class="fa-brands fa-cc-visa fs-4 text-primary"></i>
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-1">💳 Thẻ Ngân Hàng</h6>
                                            <p class="text-muted small mb-0">Visa, Mastercard, JCB</p>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" :checked="paymentMethod === 'card'" style="cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Ví Điện Tử -->
                            <div class="col-12">
                                <div class="card border-2 cursor-pointer"
                                    :class="{ 'border-danger': paymentMethod === 'wallet', 'border-light': paymentMethod !== 'wallet' }"
                                    @click="paymentMethod = 'wallet'; showCardForm = false"
                                    style="cursor: pointer;">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <i class="fa-solid fa-wallet fs-4 text-warning"></i>
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-1">💰 Ví Điện Tử</h6>
                                            <p class="text-muted small mb-0">Momo, ZaloPay, AirPay</p>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" :checked="paymentMethod === 'wallet'" style="cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Chuyển Khoản -->
                            <div class="col-12">
                                <div class="card border-2 cursor-pointer"
                                    :class="{ 'border-danger': paymentMethod === 'transfer', 'border-light': paymentMethod !== 'transfer' }"
                                    @click="paymentMethod = 'transfer'; showCardForm = false"
                                    style="cursor: pointer;">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <i class="fa-solid fa-bank fs-4 text-success"></i>
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-1">🏦 Chuyển Khoản Ngân Hàng</h6>
                                            <p class="text-muted small mb-0">Chuyển khoản qua NAPAS</p>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" :checked="paymentMethod === 'transfer'" style="cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Thanh Toán Khi Nhận Hàng -->
                            <div class="col-12">
                                <div class="card border-2 cursor-pointer"
                                    :class="{ 'border-danger': paymentMethod === 'cod', 'border-light': paymentMethod !== 'cod' }"
                                    @click="paymentMethod = 'cod'; showCardForm = false"
                                    style="cursor: pointer;">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <i class="fa-solid fa-box fs-4 text-secondary"></i>
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-1">📦 Thanh Toán Khi Nhận Hàng</h6>
                                            <p class="text-muted small mb-0">Trả tiền sau khi nhận hàng</p>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" :checked="paymentMethod === 'cod'" style="cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Form -->
                        <div v-show="showCardForm" class="mt-4 p-4 bg-light rounded">
                            <h6 class="fw-bold mb-3">Thông Tin Thẻ</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Tên chủ thẻ:</label>
                                    <input v-model="cardInfo.cardName" type="text" class="form-control" placeholder="VD: PHAM THI DUNG">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Số thẻ:</label>
                                    <input v-model="cardInfo.cardNumber" type="text" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Ngày hết hạn (MM/YY):</label>
                                    <input v-model="cardInfo.expiryDate" type="text" class="form-control" placeholder="12/25" maxlength="5">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">CVV:</label>
                                    <input v-model="cardInfo.cvv" type="password" class="form-control" placeholder="123" maxlength="4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Order Summary & Payment -->
            <div class="col-lg-4">
                <!-- Order Summary -->
                <div class="card border-0 shadow-lg mb-4" style="border-radius: 15px; background: linear-gradient(135deg, #fff5f7 0%, #ffe0e6 100%);">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-4">
                            <i class="fa-solid fa-receipt text-danger me-2"></i>Tóm Tắt Đơn Hàng
                        </h5>
                        
                        <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                            <span class="text-muted">{{ orderData.kich_thuoc }} ({{ orderData.so_luong }}x)</span>
                            <span class="fw-bold">{{ formatVND(orderData.tong_tien) }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                            <span class="text-muted">Phí giao hàng</span>
                            <span class="fw-bold">{{ getShippingFee() }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                            <span class="text-muted">Thuế VAT (10%)</span>
                            <span class="fw-bold">{{ formatVND(Math.ceil(orderData.tong_tien * 0.1)) }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                            <span class="fw-bold text-success">Giảm giá (Nếu có)</span>
                            <span class="fw-bold text-success">-{{ formatVND(discount) }}</span>
                        </div>

                        <div class="d-flex justify-content-between fw-bold fs-5 text-danger">
                            <span>Tổng cộng</span>
                            <span>{{ formatVND(getTotal()) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Promo Code -->
                <div class="card border-0 shadow-lg mb-4" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">🎟️ Mã Khuyến Mãi (Tùy Chọn)</h6>
                        <div class="input-group">
                            <input v-model="promoCode" type="text" class="form-control" placeholder="Nhập mã khuyến mãi">
                            <button @click="applyPromo" class="btn btn-danger fw-bold">Áp Dụng</button>
                        </div>
                        <small class="text-muted d-block mt-2" v-if="promoMessage">{{ promoMessage }}</small>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card border-0 shadow-lg" style="border-radius: 15px;">
                    <div class="card-body p-4 d-grid gap-3">
                        <button @click="goBack" class="btn btn-outline-secondary fw-bold py-3">
                            <i class="fa-solid fa-arrow-left me-2"></i>Quay Lại
                        </button>
                        <button @click="submitOrder" class="btn btn-danger fw-bold py-3" style="font-size: 18px;">
                            <i class="fa-solid fa-credit-card me-2"></i>Thanh Toán {{ formatVND(getTotal()) }}
                        </button>
                        <p class="text-muted text-center small mb-0">Bằng cách tiếp tục, bạn đồng ý với <a href="#" class="text-danger">Điều khoản sử dụng</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            orderData: {
                id_san_pham: null,
                ten_san_pham: '',
                hinh_anh: '',
                vi: '',
                kich_thuoc: '',
                so_luong: 1,
                gia_don_vi: 0,
                tong_tien: 0,
                ghi_chu: ''
            },
            delivery: {
                recipient: '',
                phone: '',
                address: '',
                method: 'express',
                notes: ''
            },
            paymentMethod: 'card',
            showCardForm: true,
            cardInfo: {
                cardName: '',
                cardNumber: '',
                expiryDate: '',
                cvv: ''
            },
            promoCode: '',
            promoMessage: '',
            discount: 0
        };
    },

    mounted() {
        // Kiểm tra đăng nhập
        const token = localStorage.getItem('key_client');
        if (!token) {
            this.$toast.error('Bạn cần đăng nhập để tiếp tục!');
            this.$router.push('/client/dang-nhap');
            return;
        }
        console.log('DonHang component mounted');
        console.log('Token:', token ? 'Có token' : 'Không có token');
        this.loadOrderData();
    },

    methods: {
        loadOrderData() {
            const savedData = sessionStorage.getItem('orderData');
            console.log('Saved data:', savedData);
            if (savedData) {
                try {
                    this.orderData = JSON.parse(savedData);
                    console.log('Order data loaded:', this.orderData);
                } catch (e) {
                    console.error('Error parsing order data:', e);
                    this.orderData = {
                        id_san_pham: null,
                        ten_san_pham: 'Khô Gà Chộ Đó',
                        hinh_anh: 'https://voz.vn/attachments/1000016571-jpg.3225622/',
                        vi: 'Cay',
                        kich_thuoc: 'Vừa (500g)',
                        so_luong: 1,
                        gia_don_vi: 150000,
                        tong_tien: 150000,
                        ghi_chu: ''
                    };
                }
            } else {
                // Default data nếu không có sessionStorage
                this.orderData = {
                    id_san_pham: null,
                    ten_san_pham: 'Khô Gà Chộ Đó',
                    hinh_anh: 'https://voz.vn/attachments/1000016571-jpg.3225622/',
                    vi: 'Cay',
                    kich_thuoc: 'Vừa (500g)',
                    so_luong: 1,
                    gia_don_vi: 150000,
                    tong_tien: 150000,
                    ghi_chu: ''
                };
            }
        },

        generateOrderId() {
            return Math.floor(Math.random() * 1000000).toString().padStart(6, '0');
        },

        getShippingFee() {
            const fees = {
                'express': 30000,
                'standard': 15000,
                'pickup': 0
            };
            return this.formatVND(fees[this.delivery.method] || 0);
        },

        getShippingFeeValue() {
            const fees = {
                'express': 30000,
                'standard': 15000,
                'pickup': 0
            };
            return fees[this.delivery.method] || 0;
        },

        getTotal() {
            const subtotal = this.orderData.tong_tien;
            const shipping = this.getShippingFeeValue();
            const tax = Math.ceil(subtotal * 0.1);
            const total = subtotal + shipping + tax - this.discount;
            return Math.max(0, total);
        },

        applyPromo() {
            if (!this.promoCode.trim()) {
                this.promoMessage = 'Vui lòng nhập mã khuyến mãi';
                return;
            }

            const promoCodes = {
                'WELCOME10': 50000,
                'CHODEN20': 100000,
                'FREE50': 50000
            };

            if (promoCodes[this.promoCode]) {
                this.discount = promoCodes[this.promoCode];
                this.promoMessage = `✅ Áp dụng thành công! Giảm ${this.formatVND(this.discount)}`;
            } else {
                this.promoMessage = '❌ Mã khuyến mãi không hợp lệ';
                this.discount = 0;
            }
        },

        validateForm() {
            if (!this.delivery.recipient.trim()) {
                this.$toast.error('Vui lòng nhập tên người nhận');
                return false;
            }
            if (!this.delivery.phone.trim()) {
                this.$toast.error('Vui lòng nhập số điện thoại');
                return false;
            }
            if (!this.delivery.address.trim()) {
                this.$toast.error('Vui lòng nhập địa chỉ giao hàng');
                return false;
            }

            if (this.paymentMethod === 'card') {
                if (!this.cardInfo.cardName.trim()) {
                    this.$toast.error('Vui lòng nhập tên chủ thẻ');
                    return false;
                }
                if (!this.cardInfo.cardNumber.trim() || this.cardInfo.cardNumber.length < 16) {
                    this.$toast.error('Vui lòng nhập số thẻ hợp lệ');
                    return false;
                }
                if (!this.cardInfo.expiryDate.trim()) {
                    this.$toast.error('Vui lòng nhập ngày hết hạn thẻ');
                    return false;
                }
                if (!this.cardInfo.cvv.trim() || this.cardInfo.cvv.length < 3) {
                    this.$toast.error('Vui lòng nhập CVV hợp lệ');
                    return false;
                }
            }

            return true;
        },

        submitOrder() {
            if (!this.validateForm()) {
                return;
            }

            const token = localStorage.getItem('key_client');
            if (!token) {
                this.$toast.error('Bạn cần đăng nhập để thanh toán!');
                this.$router.push('/client/dang-nhap');
                return;
            }

            const orderPayload = {
                ten_san_pham: this.orderData.ten_san_pham,
                so_luong: this.orderData.so_luong,
                gia_tien: this.orderData.tong_tien,
                ten_nguoi_nhan: this.delivery.recipient,
                sdt: this.delivery.phone,
                dia_chi: this.delivery.address,
                phuong_thuc_giao: this.delivery.method,
                ghi_chu: this.orderData.ghi_chu || this.delivery.notes,
                phuong_thuc_thanh_toan: this.paymentMethod,
                giam_gia: this.discount
            };

            console.log('Submitting order:', orderPayload);

            axios.post('http://127.0.0.1:8000/api/client/don-hang/create', orderPayload, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            })
                .then((res) => {
                    console.log('Order response:', res.data);
                    if (res.data.status) {
                        this.$toast.success('Đặt hàng thành công! 🎉');
                        sessionStorage.removeItem('orderData');
                        setTimeout(() => {
                            this.$router.push('/lich-su-don-hang');
                        }, 2000);
                    } else {
                        this.$toast.error(res.data.message || 'Có lỗi xảy ra');
                    }
                })
                .catch((err) => {
                    console.error('Order error:', err);
                    if (err.response && err.response.data && err.response.data.message) {
                        this.$toast.error(err.response.data.message);
                    } else if (err.response && err.response.status === 401) {
                        this.$toast.error('Token hết hạn, vui lòng đăng nhập lại!');
                        localStorage.removeItem('key_client');
                        this.$router.push('/client/dang-nhap');
                    } else {
                        this.$toast.error('Đặt hàng thất bại! ' + (err.message || 'Lỗi kết nối'));
                    }
                });
        },

        goBack() {
            this.$router.go(-1);
        },

        formatVND(value) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(value);
        },

        formatDate(date) {
            const d = new Date(date);
            return d.toLocaleDateString('vi-VN', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                timeZone: 'Asia/Ho_Chi_Minh'
            });
        }
    }
};
</script>

<style scoped>
</style>
