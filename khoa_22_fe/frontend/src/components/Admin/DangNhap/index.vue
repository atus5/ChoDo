<template>
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center mb-4">
                                    <img src="https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/" width="150" alt="" style="height: 150px; border-radius: 10px; object-fit: cover;" />
                                    <h4 class="mt-3 font-weight-bold text-uppercase text-nowrap">ĐĂNG NHẬP ADMIN <span
                                            class="text-primary">Khô gà Chộ Đó</span></h4>
                                </div>
                                <div class="form-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </span>
                                                <input v-model="thong_tin_dang_nhap.email" type="email" class="form-control border-start-0"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Mật khẩu</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="fa-solid fa-lock"></i>
                                                </span>
                                                <input v-model="thong_tin_dang_nhap.password" @keydown.enter="dangNhap()" type="password" class="form-control border-start-0"
                                                    placeholder="Mật khẩu">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button @click="dangNhap()" class="btn btn-primary">
                                                    <i class="fa-solid fa-right-to-bracket me-2"></i>
                                                    Đăng Nhập
                                                </button>
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
            thong_tin_dang_nhap : {}
        }
    },
    methods: {
        dangNhap(){
            axios.post('http://127.0.0.1:8000/api/admin/dang-nhap', this.thong_tin_dang_nhap)
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        localStorage.setItem('key_admin', res.data.token)
                        this.$router.push('/admin')
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch((err) => {
                    this.$toast.error('Không thể đăng nhập');
                    console.error('Admin login error:', err);
                });
        }
    }
}
</script>