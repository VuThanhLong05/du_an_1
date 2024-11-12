<?php

session_start();

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ


// Require toàn bộ file Controllers
require_once './controllers/AdminDanhMucController.php';
require_once './controllers/AdminSanPhamController.php';
require_once './controllers/AdminDonHangController.php';
require_once './controllers/AdminBaoCaoThongKeController.php';
require_once './controllers/AdminTaiKhoanController.php';

require_once './controllers/AdminBaiVietController.php';
require_once './controllers/AdminBannerController.php';


// Require toàn bộ file Models
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanPham.php';
require_once './models/AdminDonHang.php';
require_once './models/AdminTaiKhoan.php';

require_once './models/AdminBaiViet.php';
require_once './models/AdminBanner.php';

// Route
$act = $_GET['act'] ?? '/';

// if ($act !== 'check-log-admin' && $act !== 'logout-admin') {
//     checkLoginAdmin();
// }

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {

    // rou báo cáo thống kê
    '/' => (new AdminBaoCaoThongKeController())->home(),


    'danh-muc' => (new AdminDanhMucController())->danhSachDanhMuc(),
    'form-them-danh-muc' => (new AdminDanhMucController())->formAddDanhMuc(),
    'them-danh-muc' => (new AdminDanhMucController())->postAddDanhMuc(),
    'form-sua-danh-muc' => (new AdminDanhMucController())->formEditAddDanhMuc(),
    'sua-danh-muc' => (new AdminDanhMucController())->postEditAddDanhMuc(),
    'xoa-danh-muc' => (new AdminDanhMucController())->deleteDanhMuc(),

    // rou sản phẩm
    'san-pham' => (new AdminSanPhamController())->danhSachSanPham(),
    'form-them-san-pham' => (new AdminSanPhamController())->formAddSanPham(),
    'them-san-pham' => (new AdminSanPhamController())->postAddSanPham(),
    'form-sua-san-pham' => (new AdminSanPhamController())->formEditAddSanPham(),
    'sua-san-pham' => (new AdminSanPhamController())->postEditAddSanPham(),
    'sua-album-san-pham' => (new AdminSanPhamController())->postEditAnhSanPham(),
    'xoa-san-pham' => (new AdminSanPhamController())->deleteSanPham(),
    'chi-tiet-san-pham' => (new AdminSanPhamController())->getDetailSanPham(),

    // // Bình luận
    // 'update-trang-thai-binh-luan' => (new AdminSanPhamController())->updateTrangThaiBinhLuan(),


    // // rou Đơn hàng
    // 'don-hang' => (new AdminDonHangController())->danhSachDonHang(),
    // 'form-sua-don-hang' => (new AdminDonHangController())->formEditDonHang(),
    // 'sua-don-hang' => (new AdminDonHangController())->postEditDonHang(),
    // 'chi-tiet-don-hang' => (new AdminDonHangController())->detailDonHang(),

    // // rou Đơn hàng quản lý tài khoản
    // // Tài khoản quản trị
    // 'list-tai-khoan-quan-tri' => (new AdminTaiKhoanController())->danhSachQuanTri(),
    // 'form-them-quan-tri' => (new AdminTaiKhoanController())->formAddQuanTri(),
    // 'them-quan-tri' => (new AdminTaiKhoanController())->postAddQuanTri(),
    // 'form-sua-quan-tri' => (new AdminTaiKhoanController())->formEditQuanTri(),
    // 'sua-quan-tri' => (new AdminTaiKhoanController())->postEditQuanTri(),

    // // reset pass
    'reset-password' => (new AdminTaiKhoanController())->resetPassword(),

    // // Quản lý tài khoản khách hàng 
    'list-tai-khoan-khach-hang' => (new AdminTaiKhoanController())->danhSachKhachHang(),
    'form-sua-khach-hang' => (new AdminTaiKhoanController())->formEditKhachHang(),
    'sua-khach-hang' => (new AdminTaiKhoanController())->postEditKhachHang(),
    'chi-tiet-khach-hang' => (new AdminTaiKhoanController())->deltailKhachHang(),

    // QUản lý tài khoản cá nhân(quản trị)
    'form-sua-thong-tin-ca-nhan-quan-tri' => (new AdminTaiKhoanController())->formEditCaNhanQuanTri(),
    'sua-thong-tin-ca-nhan-quan-tri' => (new AdminTaiKhoanController())->postEditCaNhanQuanTri(),

    'sua-mat-khau-ca-nhan-quan-tri' => (new AdminTaiKhoanController())->postEditMatKhauCaNhan(),


    // // auth
    'login-admin' => (new AdminTaiKhoanController)->formLogin(),
    'check-log-admin' => (new AdminTaiKhoanController)->login(),
    'logout-admin' => (new AdminTaiKhoanController)->logout(),

    // bai viết
    'danh-sach-bai-viet' => (new AdminBaiVietController)->danhSachBaiViet(),
    'form-them-bai-viet' => (new AdminBaiVietController)->formAddBaiViet(),
    'them-bai-viet' => (new AdminBaiVietController)->postAddBaiViet(),
    'form-sua-bai-viet' => (new AdminBaiVietController)->formSuaBaiViet(),
    'sua-bai-viet' => (new AdminBaiVietController)->postEditAddBaiViet(),
    'xoa-bai-viet' => (new AdminBaiVietController)->xoaBaiViet(),
    'chi-tiet-bai-viet' => (new AdminBaiVietController)->getDetailBaiViet(),

    // banner
    'danh-sach-banner' => (new AdminBannerController)->danhSachBanner(),
    'form-them-banner' => (new AdminBannerController)->formAddBanner(),
    'them-banner' => (new AdminBannerController)->postAddBanner(),
    'form-sua-banner' => (new AdminBannerController)->formSuaBanner(),
    'sua-banner' => (new AdminBannerController)->suaBanner(),
    'chi-tiet-banner' => (new AdminBannerController())->getDetailBanner(),
    'xoa-banner' => (new AdminBannerController)->xoaBanner(),

};

// Thử mà thôi

