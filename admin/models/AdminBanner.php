<?php
class AdminBanner
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllBanner()
    {
        try {
            $sql = 'SELECT * FROM banners';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }

    public function insertBanner(
        $tieu_de,
        $trang_thai,
        $hinh_anh



    ) {
        try {
            $sql = 'INSERT INTO banners (tieu_de, trang_thai, hinh_anh)
                    VALUES (:tieu_de, :trang_thai, :hinh_anh)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':tieu_de' => $tieu_de,
                ':trang_thai' => $trang_thai,
                ':hinh_anh' => $hinh_anh
            ]);

            // Lấy id sản phẩm vừa thêm
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }


    public function insertAlbumAnhBanner($banner_id, $hinh_anh)
    {
        try {
            $sql = 'INSERT INTO banners (banner_id, hinh_anh)
                    VALUES (:banner_id, :hinh_anh)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':banner_id' => $banner_id,
                ':hinh_anh' => $hinh_anh
            ]);

            // Lấy id sản phẩm vừa thêm
            return true;
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }

    public function getDetailBanner($id)
    {
        $sql = 'SELECT * FROM banners WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        $banner = $stmt->fetch();
        if (!$banner) {
            // Nếu không có banner, quay lại trang danh sách
            header('Location: ' . BASE_URL_ADMIN . '?act=danh-sach-banner');
            exit();
        }
        return $banner;
    }


    public function updateBanner($banner_id, $tieu_de, $trang_thai, $hinh_anh)
{
    try {
        // Kiểm tra xem có file ảnh hay không. Nếu không có, giữ lại ảnh cũ
        if ($hinh_anh === null) {
            // Giữ ảnh cũ nếu không có ảnh mới
            $sql = 'UPDATE banners
                    SET tieu_de = :tieu_de, trang_thai = :trang_thai
                    WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':tieu_de' => $tieu_de,
                ':trang_thai' => $trang_thai,
                ':id' => $banner_id
            ]);
        } else {
            // Nếu có ảnh mới, thực hiện cập nhật cả ảnh
            $sql = 'UPDATE banners
                    SET tieu_de = :tieu_de,
                        trang_thai = :trang_thai,
                        hinh_anh = :hinh_anh
                    WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':tieu_de' => $tieu_de,
                ':trang_thai' => $trang_thai,
                ':hinh_anh' => $hinh_anh,
                ':id' => $banner_id
            ]);
        }

        // Trả về thông báo thành công
        return true;
    } catch (Exception $e) {
        // Ghi lỗi vào log hoặc trả về thông báo lỗi chi tiết
        error_log("Error updating banner: " . $e->getMessage());
        return false; // Hoặc bạn có thể throw exception để xử lý ngoài
    }
}


    public function destroyBanner($id)
    {
        try {
            $sql = 'DELETE FROM banners WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }
}
