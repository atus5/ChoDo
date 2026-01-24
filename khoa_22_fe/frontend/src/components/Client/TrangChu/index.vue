<template>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://voz.vn/attachments/untitled-1-jpg.502903/"
                    class="d-block w-100" alt="Banner 1">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://voz.vn/attachments/untitled-3-jpg.502904/"
                    class="d-block w-100" alt="Banner 2">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://voz.vn/attachments/untitled-2-jpg.502905/"
                    class="d-block w-100" alt="Banner 3">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container my-4">
        <!-- Dịch vụ Khô gà Chộ Đó -->
        <div class="card p-4">
            <h3 class="text-center mb-4">DỊCH VỤ TẠI KHÔ GÀ CHỘ ĐÓ</h3>
            <div class="row text-center">
                <div class="col-md-3 mb-3">
                    <i class="fa fa-drumstick-bite fa-3x text-danger mb-2"></i>
                    <p>
                        <strong>Khô gà loại 1</strong><br />
                        <span class="text-muted">Gà ta nướng thơm lừng, cay độc quyền. Ăn một cái là 'đổi màu mặt' nhưng vẫn cứ ăn tiếp! 🔥</span>
                    </p>
                </div>
                <div class="col-md-3 mb-3">
                    <i class="fa fa-leaf fa-3x text-success mb-2"></i>
                    <p>
                        <strong>Bã mía</strong><br />
                        <span class="text-muted">Bã mía khô từ 120 Yên Lãng, dẻo dai, vị ngọt tự nhiên. Ăn kèm khô gà là 'nặng lỳ' từng bữa! 🎋</span>
                    </p>
                </div>
                <div class="col-md-3 mb-3">
                    <i class="fa fa-fire fa-3x text-warning  mb-2"></i>
                    <p>
                        <strong>Khô gà loại 2</strong><br />
                        <span class="text-muted">Khô gà loại 2 làm từ bã mía đè team siêu dai siêu ngon 💦</span>
                    </p>
                </div>
                <div class="col-md-3 mb-3">
                    <i class="fa fa-rocket fa-3x text-primary mb-2"></i>
                    <p>
                        <strong>Giao hàng như bay</strong><br />
                        <span class="text-muted">30 phút hay miễn phí! Con chó cao bằng bộ pc chạy nhanh hơn gà bị đuổi. Khô gà vẫn nóng hơi khi tới tay bạn! 🚀</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Khô gà bán chạy -->
        <h3 class="text-center">KHÔ GÀ HOT CHỘ ĐÓ</h3>
        <div class="row mt-4">
            <template v-for="(value, index) in list_phim.filter(x => x.tinh_trang === 2).slice(0, 4)" :key="index">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card position-relative shadow-sm">
                        <img :src="value.hinh_anh" class="card-img-top" alt=""
                            style="height: 400px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title text-warning fw-bold">{{ value.ten_phim }}</h6>
                            <p class="text-muted mb-1">{{ value.the_loai }}</p>
                            <div class="d-flex align-items-center mb-2">
                                <span class="text-warning me-1">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                    9.5
                                </span>
                                <span class="ms-auto fw-bold">
                                    <router-link :to="`/chi-tiet-phim/${value.id}`">
                                        <a href="#" class="btn btn-outline-danger w-100">Mua khô gà</a>
                                    </router-link>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </template>
        </div>

        <div class="text-center mb-4">
            <router-link to="/phim/dang-chieu">
                <button class="btn btn-outline-danger rounded-pill">Xem tất cả các loại khô gà</button>
            </router-link>
        </div>

        <!-- Về chúng tôi -->
        <div class="card p-5 border-0 shadow-sm rounded-4" style="background-color: #000957;">
            <h3 class="text-center text-uppercase fw-bold mb-5 text-light">Về chúng tôi</h3>
            <div class="row align-items-center">
                <!-- Nội dung bên trái -->
                <div class="col-md-7">
                    <h4 class="fw-bold mb-3">
                        <span class="text-danger">Mua khô gà thơm lũng </span>
                        <span class="text-primary">Online </span>
                        <span class=" text-light">trên Khô gà Chộ Đó</span>
                    </h4>
                    <p class="text-light fs-5 mb-4">
                        Trải nghiệm mua khô gà trực tuyến dễ dàng, nhiều ưu đãi hấp dẫn và kết nối với các cụm bán khô gà lớn trên
                        toàn quốc.
                    </p>
                    <ul class="list-unstyled fs-5">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fa fa-check-circle text-success me-2 mt-1"></i>
                            <span class="text-light">Mua khô gà Online, trải nghiệm khô gà ngon</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fa fa-check-circle text-success me-2 mt-1"></i>
                            <span class="text-light">Đặt khô gà an toàn, tiện lợi trong vài bước</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fa fa-check-circle text-success me-2 mt-1"></i>
                            <span class="text-light">Tự do chọn loại khô gà, combo gia vị siêu hot</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fa fa-check-circle text-success me-2 mt-1"></i>
                            <span class="text-light">Lưu lịch sử đặt hàng, quản lý đơn hàng dễ dàng</span>
                        </li>
                    </ul>
                </div>

                <!-- Ảnh bên phải -->
                <div class="col-md-5 text-center">
                    <img src="https://media.baamboozle.com/uploads/images/55836/1682378705_349492_import-url.png"
                        alt="Mua khô gà online" class="img-fluid rounded-3 shadow-sm">
                </div>
            </div>
        </div>


        <!-- KHÔ GÀ SẮP BÁN -->
        <h3 class="text-center mb-4">KHÔ GÀ SẮP BÁN</h3>
        <div class="row">
            <template v-for="(value, index) in list_phim.filter(x => x.tinh_trang === 1).slice(0, 4)" :key="index">
                <div class="col-md-3 mb-4 d-flex">
                    <div class="card flex-full w-100" style="background-color: #FFF2F2;">
                        <img :src="value.hinh_anh" class="card-img-top" style="height: 350px;">
                        <div class="card-body">
                            <span class="badge bg-danger mb-2">{{ 100000 + index * 2000 }} người đã mua</span>
                            <h5 class="card-title text-truncate text-warning">{{ value.ten_phim }}</h5>
                            <p class="card-text">{{ value.the_loai }}</p>
                            <button class="btn btn-outline-danger btn-sm mt-2">Nhắc tôi</button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div class="text-center">
            <router-link to="/phim/sap-chieu">
                <button class="btn btn-outline-danger rounded-pill ">Xem tất cả các loại khô gà</button>
            </router-link>
        </div>

        <!-- BÀI VIẾT -->
        <h3 class="text-center mb-4 mt-4">BÀI VIẾT</h3>
        <div class="row">
            <template v-for="(value, index) in list_bv.slice(0, 6)" :key="index">
                <div class="col-lg-4 mb-4 ">
                    <router-link :to="`/chi-tiet-bai-viet/${value.id}`">
                        <div class="card h-100">
                            <img :src="value.hinh_anh" class="card-img-top" style="height: 250px;">
                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{ value.tieu_de }}
                                </h5>
                                <p class="card-text text-dark">{{ value.mo_ta_ngan }}</p>
                            </div>
                        </div>
                    </router-link>
                </div>
            </template>
        </div>
        <h3 class="text-center mb-4 fw-bold ">Khách Hàng Nói Gì Về Khô gà Chộ Đó?</h3>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm " style="background-color: #000957;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <img src="https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/" alt="avatar"
                                class="rounded-circle me-3" width="48" height="48">
                            <div>
                                <div class="fw-bold text-light">La Quý Xưa</div>
                                <div class="text-muted text-light" style="font-size: 0.95em;">CEO Khô gà Chộ Đó</div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                        </div>
                        <div class="fst-italic text-light" style="font-size: 1em;">
                            "Tôi ăn hết một gói khô gà trong 10 phút, rồi nằm lăn ra vì cay! Vị cay từ địa ngục nhưng ngon vô cùng. Chắc chắn mua tiếp 😭🔥"
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm " style="background-color: #000957;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <img src="https://voz.vn/attachments/images-12-jpeg.3334479/" alt="avatar"
                                class="rounded-circle me-3" width="48" height="48">
                            <div>
                                <div class="fw-bold text-light">Phạm Chí Xưa</div>
                                <div class="text-muted text-light" style="font-size: 0.95em;">Giám đốc Khô gà Chộ Đó</div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                        </div>
                        <div class="fst-italic text-light" style="font-size: 1em;">
                            "Giao hàng 30 phút mà tôi chỉ đợi 15 phút! Khô gà vẫn ấm, vẫn giòn. Anh/chị shipper chạy nhanh hơn gà sợ kêu! Cho 5 sao 💨"
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm " style="background-color: #000957;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <img src="https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/" alt="avatar"
                                class="rounded-circle me-3" width="48" height="48">
                            <div>
                                <div class="fw-bold text-light">Trần Cảnh Xưa</div>
                                <div class="text-muted text-light" style="font-size: 0.95em;">Chủ cửa hàng Khô gà Chộ Đó</div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                        </div>
                        <div class="fst-italic text-light" style="font-size: 1em;">
                            "Combo gia vị giá hợp lý, khô gà mới cập nhật liên tục, hệ thống lựa chọn khô gà đa dạng – Khô gà Chộ Đó
                            là lựa 'Sát Tử' chỉ cần ăn một lần là nghiện! Lần tới mua combo khác kẻo cay hết tất cả chân tay 😂. Website dễ dùng lắm!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            list_phim: [],
            list_bv: [],
        }
    },
    mounted() {
        this.loadData();
    },
    methods: {
        loadData() {
            axios
                .get('http://127.0.0.1:8000/api/client/home-page')
                .then((res) => {
                    this.list_phim = res.data.data_phim;
                    this.list_bv = res.data.data_bv;
                })
                .catch((err) => {
                    console.error('Load home page error:', err);
                    this.$toast.error('Không thể tải dữ liệu trang chủ');
                })
        }
    }
}
</script>

<style scoped>
.carousel-item {
    height: 400px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f0f0f0;
}

.carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.carousel {
    position: relative;
}

.carousel-inner {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.carousel-item {
    display: none;
    float: left;
    width: 100%;
    margin-right: -100%;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    transition: transform 0.6s ease-in-out;
}

.carousel-item.active {
    display: block;
}

.carousel-item-next,
.carousel-item-prev {
    display: block;
}

.carousel-item-next {
    transform: translateX(100%);
}

.carousel-item-prev {
    transform: translateX(-100%);
}

.carousel-item-next.carousel-item-start,
.carousel-item-prev.carousel-item-end {
    transform: translateX(0);
}

.carousel-item-start {
    transform: translateX(-100%);
}

.carousel-item-end {
    transform: translateX(100%);
}
</style>