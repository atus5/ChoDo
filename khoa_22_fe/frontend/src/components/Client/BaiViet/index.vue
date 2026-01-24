<template>
    <!-- Header Banner -->
    <div class="row">
        <div class="col">
            <div class="card bg-gradient text-white overflow-hidden" style="background: linear-gradient(135deg, #dc3545 0%, #ff6b6b 100%); border: none;">
                <img src="../../../assets/images/gallery/13.png" class="img-fluid" alt="Header" style="height: 180px; object-fit: cover; opacity: 0.3;">
                <div class="card-img-overlay d-flex align-items-center justify-content-center" style="min-height: 180px;">
                    <div class="text-center">
                        <h1 class="display-4 fw-bold mb-2">🐔 Tạp Chí Khô Gà</h1>
                        <p class="fs-5">Khám phá thế giới khô gà ngon, công thức, và những mẹo hay từ các chuyên gia</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-4">
            <!-- Main Article Section -->
            <div class="col-lg-8">
                <!-- Featured Article -->
                <div class="card border-0 shadow-lg overflow-hidden mb-4" style="border-radius: 12px;">
                    <div style="position: relative; height: 320px; overflow: hidden;">
                        <img src="https://voz.vn/attachments/1000016571-jpg.3225622/" 
                            class="card-img-top w-100 h-100" 
                            alt="Chộ Đó"
                            style="object-fit: cover;">
                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge bg-danger rounded-pill px-3 py-2" style="font-size: 12px;">🔥 NỔI BẬT</span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <span class="badge bg-warning text-dark me-2">Công Thức</span>
                            <small class="text-muted">📅 24 Tháng 1, 2025</small>
                        </div>
                        <h3 class="card-title fw-bold mb-3">🐔 Bí Quyết Ướp Khô Gà Cay Siêu Cấp Chuẩn Chộ Đó</h3>
                        <p class="card-text lh-lg" style="font-size: 16px;">
                            Khô gà cay siêu cấp không chỉ là một món ăn vặt, mà còn là một nghệ thuật. Để tạo ra những miếng khô gà thơm lừng, giòn rối, cay nhanh nhạy, bạn cần biết rõ quy trình ướp từ việc chọn nguyên liệu đến thời gian sấy. Hôm nay, chúng tôi sẽ chia sẻ bí quyết độc quyền...
                        </p>
                        <a href="#" @click.prevent="goToArticle(1)" class="btn btn-danger btn-lg mt-3">
                            <i class="fa-solid fa-arrow-right"></i> Đọc Tiếp
                        </a>
                    </div>
                </div>

                <!-- Articles Grid -->
                <h4 class="fw-bold mb-4 border-bottom pb-3">
                    <i class="fa-solid fa-fire"></i> Bài Viết Mới Nhất
                </h4>
                <div class="row g-3">
                    <!-- Article 1 -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius: 10px; transition: transform 0.3s; cursor: pointer;" @click="goToArticle(2)">
                            <img src="https://voz.vn/attachments/1000016571-jpg.3225622/" 
                                class="card-img-top" alt="Chộ Đó" style="object-fit: cover; height: 200px;">
                            <div class="card-body">
                                <div class="mb-2">
                                    <span class="badge bg-success">Dinh Dưỡng</span>
                                </div>
                                <h6 class="card-title fw-bold">Khô Gà Nướng Thơm: Lợi Ích Sức Khỏe Bạn Không Nên Bỏ Qua</h6>
                                <p class="card-text small">Khô gà không chỉ ngon miệng mà còn tốt cho sức khỏe. Tìm hiểu về những thành phần dinh dưỡng quý giá...</p>
                                <small class="text-muted">👤 Bác Tú Chuyên Gia | 📅 20 Tháng 1</small>
                            </div>
                        </div>
                    </div>

                    <!-- Article 2 -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius: 10px; transition: transform 0.3s; cursor: pointer;" @click="goToArticle(3)">
                            <img src="https://voz.vn/attachments/1000016571-jpg.3225622/" 
                                class="card-img-top" alt="Chộ Đó" style="object-fit: cover; height: 200px;">
                            <div class="card-body">
                                <div class="mb-2">
                                    <span class="badge bg-info text-dark">Tuyệt Chiêu</span>
                                </div>
                                <h6 class="card-title fw-bold">Cách Bảo Quản Khô Gà Tươi Lâu Ngon Như Mới</h6>
                                <p class="card-text small">Học những cách bảo quản khô gà đúng cách để giữ độ giòn, thơm và vị trong thời gian lâu nhất...</p>
                                <small class="text-muted">👤 Chị Hạnh Nội Trợ | 📅 18 Tháng 1</small>
                            </div>
                        </div>
                    </div>

                    <!-- Article 3 -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius: 10px; transition: transform 0.3s; cursor: pointer;" @click="goToArticle(4)">
                            <img src="https://voz.vn/attachments/1000016571-jpg.3225622/" 
                                class="card-img-top" alt="Chộ Đó" style="object-fit: cover; height: 200px;">
                            <div class="card-body">
                                <div class="mb-2">
                                    <span class="badge bg-warning text-dark">Sự Kiện</span>
                                </div>
                                <h6 class="card-title fw-bold">Lễ Hội Khô Gà Chộ Đó 2025: Sự Kiện Không Thể Bỏ Lỡ</h6>
                                <p class="card-text small">Tham dự lễ hội khô gà lớn nhất năm với hàng loạt hạt giống, demo nấu ăn, và giải thưởng độc quyền...</p>
                                <small class="text-muted">👤 Tổng Biên Tập | 📅 15 Tháng 1</small>
                            </div>
                        </div>
                    </div>

                    <!-- Article 4 -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius: 10px; transition: transform 0.3s; cursor: pointer;" @click="goToArticle(5)">
                            <img src="https://voz.vn/attachments/1000016571-jpg.3225622/" 
                                class="card-img-top" alt="Chộ Đó" style="object-fit: cover; height: 200px;">
                            <div class="card-body">
                                <div class="mb-2">
                                    <span class="badge bg-danger">Mẹo Nhà</span>
                                </div>
                                <h6 class="card-title fw-bold">5 Cách Ăn Khô Gà Sáng Tạo Bạn Chưa Bao Giờ Thử</h6>
                                <p class="card-text small">Từ khô gà xào rau, khô gà làm snack, đến khô gà nạp cơm... Khám phá những cách ăn độc lạ này...</p>
                                <small class="text-muted">👤 Đầu Bếp Minh | 📅 10 Tháng 1</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Trending Section -->
                <div class="card border-0 shadow-lg p-4 mb-4" style="border-radius: 12px; background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);">
                    <h5 class="fw-bold mb-4 text-dark">
                        <i class="fa-solid fa-bolt"></i> Đang Viral
                    </h5>
                    
                    <!-- Trending 1 -->
                    <div class="d-flex gap-3 mb-4 pb-3 border-bottom" style="cursor: pointer;" @click="goToArticle(6)">
                        <div style="min-width: 70px;">
                            <img src="https://voz.vn/attachments/1000016571-jpg.3225622/" 
                                class="rounded" alt="Chộ Đó" style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold text-dark mb-2">Khô Gà Sấy Lạnh Chống Ung Thư?</h6>
                            <small class="text-dark-50">👍 14.5K yêu thích</small>
                        </div>
                    </div>

                    <!-- Trending 2 -->
                    <div class="d-flex gap-3 mb-4 pb-3 border-bottom" style="cursor: pointer;" @click="goToArticle(7)">
                        <div style="min-width: 70px;">
                            <img src="https://voz.vn/attachments/1000016571-jpg.3225622/" 
                                class="rounded" alt="Chộ Đó" style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold text-dark mb-2">Startup Khô Gà Tây Bắc Gây Sốt</h6>
                            <small class="text-dark-50">💬 9.2K bình luận</small>
                        </div>
                    </div>

                    <!-- Trending 3 -->
                    <div class="d-flex gap-3" style="cursor: pointer;" @click="goToArticle(8)">
                        <div style="min-width: 70px;">
                            <img src="https://voz.vn/attachments/1000016571-jpg.3225622/" 
                                class="rounded" alt="Chộ Đó" style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold text-dark mb-2">Khô Gà Chua Cay Lên Top 1 Google</h6>
                            <small class="text-dark-50">🔥 Trending #1</small>
                        </div>
                    </div>
                </div>

                <!-- Newsletter Signup -->
                <div class="card border-0 shadow-lg p-4 mb-4" style="border-radius: 12px; background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
                    <h5 class="fw-bold text-white mb-3">
                        <i class="fa-solid fa-envelope"></i> Theo Dõi Tin Mới
                    </h5>
                    <p class="text-white-50 small mb-3">Nhận thông báo về những bài viết, công thức, và khuyến mãi mới nhất từ Tạp Chí Khô Gà</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email của bạn..." style="border-radius: 8px 0 0 8px;">
                        <button class="btn btn-warning fw-bold" style="border-radius: 0 8px 8px 0;">
                            Đăng Ký
                        </button>
                    </div>
                    <small class="text-white-50">✓ Không spam, chỉ những bài viết tốt nhất</small>
                </div>

                <!-- Categories -->
                <div class="card border-0 shadow-lg p-4" style="border-radius: 12px;">
                    <h5 class="fw-bold mb-4">
                        <i class="fa-solid fa-list"></i> Danh Mục
                    </h5>
                    <div class="d-flex flex-column gap-2">
                        <a href="#" class="btn btn-outline-danger btn-sm text-start justify-content-between">
                            <span>🍗 Công Thức Nấu Ăn</span>
                            <span class="badge bg-danger rounded-pill">12</span>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm text-start justify-content-between">
                            <span>💪 Dinh Dưỡng & Sức Khỏe</span>
                            <span class="badge bg-danger rounded-pill">8</span>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm text-start justify-content-between">
                            <span>🏆 Đánh Giá Sản Phẩm</span>
                            <span class="badge bg-danger rounded-pill">6</span>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm text-start justify-content-between">
                            <span>🌟 Mẹo & Tuyệt Chiêu</span>
                            <span class="badge bg-danger rounded-pill">15</span>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm text-start justify-content-between">
                            <span>📰 Tin Tức & Sự Kiện</span>
                            <span class="badge bg-danger rounded-pill">10</span>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm text-start justify-content-between">
                            <span>🎁 Khuyến Mãi & Giảm Giá</span>
                            <span class="badge bg-danger rounded-pill">9</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            articles: [
                {
                    id: 1,
                    title: "🐔 Bí Quyết Ướp Khô Gà Cay Siêu Cấp Chuẩn Chộ Đó",
                    category: "Công Thức",
                    author: "Đầu Bếp Long",
                    date: "24/01/2025",
                    image: "https://voz.vn/attachments/1000016571-jpg.3225622/",
                    content: "Khô gà cay siêu cấp không chỉ là một món ăn vặt, mà còn là một nghệ thuật. Để tạo ra những miếng khô gà thơm lừng, giòn rối, cay nhanh nhạy, bạn cần biết rõ quy trình ướp từ việc chọn nguyên liệu đến thời gian sấy.\n\nBước 1: Chọn gà ta tươi, không quá già.\nBước 2: Làm sạch và cắt thành miếng vừa ăn.\nBước 3: Ướp với gia vị: tiêu đen, tỏi, ớt, muối, nước mắm.\nBước 4: Ướp trong tủ lạnh từ 4-6 giờ.\nBước 5: Sấy lạnh hoặc nướng chậm 2-3 giờ.\n\nBí quyết chính là sử dụng ớt cay thật từ Tây Bắc và không ướp quá lâu để giữ độ ngọt của thịt gà.",
                    reads: "3.2K"
                },
                {
                    id: 2,
                    title: "Khô Gà Nướng Thơm: Lợi Ích Sức Khỏe Bạn Không Nên Bỏ Qua",
                    category: "Dinh Dưỡng",
                    author: "Bác Tú Chuyên Gia",
                    date: "20/01/2025",
                    image: "https://voz.vn/attachments/1000016571-jpg.3225622/",
                    content: "Khô gà nướng thơm không chỉ là một món ngon mà còn chứa nhiều dinh dưỡng tốt cho sức khỏe.\n\nThành phần dinh dưỡng:\n- Protein cao: giúp phục hồi cơ bắp\n- Sắt: tốt cho máu\n- Kẽm: tăng cường miễn dịch\n- Vitamin B: giúp trao đổi chất\n\nNgoài ra, khô gà chứa ít chất béo hơn so với các loại thịt khác, rất phù hợp cho những người theo dõi cân nặng.",
                    reads: "2.8K"
                },
                {
                    id: 3,
                    title: "Cách Bảo Quản Khô Gà Tươi Lâu Ngon Như Mới",
                    category: "Tuyệt Chiêu",
                    author: "Chị Hạnh Nội Trợ",
                    date: "18/01/2025",
                    image: "https://voz.vn/attachments/1000016571-jpg.3225622/",
                    content: "Bảo quản khô gà đúng cách là chìa khóa để giữ cho nó lâu ngon.\n\nCách 1: Bảo quản trong tủ lạnh\n- Để trong hộp kín trong tủ lạnh ở nhiệt độ 2-4°C\n- Có thể bảo quản được 1-2 tuần\n\nCách 2: Bảo quản trong ngăn đông\n- Để trong túi kín trong ngăn đông ở -18°C\n- Có thể bảo quản được 3-4 tháng\n\nCách 3: Bảo quản ở nhiệt độ phòng\n- Để trong hộp kín, nơi khô ráo\n- Thêm gói hút ẩm\n- Có thể bảo quản được 2-3 tuần",
                    reads: "5.1K"
                },
                {
                    id: 4,
                    title: "Lễ Hội Khô Gà Chộ Đó 2025: Sự Kiện Không Thể Bỏ Lỡ",
                    category: "Sự Kiện",
                    author: "Tổng Biên Tập",
                    date: "15/01/2025",
                    image: "https://voz.vn/attachments/1000016571-jpg.3225622/",
                    content: "Lễ Hội Khô Gà Chộ Đó 2025 sẽ diễn ra vào tháng 2 tại thị trấn Chộ Đó.\n\nCác hoạt động chính:\n- Triển lãm khô gà từ hơn 50 nông dân\n- Demo nấu ăn với các đầu bếp nổi tiếng\n- Thi chế biến khô gà sáng tạo\n- Mua bán trực tiếp với giá ưu đãi lên đến 50%\n- Tasting khô gà miễn phí\n\nĐây là cơ hội tuyệt vời để khám phá những sản phẩm khô gà tốt nhất từ Chộ Đó.",
                    reads: "1.9K"
                },
                {
                    id: 5,
                    title: "5 Cách Ăn Khô Gà Sáng Tạo Bạn Chưa Bao Giờ Thử",
                    category: "Mẹo Nhà",
                    author: "Đầu Bếp Minh",
                    date: "10/01/2025",
                    image: "https://voz.vn/attachments/1000016571-jpg.3225622/",
                    content: "Ngoài ăn thẳng, bạn có thể tận dụng khô gà theo nhiều cách sáng tạo khác:\n\n1. Khô Gà Xào Rau: Xào với rau mầm, hành, tỏi\n2. Khô Gà Làm Topping: Rắc lên cháo, phở, mì\n3. Khô Gà Nạp Cơm: Trộn với cơm cơm cà chua\n4. Khô Gà Bánh Mì: Kẹp vào bánh mì tươi\n5. Khô Gà Gỏi: Xé nhỏ trộn với gỏi đu đủ, cà chua\n\nMỗi cách ăn đều tạo ra hương vị riêng biệt độc đáo!",
                    reads: "4.3K"
                },
                {
                    id: 6,
                    title: "Khô Gà Sấy Lạnh Chống Ung Thư?",
                    category: "Tin Tức",
                    author: "PGS.TS. Nguyễn Văn A",
                    date: "05/01/2025",
                    image: "https://voz.vn/attachments/1000016571-jpg.3225622/",
                    content: "Một nghiên cứu mới từ Viện Dinh Dưỡng cho thấy khô gà sấy lạnh có chứa các chất chống oxy hóa cao.\n\nTheo các nhà khoa học, quá trình sấy lạnh giữ lại nhiều vitamin và chất chống oxy hóa hơn so với các phương pháp sấy truyền thống.\n\nTuy nhiên, cần lưu ý rằng khô gà không phải là thuốc chữa bệnh, mà chỉ là một phần của chế độ ăn uống lành mạnh.",
                    reads: "6.2K"
                },
                {
                    id: 7,
                    title: "Startup Khô Gà Tây Bắc Gây Sốt",
                    category: "Kinh Doanh",
                    author: "Biến Tập Kinh Tế",
                    date: "02/01/2025",
                    image: "https://voz.vn/attachments/1000016571-jpg.3225622/",
                    content: "Một startup tại Lào Cai đang tạo sóng trong ngành khô gà với mô hình bán hàng online hiện đại.\n\nThiết lập năm 2023, công ty đã phát triển từ cơ sở nhỏ thành một thương hiệu có mặt trên các sàn thương mại điện tử lớn.\n\nTham vọng của công ty là mang khô gà Tây Bắc ra thế giới, xây dựng nó thành một sản phẩm OCOP đạt chuẩn quốc tế.",
                    reads: "3.7K"
                },
                {
                    id: 8,
                    title: "Khô Gà Chua Cay Lên Top 1 Google",
                    category: "Thành Công",
                    author: "Tổng Biên Tập",
                    date: "28/12/2024",
                    image: "https://voz.vn/attachments/1000016571-jpg.3225622/",
                    content: "Khô gà chua cay từ Chộ Đó vừa lên Top 1 trên Google Trends trong hạng mục 'đặc sản Việt Nam'.\n\nThành công này là kết quả của nỗ lực trong việc nâng cao chất lượng sản phẩm và xây dựng thương hiệu.\n\nNhiều khách hàng quốc tế đã bắt đầu quan tâm đến sản phẩm này, và công ty đang chuẩn bị để xuất khẩu.",
                    reads: "8.5K"
                }
            ]
        }
    },
    methods: {
        goToArticle(articleId) {
            // Mở video YouTube trong tab mới
            window.open('https://www.youtube.com/watch?v=l3JdTYIHn-o', '_blank');
        }
    }
}
</script>
<style></style>