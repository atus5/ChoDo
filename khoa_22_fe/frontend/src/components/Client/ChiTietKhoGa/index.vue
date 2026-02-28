<template>
    <!-- Product Banner Section -->
    <div class="">
        <div class="ratio ratio-16x9 shadow-lg overflow-hidden" style="height: 450px; object-fit: cover; ">
            <img :src="getImageUrl(chi_tiet_phim.hinh_anh)" loading="lazy" alt="Product Banner" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
    </div>

    <!-- Movie Details Container -->
    <div class="container py-5">
        <div class="row g-4">
            <!-- Poster Section -->
            <div class="col-md-4">
                <img :src="getImageUrl(chi_tiet_phim.hinh_anh)" loading="lazy" alt="Movie Poster" class="img-fluid rounded shadow-lg mb-4">
                <div class="d-grid gap-3">
                    <button class="btn btn-warning py-3 fw-bold" @click="checkLoginAndBuy()">
                        <i class="fa-solid fa-ticket"></i> Mua khô gà
                    </button>
                </div>
            </div>

            <!-- Movie Information Section -->
            <div class="col-md-8">
                <div class="mb-4">
                    <h1 class="fw-bold text-dark mb-3">🐔 {{ chi_tiet_phim.ten_phim || 'Khô Gà Tuyệt Vời' }}</h1>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="badge bg-danger rounded-pill px-3 py-2" style="font-size: 16px;">
                            <strong>Giá: {{ formatVND(chi_tiet_phim.thoi_luong || 0) }}</strong>
                        </span>
                        <span class="badge bg-warning rounded-pill px-3 py-2 text-dark">
                            ⭐ {{ chi_tiet_phim.rate || '36/36' }}
                        </span>
                    </div>
                </div>

                <div class="row g-3">
                    <!-- Detailed Information -->
                    <div class="col-lg-6">
                        <h4 class="fw-bold mb-3 border-bottom pb-2">Thông Tin Sản Phẩm</h4>
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2 border-bottom pb-2">
                                    <span class="fw-bold text-dark">Thương Hiệu:</span>
                                    <span>{{ chi_tiet_phim.nha_cung_cap || 'Chộ Đó' }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2 border-bottom pb-2">
                                    <span class="fw-bold text-dark">Xuất Xứ:</span>
                                    <span>{{ chi_tiet_phim.quoc_gia || '120 Yên Lãng' }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2 border-bottom pb-2">
                                    <span class="fw-bold text-dark">Loại Vị:</span>
                                    <span>{{ chi_tiet_phim.loai_vi || getRandomFlavor(chi_tiet_phim.id) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2 border-bottom pb-2">
                                    <span class="fw-bold text-dark">Trọng Lượng:</span>
                                    <span>{{ chi_tiet_phim.kich_thuoc || getRandomWeight(chi_tiet_phim.id) }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold text-dark">Công Ty:</span>
                                    <span>{{ chi_tiet_phim.cong_ty || 'Công ty TNHH Chộ Đó Foods' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cast and Producer -->
                    <div class="col-lg-6">
                        <h4 class="fw-bold mb-3 border-bottom pb-2">🧂 Thành Phần Chính</h4>
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <p class="mb-0">{{ chi_tiet_phim.dien_vien }}</p>
                            </div>
                        </div>
                        <h4 class="fw-bold mb-3 border-bottom pb-2">📜 Chứng Chỉ Chất Lượng</h4>
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <p class="mb-0">✅ VSATTP, ✅ ISO 22000, ✅ Kiểm Nghiệm ATTP</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Synopsis -->
                <div class="mt-4">
                    <h4 class="fw-bold mb-3 border-bottom pb-2">📝 Mô Tả Chi Tiết</h4>
                    <div class="card shadow-sm">
                        <div class="card-body p-4 description-scroll">
                            <p class="text-dark m-0" style="white-space: pre-wrap; word-wrap: break-word; line-height: 1.8; font-size: 0.95rem;">
                                {{ chi_tiet_phim.mo_ta || 'Khô gà chất lượng cao, được chế biến theo công thức truyền thống kết hợp với công nghệ hiện đại. Mỗi miếng khô gà đều được chọn lọc kỹ càng để đảm bảo độ mềm, thơm và ngon nhất.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-5">
            <div class="col-lg-8">
                <div class="bg-white rounded shadow-sm p-4 h-100">
                    <h5 class="fs-5 fw-bold mb-4 border-bottom pb-2">💬 Đánh Giá Khách Hàng</h5>
                    <div class="mb-4">
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <img src="https://i.pravatar.cc/48?img=1" alt="User Avatar" class="rounded-circle"
                                    width="45" height="45">
                            </div>
                            <div class="col">
                                <textarea id="noidung" v-model="noi_dung_binh_luan" class="form-control" rows="1"
                                    placeholder="Chia sẻ trải nghiệm của bạn về khô gà..." required></textarea>
                            </div>
                            <div class="col-auto">
                                <button @click="binhLuan()"
                                    class="btn btn-danger px-4 py-2 btn-sm fw-semibold">Gửi</button>
                            </div>
                        </div>
                    </div>
                    <div class="border-top pt-4">
                        <template v-for="(value, index) in list_binh_luan" :key="index">
                            <div class="mb-3 mt-2 bg-secondary bg-opacity-10 border border-secondary rounded-3 p-3">
                                <div class="d-flex align-items-start gap-3">
                                    <img :src="value.avatar" alt="User Avatar" class="rounded-circle" width="45"
                                        height="45">
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="fw-bold mb-0">{{ value.ho_va_ten }}</h6>
                                            <small class="text-muted">{{ formatDate(value.created_at) }}</small>
                                        </div>
                                        <p class="mb-0 text-secondary">
                                            {{ value.noi_dung }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="bg-white rounded shadow-sm p-4 h-100">
                    <h5 class="fs-5 fw-bold mb-4 border-bottom pb-2">⭐ Đánh Giá Sản Phẩm</h5>
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="d-flex align-items-center gap-3">
                                <div class="text-center">
                                    <h3 class="fw-bold text-danger mb-0">{{ getRatingScore() }}</h3>
                                    <p class="text-muted small mb-0 star-display">{{ getStarDisplay() }}</p>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-danger" role="progressbar" :style="{ width: getRatingPercentage() + '%' }"
                                            :aria-valuenow="getRatingPercentage()" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="text-muted small mt-1">{{ getRatingText() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="row g-3 ">
                            <div class="col-auto">
                                <select class="form-select" aria-label="Rating select">
                                    <option selected>Chọn sao</option>
                                    <option value="1">⭐ 1 sao</option>
                                    <option value="2">⭐⭐ 2 sao</option>
                                    <option value="3">⭐⭐⭐ 3 sao</option>
                                    <option value="4">⭐⭐⭐⭐ 4 sao</option>
                                    <option value="5">⭐⭐⭐⭐⭐ 5 sao</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <textarea class="form-control" rows="2"
                                    placeholder="Viết bình luận..."></textarea>
                            </div>
                        </div>
                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-danger px-4 py-2 fw-semibold">📤 Gửi Đánh Giá</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other Movies Section -->
        <div class="bg-white rounded shadow-sm p-3 p-md-4 mt-3">
            <h4>🐔 Khô Gà Khác Từ Chộ Đó</h4>
            <div class="row">
                <template v-for="(value, index) in list_phim_khac" :key="index">
                    <div class="col-lg-3 col-md-4 rounded mb-3" style="flex: 0 0 auto;">
                        <div class="rounded position-relative"
                            style="transition: transform 0.3s ease, box-shadow 0.3s ease; overflow: hidden; height: 100%;"
                            onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.2)'; this.querySelector('.btn-overlay').style.opacity = '1'"
                            onmouseout="this.style.transform='none'; this.style.boxShadow='none'; this.querySelector('.btn-overlay').style.opacity = '0'">

                            <div class="card-img-top">
                                <img :src="getImageUrl(value.hinh_anh)" loading="lazy" class="img-fluid" alt=""
                                    style="height: 500px; object-fit: cover;">
                            </div>

                            <div class="btn-overlay text-center position-absolute w-100"
                                style="top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0; transition: opacity 0.3s ease;">
                                <a :href="`/chi-tiet-kho-ga/${value.id}`">
                                    <button class="btn btn-danger p-2 " style="width: 170px;"><i
                                            class="fa-solid fa-shopping-cart"></i> Mua Ngay
                                    </button>
                                </a>
                                <br>
                                <a :href="`/chi-tiet-kho-ga/${value.id}`">
                                    <button class="btn btn-outline-light p-2 mt-2" style="width: 170px;"><i
                                            class="fa-solid fa-eye"></i> Chi Tiết
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Modal Order Khô Gà -->
    <div class="modal fade" id="buyTicketModal" tabindex="-1" aria-labelledby="movieScheduleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger border-bottom">
                    <h4 class="modal-title fs-3 fw-bold text-white" id="movieScheduleModalLabel">
                        🐔 Đặt Hàng Khô Gà: {{ chi_tiet_phim.ten_phim || 'Khô Gà Tuyệt Vời' }}
                    </h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Chọn loại khô gà -->
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3 text-dark">🌶️ Chọn Loại Vị</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <button v-for="(flavor, index) in flavorOptions" :key="index"
                                class="btn btn-outline-danger"
                                :class="{ 'btn-danger': selectedFlavor === flavor }"
                                @click="selectedFlavor = flavor">
                                {{ flavor }}
                            </button>
                        </div>
                    </div>

                    <!-- Chọn kích thước gói -->
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3 text-dark">📦 Chọn Kích Thước & Giá</h5>
                        <div class="row g-3">
                            <div class="col-md-6" v-for="(size, index) in packageSizes" :key="index">
                                <div class="card border-2 cursor-pointer"
                                    :class="{ 'border-danger': selectedSize === size.name, 'border-light': selectedSize !== size.name }"
                                    @click="selectedSize = size.name"
                                    style="cursor: pointer;">
                                    <div class="card-body text-center">
                                        <h6 class="fw-bold">{{ size.name }}</h6>
                                        <p class="text-muted mb-2">{{ size.weight }}</p>
                                        <p class="fw-bold text-danger">💰 {{ size.price.toLocaleString() }}₫</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Số lượng -->
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3 text-dark">🛒 Số Lượng</h5>
                        <div class="d-flex align-items-center gap-3">
                            <button class="btn btn-outline-secondary" @click="quantity = Math.max(1, quantity - 1)">−</button>
                            <input v-model.number="quantity" type="number" class="form-control text-center" min="1" style="width: 80px;">
                            <button class="btn btn-outline-secondary" @click="quantity++">+</button>
                        </div>
                    </div>

                    <!-- Tổng tiền -->
                    <div class="alert alert-danger">
                        <h5 class="mb-0">💵 <strong>Tổng Tiền: {{ getTotalPrice().toLocaleString() }}₫</strong></h5>
                    </div>

                    <!-- Ghi chú -->
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3 text-dark">📝 Ghi Chú Đơn Hàng (Tùy Chọn)</h5>
                        <textarea v-model="notes" class="form-control" rows="3" placeholder="VD: Thêm muối, Cay khát..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger btn-lg" @click="muaKhoGa()" :disabled="!selectedFlavor || !selectedSize">
                        <i class="fa-solid fa-cart-shopping"></i> Thêm Vào Giỏ
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    props: ["id_phim"],
    data() {
        return {
            id_phim: this.$route.params.id_phim,
            chi_tiet_phim: {},
            suat_chieu_phim: [],
            selectedDate: false,

            noi_dung_binh_luan: "",
            list_binh_luan: [],
            list_phim_khac: [],

            // Khô gà options
            flavorOptions: ['Cay siêu cấp', 'Vàng ươm', 'Nướng thơm', 'Chua cay', 'Mặn nhẹ'],
            selectedFlavor: null,
            packageSizes: [
                { name: 'Nhỏ (100g)', weight: '100g', price: 29000 },
                { name: 'Vừa (200g)', weight: '200g', price: 49000 },
                { name: 'Lớn (500g)', weight: '500g', price: 99000 },
                { name: 'Siêu to (1kg)', weight: '1kg', price: 180000 }
            ],
            selectedSize: null,
            quantity: 1,
            notes: '',
        }
    },
    computed: {
        ngayChieu() {
            if (!this.suat_chieu_phim || this.suat_chieu_phim.length === 0) {
                return [];
            }
            // Lấy danh sách ngày chiếu
            const allDates = this.suat_chieu_phim.map(item => item.ngay_chieu);
            // Lọc bỏ trùng
            const uniqueDates = Array.from(new Set(allDates));
            // Trả về đúng định dạng
            return uniqueDates.map(date => ({ ngay_chieu: date }));
        },
        suatChieuTheoNgay() {
            return this.selectedDate ? this.suat_chieu_phim.filter(item => item.ngay_chieu === this.selectedDate)
                : [];
        }
    },
    mounted() {
        this.loadChiTietPhim();
        // Bình luận chưa hỗ trợ cho mock khô gà, tạm bỏ
        this.list_binh_luan = [];
    },
    methods: {
        formatVND(value) {
            if (!value && value !== 0) return '0₫';
            const number = Number(value) || 0;
            return number.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        },
        formatTime(time) {
            return time.slice(0, 5);
        },
        formatDate(date) {
            const d = new Date(date);
            return `${d.getDate()}/${d.getMonth() + 1}/${d.getFullYear()}`;
        },
        async loadChiTietPhim() {
            const fallbackImg = 'https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/';
            const statusOk = (res) => res?.data?.status === true || res?.data?.status === 'success';

            // Attempt 1: API endpoint for chi-tiet-kho-ga
            try {
                const resPhim = await axios.get(`/api/client/chi-tiet-kho-ga/${this.id_phim}`, { timeout: 6000 });
                const data = resPhim.data?.data || resPhim.data?.data_phim;
                if (statusOk(resPhim) && data) {
                    this.chi_tiet_phim = {
                        ...data,
                        hinh_anh: data.hinh_anh || fallbackImg,
                        ten_phim: data.ten_kho_ga || data.ten_phim,
                        thoi_luong: Number(data.gia || data.thoi_luong || 0),
                        tinh_trang: data.tinh_trang || '4.8/5',
                        rate: data.rate || '36/36',
                        mo_ta: data.mo_ta,
                        dien_vien: data.dien_vien || data.thanh_phan,
                        loai_vi: data.loai_vi || data.the_loai || this.getRandomFlavor(data.id),
                        kich_thuoc: data.kich_thuoc || this.getRandomWeight(data.id),
                        quoc_gia: data.quoc_gia || '120 Yên Lãng',
                        nha_cung_cap: data.nha_cung_cap || data.nha_san_xuat || 'Chộ Đó',
                        cong_ty: data.cong_ty || data.nha_cung_cap || data.nha_san_xuat || 'Công ty TNHH Chộ Đó Foods',
                    };
                    console.log('Loaded from API:', this.chi_tiet_phim);
                    return;
                }
            } catch (err) {
                console.error('API chi-tiet-kho-ga error:', err.message);
            }

            // Attempt 2: Static JSON file (kho-ga-data.json)
            try {
                const resStatic = await fetch('/kho-ga-data.json');
                if (resStatic.ok) {
                    const jsonData = await resStatic.json();
                    const phimList = jsonData.data || [];
                    const phimItem = phimList.find(p => p.id === parseInt(this.id_phim));
                    
                    if (phimItem) {
                        this.chi_tiet_phim = {
                            ...phimItem,
                            hinh_anh: phimItem.hinh_anh || fallbackImg,
                            ten_phim: phimItem.ten_phim,
                            thoi_luong: Number(phimItem.thoi_luong || 0),
                            tinh_trang: phimItem.tinh_trang || '4.8/5',
                            rate: phimItem.rate || '36/36',
                            mo_ta: phimItem.mo_ta,
                            dien_vien: phimItem.dien_vien,
                            loai_vi: phimItem.the_loai || this.getRandomFlavor(phimItem.id),
                            kich_thuoc: this.getRandomWeight(phimItem.id),
                            quoc_gia: phimItem.quoc_gia || '120 Yên Lãng',
                            nha_cung_cap: phimItem.nha_san_xuat || phimItem.nha_cung_cap || 'Chộ Đó',
                            cong_ty: phimItem.nha_san_xuat || phimItem.cong_ty || 'Công ty TNHH Chộ Đó Foods',
                        };
                        console.log('Loaded from static JSON:', this.chi_tiet_phim);
                        return;
                    }
                }
            } catch (err) {
                console.error('Static JSON load error:', err.message);
            }

            // Fallback 3: API endpoint legacy
            try {
                const res = await axios.get(`/api/client/chi-tiet-phim/get-data/${this.id_phim}`, { timeout: 6000 });
                if (statusOk(res) && res.data?.data_phim) {
                    const data = res.data.data_phim;
                    this.chi_tiet_phim = {
                        ...data,
                        hinh_anh: data.hinh_anh || fallbackImg,
                        ten_phim: data.ten_phim,
                        thoi_luong: Number(data.thoi_luong || 0),
                        tinh_trang: data.tinh_trang || '4.8/5',
                        rate: data.rate || '36/36',
                        mo_ta: data.mo_ta,
                        dien_vien: data.dien_vien,
                        loai_vi: data.the_loai || this.getRandomFlavor(data.id),
                        kich_thuoc: this.getRandomWeight(data.id),
                        quoc_gia: data.quoc_gia || '120 Yên Lãng',
                        nha_cung_cap: data.nha_san_xuat || 'Chộ Đó',
                        cong_ty: data.nha_san_xuat || 'Công ty TNHH Chộ Đó Foods',
                    };
                    console.log('Loaded from legacy API:', this.chi_tiet_phim);
                } else {
                    console.warn('No data found - using placeholder');
                }
            } catch (err) {
                console.error('Fallback legacy error:', err.message);
            }
        },
        binhLuan() {
            var payload = {
                "id_phim": this.id_phim,
                "noi_dung_binh_luan": this.noi_dung_binh_luan
            }
            axios
                .post("http://127.0.0.1:8000/api/client/chi-tiet-phim/binh-luan", payload, {
                    headers: {
                        Authorization: "Bearer " + localStorage.getItem('key_client')
                    }
                })
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        this.dataBinhLuan();

                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch((err) => {
                    this.$toast.error('Không thể gửi bình luận');
                    console.error('Binh luan error:', err);
                });
        },
        dataBinhLuan() {
            axios
                .get("http://127.0.0.1:8000/api/client/chi-tiet-phim/binh-luan/get-data/" + this.id_phim)
                .then((res) => {
                    this.list_binh_luan = res.data.data;
                    this.noi_dung_binh_luan = ""
                })
                .catch((err) => {
                    console.error('Get binh luan error:', err);
                    this.list_binh_luan = [];
                });
        },
        checkLoginAndBuy() {
            // Kiểm tra xem user đã đăng nhập chưa
            const token = localStorage.getItem('key_client');
            if (!token) {
                // Chưa đăng nhập - chuyển sang trang đăng nhập
                this.$toast.error('Vui lòng đăng nhập để mua hàng!');
                this.$router.push('/client/dang-nhap');
                return;
            }
            
            // Đã đăng nhập - mở modal
            const buyModal = new window.bootstrap.Modal(document.getElementById('buyTicketModal'));
            buyModal.show();
        },
        muaKhoGa() {
            if (!this.selectedFlavor || !this.selectedSize) {
                this.$toast.error("Vui lòng chọn loại vị và kích thước gói!");
                return;
            }
            const totalPrice = this.getTotalPrice();
            
            // Tạo object đơn hàng
            const orderData = {
                id_san_pham: this.id_phim,
                ten_san_pham: this.chi_tiet_phim.ten_phim || 'Khô Gà Tuyệt Vời',
                hinh_anh: this.chi_tiet_phim.hinh_anh,
                vi: this.selectedFlavor,
                kich_thuoc: this.selectedSize,
                so_luong: this.quantity,
                gia_don_vi: this.packageSizes.find(s => s.name === this.selectedSize).price,
                tong_tien: totalPrice,
                ghi_chu: this.notes
            };
            
            // Lưu vào sessionStorage
            sessionStorage.setItem('orderData', JSON.stringify(orderData));
            sessionStorage.setItem('orderStatus', 'pending');
            
            this.$toast.success(`Chuyển sang thanh toán...`);
            
            // Đóng modal
            const modalElement = document.getElementById('buyTicketModal');
            const modal = window.bootstrap.Modal.getInstance(modalElement);
            if (modal) {
                modal.hide();
            }
            
            // Điều hướng sang DonHang
            this.$router.push('/client/don-hang');
        },
        getTotalPrice() {
            if (!this.selectedSize) return 0;
            const selectedSizeObj = this.packageSizes.find(s => s.name === this.selectedSize);
            return selectedSizeObj ? selectedSizeObj.price * this.quantity : 0;
        },
        getRandomFlavor(productId) {
            const flavors = ['Cay siêu cấp', 'Vàng ươm', 'Nướng thơm', 'Chua cay', 'Mặn nhẹ', 'Tây Bắc', 'Đặc biệt'];
            // Sử dụng productId để tạo consistent result mỗi lần load
            const index = (productId || 1) % flavors.length;
            return flavors[index];
        },
        getRandomWeight(productId) {
            const weights = ['150g', '200g', '250g', '300g', '400g', '500g', '750g', '1kg'];
            // Sử dụng productId để tạo consistent result mỗi lần load
            const index = (productId || 1) % weights.length;
            return weights[index];
        },
        getRandomIngredients(productId) {
            const ingredients = [
                'Ức gà xé sợi, lá chanh, sa tế, ớt sừng',
                'Đùi gà nướng, hành phi, tỏi Lý Sơn, ớt hiểm',
                'Ức gà, tiêu xanh Phú Quốc, lá chanh, mật ong',
                'Gà ta, sả, ớt xiêm, lá chanh, muối thảo mộc',
                'Ức gà, paprika, tiêu đen, hành phi, lá nguyệt quế',
                'Ức gà hữu cơ, tỏi đen, ớt bột Hàn, lá oregano'
            ];
            const index = (productId || 1) % ingredients.length;
            return ingredients[index];
        },
        getImageUrl(imagePath) {
            const fallback = 'https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/';
            const base = axios.defaults.baseURL || window.location.origin;
            if (!imagePath) return fallback;
            if (/^https?:\/\//i.test(imagePath)) return imagePath;
            if (imagePath.startsWith('/')) return `${base}${imagePath}`;
            if (imagePath.startsWith('storage/')) return `${base}/${imagePath}`;
            return `${base}/storage/${imagePath}`;
        },
        getRatingScore() {
            // Display tinh_trang value directly from database
            const ratingStr = String(this.chi_tiet_phim.rate || this.chi_tiet_phim.tinh_trang || '36/36');
            return ratingStr;
        },
        getRatingPercentage() {
            // Convert rating to percentage for progress bar
            const ratingStr = String(this.chi_tiet_phim.rate || this.chi_tiet_phim.tinh_trang || '36/36');
            // For "X/Y" format, calculate percentage
            if (ratingStr.includes('/')) {
                const parts = ratingStr.split('/');
                const score = parseInt(parts[0]);
                const max = parseInt(parts[1]);
                if (!isNaN(score) && !isNaN(max) && max > 0) {
                    return Math.round((score / max) * 100);
                }
            }
            // For "X.X" format, convert to percentage (assuming out of 5)
            const score = parseFloat(ratingStr);
            if (!isNaN(score)) {
                return Math.round((score / 5) * 100);
            }
            return 96;
        },
        getStarDisplay() {
            // Display stars based on rating value
            const ratingStr = String(this.chi_tiet_phim.rate || this.chi_tiet_phim.tinh_trang || '36/36');
            
            // For "X/Y" format, display X stars
            if (ratingStr.includes('/')) {
                const parts = ratingStr.split('/');
                const stars = parseInt(parts[0]);
                if (!isNaN(stars)) {
                    return '⭐'.repeat(Math.min(stars, 36)); // Cap at 36 for display
                }
            }
            
            // For decimal format, display based on 5-star scale
            const score = parseFloat(ratingStr);
            if (!isNaN(score)) {
                const fullStars = Math.floor(score);
                const hasHalfStar = score % 1 >= 0.5;
                let stars = '⭐'.repeat(fullStars);
                if (hasHalfStar) stars += '⭐';
                return stars;
            }
            
            return '⭐⭐⭐⭐⭐';
        },
        getRatingText() {
            // Format rating text - extract review count or default
            const ratingStr = String(this.chi_tiet_phim.rate || this.chi_tiet_phim.tinh_trang || '36/36');
            // For "X/Y" format (from phims table), use default format
            if (ratingStr.includes('/') && !ratingStr.includes('reviews')) {
                return '(2.5K reviews)';
            }
            if (ratingStr.includes('K') || ratingStr.includes('reviews')) {
                return ratingStr.includes('(') ? ratingStr.substring(ratingStr.indexOf('(')) : 'Từ 2,542 đánh giá';
            }
            return 'Từ 2,542 đánh giá';
        }
    },
}
</script>
<style scoped>
.description-scroll {
    max-height: 600px;
    overflow-y: auto;
    border-radius: 0.375rem;
}

/* Custom scrollbar styling */
.description-scroll::-webkit-scrollbar {
    width: 10px;
}

.description-scroll::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.description-scroll::-webkit-scrollbar-thumb {
    background: #ff6b6b;
    border-radius: 10px;
    transition: background 0.3s ease;
}

.description-scroll::-webkit-scrollbar-thumb:hover {
    background: #ff5252;
}

/* Firefox scrollbar */
.description-scroll {
    scrollbar-color: #ff6b6b #f1f1f1;
    scrollbar-width: thin;
}

/* Star display styling */
.star-display {
    font-size: 0.7rem;
    word-break: break-word;
    line-height: 1.2;
}
</style>