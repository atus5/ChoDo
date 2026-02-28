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

        <!-- GỢI Ý KHÔ GÀ HẤP DẪN -->
        <div class="featured-wrap my-5">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-3">
                <div>
                    <h3 class="mb-1 fw-bold">GỢI Ý KHÔ GÀ HẤP DẪN</h3>
                    <p class="text-muted mb-0">Chọn ngay vị khô gà đang được yêu thích nhất hôm nay</p>
                </div>
                <router-link to="/kho-ga/dang-ban" class="mt-3 mt-md-0">
                    <button class="btn btn-danger rounded-pill">Khám phá thêm</button>
                </router-link>
            </div>
            <div class="row g-4">
                <template v-for="(item, index) in featuredList" :key="index">
                    <div class="col-xl-4 col-md-6">
                        <div class="card featured-card h-100 border-0 shadow-sm">
                            <div class="featured-thumb">
                                <img :src="getImageUrl(item.hinh_anh)" @error="handleImgError" loading="lazy" alt="" />
                                <span class="badge bg-danger featured-badge">Bán chạy</span>
                                <div class="featured-rating">
                                    <i class="fa-solid fa-star"></i>
                                    <span>{{ formatRating(item) }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-dark mb-2">{{ item.ten_phim }}</h5>
                                <p class="text-muted small mb-3">{{ item.the_loai || 'Khô gà đặc biệt' }}</p>
                                <div class="d-flex align-items-center">
                                    <div class="fw-bold text-danger fs-5">{{ formatVND(item.thoi_luong) }}</div>
                                    <router-link :to="`/chi-tiet-kho-ga/${item.id}`" class="ms-auto">
                                        <button class="btn btn-outline-danger btn-sm">Mua ngay</button>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Khô gà bán chạy -->
        <h3 class="text-center">KHÔ GÀ HOT CHỘ ĐÓ</h3>
        <div class="row mt-4">
            <template v-for="(value, index) in dangBanList" :key="index">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card position-relative shadow-sm">
                        <img :src="getImageUrl(value.hinh_anh)" @error="handleImgError" loading="lazy" class="card-img-top" alt=""
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
                                    {{ formatRating(value) }}
                                </span>
                                <span class="ms-auto fw-bold">
                                    <router-link :to="`/chi-tiet-kho-ga/${value.id}`">
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
            <router-link to="/kho-ga/dang-ban">
                <button class="btn btn-outline-danger rounded-pill">Xem tất cả các loại khô gà</button>
            </router-link>
        </div>

            <!-- DANH SÁCH LOẠI KHÔ GÀ TỪ BẢNG PHIM -->
            <div class="mt-5">
                <h3 class="text-center mb-4">DANH SÁCH LOẠI KHÔ GÀ</h3>
                <div v-if="!loai_kho_ga.length" class="text-center text-muted">Chưa có dữ liệu loại khô gà.</div>
                <div v-else class="row">
                    <div v-for="(item, index) in loai_kho_ga" :key="index" class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img :src="getImageUrl(item.hinh_anh)" @error="handleImgError" loading="lazy" class="card-img-top" style="height: 220px; object-fit: cover;">
                            <div class="card-body">
                                <h6 class="fw-bold text-danger mb-2">{{ item.ten_phim }}</h6>
                                <p class="text-muted small mb-2">Thành phần: {{ item.dien_vien }}</p>
                                <span class="badge bg-warning text-dark">{{ formatVND(item.thoi_luong) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
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
            <template v-for="(value, index) in sapBanList" :key="index">
                <div class="col-md-3 mb-4 d-flex">
                    <div class="card flex-full w-100" style="background-color: #FFF2F2;">
                        <img :src="getImageUrl(value.hinh_anh)" @error="handleImgError" loading="lazy" class="card-img-top" style="height: 350px; object-fit: cover;">
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
            <router-link to="/kho-ga/sap-ban">
                <button class="btn btn-outline-danger rounded-pill ">Xem tất cả các loại khô gà</button>
            </router-link>
        </div>

        <!-- DANH SÁCH KHÔGÀ PHỤ VỤ QUÁN ĂN -->
        <div style="background-color: #FFF2F2; padding: 40px 20px; margin: 40px 0; border-radius: 10px;">
            <h3 class="text-center mb-4">KHÔ GÀ PHỤC VỤ QUÁN ĂN, NHÀ HÀNG</h3>
            <div class="row">
                <template v-for="(value, index) in list_phim.slice(4, 8)" :key="index">
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card position-relative shadow-sm h-100">
                            <img :src="getImageUrl(value.hinh_anh)" @error="handleImgError" loading="lazy" class="card-img-top" alt=""
                                style="height: 350px; object-fit: cover;">
                            <div class="card-body">
                                <h6 class="card-title text-danger fw-bold">{{ value.ten_phim }}</h6>
                                <p class="text-muted small mb-2">Thành phần: {{ value.dien_vien }}</p>
                                <p class="text-muted small">{{ value.the_loai }}</p>
                                <div class="d-flex gap-2 mt-3">
                                    <router-link :to="`/chi-tiet-kho-ga/${value.id}`" class="flex-grow-1">
                                        <button class="btn btn-danger btn-sm w-100">Xem chi tiết</button>
                                    </router-link>
                                    <button class="btn btn-outline-danger btn-sm">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            <div class="text-center">
                <router-link to="/kho-ga/dang-ban">
                    <button class="btn btn-danger rounded-pill">Xem tất cả để cung cấp cho quán</button>
                </router-link>
            </div>
        </div>

        <!-- TIN TỨC VÀ HƯỚNG DẪN -->
        <h3 class="text-center mb-4 mt-5">TIN TỨC VÀ HƯỚNG DẪN</h3>
        <p class="text-center text-muted mb-4">Cập nhật những bài viết hay về cách chọn, bảo quản và nấu khô gà</p>
        <div class="row">
            <template v-for="(value, index) in getArticles()" :key="index">
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden article-card">
                        <div class="position-relative" style="height: 250px; overflow: hidden;">
                            <img :src="getImageUrl(value.hinh_anh)" @error="handleImgError" loading="lazy" class="card-img-top" style="height: 100%; object-fit: cover;">
                            <div class="position-absolute top-0 start-0 badge bg-danger" style="margin: 10px;">
                                <i class="fa fa-calendar-days me-1"></i>{{ formatDate(value.ngay_dang) }}
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <router-link :to="`/chi-tiet-bai-viet/${value.id}`">
                                <h5 class="card-title fw-bold text-dark article-title">{{ value.tieu_de }}</h5>
                            </router-link>
                            <p class="card-text text-muted flex-grow-1">{{ value.mo_ta_ngan || value.mo_ta }}</p>
                            <router-link :to="`/chi-tiet-bai-viet/${value.id}`" class="btn btn-outline-danger btn-sm">
                                Đọc thêm <i class="fa fa-arrow-right ms-1"></i>
                            </router-link>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div class="text-center mb-5">
            <router-link to="/bai-viet">
                <button class="btn btn-outline-danger rounded-pill">Xem tất cả bài viết</button>
            </router-link>
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
                loai_kho_ga: [],
            isLoading: false,
            defaultArticles: [
                {
                    id: 1,
                    tieu_de: "5 Cách Nấu Khô Gà Ngon Đạt Đỉnh Mà Bạn Phải Thử",
                    mo_ta_ngan: "Khô gà không chỉ ăn sống mà còn có thể nấu thành nhiều món ăn ngon khác nhau. Hôm nay chúng tôi sẽ chia sẻ 5 cách nấu khô gà đơn giản nhưng cực ngon.",
                    mo_ta: "Khô gà không chỉ ăn sống mà còn có thể nấu thành nhiều món ăn ngon khác nhau. Từ canh, xào đến nước lẩu, khô gà lúc nào cũng là nguyên liệu tuyệt vời.",
                    hinh_anh: "https://voz.vn/attachments/untitled-1-jpg.502903/",
                    ngay_dang: new Date(2024, 0, 15)
                },
                {
                    id: 2,
                    tieu_de: "Bí Kíp Chọn Khô Gà Chất Lượng Cao Tại Chộ Đó",
                    mo_ta_ngan: "Làm sao để chọn được khô gà tươi, ngon và chất lượng cao? Hãy cùng chúng tôi khám phá những tiêu chí quan trọng khi lựa chọn khô gà.",
                    mo_ta: "Khô gà là một sản phẩm có giá trị dinh dưỡng cao và rất được yêu thích. Nhưng không phải lúc nào chúng ta cũng biết cách chọn khô gà tốt nhất.",
                    hinh_anh: "https://voz.vn/attachments/untitled-2-jpg.502905/",
                    ngay_dang: new Date(2024, 0, 12)
                },
                {
                    id: 3,
                    tieu_de: "Khô Gà Chộ Đó - Hành Trình Từ Yên Lãng Đến Bàn Ăn Của Bạn",
                    mo_ta_ngan: "Từ những gà ta tự nhiên tại Yên Lãng, qua quá trình chế biến tỉ mỉ đến khi được gửi đến tay bạn, mỗi sản phẩm khô gà Chộ Đó là một câu chuyện.",
                    mo_ta: "Khô gà Chộ Đó không phải chỉ là một sản phẩm ăn vặt, mà là kết quả của sự tâm huyết và chất lượng trong từng bước chế biến.",
                    hinh_anh: "https://voz.vn/attachments/untitled-3-jpg.502904/",
                    ngay_dang: new Date(2024, 0, 10)
                },
                {
                    id: 4,
                    tieu_de: "Cách Bảo Quản Khô Gà Để Giữ Được Độ Tươi Ngon Lâu Nhất",
                    mo_ta_ngan: "Bảo quản khô gà đúng cách là chìa khóa để duy trì hương vị và chất lượng của sản phẩm trong thời gian dài.",
                    mo_ta: "Ngoài chất lượng khô gà, cách bảo quản cũng ảnh hưởng rất lớn đến hương vị cuối cùng của sản phẩm.",
                    hinh_anh: "https://voz.vn/attachments/untitled-1-jpg.502903/",
                    ngay_dang: new Date(2024, 0, 8)
                },
                {
                    id: 5,
                    tieu_de: "Khô Gà và Sức Khỏe - Những Tác Dụng Tuyệt Vời Bạn Chưa Biết",
                    mo_ta_ngan: "Khô gà không chỉ ngon mà còn rất tốt cho sức khỏe. Hãy cùng khám phá những tác dụng tuyệt vời của khô gà đối với cơ thể chúng ta.",
                    mo_ta: "Với lượng protein cao và chất dinh dưỡng phong phú, khô gà là lựa chọn tuyệt vời cho những ai quan tâm đến sức khỏe.",
                    hinh_anh: "https://voz.vn/attachments/untitled-2-jpg.502905/",
                    ngay_dang: new Date(2024, 0, 5)
                },
                {
                    id: 6,
                    tieu_de: "Combo Gia Vị Cực Hot - Kết Hợp Hoàn Hảo Cho Khô Gà",
                    mo_ta_ngan: "Khô gà Chộ Đó tung ra bộ sưu tập combo gia vị mới, đem đến những trải nghiệm hương vị mới lạ và kích thích vị giác.",
                    mo_ta: "Mỗi combo gia vị đều được chọn lọc kỹ lưỡng để kết hợp hoàn hảo với khô gà, tạo nên những món ăn độc đáo và hấp dẫn.",
                    hinh_anh: "https://voz.vn/attachments/untitled-3-jpg.502904/",
                    ngay_dang: new Date(2024, 0, 1)
                }
            ]
        }
    },
    mounted() {
        this.loadData();
    },
    computed: {
        dangBanList() {
            return this.filterByStatus(this.list_phim, 2).slice(0, 4);
        },
        featuredList() {
            return this.filterByStatus(this.list_phim, 2).slice(0, 3);
        },
        sapBanList() {
            return this.filterByStatus(this.list_phim, 1).slice(0, 4);
        }
    },
    methods: {
        getImageUrl(imagePath) {
            const fallback = 'https://placehold.co/800x500?text=Kho+Ga';

            if (!imagePath) return fallback;

            if (/^https?:\/\//i.test(imagePath)) return imagePath;

            if (imagePath.startsWith('/')) return `${axios.defaults.baseURL}${imagePath}`;

            if (imagePath.startsWith('storage/')) return `${axios.defaults.baseURL}/${imagePath}`;

            return `${axios.defaults.baseURL}/storage/${imagePath}`;
        },
        handleImgError(event) {
            event.target.src = 'https://placehold.co/800x500?text=Kho+Ga';
        },
        formatRating(item) {
            const raw = item?.tinh_trang ?? item?.danh_gia;
            const num = Number(raw);
            if (Number.isFinite(num)) {
                const rating = Math.min(Math.max(num, 0), 10);
                return Number.isInteger(rating) ? rating.toString() : rating.toFixed(1);
            }
            if (typeof raw === 'string' && raw.trim()) return raw.trim();
            return '0';
        },
        formatVND(amount) {
            const value = Number(amount);
            if (!Number.isFinite(value)) return '0 ₫';
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(value);
        },
        filterByStatus(list, status) {
            const arr = Array.isArray(list) ? list : [];
            const filtered = arr.filter((item) => Number(item?.tinh_trang) === status);
            return filtered.length ? filtered : arr;
        },
        getArticles() {
            // Nếu có dữ liệu từ server, sử dụng. Nếu không, dùng dữ liệu mặc định
            return this.list_bv && this.list_bv.length > 0 
                ? this.list_bv.slice(0, 6)
                : this.defaultArticles;
        },
        formatDate(date) {
            if (!date) return '';
            const d = new Date(date);
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            return `${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
        },
        loadData() {
            this.isLoading = true;

            const frontendBase = window.location.origin;
            const requests = [
                axios.get('/api/client/phim/get-data', { timeout: 6000 }),
                axios.get('/api/client/chi-tiet-kho-ga/get-data', { timeout: 6000 }),
                axios.get('/api/client/home-page', { timeout: 6000 }),
                    axios.get('/api/client/kho-ga/loai-list', { timeout: 6000 }),
                axios.get('/kho-ga-data.json', { baseURL: frontendBase, timeout: 3000 })
            ];

            Promise.allSettled(requests)
                .then((results) => {
                    const [phimRes, khoGaRes, homeRes, loaiRes, jsonRes] = results;
                    const statusOk = (res) => res?.value?.data?.status === true || res?.value?.data?.status === 'success';

                    if (phimRes.status === 'fulfilled' && statusOk(phimRes.value) && Array.isArray(phimRes.value.data.data)) {
                        this.list_phim = phimRes.value.data.data.map((item) => ({
                            id: item.id,
                            ten_phim: item.ten_phim,
                            hinh_anh: item.hinh_anh,
                            mo_ta: item.mo_ta,
                            tinh_trang: item.tinh_trang,
                            the_loai: item.ten_the_loai || item.the_loai,
                            thoi_luong: item.thoi_luong,
                            dien_vien: item.dien_vien,
                        }));
                    }

                    // Fallback sang chi-tiet-kho-ga nếu danh sách trống
                    if (!this.list_phim.length && khoGaRes.status === 'fulfilled' && statusOk(khoGaRes.value)) {
                        this.list_phim = khoGaRes.value.data.data.map(item => ({
                            id: item.id,
                            ten_phim: item.ten_kho_ga,
                            hinh_anh: item.hinh_anh,
                            mo_ta: item.mo_ta,
                            tinh_trang: item.tinh_trang,
                            the_loai: item.loai_vi
                        }));
                    }

                    const jsonItems = Array.isArray(jsonRes.value?.data)
                        ? jsonRes.value.data
                        : Array.isArray(jsonRes.value?.data?.data)
                            ? jsonRes.value.data.data
                            : [];

                    if (!this.list_phim.length && jsonRes.status === 'fulfilled' && jsonItems.length) {
                        this.list_phim = jsonItems.map((item) => ({
                            id: item.id,
                            ten_phim: item.ten_phim,
                            hinh_anh: item.hinh_anh,
                            mo_ta: item.mo_ta,
                            tinh_trang: item.tinh_trang,
                            the_loai: item.ten_the_loai || item.the_loai,
                            thoi_luong: item.thoi_luong,
                            dien_vien: item.dien_vien,
                        }));
                    }

                    if (homeRes.status === 'fulfilled' && homeRes.value?.data?.data_bv) {
                        this.list_bv = homeRes.value.data.data_bv;
                    }

                        if (loaiRes.status === 'fulfilled' && statusOk(loaiRes) && Array.isArray(loaiRes.value.data.data)) {
                            this.loai_kho_ga = loaiRes.value.data.data.map((item) => ({
                                id: item.id,
                                ten_phim: item.ten_phim,
                                hinh_anh: item.hinh_anh,
                                mo_ta: item.mo_ta,
                                tinh_trang: item.tinh_trang,
                                thoi_luong: item.thoi_luong,
                                dien_vien: item.dien_vien,
                            }));
                        }

                    // Nếu vẫn không có dữ liệu từ server, để trống và báo lỗi
                    if (!this.list_phim.length) {
                        this.list_phim = [];
                    }

                        if (!this.loai_kho_ga.length) {
                            this.loai_kho_ga = [];
                        }

                    if (!this.list_bv.length) {
                        this.list_bv = [];
                    }
                })
                .catch((err) => {
                    console.error('Load home page error:', err);
                    this.$toast?.error?.('Không thể tải dữ liệu trang chủ');
                })
                .finally(() => {
                    this.isLoading = false;
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

.article-card {
    transition: all 0.3s ease;
}

.article-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
}

.article-title {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color 0.3s ease;
}

.article-card:hover .article-title {
    color: #dc3545;
}

.article-card a {
    text-decoration: none;
}

.featured-wrap {
    background: linear-gradient(135deg, #fff7f7, #ffffff);
    border-radius: 20px;
    padding: 28px;
}

.featured-card {
    border-radius: 16px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.featured-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12) !important;
}

.featured-thumb {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.featured-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.featured-card:hover .featured-thumb img {
    transform: scale(1.05);
}

.featured-badge {
    position: absolute;
    top: 14px;
    left: 14px;
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 0.75rem;
    letter-spacing: 0.4px;
}

.featured-rating {
    position: absolute;
    bottom: 12px;
    right: 12px;
    background: rgba(0, 0, 0, 0.65);
    color: #fff;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 6px;
}
</style>