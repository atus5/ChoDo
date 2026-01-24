<template>
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center">
                                    <h3 class="text-uppercase">Đăng Nhập <span
                                            class="text-primary fw-bold">Khô gà Chộ Đó</span></h3>
                                    <p>Bạn chưa có tài khoản?
                                        <router-link to="/client/dang-ky">
                                            <a href="/client/dang-ky">Đăng ký ngay</a>
                                        </router-link>
                                    </p>
                                </div>
                                <div class="d-grid">
                                    <a class="btn my-3 shadow-sm btn-white" href="javascript:;"> <span
                                            class="d-flex justify-content-center align-items-center">
                                            <img class="me-2" src="../../../assets/images/icons/search.svg" width="16"
                                                alt="Image Description">
                                            <span>Đăng nhập bằng Google</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="login-separater text-center mb-4">
                                    <span>OR</span>
                                    <hr>
                                </div>
                                <div class="form-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </span>
                                                <input v-model="thong_tin_dang_nhap.email" type="email"
                                                    class="form-control border-start-0" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Mật khẩu</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="fa-solid fa-lock"></i>
                                                </span>
                                                <input v-model="thong_tin_dang_nhap.password" @keydown.enter="dangNhap()" type="password"
                                                    class="form-control border-start-0" placeholder="Mật khẩu">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <router-link to="/client/quen-mat-khau">
                                                Quên mật khẩu
                                            </router-link>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button v-on:click="dangNhap()" class="btn btn-success btn-pill"><i
                                                        class="bx bxs-lock-open"></i>Đăng Nhập</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            thong_tin_dang_nhap: {}
        }
    },
    methods: {
        dangNhap() {
            console.log('Gửi request đăng nhập:', this.thong_tin_dang_nhap);
            axios.post('http://127.0.0.1:8000/api/client/dang-nhap', this.thong_tin_dang_nhap)
                .then((res) => {
                    console.log('=== RESPONSE ĐĂNG NHẬP ===');
                    console.log('res.data:', res.data);
                    console.log('res.data.data:', res.data.data);
                    console.log('res.data.data.token:', res.data.data?.token);
                    console.log('res.data.token:', res.data.token);
                    
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        
                        // Token ở res.data.data.token
                        const token = res.data.data?.token || res.data.token;
                        console.log('Token nhận được:', token);
                        
                        if (token) {
                            localStorage.setItem('key_client', token);
                            console.log('Token đã lưu vào localStorage:', localStorage.getItem('key_client'));
                        } else {
                            console.error('Token không tìm thấy trong response!');
                            this.$toast.error('Lỗi: Token không được trả về từ server');
                            return;
                        }
                        
                        // Chuyển hướng sau 1 giây
                        setTimeout(() => {
                            this.$router.push('/');
                        }, 1000);
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch((err) => {
                    console.log('Lỗi 403:', err.response?.data);
                    if (err.response?.data?.message) {
                        this.$toast.error(err.response.data.message);
                    } else {
                        this.$toast.error('Đăng nhập thất bại');
                    }
                });
        }
    },
}
</script>
<style></style>