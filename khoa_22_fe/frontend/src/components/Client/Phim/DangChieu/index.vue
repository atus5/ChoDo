<template>
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
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
    <div class="container mt-3">
        <div class="row">
            <div class="text-center mb-3">
                <h4 class="text-uppercase fs-3 text-dark">Khô gà đang bán</h4>
            </div>
            <div class="row g-4">
                <template v-for="(value, index) in list_phim" :key="index">
                    <template v-if="value.tinh_trang == 2">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card rounded h-100 shadow-sm overflow-hidden"
                                style="transition: transform 0.3s ease, box-shadow 0.3s ease;"
                                onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.3)'; this.querySelector('.btn-overlay').style.opacity = '1'"
                                onmouseout="this.style.transform='none'; this.style.boxShadow=this.className.includes('shadow-sm') ? '0 0.125rem 0.25rem rgba(0,0,0,0.075)' : 'none'; this.querySelector('.btn-overlay').style.opacity = '0'">

                                <div class="position-relative" style="height: 400px; overflow: hidden;">
                                    <img :src="value.hinh_anh" class="img-fluid w-100 h-100" alt="" style="object-fit: cover;">
                                    
                                    <div class="btn-overlay text-center position-absolute"
                                        style="top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0; transition: opacity 0.3s ease; padding: 25px 20px; z-index: 10; min-width: 300px; background: rgba(0,0,0,0.8); border-radius: 8px;">
                                        <router-link :to="`/chi-tiet-phim/${value.id}`" style="display: block; margin-bottom: 12px;">
                                            <button class="btn btn-warning p-3 w-100 fw-bold" style="font-size: 18px;"><i
                                                    class="fa-solid fa-ticket"></i> Mua khô gà</button>
                                        </router-link>
                                        <router-link :to="`/chi-tiet-phim/${value.id}`" style="display: block;">
                                            <button class="btn btn-outline-light p-3 w-100 fw-bold" style="font-size: 18px;"><i
                                                    class="fa-solid fa-circle-play"></i> Trailer</button>
                                        </router-link>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h6 class="card-title fw-bold text-warning">{{ value.ten_phim }}</h6>
                                    <p class="card-text text-muted small">{{ value.mo_ta.substring(0, 80) }}...</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-info">{{ value.thoi_luong }}K người đã mua</span>
                                        <span class="text-warning"><i class="fa-solid fa-star"></i> 8.5/10</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </template>
            </div>
        </div>
    </div>

</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            list_phim: []
        }
    },
    mounted() {
        this.getPhim();
    },
    methods: {
        getPhim() {
            axios
                .get('http://127.0.0.1:8000/api/client/phim/get-data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_phim = res.data.data;
                    }
                })
                .catch((err) => {
                    console.error('Get phim error:', err);
                    this.$toast.error('Không thể tải danh sách phim');
                })
        }
    },
};
</script>
<style></style>