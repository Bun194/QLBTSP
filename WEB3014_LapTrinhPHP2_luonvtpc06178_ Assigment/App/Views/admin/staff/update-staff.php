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
      <h3 class="page-title"> Cập nhật người dùng </h3>
    </div>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Cập nhật thông tin người dùng</h4>
            <form class="forms-sample" method="POST" action="<?= ROOT_URL ?>?url=StaffController/updateStaff/<?= $data['id'] ?> " enctype="multipart/form-data" onsubmit="return validateForm()">
              <div class="form-group">
                <label for="id">ID</label>
                <input style="background-color: #2A3038" type="text" class="form-control" id="id" name="id" value="<?= $data['id'] ?>" disabled>
              </div>
              <div class="form-group">
                <label for="EmployyeeName">Tên người dùng</label>
                <input type="text" class="form-control" id="EmployeeName" name="EmployeeName" value="<?= $data['EmployeeName'] ?>">
              </div>
              <p id="StaffNameError" class="error-message"></p>
              <div class="form-group">
                <label for="Address">Địa chỉ</label>
                <input type="text" class="form-control" id="Address" name="Address" value="<?= $data['Address'] ?>">
              </div>
              <p id="AddressError" class="error-message"></p>
              <div class="form-group">
                <label for="PhoneNumber">Số điện thoại</label>
                <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" value="<?= $data['PhoneNumber'] ?>">
              </div>
              <p id="PhoneNumberError" class="error-message"></p>
              <div class="form-group">
                <label for="Email">Email</label>
                <input type="text" class="form-control" id="Email" name="Email" value="<?= $data['Email'] ?>">
              </div>
              <p id="EmailError" class="error-message"></p>
              <div class="form-group">
                <label for="Password">Mật khẩu</label>
                <input type="text" class="form-control" id="Password" name="Password" value="<?= $data['Password'] ?>">
              </div>
              <p id="PasswordError" class="error-message"></p>
              <button type="submit" class="btn btn-primary mr-2">Cập nhật nhân viên</button>
              <a href="<?= ROOT_URL ?>?url=StaffController/StaffPage" class="btn btn-dark">Hủy</a>
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
        document.getElementById('StaffNameError').innerText = "Vui lòng nhập tên người dùng";
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