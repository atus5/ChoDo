<template>
    <div class="container py-5">
        <!-- Header -->
        <div class="card mb-4 border-0 shadow-lg overflow-hidden" style="background: linear-gradient(135deg, #dc3545 0%, #ff6b6b 100%);">
            <div class="card-body text-white p-4">
                <h2 class="h3 fw-bold mb-2">
                    <i class="fa-solid fa-history me-2"></i>Lịch Sử Đơn Hàng
                </h2>
                <p class="text-white-50 mb-0">Quản lý và theo dõi tất cả các đơn hàng của bạn</p>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="card border-0 shadow mb-4" style="border-radius: 15px;">
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input v-model="searchTerm" type="text" class="form-control" placeholder="Tìm kiếm theo tên sản phẩm hoặc mã đơn hàng...">
                    </div>
                    <div class="col-md-6">
                        <select v-model="filterStatus" class="form-select">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending">Chờ xác nhận</option>
                            <option value="preparing">Đang chuẩn bị</option>
                            <option value="shipping">Đang giao</option>
                            <option value="delivered">Đã giao</option>
                            <option value="cancelled">Đã hủy</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders List -->
        <div v-if="filteredOrders.length > 0" class="row g-4">
            <div v-for="order in filteredOrders" :key="order.id" class="col-12">
                <div class="card border-0 shadow-lg hover-shadow" style="border-radius: 15px; transition: all 0.3s; cursor: pointer;" 
                    @mouseenter="selectedOrder = order.id" @mouseleave="selectedOrder = null"
                    @click="viewOrderDetail(order.id)">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <!-- Order ID & Date -->
                            <div class="col-md-3">
                                <div class="mb-3 mb-md-0">
                                    <p class="text-muted small mb-1">
                                        <i class="fa-solid fa-hashtag"></i> Mã đơn hàng
                                    </p>
                                    <h6 class="fw-bold mb-2">#{{ order.id }}</h6>
                                    <p class="text-muted small">
                                        <i class="fa-solid fa-calendar"></i> {{ formatDate(order.created_at) }}
                                    </p>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="col-md-3">
                                <div class="mb-3 mb-md-0">
                                    <p class="text-muted small mb-1">
                                        <i class="fa-solid fa-box"></i> Sản phẩm
                                    </p>
                                    <h6 class="fw-bold">{{ order.ten_san_pham }}</h6>
                                    <p class="text-muted small" v-if="order.so_luong">
                                        Số lượng: <strong>{{ order.so_luong }}</strong>
                                    </p>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-2">
                                <div class="mb-3 mb-md-0">
                                    <p class="text-muted small mb-1">
                                        <i class="fa-solid fa-info-circle"></i> Trạng thái
                                    </p>
                                    <span class="badge" :class="getStatusBadgeClass(order.trang_thai)">
                                        {{ getStatusLabel(order.trang_thai) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Total Price -->
                            <div class="col-md-2">
                                <div class="mb-3 mb-md-0">
                                    <p class="text-muted small mb-1">
                                        <i class="fa-solid fa-coins"></i> Tổng cộng
                                    </p>
                                    <h6 class="fw-bold text-danger">{{ formatVND(order.tong_tien) }}</h6>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="col-md-2 text-end">
                                <button class="btn btn-sm btn-danger fw-bold" @click.stop="viewOrderDetail(order.id)">
                                    <i class="fa-solid fa-arrow-right me-1"></i>Xem chi tiết
                                </button>
                            </div>
                        </div>

                        <!-- Status Timeline (Optional) -->
                        <div class="mt-3 pt-3 border-top" v-if="selectedOrder === order.id">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-center" 
                                    v-for="(step, index) in orderSteps" :key="step"
                                    :class="{ 'opacity-50': index > getStatusIndex(order.trang_thai) }">
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px; background-color: #f0f0f0; margin-bottom: 8px;">
                                        <i :class="getStepIcon(step)" style="font-size: 18px;"></i>
                                    </div>
                                    <small class="d-block">{{ step }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div v-else class="card border-0 shadow text-center p-5">
            <div class="text-muted">
                <i class="fa-solid fa-inbox" style="font-size: 48px; margin-bottom: 20px; display: block;"></i>
                <p class="fs-5 fw-bold">Chưa có đơn hàng nào</p>
                <p class="text-muted">Hãy bắt đầu mua sắm khô gà chất lượng cao của chúng tôi ngay!</p>
                <router-link to="/phim/dang-chieu" class="btn btn-danger mt-3">
                    <i class="fa-solid fa-shopping-cart me-2"></i>Bắt đầu mua sắm
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            orders: [],
            searchTerm: '',
            filterStatus: '',
            selectedOrder: null,
            orderSteps: ['Chờ xác nhận', 'Đang chuẩn bị', 'Đang giao', 'Đã giao']
        };
    },
    computed: {
        filteredOrders() {
            return this.orders.filter(order => {
                const matchSearch = !this.searchTerm || 
                    order.ten_san_pham.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                    String(order.id).includes(this.searchTerm);
                
                const matchStatus = !this.filterStatus || order.trang_thai === this.filterStatus;
                
                return matchSearch && matchStatus;
            });
        }
    },
    mounted() {
        this.loadOrders();
    },
    methods: {
        loadOrders() {
            const token = localStorage.getItem('key_client');
            if (!token) {
                this.$router.push('/client/dang-nhap');
                return;
            }

            axios.get('http://127.0.0.1:8000/api/client/don-hang/list', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            })
                .then((res) => {
                    console.log('Orders:', res.data);
                    if (res.data.status && res.data.data) {
                        this.orders = res.data.data;
                    }
                })
                .catch((error) => {
                    console.error('Error loading orders:', error);
                });
        },
        getStatusLabel(status) {
            const statusMap = {
                'pending': 'Chờ xác nhận',
                'preparing': 'Đang chuẩn bị',
                'shipping': 'Đang giao',
                'delivered': 'Đã giao',
                'cancelled': 'Đã hủy'
            };
            return statusMap[status] || status;
        },
        getStatusBadgeClass(status) {
            const classMap = {
                'pending': 'bg-warning text-dark',
                'preparing': 'bg-info text-white',
                'shipping': 'bg-primary text-white',
                'delivered': 'bg-success text-white',
                'cancelled': 'bg-danger text-white'
            };
            return classMap[status] || 'bg-secondary text-white';
        },
        getStatusIndex(status) {
            const statusMap = {
                'pending': 0,
                'preparing': 1,
                'shipping': 2,
                'delivered': 3,
                'cancelled': -1
            };
            return statusMap[status] || -1;
        },
        getStepIcon(step) {
            const iconMap = {
                'Chờ xác nhận': 'fa-solid fa-hourglass-start text-warning',
                'Đang chuẩn bị': 'fa-solid fa-boxes-stacked text-info',
                'Đang giao': 'fa-solid fa-truck text-primary',
                'Đã giao': 'fa-solid fa-check-circle text-success'
            };
            return iconMap[step] || 'fa-solid fa-question-circle';
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
        viewOrderDetail(orderId) {
            this.$router.push(`/don-hang/${orderId}`);
        }
    }
};
</script>

<style scoped>
.hover-shadow {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}

.hover-shadow:hover {
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
}
</style>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            list_don_hang: []
        }
    },
    mounted() {
        this.getListDonHang();
    },
    methods: {
        getListDonHang() {
            axios.get("http://127.0.0.1:8000/api/client/don-hang/get-data", {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("key_client"),
                },
            })
                .then((res) => {
                    if (res.data.status) {
                        this.list_don_hang = res.data.data;
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
        },
        formatDateTime(datetimeStr) {
            const [datePart, timePart] = datetimeStr.split(' ');
            const [year, month, day] = datePart.split('-');
            return `${timePart} ${day}-${month}-${year}`;
        },
        formatVND(number) {
            return new Intl.NumberFormat("vi-VI", { style: "currency", currency: "VND" }).format(number,);
        },
    },
}
</script>
<style></style>