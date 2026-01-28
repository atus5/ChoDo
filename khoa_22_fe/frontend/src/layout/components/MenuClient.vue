<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark py-0" style="background-color: #000957;">
            <div class="container"> <a class="navbar-brand fs-4 fw-bold" href="#"><span
                        class="text-warning">Khô gà</span> Chộ Đó</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1"
                    aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    </ul>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <router-link to="/">
                            <li class="nav-item"> <a class="nav-link  text-light fs-6" aria-current="page"
                                    href="#">Trang
                                    Chủ</a>
                            </li>
                        </router-link>
                        <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle text-light fs-6" href="#"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Khô Gà
                            </a>
                            <ul class="dropdown-menu">
                                <router-link to="/phim/dang-chieu">
                                    <li><a class="dropdown-item" href="/phim/dang-chieu">Khô Gà Đang Bán</a>
                                    </li>
                                </router-link>
                                <router-link to="/phim/sap-chieu">
                                    <li><a class="dropdown-item" href="/phim/sap-chieu">Khô Gà Sắp Bán</a>
                                    </li>
                                </router-link>
                            </ul>
                        </li>
                        <router-link to="/bai-viet">
                            <li class="nav-item"> <a class="nav-link text-light fs-6" href="/bai-viet">Bài Viết</a>
                            </li>
                        </router-link>
                        <router-link to="/about">
                            <li class="nav-item"> <a class="nav-link text-light fs-6" href="/about">Về chúng tôi</a>
                            </li>
                        </router-link>
                        <template v-if="user">
                            <!-- Icon Giỏ Hàng / Lịch Sử Đơn Hàng -->
                            <li class="nav-item dropdown position-relative">
                                <button class="nav-link btn btn-link text-light fs-5" type="button" 
                                    id="orderDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                                    @click="loadOrders()" style="border: none; padding: 0.5rem 0;">
                                    <i class="fa-solid fa-shopping-cart"></i>
                                    <span v-if="orderCount > 0" class="badge bg-danger position-absolute" 
                                        style="top: -5px; right: -10px; border-radius: 50%; padding: 4px 6px; font-size: 10px;">
                                        {{ orderCount }}
                                    </span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" style="min-width: 400px; max-height: 500px; overflow-y: auto;" aria-labelledby="orderDropdown">
                                    <li class="dropdown-header">
                                        <i class="fa-solid fa-history"></i> Lịch Sử Đơn Hàng
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    
                                    <!-- Danh Sách Đơn Hàng -->
                                    <li v-if="orders.length === 0" class="dropdown-item text-center text-muted">
                                        <p class="mb-0">Chưa có đơn hàng nào</p>
                                    </li>
                                    <li v-for="order in orders" :key="order.id" class="dropdown-item p-0">
                                        <div class="p-2 border-bottom d-flex gap-2" style="cursor: pointer; hover-color: #f0f0f0;"
                                            @click="viewOrderDetail(order)">
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <span class="fw-bold">{{ order.ten_san_pham }}</span>
                                                    <span class="badge" :class="getStatusBadgeClass(order.trang_thai)">
                                                        {{ getStatusLabel(order.trang_thai) }}
                                                    </span>
                                                </div>
                                                <div class="small text-muted mb-1">
                                                    <i class="fa-solid fa-hashtag"></i> #{{ order.id }}
                                                </div>
                                                <div class="small text-muted">
                                                    <i class="fa-solid fa-calendar"></i> 
                                                    {{ formatDate(order.created_at) }}
                                                </div>
                                                <div class="small text-danger fw-bold mt-1">
                                                    💰 {{ formatVND(order.tong_tien) }}
                                                </div>
                                            </div>
                                            <button v-if="order.sourceType !== 'api'" class="btn btn-outline-danger btn-sm h-100"
                                                @click.stop="removeOrder(order)">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </li>
                                    
                                    <li v-if="orders.length > 0"><hr class="dropdown-divider"></li>
                                    <li v-if="orders.length > 0" class="dropdown-item text-center">
                                        <router-link to="/lich-su-don-hang" class="text-danger fw-bold text-decoration-none">
                                            <i class="fa-solid fa-arrow-right"></i> Xem Tất Cả Đơn Hàng
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                        </template>
                    </ul>
                    <div class="dropdown my-3">
                        <template v-if="user">
                            <button class="btn btn-link dropdown-toggle dropdown-toggle-nocaret d-flex align-items-center nav-link"
                                type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/"
                                    class="user-img" style="height: 35px; width: 35px; border-radius: 50%; object-fit: cover;">
                                <div class="user-info ps-3 pe-3">
                                    <p class="user-name mb-0 text-light">{{ user.ho_va_ten }}</p>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <button type="button" class="dropdown-item border-0 bg-transparent w-100 text-start" @click.prevent.stop="goToProfile()">
                                        <i class="bx bx-user"></i>
                                        <span>Thông tin cá nhân</span>
                                    </button>
                                </li>
                                <li><button type="button" class="dropdown-item border-0 bg-transparent w-100 text-start" @click.prevent.stop="dangXuat()">
                                        <i class="bx bx-log-out-circle"></i>
                                        <span>Đăng xuất</span>
                                    </button>
                                </li>
                            </ul>
                        </template>

                        <template v-else>
                            <button class="btn btn-link dropdown-toggle dropdown-toggle-nocaret d-flex align-items-center nav-link"
                                type="button" id="guestDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/" class="user-img"
                                    style="height: 35px; object-fit: cover;">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="guestDropdown">
                                <li><button type="button" class="dropdown-item border-0 bg-transparent w-100 text-start" @click.prevent.stop="goToDangKy()"><i class="bx bx-user me-1"></i><span>Đăng Ký</span></button></li>
                                <li><button type="button" class="dropdown-item border-0 bg-transparent w-100 text-start" @click.prevent.stop="goToDangNhap()"><i class="bx bx-log-in-circle"></i><span>Đăng Nhập</span></button></li>
                            </ul>
                        </template>
                    </div>

                </div>
            </div>
        </nav>
    </header>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: null,
            orders: [],
            orderCount: 0,
        }
    },
    mounted() {
        this.checkLogin();
    },
    watch: {
        '$route'() {
            this.checkLogin();
        }
    },
    methods: {
        checkLogin() {
            const token = localStorage.getItem("key_client");
            console.log('Token từ localStorage:', token);
            if (!token) {
                console.log('Không có token, bỏ qua kiểm tra');
                return;
            }

            axios.get('http://127.0.0.1:8000/api/client/thong-tin', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            })
                .then((res) => {
                    console.log('Response thong-tin:', res.data);
                    this.user = res.data.data;
                    console.log('User đã set:', this.user);
                })
                .catch((error) => {
                    console.log('Lỗi khi lấy thông tin:', error.response?.data || error.message);
                    this.user = null;
                    localStorage.removeItem("key_client");
                });
        },
        hideDropdown(dropdownId = 'userDropdown') {
            const dropdownElement = document.getElementById(dropdownId);
            if (dropdownElement) {
                const dropdown = new bootstrap.Dropdown(dropdownElement);
                dropdown.hide();
            }
        },
        dangXuat() {
            console.log('Đang xuất được gọi');
            this.hideDropdown('userDropdown');
            axios.get('http://127.0.0.1:8000/api/client/dang-xuat', {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem("key_client")
                }
            })
                .then((res) => {
                    console.log('Đăng xuất thành công');
                    localStorage.removeItem("key_client");
                    localStorage.removeItem("check_kh");
                    localStorage.removeItem("email_kh");
                    localStorage.removeItem("ho_va_ten");
                    this.user = null;
                    this.$router.push("/");
                })
                .catch((err) => {
                    console.error('Lỗi đăng xuất:', err);
                    localStorage.removeItem("key_client");
                    this.user = null;
                    this.$router.push("/");
                });
        },
        goToProfile() {
            console.log('Đi tới hồ sơ');
            this.hideDropdown('userDropdown');
            this.$router.push("/client/profile");
        },
        goToDangKy() {
            console.log('Đi tới đăng ký');
            this.hideDropdown('guestDropdown');
            this.$router.push("/client/dang-ky");
        },
        goToDangNhap() {
            console.log('Đi tới đăng nhập');
            this.hideDropdown('guestDropdown');
            this.$router.push("/client/dang-nhap");
        },
        // Phương thức xử lý lịch sử đơn hàng
        loadOrders() {
            const token = localStorage.getItem("key_client");
            const localPreorders = JSON.parse(localStorage.getItem('preorderOrders') || '[]').map((item) => ({
                id: item.id,
                ten_san_pham: item.ten_san_pham,
                tong_tien: item.tong_tien,
                trang_thai: 'preorder',
                created_at: item.created_at,
                hinh_anh: item.hinh_anh,
                so_luong: item.so_luong,
                gia_don_vi: item.gia_don_vi,
                vi: item.vi,
                kich_thuoc: item.kich_thuoc,
                ghi_chu: item.ghi_chu,
                ten_nguoi_nhan: item.ten_nguoi_nhan,
                sdt: item.sdt,
                dia_chi: item.dia_chi,
                email: item.email,
                sourceType: 'preorder',
            }));
            if (!token) {
                this.orders = [...localPreorders];
                this.orderCount = this.orders.length;
                return;
            }

            axios.get('/api/client/lich-su-dat-hang', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            })
                .then((res) => {
                    console.log('Lịch sử đặt hàng:', res.data);
                    if (res.data.status && res.data.data) {
                        const apiOrders = res.data.data.map((item) => ({
                            id: item.id,
                            ten_san_pham: item.ten_san_pham,
                            tong_tien: item.tong_tien,
                            trang_thai: item.trang_thai || 'paid',
                            created_at: item.created_at,
                            hinh_anh: item.hinh_anh,
                            so_luong: item.so_luong,
                            gia_don_vi: item.gia_don_vi,
                            vi: item.vi,
                            kich_thuoc: item.kich_thuoc,
                            ghi_chu: item.ghi_chu,
                            ten_nguoi_nhan: item.ten_nguoi_nhan,
                            sdt: item.sdt,
                            dia_chi: item.dia_chi,
                            sourceType: 'history',
                        }));
                        const paidNames = new Set([
                            ...apiOrders.map((item) => item.ten_san_pham),
                        ]);
                        const filteredPreorders = localPreorders.filter((item) => !paidNames.has(item.ten_san_pham));
                        this.orders = [...apiOrders, ...filteredPreorders];
                        this.orderCount = this.orders.length;
                    } else {
                        this.orders = [...localPreorders];
                        this.orderCount = this.orders.length;
                    }
                })
                .catch((error) => {
                    console.log('Lỗi khi tải đơn hàng:', error);
                    this.orders = [...localPreorders];
                    this.orderCount = this.orders.length;
                });
        },
        getStatusLabel(status) {
            const statusMap = {
                'pending': 'Chờ xác nhận',
                'preparing': 'Đang chuẩn bị',
                'shipping': 'Đang giao',
                'delivered': 'Đã giao',
                'cancelled': 'Đã hủy',
                'preorder': 'Đặt trước',
                'paid': 'Đã thanh toán'
            };
            return statusMap[status] || status;
        },
        getStatusBadgeClass(status) {
            const classMap = {
                'pending': 'bg-warning text-dark',
                'preparing': 'bg-info text-white',
                'shipping': 'bg-primary text-white',
                'delivered': 'bg-success text-white',
                'cancelled': 'bg-danger text-white',
                'preorder': 'bg-info text-white',
                'paid': 'bg-success text-white'
            };
            return classMap[status] || 'bg-secondary text-white';
        },
        formatDate(dateString) {
            if (!dateString) return '';
            const options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' };
            return new Date(dateString).toLocaleDateString('vi-VN', options);
        },
        formatVND(amount) {
            if (!amount) return '0 ₫';
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(amount);
        },
        viewOrderDetail(order) {
            if (order) {
                sessionStorage.setItem('orderData', JSON.stringify(order));
                if (order.trang_thai) {
                    sessionStorage.setItem('orderStatus', order.trang_thai);
                }
            }
            this.$router.push(`/don-hang/${order?.id || order}`);
            // Đóng dropdown
            const dropdown = new bootstrap.Dropdown(document.getElementById('orderDropdown'));
            dropdown.hide();
        },
        removeOrder(order) {
            if (!order) return;

            if (order.sourceType === 'preorder') {
                const list = JSON.parse(localStorage.getItem('preorderOrders') || '[]');
                const next = list.filter((item) => Number(item.id) !== Number(order.id));
                localStorage.setItem('preorderOrders', JSON.stringify(next));
            }

            if (order.sourceType === 'history') {
                const token = localStorage.getItem('key_client');
                if (token) {
                    axios.delete(`/api/client/lich-su-dat-hang/${order.id}`, {
                        headers: {
                            Authorization: 'Bearer ' + token
                        }
                    }).catch((error) => {
                        console.log('Lỗi khi xóa lịch sử:', error);
                    });
                }
            }

            this.orders = this.orders.filter((item) => Number(item.id) !== Number(order.id) || item.sourceType !== order.sourceType);
            this.orderCount = this.orders.length;
        }
    },
}
</script>
<style></style>