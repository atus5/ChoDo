<template>
    <div class="py-4">
        <!-- Header -->
        <div class="container-fluid py-5 hero-gradient">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark mb-3">
                        <li class="breadcrumb-item"><a href="/" class="text-white">Trang Chủ</a></li>
                        <li class="breadcrumb-item"><a href="/kho-ga/sap-ban" class="text-white">Khô Gà Sắp Bán</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">Đặt trước</li>
                    </ol>
                </nav>
                <h1 class="display-6 fw-bold text-white mb-2">Đặt trước khô gà</h1>
                <p class="text-white-50 mb-0">Giữ chỗ sản phẩm yêu thích, nhận ưu đãi khi mở bán.</p>
            </div>
        </div>

        <div class="container py-5">
            <div class="row g-4">
                <!-- Product Summary -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="ratio ratio-4x3 bg-light">
                            <img :src="product.hinh_anh" @error="handleImgError" class="w-100 h-100" style="object-fit: cover;" :alt="product.ten_phim">
                        </div>
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-2">{{ product.ten_phim }}</h4>
                            <p class="text-muted mb-3">{{ product.mo_ta }}</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="badge bg-warning text-dark px-3 py-2">{{ formatPrice(product) }}</span>
                                <span class="text-info fw-semibold"><i class="fa-solid fa-clock me-1"></i>{{ product.tinh_trang }}</span>
                            </div>
                            <div class="row mt-4 g-3">
                                <div class="col-6">
                                    <div class="info-tile">
                                        <div class="label">Ngày mở bán</div>
                                        <div class="value">{{ product.ngay_phat_hanh || 'Sắp cập nhật' }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="info-tile">
                                        <div class="label">Đã đặt trước</div>
                                        <div class="value">{{ product.so_luong_dat_truoc || 0 }} đơn</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Preorder Form -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-lg rounded-4">
                        <div class="card-body p-4 p-lg-5">
                            <h4 class="fw-bold mb-4">Thông tin đặt trước</h4>
                            <form @submit.prevent="handleSubmit">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Họ và tên</label>
                                        <input v-model="form.name" type="text" class="form-control" placeholder="Nguyễn Văn A" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Số điện thoại</label>
                                        <input v-model="form.phone" type="tel" class="form-control" placeholder="0909 000 000" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email (tuỳ chọn)</label>
                                        <input v-model="form.email" type="email" class="form-control" placeholder="email@example.com">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Số lượng</label>
                                        <input v-model.number="form.quantity" type="number" min="1" class="form-control" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Địa chỉ nhận hàng</label>
                                        <input v-model="form.address" type="text" class="form-control" placeholder="Số nhà, đường, quận/huyện, tỉnh/thành" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Ghi chú</label>
                                        <textarea v-model="form.note" class="form-control" rows="3" placeholder="Ghi chú về thời gian giao hàng, yêu cầu đặc biệt..."></textarea>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between mt-4">
                                    <div class="text-muted small">
                                        Bằng việc đặt trước, bạn đồng ý với chính sách của chúng tôi.
                                    </div>
                                    <button class="btn btn-primary px-4 py-2 fw-bold">
                                        <i class="fa-solid fa-bag-shopping me-2"></i>Đặt trước ngay
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="alert alert-info rounded-4 mt-4">
                        <i class="fa-solid fa-circle-info me-2"></i>
                        Đơn đặt trước sẽ được xác nhận qua điện thoại trong 24h. Khi mở bán, chúng tôi sẽ ưu tiên giao hàng cho bạn.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["id"],
    data() {
        return {
            product: {
                id: null,
                ten_phim: 'Khô gà sắp bán',
                mo_ta: 'Sản phẩm khô gà chuẩn bị ra mắt.',
                hinh_anh: 'https://placehold.co/800x600?text=Kho+Ga',
                thoi_luong: 0,
                loai_vi: 'Đặc biệt',
                tinh_trang: 'Sắp bán',
                ngay_phat_hanh: null,
                so_luong_dat_truoc: 0,
            },
            form: {
                name: '',
                phone: '',
                email: '',
                quantity: 1,
                address: '',
                note: '',
            },
        };
    },
    mounted() {
        const token = localStorage.getItem('key_client');
        if (!token) {
            this.$toast?.error?.('Vui lòng đăng nhập để đặt trước!');
            this.$router.push('/client/dang-nhap');
            return;
        }
        this.loadProduct();
    },
    methods: {
        handleImgError(event) {
            event.target.src = 'https://placehold.co/800x600?text=Kho+Ga';
        },
        formatPrice(item) {
            const price = Number(item?.thoi_luong ?? item?.gia ?? 0);
            return `${Math.max(price, 0).toLocaleString('vi-VN')} đ`;
        },
        async loadProduct() {
            const id = Number(this.id);
            if (!Number.isFinite(id)) return;

            // Try API first
            try {
                const res = await fetch('/api/client/kho-ga-sap-ban/get-data');
                if (res.ok) {
                    const data = await res.json();
                    const list = Array.isArray(data?.data) ? data.data : [];
                    const found = list.find((item) => Number(item.id) === id);
                    if (found) {
                        this.applyProduct(found);
                        return;
                    }
                }
            } catch (err) {
                console.error('Load kho-ga-sap-ban API error:', err);
            }

            // Fallback JSON
            try {
                const res = await fetch('/kho-ga-sap-ban.json');
                if (res.ok) {
                    const data = await res.json();
                    const list = Array.isArray(data?.data) ? data.data : [];
                    const found = list.find((item) => Number(item.id) === id);
                    if (found) {
                        this.applyProduct(found);
                    }
                }
            } catch (err) {
                console.error('Load kho-ga-sap-ban JSON error:', err);
            }
        },
        applyProduct(item) {
            this.product = {
                id: item.id,
                ten_phim: item.ten_phim || item.ten_kho_ga,
                mo_ta: item.mo_ta_ngan || item.mo_ta || 'Sản phẩm khô gà chuẩn bị ra mắt.',
                hinh_anh: item.hinh_anh || 'https://placehold.co/800x600?text=Kho+Ga',
                thoi_luong: item.thoi_luong ?? item.gia,
                loai_vi: item.loai_vi || 'Đặc biệt',
                tinh_trang: item.tinh_trang || 'Sắp bán',
                ngay_phat_hanh: item.ngay_phat_hanh || null,
                so_luong_dat_truoc: item.so_luong_dat_truoc || 0,
            };
        },
        handleSubmit() {
            const token = localStorage.getItem('key_client');
            if (!token) {
                this.$toast?.error?.('Vui lòng đăng nhập để đặt trước!');
                this.$router.push('/client/dang-nhap');
                return;
            }
            const orderId = Date.now();
            const preorder = {
                id: orderId,
                ten_san_pham: this.product.ten_phim,
                hinh_anh: this.product.hinh_anh,
                vi: this.product.loai_vi || 'Đặc biệt',
                kich_thuoc: 'Tiêu chuẩn',
                so_luong: this.form.quantity,
                gia_don_vi: Number(this.product.thoi_luong ?? 0),
                tong_tien: Number(this.product.thoi_luong ?? 0) * Number(this.form.quantity || 1),
                ghi_chu: this.form.note,
                ten_nguoi_nhan: this.form.name,
                sdt: this.form.phone,
                email: this.form.email,
                dia_chi: this.form.address,
                trang_thai: 'preorder',
                created_at: new Date().toISOString(),
            };

            const existing = JSON.parse(localStorage.getItem('preorderOrders') || '[]');
            existing.unshift(preorder);
            localStorage.setItem('preorderOrders', JSON.stringify(existing));

            this.$toast?.success?.('Đặt trước thành công! 🎉');
            this.$router.push('/');
        },
    },
};
</script>

<style scoped>
.hero-gradient {
    background: linear-gradient(135deg, #0f766e 0%, #0d9488 50%, #14b8a6 100%);
}

.info-tile {
    background: #f8fafc;
    border-radius: 12px;
    padding: 12px 14px;
}

.info-tile .label {
    font-size: 0.8rem;
    color: #6b7280;
}

.info-tile .value {
    font-weight: 700;
    color: #0f172a;
}
</style>
