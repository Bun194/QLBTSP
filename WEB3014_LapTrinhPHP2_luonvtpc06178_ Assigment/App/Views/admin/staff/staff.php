<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Người dùng </h3>
    </div>
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <a href="<?php ROOT_URL ?>?url=StaffController/createStaff" style="text-decoration: none;">
              <p class="card-title"><i class="mdi mdi-library-plus"></i>Thêm người dùng</p>
            </a>
            <div class="table-responsive">
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th> ID </th>
                    <th> Tên người dùng </th>
                    <th> Địa chỉ </th>
                    <th> Số điện thoại </th>
                    <th> Email </th>
                    <th> Chức năng </th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $key) : ?>
                    <tr>
                      <td> <?= $key['id'] ?> </td>
                      <td> <?= $key['EmployeeName'] ?> </td>
                      <td> <?= $key['Address'] ?> </td>
                      <td> <?= $key['PhoneNumber'] ?> </td>
                      <td> <?= $key['Email'] ?> </td>
                      <td>
                        <ul class="nav">
                          <li class="nav-item menu-items">
                            <a class="nav-link" href="<?php ROOT_URL ?>?url=StaffController/detailUpdate/<?= $key['id'] ?> ">
                              <span class="menu-icon">
                                <i class="mdi mdi-pencil"></i>
                              </span>
                            </a>
                          </li>
                          <li class="nav-item menu-items">
                            <a class="nav-link" href="<?php ROOT_URL ?>?url=StaffController/deleteStaff/<?= $key['id'] ?> ">
                              <span class="menu-icon">
                                <i class="mdi mdi-delete"></i>
                              </span>
                            </a>
                          </li>
                        </ul>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- Phân trang -->
          <div class="pagination justify-content-center">
            <ul class="pagination">
              <?php if (isset($paginationData['totalPages'])) : ?>
                <?php for ($i = 1; $i <= $paginationData['totalPages']; $i++) : ?>
                  <li class="page-item <?php echo ($paginationData['currentPage'] == $i) ? 'active' : ''; ?>">
                    <a class="page-link" href="<?= ROOT_URL ?>?url=StaffController/StaffPage&page=<?= $i ?>"><?= $i ?></a>
                  </li>
                <?php endfor; ?>
              <?php endif; ?>
            </ul>
          </div>
          <!-- Kết thúc phân trang -->
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->