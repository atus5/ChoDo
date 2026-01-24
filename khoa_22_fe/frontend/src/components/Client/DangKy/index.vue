<template>
    <div class="d-flex align-items-center justify-content-center my-5 my-lg-0"
        style="background-position: center; height: 100vh;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="my-4 text-center"></div>
                    <div class="card d-flex">
                        <div class="card-body flex-full">
                            <div class="border p-4 rounded">
                                <div class="text-center">
                                    <h3 class="text-uppercase ">Đăng ký tài khoản <b class="text-primary">Khô gà Chộ Đó</b>
                                    </h3>
                                    <p>Bạn đã có tài khoản?
                                        <router-link to="/client/dang-nhap">
                                            <a href="/client/dang-nhap">Đăng nhập tại đây</a>
                                        </router-link>
                                    </p>
                                </div>
                                <div class="form-body">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <label class="form-label">Họ và tên</label>
                                            <input v-model="user.ho_va_ten" type="text" class="form-control">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputEmailAddress" class="form-label">Email</label>
                                            <input v-model="user.email" type="email" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">Số điện thoại</label>
                                            <input v-model="user.so_dien_thoai" type="text" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">Số CCCD</label>
                                            <input v-model="user.cccd" type="text" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">Ngày Sinh</label>
                                            <input v-model="user.ngay_sinh" type="date" class="form-control"
                                                min="1900-01-01" max="2025-12-31">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Mật khẩu</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input v-model="user.password"
                                                    :type="showPassword ? 'text' : 'password'"
                                                    class="form-control border-end-0">
                                                <a href="javascript:;" class="input-group-text bg-transparent"
                                                    @click="showPassword = !showPassword">
                                                    <i :class="showPassword ? 'bx bx-show' : 'bx bx-hide'"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Nhập Lại Mật khẩu</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input v-model="user.re_password"
                                                    :type="showRePassword ? 'text' : 'password'"
                                                    class="form-control border-end-0">
                                                <a href="javascript:;" class="input-group-text bg-transparent"
                                                    @click="showRePassword = !showRePassword">
                                                    <i :class="showRePassword ? 'bx bx-show' : 'bx bx-hide'"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-switch">
                                                <input v-model="user.terms_accepted" class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckChecked">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Bằng việc
                                                    đăng ký tài khoản, tôi đồng ý với Điều khoản dịch vụ &amp; Chính
                                                    sách bảo mật của <b>Khô gà Chộ Đó</b>.</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button v-if="!isLoading" @click="dangKyTaiKhoan()" type="submit"
                                                    class="btn btn-success text-uppercase"><i class="bx bx-user"></i>
                                                    Đăng Ký</button>
                                                <button v-if="isLoading" class="btn btn-success" type="button" disabled>
                                                    <span class="spinner-border spinner-border-sm" role="status"
                                                        aria-hidden="true"></span>
                                                    Đang xử lý...</button>
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
import axios from 'axios'
export default {
    data() {
        return {
            user: {},
            showRePassword: false,
            showPassword: false,
            isLoading: false
        }
    },
    methods: {
        dangKyTaiKhoan() {
            // Validate required fields
            if (!this.user.ho_va_ten) {
                this.$toast.error('Vui lòng nhập họ và tên');
                return;
            }
            if (!this.user.email) {
                this.$toast.error('Vui lòng nhập email');
                return;
            }
            if (!this.user.so_dien_thoai) {
                this.$toast.error('Vui lòng nhập số điện thoại');
                return;
            }
            if (!this.user.cccd) {
                this.$toast.error('Vui lòng nhập số CCCD');
                return;
            }
            if (!this.user.ngay_sinh) {
                this.$toast.error('Vui lòng chọn ngày sinh');
                return;
            }
            if (!this.user.password) {
                this.$toast.error('Vui lòng nhập mật khẩu');
                return;
            }
            if (!this.user.re_password) {
                this.$toast.error('Vui lòng nhập lại mật khẩu');
                return;
            }
            if (this.user.password !== this.user.re_password) {
                this.$toast.error('Mật khẩu nhập lại không khớp');
                return;
            }
            if (this.user.password.length < 6) {
                this.$toast.error('Mật khẩu phải có ít nhất 6 ký tự');
                return;
            }
            if (!this.user.terms_accepted) {
                this.$toast.error('Vui lòng đồng ý với điều khoản dịch vụ');
                return;
            }

            this.isLoading = true;
            console.log('Dữ liệu gửi:', this.user);
            axios.post('http://127.0.0.1:8000/api/client/dang-ky', this.user)
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        // Reset form
                        this.user = {};
                        // Chuyển hướng sau 2 giây
                        setTimeout(() => {
                            this.$router.push('/client/dang-nhap');
                        }, 2000);
                    } else {
                        this.$toast.error(res.data.message || 'Đăng ký tài khoản thất bại');
                    }
                    this.isLoading = false;
                })
                .catch((err) => {
                    this.isLoading = false;
                    if (err.response && err.response.data && err.response.data.errors) {
                        const listErr = err.response.data.errors;
                        Object.values(listErr).forEach((error) => {
                            this.$toast.error(error[0]);
                        });
                    } else if (err.response && err.response.data && err.response.data.message) {
                        this.$toast.error(err.response.data.message);
                    } else {
                        this.$toast.error('Có lỗi xảy ra khi đăng ký. Vui lòng thử lại!');
                    }
                });
        }
    },
}
</script>
<style></style>