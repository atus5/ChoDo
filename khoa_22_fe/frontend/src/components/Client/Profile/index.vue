<template>
	<div class="profile-wrapper" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 40px 0;">
		<div class="container">
			<!-- Header Section -->
			<div class="row mb-4">
				<div class="col-lg-12">
					<div class="profile-header text-white text-center mb-5">
					<img src="https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/"
							alt="Avatar" class="profile-avatar mb-3" style="width: 120px; height: 120px; border-radius: 50%; border: 4px solid white; object-fit: cover;">
						<h1 class="display-5 fw-bold mb-2">{{ user.ho_va_ten || 'Người dùng' }}</h1>
						<p class="fs-5 text-light">{{ user.email || 'email@example.com' }}</p>
					</div>
				</div>
			</div>

			<!-- Tabs Navigation -->
			<div class="row">
				<div class="col-lg-12">
					<ul class="nav nav-tabs custom-nav-tabs mb-4" id="profileTabs" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active fw-bold" id="profile-tab" data-bs-toggle="tab" 
								data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
								<i class="bx bx-user me-2"></i>Thông Tin Cá Nhân
							</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link fw-bold" id="password-tab" data-bs-toggle="tab" 
								data-bs-target="#password" type="button" role="tab" aria-controls="password" aria-selected="false">
								<i class="bx bx-lock-alt me-2"></i>Đổi Mật Khẩu
							</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link fw-bold" id="history-tab" data-bs-toggle="tab" 
								data-bs-target="#history" type="button" role="tab" aria-controls="history" aria-selected="false">
								<i class="bx bx-history me-2"></i>Lịch Sử Giao Dịch
							</button>
						</li>
					</ul>
				</div>
			</div>

			<!-- Tab Content -->
			<div class="tab-content" id="profileTabContent">
				<!-- Profile Tab -->
				<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="row">
						<div class="col-lg-8 offset-lg-2">
							<div class="card shadow-lg border-0 rounded-4">
								<div class="card-body p-4">
									<h3 class="card-title mb-4 fw-bold text-primary">Cập Nhật Thông Tin</h3>
									
									<form @submit.prevent="capNhatThongTin">
										<!-- Row 1: Full Name & Email -->
										<div class="row mb-4">
											<div class="col-md-6">
												<label class="form-label fw-bold text-secondary mb-2">Họ và Tên</label>
												<div class="input-group input-group-lg">
													<span class="input-group-text bg-light border-0">
														<i class="bx bx-user text-primary"></i>
													</span>
													<input type="text" class="form-control border-0 bg-light ps-2" 
														v-model="user.ho_va_ten" placeholder="Nhập họ và tên" required>
												</div>
											</div>
											<div class="col-md-6">
												<label class="form-label fw-bold text-secondary mb-2">Email</label>
												<div class="input-group input-group-lg">
													<span class="input-group-text bg-light border-0">
														<i class="bx bx-envelope text-primary"></i>
													</span>
													<input type="email" class="form-control border-0 bg-light ps-2" 
														v-model="user.email" disabled placeholder="Email">
												</div>
											</div>
										</div>

										<!-- Row 2: Date & Phone -->
										<div class="row mb-4">
											<div class="col-md-6">
												<label class="form-label fw-bold text-secondary mb-2">Ngày Sinh</label>
												<div class="input-group input-group-lg">
													<span class="input-group-text bg-light border-0">
														<i class="bx bx-calendar text-primary"></i>
													</span>
													<input type="date" class="form-control border-0 bg-light ps-2" 
														v-model="user.ngay_sinh" required>
												</div>
											</div>
											<div class="col-md-6">
												<label class="form-label fw-bold text-secondary mb-2">Số Điện Thoại</label>
												<div class="input-group input-group-lg">
													<span class="input-group-text bg-light border-0">
														<i class="bx bx-phone text-primary"></i>
													</span>
													<input type="tel" class="form-control border-0 bg-light ps-2" 
														v-model="user.so_dien_thoai" maxlength="10" placeholder="Số điện thoại" required>
												</div>
											</div>
										</div>

										<!-- Row 3: CCCD -->
										<div class="row mb-4">
											<div class="col-md-12">
												<label class="form-label fw-bold text-secondary mb-2">CCCD / Số Chứng Minh</label>
												<div class="input-group input-group-lg">
													<span class="input-group-text bg-light border-0">
														<i class="bx bx-id-card text-primary"></i>
													</span>
													<input type="text" class="form-control border-0 bg-light ps-2" 
														v-model="user.cccd" placeholder="Nhập số CCCD" required>
												</div>
											</div>
										</div>

										<!-- Submit Button -->
										<div class="d-grid gap-2">
											<button type="submit" class="btn btn-primary btn-lg fw-bold rounded-3">
												<i class="bx bx-check-circle me-2"></i>Cập Nhật Thông Tin
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Password Tab -->
				<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
					<div class="row">
						<div class="col-lg-8 offset-lg-2">
							<div class="card shadow-lg border-0 rounded-4">
								<div class="card-body p-4">
									<h3 class="card-title mb-4 fw-bold text-primary">Đổi Mật Khẩu</h3>
									
									<form @submit.prevent="doiMatKhau">
										<!-- New Password -->
										<div class="mb-4">
											<label class="form-label fw-bold text-secondary mb-2">Mật Khẩu Mới</label>
											<div class="input-group input-group-lg">
												<span class="input-group-text bg-light border-0">
													<i class="bx bx-lock text-primary"></i>
												</span>
												<input :type="isShow ? 'text' : 'password'" class="form-control border-0 bg-light ps-2" 
													v-model="doi_mat_khau.new_password" placeholder="Nhập mật khẩu mới" required>
												<button type="button" class="btn btn-outline-secondary border-0 bg-light"
													@click="doiMat()">
													<i :class="isShow ? 'bx bx-hide' : 'bx bx-show'"></i>
												</button>
											</div>
										</div>

										<!-- Confirm Password -->
										<div class="mb-4">
											<label class="form-label fw-bold text-secondary mb-2">Xác Nhận Mật Khẩu</label>
											<div class="input-group input-group-lg">
												<span class="input-group-text bg-light border-0">
													<i class="bx bx-lock-open text-primary"></i>
												</span>
												<input :type="isShow ? 'text' : 'password'" class="form-control border-0 bg-light ps-2" 
													v-model="doi_mat_khau.confirm_password" placeholder="Xác nhận mật khẩu mới" required>
												<button type="button" class="btn btn-outline-secondary border-0 bg-light"
													@click="doiMat()">
													<i :class="isShow ? 'bx bx-hide' : 'bx bx-show'"></i>
												</button>
											</div>
										</div>

										<!-- Forgot Password Link -->
										<div class="mb-4">
											<router-link to="/client/quen-mat-khau" class="text-decoration-none text-primary fw-bold">
												<i class="bx bx-help-circle me-1"></i>Quên mật khẩu?
											</router-link>
										</div>

										<!-- Submit Button -->
										<div class="d-grid gap-2">
											<button type="submit" class="btn btn-success btn-lg fw-bold rounded-3">
												<i class="bx bx-check-circle me-2"></i>Đổi Mật Khẩu
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- History Tab -->
				<div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
					<div class="row">
						<div class="col-lg-12">
							<div class="card shadow-lg border-0 rounded-4">
								<div class="card-body p-4">
									<h3 class="card-title mb-4 fw-bold text-primary">Lịch Sử Giao Dịch</h3>
									
									<div v-if="ls_don_hang.length > 0" class="table-responsive">
										<table class="table table-hover mb-0">
											<thead class="table-light">
												<tr>
													<th class="fw-bold">#</th>
													<th class="fw-bold">Mã Đơn Hàng</th>
													<th class="fw-bold">Ngày Đặt</th>
													<th class="fw-bold">Tiền</th>
													<th class="fw-bold">Trạng Thái</th>
												</tr>
											</thead>
											<tbody>
												<tr v-for="(value, index) in ls_don_hang" :key="index">
													<td class="text-muted">{{ index + 1 }}</td>
													<td class="fw-bold">{{ value.ma_don_hang }}</td>
													<td>{{ formatdate(value.ngay_dat) }}</td>
													<td class="text-success fw-bold">{{ formatCurrency(value.tong_tien) }}</td>
													<td>
														<span class="badge bg-info text-dark">
															{{ value.trang_thai || 'Chờ xử lý' }}
														</span>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div v-else class="text-center py-5">
										<i class="bx bx-inbox text-muted" style="font-size: 48px;"></i>
										<p class="text-muted mt-3">Bạn chưa có giao dịch nào</p>
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
			user: {},
			doi_mat_khau: {},
			isShow: false,
			ls_don_hang: [],
		}
	},
	mounted() {
		this.getThongTin();
		this.lsDonHang();
	},
	methods: {
		doiMat() {
			this.isShow = !this.isShow
		},
		formatdate(thoi_gian) {
			const date = new Date(thoi_gian);
			return date.toLocaleDateString('vi-VN', { timeZone: 'Asia/Ho_Chi_Minh' });
		},
		formatCurrency(value) {
			if (!value) return '0 ₫';
			return new Intl.NumberFormat('vi-VN', {
				style: 'currency',
				currency: 'VND'
			}).format(value);
		},
		getThongTin() {
			const token = localStorage.getItem("key_client");
			if (!token) {
				this.$router.push("/client/dang-nhap");
				return;
			}
			axios
				.get('http://127.0.0.1:8000/api/client/thong-tin', {
					headers: {
						Authorization: 'Bearer ' + token
					}
				})
				.then((res) => {
					if (res.data.status) {
						this.user = res.data.data;
					}
				})
				.catch((error) => {
					console.error('Lỗi lấy thông tin:', error);
					this.$toast.error('Không thể lấy thông tin cá nhân');
				});
		},
		doiMatKhau() {
			const token = localStorage.getItem("key_client");
			if (!token) {
				this.$toast.error("Vui lòng đăng nhập");
				return;
			}

			// Validate
			if (!this.doi_mat_khau.new_password || !this.doi_mat_khau.confirm_password) {
				this.$toast.error("Vui lòng nhập mật khẩu mới và xác nhận");
				return;
			}

			if (this.doi_mat_khau.new_password !== this.doi_mat_khau.confirm_password) {
				this.$toast.error("Mật khẩu xác nhận không trùng khớp");
				return;
			}

			axios
				.post('http://127.0.0.1:8000/api/client/profile', {
					ho_va_ten: this.user.ho_va_ten,
					so_dien_thoai: this.user.so_dien_thoai,
					cccd: this.user.cccd,
					ngay_sinh: this.user.ngay_sinh,
					password: this.doi_mat_khau.new_password,
					password_confirmation: this.doi_mat_khau.confirm_password
				}, {
					headers: {
						Authorization: 'Bearer ' + token
					}
				})
				.then((res) => {
					if (res.data.status) {
						this.$toast.success(res.data.message);
						this.doi_mat_khau = {};
					} else {
						this.$toast.error(res.data.message);
					}
				})
				.catch((error) => {
					console.error('Lỗi:', error);
					this.$toast.error('Có lỗi xảy ra');
				});
		},
		lsDonHang() {
			axios
				.get("http://127.0.0.1:8000/api/client/don-hang", {
					headers: {
						Authorization: 'Bearer ' + localStorage.getItem("key_client")
					}
				})
				.then((res) => {
					if (res.data.status) {
						this.ls_don_hang = res.data.data;
					} else {
						this.$toast.error(res.data.message, "Lỗi", {
							timeOut: 5000,
						});
					}
				})
				.catch((error) => {
					console.error('Lỗi lấy lịch sử:', error);
				});
		},
		capNhatThongTin() {
			const token = localStorage.getItem("key_client");
			if (!token) {
				this.$toast.error("Vui lòng đăng nhập");
				this.$router.push("/client/dang-nhap");
				return;
			}

			// Validate dữ liệu
			if (!this.user.ho_va_ten || !this.user.so_dien_thoai || !this.user.cccd || !this.user.ngay_sinh) {
				this.$toast.error("Vui lòng điền đầy đủ thông tin");
				return;
			}

			axios
				.post('http://127.0.0.1:8000/api/client/profile', {
					ho_va_ten: this.user.ho_va_ten,
					so_dien_thoai: this.user.so_dien_thoai,
					cccd: this.user.cccd,
					ngay_sinh: this.user.ngay_sinh
				}, {
					headers: {
						Authorization: 'Bearer ' + token
					}
				})
				.then((res) => {
					if (res.data.status) {
						this.$toast.success(res.data.message);
						this.user = res.data.data;
					} else {
						this.$toast.error(res.data.message);
					}
				})
				.catch((error) => {
					console.error('Lỗi:', error);
					this.$toast.error('Có lỗi xảy ra khi cập nhật');
				});
		}

	},
}
</script>
<style scoped>
.profile-wrapper {
	background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
	min-height: 100vh;
}

.profile-header {
	text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
	animation: fadeInDown 0.6s ease-out;
}

.profile-avatar {
	box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
	animation: fadeInUp 0.6s ease-out;
}

.custom-nav-tabs {
	border-bottom: 2px solid rgba(255, 255, 255, 0.3);
	background: rgba(255, 255, 255, 0.1);
	border-radius: 10px;
	padding: 5px;
	gap: 10px;
}

.custom-nav-tabs .nav-link {
	color: rgba(255, 255, 255, 0.8) !important;
	border: none;
	border-radius: 8px;
	transition: all 0.3s ease;
	padding: 12px 20px;
}

.custom-nav-tabs .nav-link:hover {
	color: white !important;
	background: rgba(255, 255, 255, 0.2);
	transform: translateY(-2px);
}

.custom-nav-tabs .nav-link.active {
	background: white !important;
	color: #667eea !important;
	box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.card {
	transition: all 0.3s ease;
	border-radius: 1rem !important;
}

.card:hover {
	transform: translateY(-5px);
	box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2) !important;
}

.form-control, .form-label {
	transition: all 0.3s ease;
}

.form-control {
	border-radius: 8px !important;
	height: 50px;
	font-size: 15px;
}

.form-control:focus {
	box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3) !important;
	border-color: #667eea !important;
	transform: scale(1.02);
}

.input-group-text {
	border-radius: 8px 0 0 8px !important;
}

.btn {
	border-radius: 8px !important;
	transition: all 0.3s ease;
	font-weight: 500;
	letter-spacing: 0.5px;
}

.btn-primary {
	background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
	border: none;
	box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

.btn-primary:hover {
	transform: translateY(-3px);
	box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
}

.btn-success {
	background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
	border: none;
	box-shadow: 0 5px 15px rgba(245, 87, 108, 0.3);
}

.btn-success:hover {
	transform: translateY(-3px);
	box-shadow: 0 8px 25px rgba(245, 87, 108, 0.5);
}

.table-hover tbody tr:hover {
	background-color: #f8f9ff !important;
	transform: scale(1.01);
}

.badge {
	padding: 8px 12px !important;
	border-radius: 20px;
	font-size: 12px;
	font-weight: 600;
}

@keyframes fadeInDown {
	from {
		opacity: 0;
		transform: translateY(-20px);
	}
	to {
		opacity: 1;
		transform: translateY(0);
	}
}

@keyframes fadeInUp {
	from {
		opacity: 0;
		transform: translateY(20px);
	}
	to {
		opacity: 1;
		transform: translateY(0);
	}
}

/* Responsive */
@media (max-width: 768px) {
	.profile-header h1 {
		font-size: 28px !important;
	}
	
	.custom-nav-tabs {
		flex-wrap: nowrap;
		overflow-x: auto;
	}
	
	.custom-nav-tabs .nav-link {
		padding: 10px 15px;
		font-size: 13px;
	}
	
	.col-lg-8,
	.col-lg-2,
	.offset-lg-2 {
		padding: 15px;
	}
}
</style>