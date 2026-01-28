<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use App\Models\ChiTietKhoGa;
use Illuminate\Http\Request;

class ChiTietKhoGaDbController extends Controller
{
    private function mapKhoGaModel($product)
    {
        if (!$product) {
            return null;
        }

        $defaultImage  = 'https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/';
        $defaultBrand  = 'Chộ Đó';
        $defaultOrigin = '120 Yên Lãng';

        $flavors = ['Cay siêu cấp', 'Vàng ươm', 'Nướng thơm', 'Chua cay', 'Mặn nhẹ', 'Tây Bắc', 'Đặc biệt'];
        $weights = ['150g', '200g', '250g', '300g', '400g', '500g', '750g', '1kg'];
        $ingredients = [
            'Ức gà xé, lá chanh, sa tế, ớt sừng',
            'Đùi gà nướng, hành phi, tỏi Lý Sơn, ớt hiểm',
            'Ức gà, tiêu xanh Phú Quốc, lá chanh, mật ong',
            'Gà ta, sả, ớt xiêm, lá chanh, muối thảo mộc',
            'Ức gà, paprika, tiêu đen, hành phi, lá nguyệt quế',
            'Ức gà hữu cơ, tỏi đen, ớt bột Hàn, lá oregano',
            'Ức gà xông khói, ngò rí, tiêu hạt, ớt chuông'
        ];

        $flavorIndex     = $product->id % count($flavors);
        $weightIndex     = $product->id % count($weights);
        $ingredientIndex = $product->id % count($ingredients);

        $rawImage  = trim((string) ($product->hinh_anh ?? ''));
        $isHttp    = preg_match('/^https?:\/\//i', $rawImage);
        $isStorage = str_starts_with($rawImage, '/') || str_starts_with($rawImage, 'storage/');
        $image     = ($isHttp || $isStorage) && $rawImage !== '' ? $rawImage : $defaultImage;

        return [
            'id'           => $product->id,
            'ten_kho_ga'   => $product->ten_kho_ga,
            'mo_ta'        => $product->mo_ta,
            'noi_dung'     => $product->noi_dung ?? $product->mo_ta,
            'hinh_anh'     => $image,
            'gia'          => $product->gia,
            'tinh_trang'   => $product->tinh_trang,
            'loai_vi'      => $product->loai_vi ?: $flavors[$flavorIndex],
            'kich_thuoc'   => $product->kich_thuoc ?: $weights[$weightIndex],
            'nha_cung_cap' => $product->nha_cung_cap ?? $defaultBrand,
            'quoc_gia'     => $product->quoc_gia ?? $defaultOrigin,
            'thanh_phan'   => $product->thanh_phan ?? $ingredients[$ingredientIndex],
            'cong_ty'      => $product->cong_ty ?? $product->nha_cung_cap ?? $defaultBrand,
            'the_loai'     => $product->the_loai ?? null,
        ];
    }

    private function mapPhimToKhoGa($phim)
    {
        if (!$phim) {
            return null;
        }

        $defaultImage = 'https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/';
        $defaultBrand = 'Chộ Đó';
        $defaultOrigin = '120 Yên Lãng';

        // Tạo thông tin tự chế nhưng ổn định theo id để tránh nhảy mỗi lần gọi
        $flavors = ['Cay siêu cấp', 'Vàng ươm', 'Nướng thơm', 'Chua cay', 'Mặn nhẹ', 'Tây Bắc', 'Đặc biệt'];
        $weights = ['150g', '200g', '250g', '300g', '400g', '500g', '750g', '1kg'];
        $ingredients = [
            'Ức gà xé, lá chanh, sa tế, ớt sừng',
            'Đùi gà nướng, hành phi, tỏi Lý Sơn, ớt hiểm',
            'Ức gà, tiêu xanh Phú Quốc, lá chanh, mật ong',
            'Gà ta, sả, ớt xiêm, lá chanh, muối thảo mộc',
            'Ức gà, paprika, tiêu đen, hành phi, lá nguyệt quế',
            'Ức gà hữu cơ, tỏi đen, ớt bột Hàn, lá oregano',
            'Ức gà xông khói, ngò rí, tiêu hạt, ớt chuông'
        ];

        $flavorIndex = $phim->id % count($flavors);
        $weightIndex  = $phim->id % count($weights);
        $ingredientIndex = $phim->id % count($ingredients);

        $rawImage = trim((string) ($phim->hinh_anh ?? ''));
        $isHttp = preg_match('/^https?:\/\//i', $rawImage);
        $isStorage = str_starts_with($rawImage, '/') || str_starts_with($rawImage, 'storage/');
        $image = ($isHttp || $isStorage) && $rawImage !== '' ? $rawImage : $defaultImage;

        return [
            'id'           => $phim->id,
            'ten_kho_ga'   => $phim->ten_phim,
            'mo_ta'        => $phim->mo_ta,
            'noi_dung'     => $phim->noi_dung,
            'hinh_anh'     => $image,
            'gia'          => $phim->thoi_luong, // dùng thoi_luong làm giá (theo dữ liệu hiện có)
            'tinh_trang'   => $phim->tinh_trang,
            'loai_vi'      => $flavors[$flavorIndex],
            'kich_thuoc'   => $weights[$weightIndex],
            'nha_cung_cap' => $phim->nha_san_xuat ?? $defaultBrand,
            'quoc_gia'     => $phim->quoc_gia ?? $defaultOrigin,
            'thanh_phan'   => $ingredients[$ingredientIndex],
            'cong_ty'      => $phim->dao_dien,
            'the_loai'     => $phim->ten_the_loai ?? null,
        ];
    }

    public function getData()
    {
        try {
            // Ưu tiên lấy từ bảng chi_tiet_kho_ga nếu có dữ liệu thực tế
            $products = ChiTietKhoGa::all()
                ->map(fn($p) => $this->mapKhoGaModel($p));

            if ($products->count()) {
                return response()->json([
                    'status' => true,
                    'data'   => $products,
                ]);
            }

            $products = Phim::leftJoin('the_loai_phims', 'phims.id_the_loai', '=', 'the_loai_phims.id')
                ->select('phims.*', 'the_loai_phims.ten_the_loai')
                ->get()
                ->map(fn($p) => $this->mapPhimToKhoGa($p));

            return response()->json([
                'status' => true,
                'data'   => $products,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Không thể lấy dữ liệu khô gà: ' . $e->getMessage(),
                'data'    => [],
            ], 500);
        }
    }

    public function getDangBan()
    {
        try {
            // Ưu tiên dữ liệu thật từ bảng chi_tiet_kho_ga
            $products = ChiTietKhoGa::where('tinh_trang', 2)
                ->get()
                ->map(fn($p) => $this->mapKhoGaModel($p));

            if ($products->count()) {
                return response()->json([
                    'status' => true,
                    'data'   => $products,
                ]);
            }

            $products = Phim::where('phims.tinh_trang', 2)
                ->leftJoin('the_loai_phims', 'phims.id_the_loai', '=', 'the_loai_phims.id')
                ->select('phims.*', 'the_loai_phims.ten_the_loai')
                ->get()
                ->map(fn($p) => $this->mapPhimToKhoGa($p));

            return response()->json([
                'status' => true,
                'data'   => $products,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Không thể lấy danh sách khô gà đang bán: ' . $e->getMessage(),
                'data'    => [],
            ], 500);
        }
    }

    public function getSapBan()
    {
        try {
            // Ưu tiên dữ liệu thật từ bảng chi_tiet_kho_ga
            $products = ChiTietKhoGa::where('tinh_trang', 1)
                ->get()
                ->map(fn($p) => $this->mapKhoGaModel($p));

            if ($products->count()) {
                return response()->json([
                    'status' => true,
                    'data'   => $products,
                ]);
            }

            $products = Phim::where('phims.tinh_trang', 1)
                ->leftJoin('the_loai_phims', 'phims.id_the_loai', '=', 'the_loai_phims.id')
                ->select('phims.*', 'the_loai_phims.ten_the_loai')
                ->get()
                ->map(fn($p) => $this->mapPhimToKhoGa($p));

            return response()->json([
                'status' => true,
                'data'   => $products,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Không thể lấy danh sách khô gà sắp bán: ' . $e->getMessage(),
                'data'    => [],
            ], 500);
        }
    }

    public function getChiTiet($id)
    {
        try {
            // Lấy chi tiết từ bảng chi_tiet_kho_ga trước
            $product = ChiTietKhoGa::find($id);
            if ($product) {
                return response()->json([
                    'status' => true,
                    'data'   => $this->mapKhoGaModel($product),
                ]);
            }

            $phim = Phim::where('phims.id', $id)
                ->leftJoin('the_loai_phims', 'phims.id_the_loai', '=', 'the_loai_phims.id')
                ->select('phims.*', 'the_loai_phims.ten_the_loai')
                ->first();

            if (!$phim) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Sản phẩm không tồn tại',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'data'   => $this->mapPhimToKhoGa($phim),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Không thể lấy chi tiết sản phẩm: ' . $e->getMessage(),
            ], 500);
        }
    }
}
