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
      <h3 class="page-title"> Thêm người dùng </h3>
    </div>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Thêm người dùng</h4>
            <form class="forms-sample" action="<?= ROOT_URL ?>?url=StaffController/store" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
              <div class="form-group">
                <label for="EmployeeName">Tên người dùng</label>
                <input type="text" class="form-control" id="EmployeeName" name="EmployeeName" placeholder="Tên người dùng">
              </div>
              <p id="StaffNameError" class="error-message"></p>
              <div class="form-group">
                <label for="Address">Địa chỉ</label>
                <input type="text" class="form-control" id="Address" name="Address" placeholder="Địa chỉ">
              </div>
              <p id="AddressError" class="error-message"></p>
              <div class="form-group">
                <label for="PhoneNumber">Số điện thoại</label>
                <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="Số điện thoại">
              </div>
              <p id="PhoneNumberError" class="error-message"></p>
              <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" class="form-control" id="Email" name="Email" placeholder="Email">
              </div>
              <p id="EmailError" class="error-message"></p>
              <div class="form-group">
                <label for="Password">Mật khẩu</label>
                <input type="text" class="form-control" id="Password" name="Password" placeholder="Mật khẩu">
              </div>
              <p id="PasswordError" class="error-message"></p>
              <button type="submit" class="btn btn-primary mr-2">Thêm khách hàng</button>
              <a href="?url=StaffController/StaffPage" class="btn btn-dark">Hủy</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- Xử lý bắt lỗi nhập đầy đủ -->
  <script type="text/javascript">
    function validateForm() {
    var employeeName = document.getElementById('EmployeeName').value;
    var address = document.getElementById('Address').value;
    var phoneNumber = document.getElementById('PhoneNumber').value;
    var email = document.getElementById('Email').value;
    var password = document.getElementById('Password').value;

    // Kiểm tra xem các trường có rỗng không
    if (employeeName == "") {
        document.getElementById('StaffNameError').innerText = "Vui lòng nhập tên nhân viên";
        return false;
    }
    if (address == "") {
        document.getElementById('AddressError').innerText = "Vui lòng nhập địa chỉ";
        return false;
    }
    if (phoneNumber == "") {
        document.getElementById('PhoneNumberError').innerText = "Vui lòng nhập số điện thoại";
        return false;
    }
    if (email == "") {
        document.getElementById('EmailError').innerText = "Vui lòng nhập email";
        return false;
    }
    if (password == "") {
        document.getElementById('PasswordError').innerText = "Vui lòng nhập mật khẩu";
        return false;
    }

    return true; // Nếu không có lỗi, cho phép submit form
}

  </script>