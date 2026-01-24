<template>
    <!-- Hero Banner -->
    <div class="position-relative"
        style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.8)), url('https://voz.vn/attachments/img_7962-jpeg.3230521/'); background-size: cover; background-position: center; height: 500px;">
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 text-white">
                        <h2 class="display-4 fw-bold text-light">Chào mừng đến với Khô gà Chộ Đó</h2>
                        <p class="lead">Nơi những bữa ăn trở nên thú vị với bã mía tươi ngon, gia vị hài hoà và
                            hương vị tuyệt vời</p>
                        <button class="btn btn-danger btn-lg">Khám phá ngay</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div id="about" class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="fw-bold">Về Khô gà Chộ Đó</h2>
                    <div class="d-inline-block bg-danger" style="width: 60px; height: 3px; margin-bottom: 30px;"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>🐔 Khô gà Chộ Đó là chuỗi bán khô gà uy tín được thành lập vào năm 2020, mang đến trải nghiệm ẩm thực
                        đẳng cấp quốc tế với công thức nướng khô gà bí truyền từ con chó cao bằng bộ pc!</p>
                    <p>Với sứ mệnh "Nâng tầm khô gà từ bã mía", chúng tôi không ngừng tìm kiếm những chú gà
                        tốt nhất, ướp gia vị đặc biệt và nướng cho "mềm ngoài, giòn trong" để mang đến những giây phút thích thú
                        tuyệt vời nhất cho hàng triệu người yêu khô gà!</p>
                    <p>Hệ thống chi nhánh của chúng tôi hiện đã có mặt tại 5 thành phố lớn với 12 chi nhánh hiện đại, đáp
                        ứng nhu cầu ăn khô gà lành mạnh của hàng triệu khách hàng. Mỗi chi nhánh đều có lò nướng hiện đại
                        và đội ngũ chế biến chuyên nghiệp! 🎵</p>
                </div>
                <div class="col-md-6">
                    <div class="rounded overflow-hidden">
                        <img src="https://voz.vn/attachments/untitled-1-jpg.502903/"
                            alt="Hình ảnh Khô gà Chộ Đó" class="img-fluid w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="bg-light py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="fw-bold">Tiện ích độc đáo</h2>
                    <div class="d-inline-block bg-danger" style="width: 60px; height: 3px; margin-bottom: 30px;"></div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center p-4 bg-white rounded shadow-sm h-100" style="transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.classList.add('shadow');"
                        onmouseout="this.style.transform='translateY(0)'; this.classList.remove('shadow');">
                        <div class="mb-3">
                            <i class="bi bi-fire text-danger fs-1"></i>
                        </div>
                        <h4>Lò nướng hiện đại</h4>
                        <p class="mb-0">Trải nghiệm ẩm thực tuyệt vời với lò nướng từ Nhật Bản, bã mía vàng ươm, 
                            giòn tan, hương thơm lan tỏa! 🔥</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 bg-white rounded shadow-sm h-100" style="transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.classList.add('shadow');"
                        onmouseout="this.style.transform='translateY(0)'; this.classList.remove('shadow');">
                        <div class="mb-3">
                            <i class="bi bi-spoon text-danger fs-1"></i>
                        </div>
                        <h4>Vị cay độc quyền</h4>
                        <p class="mb-0">Công thức gia vị bí mật 10 vị cay từ khắp Việt Nam, kết hợp hài hoà, cay vừa vặn. 
                            Ăn một lần là nghiện vì hương vị tuyệt vời! 🌶️🌶️🌶️</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 bg-white rounded shadow-sm h-100" style="transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.classList.add('shadow');"
                        onmouseout="this.style.transform='translateY(0)'; this.classList.remove('shadow');">
                        <div class="mb-3">
                            <i class="bi bi-cup-straw text-danger fs-1"></i>
                        </div>
                        <h4>Combo "Sát Tử"</h4>
                        <p class="mb-0">Khô gà + bã mía + muối ớt + tiêu + lá chanh = combo hoàn hảo để khiến 
                            cả gia đình "ứa nước mắt" vì ngon quá!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Technology Section -->
    <div id="technology" class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="fw-bold">Công nghệ hiện đại</h2>
                    <div class="d-inline-block bg-danger" style="width: 60px; height: 3px; margin-bottom: 30px;"></div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2">
                    <h3>Công nghệ nướng hiện đại</h3>
                    <p>Khô gà Chộ Đó tự hào sở hữu những công nghệ nướng tiên tiến nhất:</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent"><i
                                class="bi bi-check-circle-fill text-success me-2"></i> Lò nướng công nghiệp từ Nhật Bản với
                            kiểm soát nhiệt độ tự động</li>
                        <li class="list-group-item bg-transparent"><i
                                class="bi bi-check-circle-fill text-success me-2"></i> Hệ thống lọc mùi khí mùi cao cấp</li>
                        <li class="list-group-item bg-transparent"><i
                                class="bi bi-check-circle-fill text-success me-2"></i> Quy trình chuẩn hóa HACCP
                        </li>
                        <li class="list-group-item bg-transparent"><i
                                class="bi bi-check-circle-fill text-success me-2"></i> Nguyên liệu tươi sạch từ những trang trại
                            uy tín</li>
                        <li class="list-group-item bg-transparent"><i
                                class="bi bi-check-circle-fill text-success me-2"></i> Đóng gói chân không bảo quản tươi ngon
                            14 ngày</li>
                    </ul>
                </div>
                <div class="col-md-6 order-md-1">
                    <div class="rounded overflow-hidden">
                        <img src="https://voz.vn/attachments/untitled-1-jpg.502903/"
                            alt="Hình ảnh công nghệ Khô gà Chộ Đó" class="img-fluid w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Location Section -->
    <div id="locations" class="bg-light py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="fw-bold">Hệ thống chi nhánh</h2>
                    <div class="d-inline-block bg-danger" style="width: 60px; height: 3px; margin-bottom: 30px;"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Khô gà Chộ Đó - Hà Nội</h5>
                            <p class="card-text">120 Yên Lãng</p>
                            <p class="mb-0"><i class="bi bi-telephone me-2"></i> 024.3535.8888</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Khô gà Chộ Đó - Đà Nẵng</h5>
                            <p class="card-text">120 Yên Lãng</p>
                            <p class="mb-0"><i class="bi bi-telephone me-2"></i> 0236.3888.999</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Khô gà Chộ Đó - TP.HCM 1</h5>
                            <p class="card-text">120 Yên Lãng</p>
                            <p class="mb-0"><i class="bi bi-telephone me-2"></i> 028.3821.9999</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Khô gà Chộ Đó - TP.HCM 2</h5>
                            <p class="card-text">120 Yên Lãng</p>
                            <p class="mb-0"><i class="bi bi-telephone me-2"></i> 028.3622.8888</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {


}
</script>

<style></style>