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
      <h3 class="page-title"> Thêm sản phẩm </h3>
    </div>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Thêm thông tin</h4>
            <form class="forms-sample" action="<?= ROOT_URL ?>?url=ProductController/store" method="post" enctype="multipart/form-data" onsubmit="return validateFormDemo()">
              <div class="form-group">
                <label for="exampleInputName1">Tên sản phẩm</label>
                <input type="text" class="form-control" id="ProductsName" name="ProductsName" placeholder="Tên sản phẩm">
              </div>
              <p id="productNameError" class="error-message"></p>
              <div class="form-group">
                <label>Hình ảnh</label><br>
                <img id="previewImage" src="#" alt="Hình ảnh sản phẩm" style="max-width: 200px; max-height: 200px;"><br>
                <input type="file" id="image" name="ProductsImage" class="file-upload-default" style="display: none;">
                <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info" placeholder="Tải hình ảnh" id="imagePath" disabled>
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button" onclick="document.getElementById('image').click()">Tải lên</button>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword4">Mô tả</label>
                <input type="text" class="form-control" id="Description" name="Description" placeholder="Mổ tả">
              </div>
              <p id="productDescriptionError" class="error-message"></p>
              <div class="form-group">
                <label for="PurchaseDate">Ngày mua hàng</label>
                <input type="date" class="form-control" id="PurchaseDate" name="PurchaseDate" placeholder="Ngày mua hàng">
              </div>
              <p id="productPurchaseDateError" class="error-message"></p>
              <div class="form-group">
                <label for="exampleInputCity1">Số lượng</label>
                <input type="number" class="form-control" id="Quantity" name="Quantity" placeholder="Số lượng">
              </div>
              <p id="productQuantityError" class="error-message"></p>
              <div class="form-group">
                <label for="Status">Trạng thái</label>
                <select name="Status" id="Status" class="form-control">
                  <option value="" selected disabled>Vui lòng chọn</option>
                  <option value="0">Đang sửa</option>
                  <option value="1">Hoàn thành</option>
                </select>
              </div>
              <p id="productStatusError" class="error-message"></p>
              <button type="submit" class="btn btn-primary mr-2">Thêm sản phẩm</button>
              <a href="?url=ProductController/ProductPage" class="btn btn-dark">Hủy</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- Xử lý nút Button load ảnh-->
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
    function validateFormDemo() {

      var productName = document.getElementById('ProductsName').value;
      var description = document.getElementById('Description').value;
      var purchaseDate = document.getElementById('PurchaseDate').value;
      var quantity = document.getElementById('Quantity').value;
      var status = document.getElementById('Status').value;

      var productNameError = document.getElementById('productNameError');
      var descriptionError = document.getElementById('productDescriptionError');
      var purchaseDateError = document.getElementById('productPurchaseDateError');
      var quantityError = document.getElementById('productQuantityError');
      var statusError = document.getElementById('productStatusError');

      var isValid = true;

      // Kiểm tra tên sản phẩm
      if (productName.trim() === '') {
        productNameError.innerHTML = 'Tên sản phẩm không được bỏ trống';
        isValid = false;
      } else {
        productNameError.innerHTML = '';
      }

      // Kiểm tra mô tả
      if (description.trim() === '') {
        descriptionError.innerHTML = 'Mô tả không được bỏ trống';
        isValid = false;
      } else {
        descriptionError.innerHTML = '';
      }

      // Kiểm tra ngày mua hàng
      if (purchaseDate.trim() === '') {
        purchaseDateError.innerHTML = 'Ngày mua hàng không được bỏ trống';
        isValid = false;
      } else {
        purchaseDateError.innerHTML = '';
      }

      // Kiểm tra số lượng
      if (quantity.trim() === '') {
        quantityError.innerHTML = 'Số lượng không được bỏ trống';
        isValid = false;
      } else {
        quantityError.innerHTML = '';
      }

      // Kiểm tra trạng thái
      if (status === '') {
        statusError.innerHTML = 'Vui lòng chọn trạng thái';
        isValid = false;
      } else {
        statusError.innerHTML = '';
      }

      return isValid;
    }
  </script>