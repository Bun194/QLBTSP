<style>
  .error-message {
    color: red;
    font-size: 14px;
  }
</style>
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Cập nhật sản phẩm </h3>
    </div>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Cập nhật thông tin</h4>
            <form class="forms-sample" method="POST" action="<?= ROOT_URL ?>?url=ProductController/updateProduct/<?= $data['id'] ?> " enctype="multipart/form-data" onsubmit="return validateForm()">
              <div class="form-group">
                <label for="id">ID</label>
                <input style="background-color: #2A3038" type="text" class="form-control" id="id" name="id" value="<?= $data['id'] ?>" disabled>
              </div>
              <div class="form-group">
                <label for="ProductsName">Tên sản phẩm</label>
                <input type="text" class="form-control" id="ProductsName" name="ProductsName" value="<?= $data['ProductsName'] ?>">
              </div>
              <p id="productNameError" class="error-message"></p>
              <div class="form-group">
                <label for="image">Hình ảnh</label><br>
                <img id="previewImage" src="<?= $data['ProductsImage'] ?>" alt="Hình ảnh sản phẩm" style="max-width: 200px; max-height: 200px;"><br>
                <input type="file" id="image" name="ProductsImage" class="file-upload-default" style="display: none;">
                <div class="input-group col-xs-12">
                  <!-- Để hiển thị tên tệp đã chọn -->
                  <input type="text" class="form-control file-upload-info" id="imagePath" disabled placeholder="Tải hình ảnh">
                  <!-- Nút kích hoạt để chọn tệp -->
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button" onclick="document.getElementById('image').click()">Chọn tệp</button>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label for="">Mô tả</label>
                <input type="text" class="form-control" id="Description" value="<?= $data['Description'] ?>" name="Description">
              </div>
              <p id="productDescriptionError" class="error-message"></p>
              <div class="form-group">
                <label for="">Ngày mua hàng</label>
                <input type="date" class="form-control" id="PurchaseDate" value="<?= $data['PurchaseDate'] ?>" name="PurchaseDate">
              </div>
              <p id="productPurchaseDateError" class="error-message"></p>
              <div class="form-group">
                <label for="">Số lượng</label>
                <input type="text" class="form-control" id="Quantity" value="<?= $data['Quantity'] ?>" name="Quantity">
              </div>
              <p id="productQuantityError" class="error-message"></p>
              <div class="form-group">
                <label for="Status">Trạng thái</label>
                <select name="Status" id="Status" class="form-control" required>
                  <!-- <option value="" selected disabled>Vui lòng chọn</option> -->
                  <option value="0" <?= ($data['Status'] == 0) ? 'selected' : '' ?>>Đang sửa</option>
                  <option value="1" <?= ($data['Status'] == 1) ? 'selected' : '' ?>>Hoàn thành</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary mr-2">Cập nhật sản phẩm</button>
              <a href="<?= ROOT_URL ?>?url=ProductController/ProductPage" class="btn btn-dark">Hủy</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- Xử lý load ảnh -->
  <script>
    // Sự kiện change khi người dùng chọn tệp tin mới
    document.getElementById('image').addEventListener('change', function() {
      var fileInput = this;
      var fileName = fileInput.files[0].name;
      document.getElementById('imagePath').value = fileName;

      // Hiển thị hình ảnh được chọn trên trang
      var reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('previewImage').src = e.target.result;
      }
      reader.readAsDataURL(fileInput.files[0]);
    });
  </script>
  <!-- Xử lý YYYY-MM-DD -->
  <script>
    document.querySelector('form').addEventListener('submit', function(event) {
      var purchaseDateInput = document.getElementById('PurchaseDate');
      var purchaseDateValue = purchaseDateInput.value;
      var formattedDate = new Date(purchaseDateValue);
      var formattedDateString = formattedDate.getFullYear() + '-' + (formattedDate.getMonth() + 1).toString().padStart(2, '0') + '-' + formattedDate.getDate().toString().padStart(2, '0');
      purchaseDateInput.value = formattedDateString;
    });
  </script>
  <!-- Xử lý bắt lỗi nhập đầy đủ -->
  <script type="text/javascript">
    function validateForm() {
      var productName = document.getElementById('ProductsName').value;
      var productDescription = document.getElementById('Description').value;
      var productPurchaseDate = document.getElementById('PurchaseDate').value;
      var productQuantity = document.getElementById('Quantity').value;

      if (productName === '') {
        document.getElementById('productNameError').innerHTML = 'Tên sản phẩm không được bỏ trống';
        return false;
      }

      if (productDescription === '') {
        document.getElementById('productDescriptionError').innerHTML = 'Mô tả không được bỏ trống';
        return false;
      }

      if (productPurchaseDate === '') {
        document.getElementById('productPurchaseDateError').innerHTML = 'Ngày mua không được bỏ trống';
        return false;
      }

      if (productQuantity === '') {
        document.getElementById('productQuantityError').innerHTML = 'Số lượng không được bỏ trống';
        return false;
      }

      return true; // Trả về true nếu tất cả các trường đều đã được nhập đúng
    }
  </script>