<template>
    <div id="carouselExampleAutoplaying" class="carousel slide mb-5" data-bs-ride="false">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1585521537411-16b2d6ea1cc5?w=1200&h=400&fit=crop" class="d-block w-100"
                    style="width: 100%; height: 400px; object-fit: cover; border-radius: 8px;">
            </div>
            <div class="carousel-item ">
                <img src="https://images.unsplash.com/photo-1626082927389-6cd097cdc46e?w=1200&h=400&fit=crop" class="d-block w-100"
                    style="width: 100%; height: 400px; object-fit: cover; border-radius: 8px;">
            </div>
            <div class="carousel-item ">
                <img src="https://images.unsplash.com/photo-1555939594-58d7cb561af1?w=1200&h=400&fit=crop"
                    class="d-block w-100 img-fluid" style="width: 100%; height: 400px; object-fit: cover; border-radius: 8px;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container-fluid px-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="text-center">
                    <h1 class="text-uppercase fw-bold text-gradient mb-2" style="font-size: 2.5rem; background: linear-gradient(45deg, #ff6b6b, #feca57); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        🐔 Khô Gà Đang Bán
                    </h1>
                    <p class="text-muted fs-5">Những sản phẩm khô gà chất lượng cao, đảm bảo vị ngon mỗi ngày</p>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div v-if="isLoading" class="text-center py-5">
            <div class="spinner-border text-warning mb-3" role="status">
                <span class="visually-hidden">Đang tải...</span>
            </div>
            <p class="text-muted fs-5">Đang tải dữ liệu khô gà...</p>
        </div>

        <!-- Empty State -->
        <div v-else-if="!list_phim.length" class="text-center py-5">
            <div class="alert alert-info rounded-3" role="alert">
                <i class="fa-solid fa-inbox fs-1 mb-3"></i>
                <p class="text-muted fs-5 mt-3">Chưa có dữ liệu khô gà từ hệ thống.</p>
            </div>
        </div>

        <!-- Products Grid -->
        <div v-else class="row g-4 mb-5">
            <div v-for="(product, index) in list_phim" :key="index" class="col-lg-4 col-md-6 col-sm-12">
                <div class="card rounded-3 h-100 shadow-sm overflow-hidden product-card border-0" style="transition: all 0.3s ease;">
                    <!-- Product Image -->
                    <div class="position-relative" style="height: 300px; overflow: hidden; background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);">
                        <img :src="getImageUrl(product.hinh_anh)" @error="handleImgError" loading="lazy" class="img-fluid w-100 h-100" 
                            :alt="product.ten_phim" style="object-fit: cover; transition: transform 0.3s ease;">
                        
                        <!-- Action Buttons Overlay -->
                        <div class="btn-overlay position-absolute w-100 h-100 d-flex align-items-center justify-content-center gap-2" 
                            style="top: 0; left: 0; opacity: 0; transition: opacity 0.3s ease; background: rgba(0,0,0,0.7);">
                            <router-link :to="`/chi-tiet-phim/${product.id}`" class="btn btn-warning px-4 py-2 fw-bold">
                                <i class="fa-solid fa-ticket me-2"></i>Mua Ngay
                            </router-link>
                            <router-link :to="`/chi-tiet-phim/${product.id}`" class="btn btn-outline-light px-4 py-2 fw-bold">
                                <i class="fa-solid fa-eye me-2"></i>Chi Tiết
                            </router-link>
                        </div>

                        <!-- Badge -->
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-danger rounded-pill px-3 py-2" style="font-size: 0.9rem;">
                                <i class="fa-solid fa-flash me-1"></i>Sale
                            </span>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="card-body d-flex flex-column" style="background: white;">
                        <h6 class="card-title fw-bold text-dark mb-2" style="font-size: 1.1rem; min-height: 2.2rem; line-height: 1.1;">
                            {{ product.ten_phim }}
                        </h6>
                        
                        <p class="card-text text-muted small mb-3" style="flex-grow: 1; max-height: 3rem; overflow: hidden;">
                            {{ product.mo_ta || 'Sản phẩm khô gà chất lượng cao' }}
                        </p>

                        <!-- Price and Rating Row -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <div class="price-section">
                                <span class="badge bg-warning text-dark px-3 py-2 fw-bold" style="font-size: 1.1rem;">
                                    {{ formatPrice(product) }}
                                </span>
                            </div>
                            <div class="rating-section">
                                <span class="text-warning fw-bold" style="font-size: 0.95rem;">
                                    <i class="fa-solid fa-star"></i> {{ product.rate || '36/36' }}
                                </span>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <router-link :to="`/chi-tiet-phim/${product.id}`" class="btn btn-primary mt-3 w-100 fw-bold py-2">
                            <i class="fa-solid fa-shopping-cart me-2"></i>Mua Khô Gà
                        </router-link>
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
            list_phim: [],
            isLoading: false
        }
    },
    mounted() {
        this.getPhim();
    },
    methods: {
        getImageUrl(imagePath) {
            const fallback = 'https://placehold.co/600x400?text=Kho+Ga';

            const base = axios.defaults.baseURL || window.location.origin;

            if (!imagePath) {
                return fallback;
            }

            // If already a full URL, use directly
            if (/^https?:\/\//i.test(imagePath)) {
                return imagePath;
            }

            if (imagePath.startsWith('/')) {
                return `${base}${imagePath}`;
            }

            if (imagePath.startsWith('storage/')) {
                return `${base}/${imagePath}`;
            }

            return `${base}/storage/${imagePath}`;
        },
        handleImgError(event) {
            event.target.src = 'https://placehold.co/600x400?text=Kho+Ga';
        },
        shortDesc(item) {
            // Lấy mô tả từ cột mo_ta
            const text = item?.mo_ta || 'Sản phẩm khô gà chất lượng cao';
            return text.length > 100 ? `${text.substring(0, 100)}...` : text;
        },
        formatPrice(item) {
            // Giá đang lưu ở cột thoi_luong trong bảng phims
            const price = Number(item?.thoi_luong ?? item?.gia_ve ?? item?.suat_chieu?.[0]?.gia_ve ?? 0);
            return `${Math.max(price, 0).toLocaleString('vi-VN')} đ`;
        },
        formatRating(item) {
            // Lấy tinh_trang thay vì danh_gia
            return item?.tinh_trang || 'Sẵn hàng';
        },
        async getPhim() {
            this.isLoading = true;
            const statusOk = (res) => res?.data?.status === true || res?.data?.status === 'success';
            const base = axios.defaults.baseURL || window.location.origin;
            console.log('Backend URL:', base);

            // Attempt 0: API endpoint for kho-ga list (from phims table)
            try {
                const resLoai = await axios.get('/api/client/kho-ga/loai-list', { timeout: 6000 });
                console.log('API Response from kho-ga/loai-list:', resLoai.data);
                if (statusOk(resLoai) && Array.isArray(resLoai.data.data) && resLoai.data.data.length) {
                    this.list_phim = resLoai.data.data.map((item) => ({
                        id: item.id,
                        ten_phim: item.ten_phim,
                        hinh_anh: item.hinh_anh,
                        mo_ta: item.mo_ta,
                        tinh_trang: item.tinh_trang,
                        rate: item.rate,
                        thoi_luong: item.thoi_luong,
                        dien_vien: item.dien_vien,
                    }));
                    this.isLoading = false;
                    console.log('Loaded kho ga list from API:', this.list_phim.length);
                    return;
                }
            } catch (err) {
                console.error('Get kho-ga/loai-list error:', err.message);
            }

            // Attempt 1: API endpoint for phim-dang-chieu
            try {
                const res = await axios.get('/api/client/phim-dang-chieu', { timeout: 6000 });
                console.log('API Response from phim-dang-chieu:', res.data);
                if (statusOk(res) && Array.isArray(res.data.data) && res.data.data.length) {
                    this.list_phim = res.data.data;
                    this.isLoading = false;
                    console.log('Loaded phim from API:', this.list_phim.length);
                    return;
                }
            } catch (err) {
                console.error('Get phim-dang-chieu error:', err.message);
            }

            // Fallback 1: Lấy toàn bộ phim từ bảng phims
            try {
                const resFallback = await axios.get('/api/client/phim/get-data', { timeout: 6000 });
                console.log('API Response from phim/get-data:', resFallback.data);
                if (statusOk(resFallback) && Array.isArray(resFallback.data.data)) {
                    this.list_phim = resFallback.data.data;
                    this.isLoading = false;
                    console.log('Loaded phim from fallback API:', this.list_phim.length);
                    return;
                }
            } catch (err) {
                console.error('Fallback get-data error:', err.message);
            }

            // Fallback 2: Lấy từ static JSON file (mock data)
            try {
                const resStatic = await fetch('/phim-data.json');
                if (resStatic.ok) {
                    const data = await resStatic.json();
                    if (statusOk({ data }) && Array.isArray(data.data)) {
                        this.list_phim = data.data;
                        console.log('Loaded phim from static JSON:', this.list_phim.length);
                    }
                }
            } catch (err) {
                console.error('Static JSON load error:', err.message);
            }

            this.isLoading = false;
        }
    },
};
</script>
<style scoped>
.product-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    background: white;
    border: 1px solid #f0f0f0;
}

.product-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
    border-color: #ffc107;
}

.product-card:hover img {
    transform: scale(1.08);
}

.product-card .btn-overlay {
    opacity: 0;
    transition: opacity 0.3s ease;
    backdrop-filter: blur(4px);
}

.product-card:hover .btn-overlay {
    opacity: 1 !important;
}

.card-body {
    background: linear-gradient(to bottom, #ffffff 0%, #fafafa 100%);
}

.text-gradient {
    display: inline-block;
}

.product-card .card-title {
    color: #2c3e50;
    font-size: 1.1rem;
    word-wrap: break-word;
}

.product-card:hover .card-title {
    color: #ffc107;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container-fluid {
        padding-left: 12px;
        padding-right: 12px;
    }
    
    h1 {
        font-size: 1.8rem !important;
    }
}

/* Product price animation */
.price-section .badge {
    transition: transform 0.3s ease;
}

.product-card:hover .price-section .badge {
    transform: scale(1.1);
}

/* Loading spinner */
.spinner-border {
    width: 3rem;
    height: 3rem;
}

/* Badge styling */
.badge {
    font-weight: 600;
    letter-spacing: 0.5px;
}
</style>