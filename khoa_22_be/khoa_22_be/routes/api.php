<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChucNangController;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\TheLoaiPhimController;
use App\Http\Controllers\PhongChieuController;
use App\Http\Controllers\DichVuController;
use App\Http\Controllers\GheController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\PhimController;
use App\Http\Controllers\SuatChieuController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\VeController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\ChiTietKhoGaController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\MockPhimController;
use App\Http\Controllers\MockChiTietKhoGaController;
use App\Http\Controllers\ChiTietKhoGaDbController;
use App\Http\Controllers\MockDonHangController;
use App\Http\Controllers\KhoGaSapBanController;
use App\Http\Controllers\LichSuDatHangController;

// Auth - Client
Route::post('/client/dang-ky', [AuthController::class, 'dangKy']);
Route::post('/client/dang-nhap', [AuthController::class, 'dangNhap']);
Route::post('/client/kich-hoat/{hash_active}', [AuthController::class, 'kichHoat']);
Route::post('/client/quen-mat-khau', [AuthController::class, 'quenMatKhau']);
Route::post('/client/dat-lai-mat-khau', [AuthController::class, 'datLaiMatKhau']);

// Auth - Admin
Route::post('/admin/dang-nhap', [AuthController::class, 'adminDangNhap']);

// Protected routes
Route::middleware('auth.api')->group(function () {
    Route::get('/client/check-token', [AuthController::class, 'checkToken']);
    Route::post('/client/dang-xuat', [AuthController::class, 'dangXuat']);
    Route::get('/client/profile', [AuthController::class, 'getProfile']);
    Route::get('/client/thong-tin', [AuthController::class, 'getProfile']); // Alias for thong-tin
    Route::post('/client/profile', [AuthController::class, 'updateProfile']);

    // Đặt vé - Client
    Route::post('/client/dat-ve', [DonHangController::class, 'datVe']);
    Route::post('/client/don-hang/create', [DonHangController::class, 'createOrder']);
    Route::get('/client/don-hang', [DonHangController::class, 'getDonHangOfUser']);
    
    // Lịch sử đơn hàng - PROTECTED
    Route::get('/client/don-hang/list-auth', [DonHangController::class, 'getOrderHistory']);

    // Lịch sử đặt hàng khô gà
    Route::get('/client/lich-su-dat-hang', [LichSuDatHangController::class, 'index']);
    Route::get('/client/lich-su-dat-hang/{id}', [LichSuDatHangController::class, 'show'])->where('id', '[0-9]+');
    Route::post('/client/lich-su-dat-hang', [LichSuDatHangController::class, 'store']);
    Route::delete('/client/lich-su-dat-hang/{id}', [LichSuDatHangController::class, 'destroy'])->where('id', '[0-9]+');
    
    // Parametric routes - MUST be last
    Route::get('/client/don-hang/{id}', [DonHangController::class, 'getOrderDetail'])->where('id', '[0-9]+');
    Route::delete('/client/don-hang/{id}', [DonHangController::class, 'huyVe'])->where('id', '[0-9]+');
});

// Client - Phim đang chiếu
Route::get('/client/home-page', [PhimController::class, 'homePage']);
Route::get('/client/phim-dang-chieu', [PhimController::class, 'getPhimDangChieu']);
Route::get('/client/phim/get-data', [PhimController::class, 'getDataClient']);
Route::get('/client/kho-ga-sap-ban/get-data', [KhoGaSapBanController::class, 'getData']);
Route::post('/client/chi-tiet-phim/get-data', [PhimController::class, 'getChiTietPhimData']);
Route::get('/client/chi-tiet-phim/get-data/{id}', [PhimController::class, 'getChiTietPhimData'])->where('id', '[0-9]+');
Route::get('/client/phim/{id}', [PhimController::class, 'getChiTietPhim']);
Route::get('/client/suat-chieu/{id}/ghe', [SuatChieuController::class, 'getGheOfSuatChieu']);

// Client - Comment/Rating
Route::post('/client/chi-tiet-phim/binh-luan', [DanhGiaController::class, 'binh_luan']);
Route::get('/client/chi-tiet-phim/binh-luan/get-data/{id_phim}', [DanhGiaController::class, 'binh_luan_get_data']);

// Client - Lấy dịch vụ
Route::get('/client/dich-vu/get-data', [DichVuController::class, 'getData']);

//Nhân Viên
Route::get('/admin/nhan-vien/get-data', [NhanVienController::class, 'getData']);
Route::post('/admin/nhan-vien/add-data', [NhanVienController::class, 'addData']);
Route::post('/admin/nhan-vien/update', [NhanVienController::class, 'update']);
Route::post('/admin/nhan-vien/delete', [NhanVienController::class, 'destroy']);

//Chức Vụ
Route::get('/admin/chuc-vu/get-data', [ChucVuController::class, 'getData']);
Route::post('/admin/chuc-vu/add-data', [ChucVuController::class, 'addData']);
Route::post('/admin/chuc-vu/update', [ChucVuController::class, 'update']);
Route::post('/admin/chuc-vu/delete', [ChucVuController::class, 'destroy']);

//Chức Năng
Route::get('/admin/chuc-nang/get-data', [ChucNangController::class, 'getData']);


//Khách Hàng
Route::get('/admin/khach-hang/get-data', [KhachHangController::class, 'getData']);


//Phim
Route::get('/admin/phim/get-data', [MockPhimController::class, 'getData']);
Route::post('/admin/phim/add-data', [PhimController::class, 'addData']);
Route::post('/admin/phim/update', [PhimController::class, 'update']);
Route::post('/admin/phim/delete', [PhimController::class, 'destroy']);
Route::post('/admin/phim/change-status', [PhimController::class, 'changeStatus']);

// Mock Chi Tiết Khô Gà (for local testing without database)
// Khô gà lấy từ database (bảng phims)
Route::get('/client/chi-tiet-kho-ga/get-data', [ChiTietKhoGaDbController::class, 'getData']);
Route::get('/client/chi-tiet-kho-ga/{id}', [ChiTietKhoGaDbController::class, 'getChiTiet']);
Route::get('/client/chi-tiet-kho-ga/dang-ban/list', [ChiTietKhoGaDbController::class, 'getDangBan']);
Route::get('/client/chi-tiet-kho-ga/sap-ban/list', [ChiTietKhoGaDbController::class, 'getSapBan']);

// Mock Đơn Hàng (for local testing - public endpoint)
Route::get('/client/don-hang/list', [MockDonHangController::class, 'getData']);

//Thể Loại Phim
Route::get('/admin/the-loai-phim/get-data', [TheLoaiPhimController::class, 'getData']);
Route::post('/admin/the-loai-phim/add-data', [TheLoaiPhimController::class, 'addData']);
Route::post('/admin/the-loai-phim/update', [TheLoaiPhimController::class, 'update']);
Route::post('/admin/the-loai-phim/delete', [TheLoaiPhimController::class, 'destroy']);
Route::post('/admin/the-loai-phim/change-status', [TheLoaiPhimController::class, 'changeStatus']);


//Phong Chieu
Route::get('/admin/phong-chieu/get-data', [PhongChieuController::class, 'getData']);
Route::post('/admin/phong-chieu/add-data', [PhongChieuController::class, 'addData']);
Route::post('/admin/phong-chieu/update', [PhongChieuController::class, 'update']);
Route::post('/admin/phong-chieu/delete', [PhongChieuController::class, 'destroy']);
Route::post('/admin/phong-chieu/change-status', [PhongChieuController::class, 'changeStatus']);


//Dịch Vụ
Route::get('/admin/dich-vu/get-data', [DichVuController::class, 'getData']);
Route::post('/admin/dich-vu/add-data', [DichVuController::class, 'addData']);
Route::post('/admin/dich-vu/update', [DichVuController::class, 'update']);
Route::post('/admin/dich-vu/delete', [DichVuController::class, 'destroy']);
Route::post('/admin/dich-vu/change-status', [DichVuController::class, 'changeStatus']);


//Voucher
Route::get('/admin/voucher/get-data', [VoucherController::class, 'getData']);
Route::post('/admin/voucher/add-data', [VoucherController::class, 'addData']);
Route::post('/admin/voucher/update', [VoucherController::class, 'update']);
Route::post('/admin/voucher/delete', [VoucherController::class, 'destroy']);


//Suất Chiếu
Route::get('/admin/suat-chieu/get-data', [SuatChieuController::class, 'getData']);
Route::post('/admin/suat-chieu/add-data', [SuatChieuController::class, 'addData']);
Route::post('/admin/suat-chieu/update', [SuatChieuController::class, 'update']);
Route::post('/admin/suat-chieu/delete', [SuatChieuController::class, 'destroy']);
Route::post('/admin/suat-chieu/change-status', [SuatChieuController::class, 'changeStatus']);


//Vé
Route::get('/admin/ve/get-data', [VeController::class, 'getData']);
Route::post('/admin/ve/add-data', [VeController::class, 'addData']);
Route::post('/admin/ve/update', [VeController::class, 'update']);
Route::post('/admin/ve/delete', [VeController::class, 'destroy']);
Route::post('/admin/ve/change-status', [VeController::class, 'changeStatus']);

// Đơn hàng - Admin
Route::get('/admin/don-hang/get-data', [DonHangController::class, 'getData']);
Route::post('/admin/don-hang/add-data', [DonHangController::class, 'addData']);
Route::post('/admin/don-hang/update', [DonHangController::class, 'update']);
Route::post('/admin/don-hang/delete', [DonHangController::class, 'destroy']);

// Ghế
Route::get('/admin/ghe/get-data', [GheController::class, 'getData']);
Route::post('/admin/ghe/add-data', [GheController::class, 'addData']);
Route::post('/admin/ghe/update', [GheController::class, 'update']);
Route::post('/admin/ghe/delete', [GheController::class, 'destroy']);


// Tin Tức
Route::get('/admin/tin-tuc/get-data', [TinTucController::class, 'getData']);
Route::post('/admin/tin-tuc/add-data', [TinTucController::class, 'addData']);
Route::post('/admin/tin-tuc/update', [TinTucController::class, 'update']);

// Protected Admin routes
Route::middleware('auth.api')->group(function () {
    Route::get('/admin/check-token', [AuthController::class, 'adminCheckToken']);
    Route::get('/admin/dang-xuat', [AuthController::class, 'adminDangXuat']);
});
Route::post('/admin/tin-tuc/delete', [TinTucController::class, 'destroy']);
Route::post('/admin/tin-tuc/change-status', [TinTucController::class, 'changeStatus']);
