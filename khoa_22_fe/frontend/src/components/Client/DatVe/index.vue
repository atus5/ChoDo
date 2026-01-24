<template>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Chọn Ghế</h6>
                        <table class="table table-borderless table-hover">
                            <tbody>
                                <tr>
                                    <th colspan="100%" class="bg-dark text-light fs-4 p-2 text-center">MÀN HÌNH</th>
                                </tr>
                                <tr>
                                    <th>
                                        <p class="mt-5"></p>
                                    </th>
                                </tr>
                                <template v-for="(row, key) in taoGheChoPhong" :key="key">
                                    <tr>
                                        <template v-for="(value, index) in row" :key="index">
                                            <th @click="chonGhe(value)" class="text-center">
                                                <template v-if="value.id_don_hang > 0">
                                                    <div class="border rounded shadow-sm p-1 bg-light"
                                                        style="color: #d6d6d6;">
                                                        <div class="fw-bold fs-7 ">{{ value.ten_ghe }} - {{
                                                            formatVND(value.gia_ve) }}</div>
                                                        <i class="fa-solid fa-couch  m-2" style="color: #d6d6d6;"></i>
                                                    </div>
                                                </template>
                                                <template v-else-if="value.id_don_hang == 0">
                                                    <div class="border border-dark rounded shadow-sm p-1 bg-light">
                                                        <div class="fw-bold fs-7 text-secondary">{{
                                                            value.ten_ghe }} - {{ formatVND(value.gia_ve) }}
                                                        </div>
                                                        <i class="fa-solid fa-couch  m-2 text-secondary"></i>
                                                    </div>
                                                </template>
                                                <template v-else>
                                                    <div class="border border-warning rounded shadow-sm p-1 bg-light">
                                                        <div class="fw-bold fs-7 " style="color: #f97316;">{{
                                                            value.ten_ghe }} - {{ formatVND(value.gia_ve) }}</div>
                                                        <i class="fa-solid fa-couch  m-2" style="color: #f97316;"></i>
                                                    </div>
                                                </template>
                                            </th>
                                        </template>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-1 radius-15 " style="background-color: #f97316;"></div>
                <div class="row my-3 d-flex justify-content-between">
                    <div class="col-lg-4">
                        <div class="d-flex align-items-center gap-3 mt-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded me-2" style="width: 20px; height: 20px; background-color: #d6d6d6;">
                                </div>
                                <span>Ghế đã bán</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="rounded me-2" style="width: 20px; height: 20px; background-color: #f97316;">
                                </div>
                                <span>Ghế đang chọn</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card radius-10 border-top border-0 border-5 border-success">
                    <div class="card-body">
                        <div class="mb-3">
                            <h4>Danh Sách Dịch Vụ</h4>
                        </div>
                        <div v-for="(value, index) in list_ben_trai" :key="index" class="card">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img :src="value.hinh_anh" alt="..." class="card-img "
                                        style="height: 180px; object-fit: cover;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ value.ten_dich_vu }}</h5>
                                        <p class="card-text">{{ value.mo_ta }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="card-text fw-bold mb-0">Giá: {{ formatVND(value.gia) }}</p>
                                            <button @click="themDichvu(value)" class="btn btn-outline-primary">Thêm dịch
                                                vụ</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card radius-10 border-top border-0 border-5 border-warning">
                    <div class="card-body">
                        <div class="d-flex mb-2">
                            <img :src="thong_tin_phim.hinh_anh" alt="Poster phim" class="img-fluid rounded me-3"
                                style="width: 150px; height: 270px; object-fit: cover;">
                            <div>
                                <h6 class="mb-1 fw-bold">{{ thong_tin_phim.ten_phim }}</h6>
                                <p class="mb-1 text-muted small">{{ thong_tin_phim.ngon_ngu }}</p>
                            </div>
                        </div>
                        <p class="mb-3">Suất chiếu: <strong>{{ thong_tin_phim.thoi_gian_bat_dau }}</strong> -
                            <strong>{{ formatDate(thong_tin_phim.ngay_chieu) }}</strong>
                        </p>
                        <hr class="my-2" style="border: 1px dashed;">
                        <!-- v-for ghế  -->
                        <template v-for="(value, index) in list_ben_phai" :key="index">
                            <template v-if="value.type == 1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>Ghế {{ value.ten_ghe }}</div>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">{{ formatVND(value.gia_ve) }}</div>
                                        <i @click="xoaBo(value)"
                                            class="fa-solid fa-rectangle-xmark fa-2x text-danger"></i>
                                    </div>
                                </div>
                                <hr class="my-2" style="border: 1px dashed;">
                            </template>
                        </template>

                        <!-- v-for dịch vụ -->
                        <template v-for="(value, index) in list_ben_phai" :key="index">
                            <template v-if="value.type == 2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>{{ value.ten_ghe }}</div>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">{{ formatVND(value.gia_ve) }}</div>
                                        <i @click="xoaBo(value)"
                                            class="fa-solid fa-rectangle-xmark fa-2x text-danger"></i>
                                    </div>
                                </div>
                                <hr class="my-2" style="border: 1px dashed;">
                            </template>
                        </template>
                        <div class="d-flex justify-content-start mt-1">
                            <input v-model="ma_voucher" type="text" class="form-control me-4"
                                placeholder="Nhập vào mã voucher">
                            <button v-on:click="thongTinVoucher()" class="btn btn-info text-light text-nowrap">Áp
                                Dụng</button>
                        </div>
                        <hr class="my-2" style="border: 1px dashed;">
                        <div class="d-flex justify-content-between">
                            <strong>Tổng cộng</strong>
                            <strong class="text-danger">{{ formatVND(tongCong) }}</strong>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                            </div>
                            <div class="col-lg-6">
                                <button v-if="!loading" @click="thanhToan" class="btn btn-warning w-100" :disabled="list_ben_phai.length == 0">
                                    Thanh Toán
                                </button>

                                <button v-else class="btn btn-success w-100" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    Đang xử lý...
                                </button>
                            </div>

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
    props: ['id_suat_chieu'],
    data() {
        return {
            id_suat_chieu: this.$route.params.id_suat_chieu,
            ghes: [],
            suatChieu: {},
            phim: {},
            danhSachGheChon: [],
            loading: false,
            list_ben_trai: [],
            list_ben_phai: [],
            thong_tin_phim: {},
            ma_voucher: '',
        }
    },
    mounted() {
        this.loadGheAndSuatChieu();
        this.loadDichVu();
    },
    computed: {
        taoGheChoPhong() {
            if (!this.ghes.length) return [];
            const soGheCot = 8;
            let a = [];
            for (let i = 0; i < this.ghes.length; i += soGheCot) {
                a.push(this.ghes.slice(i, i + soGheCot));
            }
            return a;
        },
        tongCong() {
            return this.danhSachGheChon.length * 50000; // Giá vé mặc định 50k (có thể lấy từ DB)
        }
    },
    methods: {
        loadGheAndSuatChieu() {
            axios.get(`http://127.0.0.1:8000/api/client/suat-chieu/${this.id_suat_chieu}/ghe`, {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('key_client')
                }
            })
                .then((res) => {
                    if (res.data.status) {
                        this.ghes = res.data.data.ghes;
                        this.suatChieu = res.data.data.suat_chieu;
                        this.loadThongTinPhim();
                    } else {
                        this.$toast.error(res.data.message);
                        this.$router.push('/phim/dang-chieu');
                    }
                })
                .catch((err) => {
                    this.$toast.error('Không thể tải thông tin suất chiếu');
                    this.$router.push('/phim/dang-chieu');
                });
        },
        loadDichVu() {
            axios.get('http://127.0.0.1:8000/api/client/dich-vu/get-data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_ben_trai = res.data.data;
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch((err) => {
                    this.$toast.error('Không thể tải danh sách dịch vụ');
                    console.error('Load dich vu error:', err);
                });
        },
        loadThongTinPhim() {
            axios.get(`http://127.0.0.1:8000/api/client/phim/${this.suatChieu.id_phim}`)
                .then((res) => {
                    if (res.data.status) {
                        this.thong_tin_phim = res.data.data;
                    }
                })
                .catch((err) => {
                    console.error('Load thong tin phim error:', err);
                });
        },
        chonGhe(ghe) {
            if (ghe.is_booked) {
                this.$toast.error('Ghế này đã được đặt');
                return;
            }

            const index = this.danhSachGheChon.findIndex(g => g.id === ghe.id);
            if (index > -1) {
                this.danhSachGheChon.splice(index, 1);
            } else {
                this.danhSachGheChon.push(ghe);
            }
        },
        thanhToan() {
            if (this.danhSachGheChon.length === 0) {
                this.$toast.error('Vui lòng chọn ít nhất một ghế');
                return;
            }

            this.loading = true;
            const payload = {
                id_suat_chieu: this.id_suat_chieu,
                danh_sach_ghe: this.danhSachGheChon.map(g => g.ten_ghe),
                tong_tien: this.tongCong,
            };

            axios.post('http://127.0.0.1:8000/api/client/dat-ve', payload, {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('key_client')
                }
            })
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        setTimeout(() => {
                            this.$router.push('/client/don-hang');
                        }, 1500);
                    } else {
                        this.$toast.error(res.data.message);
                    }
                    this.loading = false;
                })
                .catch((err) => {
                    const message = err.response?.data?.message || 'Có lỗi xảy ra';
                    this.$toast.error(message);
                    this.loading = false;
                });
        },
        themDichvu(dichVu) {
            const item = {
                type: 2,
                ten_ghe: dichVu.ten_dich_vu,
                gia_ve: dichVu.gia,
                id_dich_vu: dichVu.id
            };
            this.list_ben_phai.push(item);
            this.$toast.success('Đã thêm dịch vụ ' + dichVu.ten_dich_vu);
        },
        xoaBo(item) {
            const index = this.list_ben_phai.findIndex(i => i.id_dich_vu === item.id_dich_vu && i.type === 2);
            if (index > -1) {
                this.list_ben_phai.splice(index, 1);
                this.$toast.success('Đã xóa dịch vụ');
            }
        },
        thongTinVoucher() {
            if (!this.ma_voucher) {
                this.$toast.error('Vui lòng nhập mã voucher');
                return;
            }
            axios.get('http://127.0.0.1:8000/api/client/voucher/' + this.ma_voucher)
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success('Mã voucher hợp lệ: Giảm ' + res.data.data.khuyen_mai + '%');
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch((err) => {
                    this.$toast.error('Mã voucher không tồn tại hoặc hết hạn');
                });
        },
        formatVND(number) {
            return new Intl.NumberFormat("vi-VI", { style: "currency", currency: "VND" }).format(number);
        },
        formatDate(date) {
            const thuVN = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'];
            const d = new Date(date);
            return `${thuVN[d.getDay()]}, ngày ${d.getDate()}/${d.getMonth() + 1}/${d.getFullYear()}`;
        }
    },
}
</script>
<style></style>