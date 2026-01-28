<template>
    <div class="py-4">
        <!-- Header -->
        <div class="container-fluid py-5" style="background: linear-gradient(135deg, #0f766e 0%, #0d9488 50%, #14b8a6 100%) !important;">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="/" class="text-white fw-500">Trang Chủ</a></li>
                        <li class="breadcrumb-item"><a href="/bai-viet" class="text-white fw-500">Bài Viết</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">{{ article.title }}</li>
                    </ol>
                </nav>
                <h1 class="display-5 fw-bold text-white mb-3" style="text-shadow: 0 2px 4px rgba(0,0,0,0.1);">{{ article.title }}</h1>
                <div class="d-flex flex-wrap gap-3 align-items-center" style="color: rgba(255,255,255,0.85);">
                    <span><i class="fa-solid fa-user"></i> {{ article.author }}</span>
                    <span><i class="fa-solid fa-calendar"></i> {{ article.date }}</span>
                    <span><i class="fa-solid fa-tag"></i> {{ article.category }}</span>
                    <span><i class="fa-solid fa-eye"></i> {{ article.reads }} lượt xem</span>
                </div>
            </div>
        </div>

        <!-- Article Content -->
        <div class="container py-5">
            <div class="row g-4">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <article class="card border-0 shadow-lg p-5" style="border-radius: 12px;">
                        <!-- Featured Image -->
                        <div class="mb-5">
                            <img :src="article.image" alt="Chộ Đó" class="img-fluid rounded shadow" style="width: 100%; height: 400px; object-fit: cover;">
                        </div>

                        <!-- Article Body -->
                        <div class="article-content lh-lg" style="font-size: 16px; line-height: 1.8; color: #333;">
                            <div v-for="(paragraph, index) in article.content.split('\n')" :key="index" class="mb-4">
                                <p v-if="paragraph.trim()" class="mb-0">{{ paragraph }}</p>
                            </div>
                        </div>

                        <!-- Social Share -->
                        <div class="mt-5 pt-5 border-top">
                            <h5 class="fw-bold mb-3">🔗 Chia Sẻ Bài Viết</h5>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-primary btn-sm" title="Chia sẻ Facebook">
                                    <i class="fa-brands fa-facebook"></i> Facebook
                                </a>
                                <a href="#" class="btn btn-info btn-sm" title="Chia sẻ Twitter">
                                    <i class="fa-brands fa-twitter"></i> Twitter
                                </a>
                                <a href="#" class="btn btn-success btn-sm" title="Chia sẻ Zalo">
                                    <i class="fa-solid fa-share"></i> Zalo
                                </a>
                                <button @click="copyLink" class="btn btn-secondary btn-sm" title="Copy link">
                                    <i class="fa-solid fa-link"></i> Copy Link
                                </button>
                            </div>
                        </div>

                        <!-- Related Articles -->
                        <div class="mt-5 pt-5 border-top">
                            <h5 class="fw-bold mb-4">📖 Bài Viết Liên Quan</h5>
                            <div class="row g-3">
                                <div class="col-md-6" v-for="(relatedArticle, index) in relatedArticles.slice(0, 2)" :key="index">
                                    <div class="card border-0 shadow-sm h-100 overflow-hidden" style="cursor: pointer;" @click="goToArticle(relatedArticle.id)">
                                        <img :src="relatedArticle.image" class="card-img-top" alt="Chộ Đó" style="height: 150px; object-fit: cover;">
                                        <div class="card-body">
                                            <h6 class="card-title fw-bold">{{ relatedArticle.title }}</h6>
                                            <small class="text-muted">👤 {{ relatedArticle.author }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Article Info Card -->
                    <div class="card border-0 shadow-lg p-4 mb-4" style="border-radius: 12px; position: sticky; top: 20px;">
                        <h5 class="fw-bold mb-4">📊 Thông Tin Bài Viết</h5>
                        
                        <div class="mb-4">
                            <p class="text-muted small mb-2">Danh Mục</p>
                            <span class="badge bg-danger px-3 py-2" style="font-size: 12px;">{{ article.category }}</span>
                        </div>

                        <div class="mb-4">
                            <p class="text-muted small mb-2">Tác Giả</p>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://i.pravatar.cc/32?u=author" class="rounded-circle" alt="">
                                <strong>{{ article.author }}</strong>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="text-muted small mb-2">Ngày Xuất Bản</p>
                            <p class="mb-0"><i class="fa-solid fa-calendar-days"></i> {{ article.date }}</p>
                        </div>

                        <div>
                            <p class="text-muted small mb-2">Lượt Xem</p>
                            <p class="mb-0"><i class="fa-solid fa-eye"></i> {{ article.reads }}</p>
                        </div>
                    </div>

                    <!-- Newsletter Signup -->
                    <div class="card border-0 shadow-lg p-4 mb-4" style="border-radius: 12px; background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
                        <h5 class="fw-bold text-white mb-3">
                            <i class="fa-solid fa-envelope"></i> Theo Dõi Tin Mới
                        </h5>
                        <p class="text-white-50 small mb-3">Nhận thông báo về những bài viết mới nhất từ Tạp Chí Khô Gà</p>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Email của bạn..." style="border-radius: 8px 0 0 8px;">
                            <button class="btn btn-warning fw-bold" style="border-radius: 0 8px 8px 0;">
                                Đăng Ký
                            </button>
                        </div>
                        <small class="text-white-50 d-block mt-2">✓ Không spam, chỉ những bài viết tốt nhất</small>
                    </div>

                    <!-- Back Button -->
                    <div class="mt-4">
                        <a href="/bai-viet" class="btn btn-outline-danger w-100">
                            <i class="fa-solid fa-arrow-left"></i> Quay Lại Danh Sách
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["id_bai_viet"],
    data() {
        return {
            article: {
                id: 1,
                title: "🐔 Bí Quyết Ướp Khô Gà Cay Siêu Cấp Chuẩn Chộ Đó",
                category: "Công Thức",
                author: "Chọ Đố",
                date: "24/01/2025",
                image: "https://images.unsplash.com/photo-1598103442097-8b74394b95c6?w=800",
                content: "Khô gà cay siêu cấp không chỉ là một món ăn vặt, mà còn là một nghệ thuật. Để tạo ra những miếng khô gà thơm lừng, giòn rối, cay nhanh nhạy, bạn cần biết rõ quy trình ướp từ việc chọn nguyên liệu đến thời gian sấy.\n\nBước 1: Chọn gà ta tươi, không quá già.\nBước 2: Làm sạch và cắt thành miếng vừa ăn.\nBước 3: Ướp với gia vị: tiêu đen, tỏi, ớt, muối, nước mắm.\nBước 4: Ướp trong tủ lạnh từ 4-6 giờ.\nBước 5: Sấy lạnh hoặc nướng chậm 2-3 giờ.\n\nBí quyết chính là sử dụng ớt cay thật từ Tây Bắc và không ướp quá lâu để giữ độ ngọt của thịt gà.",
                reads: "3.2K"
            },
            allArticles: [
                {
                    id: 1,
                    title: "🐔 Bí Quyết Ướp Khô Gà Cay Siêu Cấp Chuẩn Chộ Đó",
                    category: "Công Thức",
                    author: "Độ Chó",
                    date: "24/01/2025",
                    image: "https://picsum.photos/800/400?random=1",
                    content: "Khô gà cay siêu cấp không chỉ là một món ăn vặt, mà còn là một nghệ thuật. Để tạo ra những miếng khô gà thơm lừng, giòn rối, cay nhanh nhạy, bạn cần biết rõ quy trình ướp từ việc chọn nguyên liệu đến thời gian sấy.\n\nBước 1: Chọn gà ta tươi, không quá già.\nBước 2: Làm sạch và cắt thành miếng vừa ăn.\nBước 3: Ướp với gia vị: tiêu đen, tỏi, ớt, muối, nước mắm.\nBước 4: Ướp trong tủ lạnh từ 4-6 giờ.\nBước 5: Sấy lạnh hoặc nướng chậm 2-3 giờ.\n\nBí quyết chính là sử dụng ớt cay thật từ Tây Bắc và không ướp quá lâu để giữ độ ngọt của thịt gà.",
                    reads: "3.2K"
                },
                {
                    id: 2,
                    title: "Khô Gà Nướng Thơm: Lợi Ích Sức Khỏe Bạn Không Nên Bỏ Qua",
                    category: "Dinh Dưỡng",
                    author: "Mộ xum xuê",
                    date: "20/01/2025",
                    image: "https://picsum.photos/800/400?random=2",
                    content: "Khô gà nướng thơm không chỉ là một món ngon mà còn chứa nhiều dinh dưỡng tốt cho sức khỏe.\n\nThành phần dinh dưỡng:\n- Protein cao: giúp phục hồi cơ bắp\n- Sắt: tốt cho máu\n- Kẽm: tăng cường miễn dịch\n- Vitamin B: giúp trao đổi chất\n\nNgoài ra, khô gà chứa ít chất béo hơn so với các loại thịt khác, rất phù hợp cho những người theo dõi cân nặng.",
                    reads: "2.8K"
                },
                {
                    id: 3,
                    title: "Cách Bảo Quản Khô Gà Tươi Lâu Ngon Như Mới",
                    category: "Tuyệt Chiêu",
                    author: "Dùng Thanh Nộ",
                    date: "18/01/2025",
                    image: "https://picsum.photos/800/400?random=3",
                    content: "Bảo quản khô gà đúng cách là chìa khóa để giữ cho nó lâu ngon.\n\nCách 1: Bảo quản trong tủ lạnh\n- Để trong hộp kín trong tủ lạnh ở nhiệt độ 2-4°C\n- Có thể bảo quản được 1-2 tuần\n\nCách 2: Bảo quản trong ngăn đông\n- Để trong túi kín trong ngăn đông ở -18°C\n- Có thể bảo quản được 3-4 tháng\n\nCách 3: Bảo quản ở nhiệt độ phòng\n- Để trong hộp kín, nơi khô ráo\n- Thêm gói hút ẩm\n- Có thể bảo quản được 2-3 tuần",
                    reads: "5.1K"
                },
                {
                    id: 4,
                    title: "Lễ Hội Khô Gà Chộ Đó 2025: Sự Kiện Không Thể Bỏ Lỡ",
                    category: "Sự Kiện",
                    author: "Anh Trai Gay Sex",
                    date: "15/01/2025",
                    image: "https://picsum.photos/800/400?random=4",
                    content: "Lễ Hội Khô Gà Chộ Đó 2025 sẽ diễn ra vào tháng 2 tại thị trấn Chộ Đó.\n\nCác hoạt động chính:\n- Triển lãm khô gà từ hơn 50 nông dân\n- Demo nấu ăn với các đầu bếp nổi tiếng\n- Thi chế biến khô gà sáng tạo\n- Mua bán trực tiếp với giá ưu đãi lên đến 50%\n- Tasting khô gà miễn phí\n\nĐây là cơ hội tuyệt vời để khám phá những sản phẩm khô gà tốt nhất từ Chộ Đó.",
                    reads: "1.9K"
                },
                {
                    id: 5,
                    title: "5 Cách Ăn Khô Gà Sáng Tạo Bạn Chưa Bao Giờ Thử",
                    category: "Mẹo Nhà",
                    author: "Thằng em Linh",
                    date: "10/01/2025",
                    image: "https://picsum.photos/800/400?random=5",
                    content: "Ngoài ăn thẳng, bạn có thể tận dụng khô gà theo nhiều cách sáng tạo khác:\n\n1. Khô Gà Xào Rau: Xào với rau mầm, hành, tỏi\n2. Khô Gà Làm Topping: Rắc lên cháo, phở, mì\n3. Khô Gà Nạp Cơm: Trộn với cơm cơm cà chua\n4. Khô Gà Bánh Mì: Kẹp vào bánh mì tươi\n5. Khô Gà Gỏi: Xé nhỏ trộn với gỏi đu đủ, cà chua\n\nMỗi cách ăn đều tạo ra hương vị riêng biệt độc đáo!",
                    reads: "4.3K"
                },
                {
                    id: 6,
                    title: "Khô Gà Sấy Lạnh Chống Ung Thư?",
                    category: "Tin Tức",
                    author: "Nguyễn Anh Xưa",
                    date: "05/01/2025",
                    image: "https://picsum.photos/800/400?random=6",
                    content: "Một nghiên cứu mới từ Viện Dinh Dưỡng cho thấy khô gà sấy lạnh có chứa các chất chống oxy hóa cao.\n\nTheo các nhà khoa học, quá trình sấy lạnh giữ lại nhiều vitamin và chất chống oxy hóa hơn so với các phương pháp sấy truyền thống.\n\nTuy nhiên, cần lưu ý rằng khô gà không phải là thuốc chữa bệnh, mà chỉ là một phần của chế độ ăn uống lành mạnh.",
                    reads: "6.2K"
                },
                {
                    id: 7,
                    title: "Startup Khô Gà Tây Bắc Gây Sốt",
                    category: "Kinh Doanh",
                    author: "Trần Văn Xưa",
                    date: "02/01/2025",
                    image: "https://picsum.photos/800/400?random=7",
                    content: "Một startup tại Lào Cai đang tạo sóng trong ngành khô gà với mô hình bán hàng online hiện đại.\n\nThiết lập năm 2023, công ty đã phát triển từ cơ sở nhỏ thành một thương hiệu có mặt trên các sàn thương mại điện tử lớn.\n\nTham vọng của công ty là mang khô gà Tây Bắc ra thế giới, xây dựng nó thành một sản phẩm OCOP đạt chuẩn quốc tế.",
                    reads: "3.7K"
                },
                {
                    id: 8,
                    title: "Khô Gà Chua Cay Lên Top 1 Google",
                    category: "Thành Công",
                    author: "La Quý Xưa",
                    date: "28/12/2024",
                    image: "https://vigift.vn/wp-content/uploads/2022/08/an-kho-ga-co-map-khong-2-768x899.jpg",
                    content: "Khô gà chua cay từ Chộ Đó vừa lên Top 1 trên Google Trends trong hạng mục 'đặc sản Việt Nam'.\n\nThành công này là kết quả của nỗ lực trong việc nâng cao chất lượng sản phẩm và xây dựng thương hiệu.\n\nNhiều khách hàng quốc tế đã bắt đầu quan tâm đến sản phẩm này, và công ty đang chuẩn bị để xuất khẩu.",
                    reads: "8.5K"
                }
            ]
        }
    },
    computed: {
        relatedArticles() {
            return this.allArticles.filter(a => a.id !== this.article.id);
        }
    },
    mounted() {
        this.loadArticle();
    },
    methods: {
        loadArticle() {
            // Kiểm tra sessionStorage trước
            const savedArticle = sessionStorage.getItem('selectedArticle');
            if (savedArticle) {
                this.article = JSON.parse(savedArticle);
                sessionStorage.removeItem('selectedArticle');
            } else {
                // Nếu không có, tìm trong mảng allArticles theo id
                const articleId = parseInt(this.id_bai_viet);
                const found = this.allArticles.find(a => a.id === articleId);
                if (found) {
                    this.article = found;
                }
            }
        },
        goToArticle(articleId) {
            const article = this.allArticles.find(a => a.id === articleId);
            if (article) {
                sessionStorage.setItem('selectedArticle', JSON.stringify(article));
                this.$router.push(`/bai-viet-chi-tiet/${articleId}`);
                // Reload after navigation
                this.$nextTick(() => {
                    this.loadArticle();
                });
            }
        },
        copyLink() {
            const link = window.location.href;
            navigator.clipboard.writeText(link).then(() => {
                alert('Đã copy link bài viết!');
            });
        }
    }
}
</script>

<style scoped>
.article-content {
    color: #990909;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.article-content p {
    margin-bottom: 1.5rem;
}

.breadcrumb-dark {
    background-color: transparent;
}

.breadcrumb-dark .breadcrumb-item.active {
    color: rgba(197, 20, 20, 0.8);
}
</style>
