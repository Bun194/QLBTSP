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
      <h3 class="page-title"> Cập nhật phiếu bảo trì </h3>
    </div>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Cập nhật phiếu bảo trì</h4>
            <form class="forms-sample" method="post" action="<?= ROOT_URL ?>?url=MaintenanceController/updateMaintenance/<?= $data['id'] ?> " enctype="multipart/form-data" onsubmit="return validateFormDemo()">
              <div class="form-group">
                <label for="id">ID</label>
                <input style="background-color: #2A3038" type="text" class="form-control" id="id" name="id" value="<?= $data['id'] ?>" disabled>
              </div>
              <div class="form-group">
                <label for="ProductsID">Mã sản phẩm</label>
                <input style="background-color: #2A3038" type="text" class="form-control" id="selectedProductID" name="ProductsID" value="<?= $data['ProductsID'] ?>" disabled>
                <select name="ProductsID" id="ProductsIDSelect" class="form-control" onchange="updateProductID()">
                  <option value="" selected disabled>Vui lòng chọn</option>
                  <?php
                  use App\Models\Product;
                  $product = new Product();
                  $productData = $product->getAllProduct();
                  foreach ($productData as $productItem) {
                    echo '<option value="' . $productItem['id'] . '"> ' . $productItem['ProductsName'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <p id="ProductsIDError" class="error-message"></p>
              <div class="form-group">
                <label for="EmployeeID">Mã người dùng</label>
                <input style="background-color: #2A3038" type="text" class="form-control" id="selectedEmployeeID" name="EmployeeID" value="<?= $data['EmployeeID'] ?>" disabled>
                <select name="EmployeeID" id="EmployeeIDSelect" class="form-control" onchange="updateInput()">
                  <option value="" selected disabled>Vui lòng chọn</option>
                  <?php
                  use App\Models\Staff;
                  $staff = new Staff();
                  $staffData = $staff->getAllStaff();
                  foreach ($staffData as $staffItem) {
                    echo '<option value="' . $staffItem['id'] . '"> ' . $staffItem['EmployeeName'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <p id="EmployeeIDError" class="error-message"></p>
              <div class="form-group">
                <label for="MaintenanceDate">Ngày bảo trì</label>
                <input type="date" class="form-control" id="MaintenanceDate" name="MaintenanceDate" value="<?= $data['MaintenanceDate'] ?>">
              </div>
              <p id="MaintenanceDateError" class="error-message"></p>
              <div class="form-group">
                <label for="Description">Mô tả</label>
                <input type="text" class="form-control" id="Description" name="Description" value="<?= $data['Description'] ?>">
              </div>
              <p id="DescriptionError" class="error-message"></p>
              <div class="form-group">
                <label for="MaintenanceCost">Chi phí</label>
                <input type="text" class="form-control" id="MaintenanceCost" name="MaintenanceCost" value="<?= $data['MaintenanceCost'] ?>">
              </div>
              <p id="MaintenanceCostError" class="error-message"></p>
              <div class="form-group">
                <label for="Status">Trạng thái</label>
                <select name="Status" id="Status" class="form-control" required>
                  <!-- <option value="" selected disabled>Vui lòng chọn</option> -->
                  <option value="0" <?= ($data['Status'] == 0) ? 'selected' : '' ?>>Đang sửa</option>
                  <option value="1" <?= ($data['Status'] == 1) ? 'selected' : '' ?>>Hoàn thành</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary mr-2">Cập nhật phiếu bảo trì</button>
              <a href="<?= ROOT_URL ?>?url=MaintenanceController/MaintenancePage" class="btn btn-dark">Hủy</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- Xử lý bắt lỗi nhập đầy đủ -->
  <script type="text/javascript">
    function validateFormDemo() {
      var productsid = document.getElementById('ProductsIDSelect').value;
      var employeeid = document.getElementById('EmployeeIDSelect').value;
      var maintenancedate = document.getElementById('MaintenanceDate').value;
      var description = document.getElementById('Description').value;
      var maintenancecost = document.getElementById('MaintenanceCost').value;

      // Kiểm tra xem các trường có rỗng không
      if (productsid == "") {
        document.getElementById('ProductsIDError').innerText = "Vui lòng nhập tên nhân viên";
        return false;
      }
      if (employeeid == "") {
        document.getElementById('EmployeeIDError').innerText = "Vui lòng nhập địa chỉ";
        return false;
      }
      if (maintenancedate == "") {
        document.getElementById('MaintenanceDateError').innerText = "Vui lòng nhập số điện thoại";
        return false;
      }
      if (description == "") {
        document.getElementById('DescriptionError').innerText = "Vui lòng nhập email";
        return false;
      }
      if (maintenancecost == "") {
        document.getElementById('MaintenanceCostError').innerText = "Vui lòng nhập mật khẩu";
        return false;
      }

      return true; // Nếu không có lỗi, cho phép submit form
    }
  </script>
  <!-- Xử lý chọn Sleect hiển thị lên input -->
  <script>
    function updateInput() {
      var selectElement = document.getElementById("EmployeeIDSelect");
      var inputElement = document.getElementById("selectedEmployeeID");
      var selectedOption = selectElement.options[selectElement.selectedIndex];
      inputElement.value = selectedOption.value; // or selectedOption.text if you want to display the text of the option
    }

    function updateProductID() {
      var selectElement = document.getElementById("ProductsIDSelect");
      var inputElement = document.getElementById("selectedProductID");
      var selectedOption = selectElement.options[selectElement.selectedIndex];
      inputElement.value = selectedOption.value; // or selectedOption.text if you want to display the text of the option
    }
  </script>