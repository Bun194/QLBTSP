<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Core\BaseRender;
use App\Models\Product;

class ProductController extends BaseController
{

    private $_renderBase;

    /**
     * Thuốc trị đau lưng
     * Copy lại là hết đau lưng
     * 
     */
    function __construct()
    {
        parent::__construct();
        $this->_renderBase = new BaseRender();
        // $this->ProductController();
    }
    function ProductPage()
    {
        $staff = new Product();

        // Số bản ghi trên mỗi trang
        $limit = 5;

        // Số trang hiện tại, mặc định là 1
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        // Lấy tổng số lượng nhân viên
        $totalStaff = count($staff->getAllProduct());

        // Tính toán số trang
        $totalPages = ceil($totalStaff / $limit);


        // Lấy dữ liệu cho trang hiện tại
        $data = $staff->getAllWithPaginateDemo($limit, $currentPage);

        if (!is_array($data)) {
            $data = [];
        }

        // Truyền dữ liệu phân trang vào view
        $paginationData = [
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'baseUrl' => ROOT_URL . '?url=ProductController/ProductPage',
        ];

        // Render view và truyền dữ liệu phân trang
        $this->_renderBase->renderAdminHeader();
        $this->_renderBase->renderAdminNav();
        $this->load->render('admin/product/product', ['data' => $data, 'paginationData' => $paginationData]);
        $this->_renderBase->renderAdminFooter();
    }
    function createProduct()
    {
        $this->_renderBase->renderAdminHeader();
        $this->_renderBase->renderAdminNav();
        // $this->load->render('layouts/client/slider');
        $this->load->render('admin/product/add-product');
        $this->_renderBase->renderAdminFooter();
    }
    function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Xử lý dữ liệu form
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $productName = isset($_POST['ProductsName']) ? $_POST['ProductsName'] : '';
            $description = isset($_POST['Description']) ? $_POST['Description'] : '';
            $purchaseDate = isset($_POST['PurchaseDate']) ? $_POST['PurchaseDate'] : '';
            $quantity = isset($_POST['Quantity']) ? $_POST['Quantity'] : '';
            $status = isset($_POST['Status']) ? $_POST['Status'] : '';

            // Xử lý hình ảnh
            $imageName = $_FILES['ProductsImage']['name'];
            $imageTempName = $_FILES['ProductsImage']['tmp_name'];
            $file_extension = pathinfo($imageName, PATHINFO_EXTENSION);
            $new_name = date('Y-m-d_H-i-s') . '.' . $file_extension;
            $imagePath = 'Public/uploads/' . $new_name;

            // Di chuyển hình ảnh vào thư mục Public/uploads và đổi tên
            move_uploaded_file($imageTempName, $imagePath);

            // Kết nối CSDL và thực hiện truy vấn để lưu dữ liệu
            $createProduct = new Product();
            $table = 'products';
            $data = [
                'ProductsName' => $productName,
                'Description' => $description,
                'PurchaseDate' => $purchaseDate,
                'Quantity' => $quantity,
                'Status' => $status,
                'ProductsImage' => $imagePath, // Lưu đường dẫn của hình ảnh
                // 'ImageType' => $imageType // Lưu loại hình ảnh
            ];

            $result = $createProduct->insertDataProduct($table, $data);

            if ($result) {
                header('location: ' . ROOT_URL . '?url=ProductController/ProductPage');
                exit; // Đảm bảo không có mã HTML hoặc mã PHP nào được gửi sau khi chuyển hướng
            } else {
                echo 'Thêm lỗi';
            }
        } else {
            echo 'Không có dữ liệu được gửi từ form.';
        }
    }

    function deleteProduct($id)
    {
        $product = new Product();
        $data = $product->deleteProduct($id);

        if ($data) {
            header('location: ' . ROOT_URL . '?url=ProductController/ProductPage');
        } else {
            echo 'Xóa lỗi!';
        }
    }
    function detailUpdate($id)
    {
        // dữ liệu ở đây lấy từ repositories hoặc model
        $product = new Product();
        $data = $product->getOneProduct($id);
        $this->_renderBase->renderAdminHeader();
        $this->_renderBase->renderAdminNav();
        // $this->load->render('layouts/client/slider');
        $this->load->render('admin/product/update-product', $data);
        $this->_renderBase->renderAdminFooter();
    }
    function updateProduct($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $productName = isset($_POST['ProductsName']) ? $_POST['ProductsName'] : '';
            $description = isset($_POST['Description']) ? $_POST['Description'] : '';
            $purchaseDate = isset($_POST['PurchaseDate']) ? $_POST['PurchaseDate'] : '';
            $quantity = isset($_POST['Quantity']) ? $_POST['Quantity'] : '';
            $status = isset($_POST['Status']) ? $_POST['Status'] : '';
            // Kiểm tra xem có hình ảnh mới được tải lên không
            $imagePath = ''; // Khởi tạo biến đường dẫn hình ảnh
            if (!empty($_FILES['ProductsImage']['name'])) {
                $image = $_FILES['ProductsImage'];
                // Tạo tên mới cho hình ảnh dựa trên thời gian hiện tại
                $newName = date('Y-m-d_H-i-s') . '_' . $image['name'];
                $imagePath = 'Public/uploads/' . $newName;
                // Di chuyển hình ảnh mới vào thư mục đích
                if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
                    echo 'Lỗi khi tải lên hình ảnh.';
                    return;
                }
            }
            /// Tạo mảng dữ liệu cần cập nhật
            $data = [
                'ProductsName' => $productName,
                'Description' => $description,
                'PurchaseDate' => $purchaseDate,
                'Quantity' => $quantity,
                'Status' => $status,
            ];
            // Nếu có hình ảnh mới được tải lên, cập nhật đường dẫn hình ảnh
            if (!empty($imagePath)) {
                $data['ProductsImage'] = $imagePath;
            }
            // Gọi phương thức updateDataProduct từ đối tượng Product
            $product = new Product();
            $result = $product->updateDataProduct($id, $data);

            if ($result) {
                header('location: ' . ROOT_URL . '?url=ProductController/ProductPage');
                exit; // Đảm bảo không có mã HTML hoặc mã PHP nào được gửi sau khi chuyển hướng
            } else {
                echo 'Không cập nhật được.';
            }
        }
    }
}
