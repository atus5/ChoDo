<template>
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="false">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/" class="d-block w-100"
                    style="width: 100%; height: 400px; object-fit: cover;">
            </div>
            <div class="carousel-item ">
                <img src="https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/" class="d-block w-100"
                    style="width: 100%; height: 400px; object-fit: cover;">
            </div>
            <div class="carousel-item ">
                <img src="https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/"
                    class="d-block w-100 img-fluid" style="width: 100%; height: 400px; object-fit: cover;">
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
    <div class="container-fluid px-4 mt-3">
        <div class="row mb-4">
            <div class="col-12">
                <div class="text-center">
                    <h1 class="text-uppercase fw-bold text-gradient mb-2" style="font-size: 2.5rem; background: linear-gradient(45deg, #34d399, #22d3ee); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        🐔 Khô Gà Sắp Bán
                    </h1>
                    <p class="text-muted fs-5">Những sản phẩm khô gà chuẩn bị ra mắt, đặt trước để nhận ưu đãi</p>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div v-if="isLoading" class="text-center py-5">
            <div class="spinner-border text-info mb-3" role="status">
                <span class="visually-hidden">Đang tải...</span>
            </div>
            <p class="text-muted fs-5">Đang tải dữ liệu khô gà sắp bán...</p>
        </div>

        <!-- Empty State -->
        <div v-else-if="!list_phim.length" class="text-center py-5">
            <div class="alert alert-info rounded-3" role="alert">
                <i class="fa-solid fa-inbox fs-1 mb-3"></i>
                <p class="text-muted fs-5 mt-3">Chưa có dữ liệu khô gà sắp bán từ hệ thống.</p>
            </div>
        </div>

        <!-- Products Grid -->
        <div v-else class="row g-4 mb-5">
            <div v-for="(product, index) in list_phim" :key="index" class="col-lg-4 col-md-6 col-sm-12">
                <div class="card rounded-3 h-100 shadow-sm overflow-hidden product-card border-0" style="transition: all 0.3s ease;">
                    <!-- Product Image -->
                    <div class="position-relative" style="height: 300px; overflow: hidden; background: linear-gradient(135deg, #f5f5f5 0%, #e0f2fe 100%);">
                        <img :src="getImageUrl(product.hinh_anh)" @error="handleImgError" loading="lazy" class="img-fluid w-100 h-100" 
                            :alt="product.ten_phim" style="object-fit: cover; transition: transform 0.3s ease;">
                        
                        <!-- Action Buttons Overlay -->
                        <div class="btn-overlay position-absolute w-100 h-100 d-flex align-items-center justify-content-center gap-2" 
                            style="top: 0; left: 0; opacity: 0; transition: opacity 0.3s ease; background: rgba(0,0,0,0.7);">
                            <router-link :to="`/dat-truoc-kho-ga/${product.id}`" class="btn btn-warning px-4 py-2 fw-bold">
                                <i class="fa-solid fa-ticket me-2"></i>Đặt trước
                            </router-link>
                            <router-link :to="`/chi-tiet-phim/${product.id}`" class="btn btn-outline-light px-4 py-2 fw-bold">
                                <i class="fa-solid fa-eye me-2"></i>Chi Tiết
                            </router-link>
                        </div>

                        <!-- Badge -->
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-info rounded-pill px-3 py-2" style="font-size: 0.9rem;">
                                <i class="fa-solid fa-clock me-1"></i>Sắp bán
                            </span>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="card-body d-flex flex-column" style="background: white;">
                        <h6 class="card-title fw-bold text-dark mb-2" style="font-size: 1.1rem; min-height: 2.2rem; line-height: 1.1;">
                            {{ product.ten_phim }}
                        </h6>
                        
                        <p class="card-text text-muted small mb-3" style="flex-grow: 1; max-height: 3rem; overflow: hidden;">
                            {{ product.mo_ta || 'Sản phẩm khô gà chuẩn bị ra mắt' }}
                        </p>

                        <!-- Price and Rating Row -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <div class="price-section">
                                <span class="badge bg-warning text-dark px-3 py-2 fw-bold" style="font-size: 1.1rem;">
                                    {{ formatPrice(product) }}
                                </span>
                            </div>
                            <div class="rating-section">
                                <span class="text-info fw-bold" style="font-size: 0.95rem;">
                                    <i class="fa-solid fa-star"></i> {{ product.tinh_trang || 'Sắp ra mắt' }}
                                </span>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <router-link :to="`/dat-truoc-kho-ga/${product.id}`" class="btn btn-primary mt-3 w-100 fw-bold py-2">
                            <i class="fa-solid fa-shopping-cart me-2"></i>Đặt trước khô gà
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
            isLoading: false,
            fallbackList: [
                {
                    id: 101,
                    ten_phim: 'Khô gà sắp bán - vị chanh sả',
                    mo_ta: 'Chanh sả thanh mát, thơm dịu, sắp ra mắt.',
                    hinh_anh: 'https://images.unsplash.com/photo-1555939594-58d7cb561af1?w=1200&h=800&fit=crop',
                    thoi_luong: 39000,
                    tinh_trang: 'Sắp bán'
                },
                {
                    id: 102,
                    ten_phim: 'Khô gà sắp bán - vị bơ tỏi',
                    mo_ta: 'Bơ tỏi béo thơm, hậu vị đậm.',
                    hinh_anh: 'https://images.unsplash.com/photo-1585521537411-16b2d6ea1cc5?w=1200&h=800&fit=crop',
                    thoi_luong: 42000,
                    tinh_trang: 'Sắp bán'
                },
                {
                    id: 103,
                    ten_phim: 'Khô gà sắp bán - vị cay Hàn',
                    mo_ta: 'Cay Hàn tê tê, thơm nồng.',
                    hinh_anh: 'https://images.unsplash.com/photo-1626082927389-6cd097cdc46e?w=1200&h=800&fit=crop',
                    thoi_luong: 45000,
                    tinh_trang: 'Sắp bán'
                }
            ]
        }
    },
    mounted() {
        this.getPhim();
    },
    methods: {
        getImageUrl(imagePath) {
            const fallback = 'https://placehold.co/600x400?text=Kho+Ga';

            const base = axios.defaults.baseURL || 'http://127.0.0.1:8000';

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
            const text = item?.mo_ta || item?.noi_dung || 'Khô gà Chộ Đó thơm ngon, chuẩn vị.';
            return text.length > 80 ? `${text.substring(0, 80)}...` : text;
        },
        formatPrice(item) {
            const price = Number(item?.thoi_luong ?? item?.gia ?? item?.gia_ve ?? item?.suat_chieu?.[0]?.gia_ve ?? 0);
            return `${Math.max(price, 0).toLocaleString('vi-VN')} đ`;
        },
        async getPhim() {
            this.isLoading = true;
            const statusOk = (res) => res?.data?.status === true || res?.data?.status === 'success';
            // Ưu tiên JSON đã đồng bộ để hiển thị nhanh
            try {
                const resStatic = await fetch('/kho-ga-sap-ban.json');
                if (resStatic.ok) {
                    const data = await resStatic.json();
                    if (statusOk({ data }) && Array.isArray(data.data)) {
                        this.list_phim = data.data.map((item) => ({
                            ...item,
                            ten_phim: item.ten_kho_ga || item.ten_phim,
                            thoi_luong: item.gia ?? item.thoi_luong,
                            tinh_trang: item.tinh_trang ?? 'Sắp bán',
                        }));
                    }
                }
            } catch (err) {
                console.error('Load kho-ga-sap-ban JSON error:', err);
            }

            // Nếu JSON trống thì thử API
            if (!this.list_phim.length) {
                try {
                    const res = await axios.get('/api/client/kho-ga-sap-ban/get-data', { timeout: 3000 });
                    if (statusOk(res) && Array.isArray(res.data.data)) {
                        this.list_phim = res.data.data.map((item) => ({
                            ...item,
                            ten_phim: item.ten_phim || item.ten_kho_ga,
                            thoi_luong: item.thoi_luong ?? item.gia,
                        }));
                    }
                } catch (err) {
                    console.error('Get kho-ga-sap-ban error:', err);
                }
            }

            // Fallback: thử endpoint home-page nếu vẫn trống
            if (!this.list_phim.length) {
                try {
                    const resFallback = await axios.get('/api/client/home-page', { timeout: 3000 });
                    if (statusOk(resFallback)) {
                        const sapChieu = resFallback.data?.phim_sap_chieu || [];
                        this.list_phim = Array.isArray(sapChieu)
                            ? sapChieu.map((item) => ({
                                ...item,
                                ten_phim: item.ten_phim || item.ten_kho_ga,
                                thoi_luong: item.thoi_luong ?? item.gia,
                            }))
                            : [];
                    }
                } catch (err) {
                    console.error('Fallback home-page error:', err);
                }
            }

            if (!this.list_phim.length) {
                this.list_phim = this.fallbackList;
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
    border-color: #22d3ee;
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
    background: linear-gradient(to bottom, #ffffff 0%, #f8fafc 100%);
}

.text-gradient {
    display: inline-block;
}
</style>