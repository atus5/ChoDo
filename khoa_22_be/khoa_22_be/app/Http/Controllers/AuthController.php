<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Kiểm tra token hợp lệ
    public function checkToken(Request $request)
    {
        try {
            $user = $request->user();
            
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token không hợp lệ'
                ], 401);
            }

            return response()->json([
                'status' => true,
                'ho_ten' => $user->ho_va_ten,
                'email' => $user->email,
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    // Đăng ký tài khoản khách hàng
    public function dangKy(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'ho_va_ten' => 'required|string|max:255',
            'email' => 'required|email|unique:khach_hangs,email',
            'so_dien_thoai' => 'required|string|max:20',
            'cccd' => 'required|string|max:20',
            'ngay_sinh' => 'required|date',
            'password' => 'required|string|min:6',
            're_password' => 'required|string|same:password',
        ]);

        try {
            // Tạo hash kích hoạt
            $hash_active = Str::random(60);

            // Tạo khách hàng
            $khachHang = KhachHang::create([
                'ho_va_ten' => $validated['ho_va_ten'],
                'email' => $validated['email'],
                'so_dien_thoai' => $validated['so_dien_thoai'],
                'cccd' => $validated['cccd'],
                'ngay_sinh' => $validated['ngay_sinh'],
                'password' => $validated['password'], // Model sẽ tự động hash via casts
                'hash_active' => $hash_active,
                'is_active' => 1, // Auto-activate for testing (change to 0 for email activation)
                'is_block' => 0,
            ]);

            // TODO: Gửi email kích hoạt tài khoản
            // $this->sendActivationEmail($khachHang);

            return response()->json([
                'status' => true,
                'message' => 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.',
                'data' => $khachHang
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    // Đăng nhập
    public function dangNhap(Request $request)
    {
        \Log::info('dangNhap called', $request->all());
        
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        
        \Log::info('Validation passed', $validated);

        $khachHang = KhachHang::where('email', $validated['email'])->first();
        \Log::info('Found user', ['user' => $khachHang ? $khachHang->email : 'NOT FOUND']);

        if (!$khachHang || !Hash::check($validated['password'], $khachHang->password)) {
            \Log::info('Invalid credentials');
            return response()->json([
                'status' => false,
                'message' => 'Email hoặc mật khẩu không chính xác'
            ], 401);
        }

        if ($khachHang->is_block) {
            \Log::info('User is blocked');
            return response()->json([
                'status' => false,
                'message' => 'Tài khoản của bạn đã bị khóa'
            ], 403);
        }

        if (!$khachHang->is_active) {
            \Log::info('User not active');
            return response()->json([
                'status' => false,
                'message' => 'Tài khoản chưa được kích hoạt. Vui lòng kiểm tra email'
            ], 403);
        }

        // Tạo token
        $token = $khachHang->createToken('auth_token')->plainTextToken;
        \Log::info('Token created', ['token' => $token]);

        $response = response()->json([
            'status' => true,
            'message' => 'Đăng nhập thành công',
            'data' => [
                'khach_hang' => $khachHang,
                'token' => $token,
            ]
        ], 200);
        
        \Log::info('Returning response', ['status' => 200]);
        return $response;
    }

    // Kích hoạt tài khoản
    public function kichHoat($hash_active)
    {
        $khachHang = KhachHang::where('hash_active', $hash_active)->first();

        if (!$khachHang) {
            return response()->json([
                'status' => false,
                'message' => 'Link kích hoạt không hợp lệ'
            ], 404);
        }

        $khachHang->update([
            'is_active' => 1,
            'hash_active' => null,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Kích hoạt tài khoản thành công'
        ], 200);
    }

    // Quên mật khẩu
    public function quenMatKhau(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $khachHang = KhachHang::where('email', $validated['email'])->first();

        if (!$khachHang) {
            return response()->json([
                'status' => false,
                'message' => 'Email không tồn tại trong hệ thống'
            ], 404);
        }

        // Tạo hash reset
        $hash_reset = Str::random(60);
        $khachHang->update([
            'hash_reset' => $hash_reset
        ]);

        // TODO: Gửi email reset mật khẩu
        // $this->sendResetEmail($khachHang);

        return response()->json([
            'status' => true,
            'message' => 'Vui lòng kiểm tra email để đặt lại mật khẩu'
        ], 200);
    }

    // Đặt lại mật khẩu
    public function datLaiMatKhau(Request $request)
    {
        $validated = $request->validate([
            'hash_reset' => 'required|string',
            'password' => 'required|string|min:6',
            're_password' => 'required|string|same:password',
        ]);

        $khachHang = KhachHang::where('hash_reset', $validated['hash_reset'])->first();

        if (!$khachHang) {
            return response()->json([
                'status' => false,
                'message' => 'Link đặt lại mật khẩu không hợp lệ'
            ], 404);
        }

        $khachHang->password = $validated['password']; // Model sẽ tự động hash via casts
        $khachHang->hash_reset = null;
        $khachHang->save();

        return response()->json([
            'status' => true,
            'message' => 'Đặt lại mật khẩu thành công'
        ], 200);
    }

    // Đăng xuất
    public function dangXuat(Request $request)
    {
        // Xóa tất cả token của user
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Đăng xuất thành công'
        ], 200);
    }

    // Lấy thông tin khách hàng
    public function getProfile(Request $request)
    {
        $khachHang = $request->user();

        return response()->json([
            'status' => true,
            'data' => $khachHang
        ], 200);
    }

    // Cập nhật thông tin khách hàng
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'ho_va_ten' => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|max:20',
            'cccd' => 'required|string|max:20',
            'ngay_sinh' => 'required|date',
            'password' => 'nullable|string|min:6',
            'password_confirmation' => 'nullable|string|same:password',
        ]);

        $khachHang = $request->user();
        
        // Nếu có password mới thì cập nhật, nếu không thì xóa khỏi data update
        if (isset($validated['password']) && !empty($validated['password'])) {
            $khachHang->password = $validated['password'];
        }
        
        // Cập nhật thông tin khác
        $khachHang->ho_va_ten = $validated['ho_va_ten'];
        $khachHang->so_dien_thoai = $validated['so_dien_thoai'];
        $khachHang->cccd = $validated['cccd'];
        $khachHang->ngay_sinh = $validated['ngay_sinh'];
        
        $khachHang->save();

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật thông tin thành công',
            'data' => $khachHang
        ], 200);
    }

    // ========== ADMIN LOGIN ==========
    public function adminDangNhap(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = \App\Models\User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Email hoặc mật khẩu không chính xác'
            ], 401);
        }

        // Tạo token cho admin
        $token = $user->createToken('admin-token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Đăng nhập thành công',
            'token' => $token,
            'data' => $user
        ], 200);
    }

    // Check admin token
    public function adminCheckToken(Request $request)
    {
        try {
            $user = $request->user();
            
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token không hợp lệ'
                ], 401);
            }

            return response()->json([
                'status' => true,
                'name' => $user->name,
                'email' => $user->email,
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    // Admin logout
    public function adminDangXuat(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Đăng xuất thành công'
        ], 200);
    }
}
