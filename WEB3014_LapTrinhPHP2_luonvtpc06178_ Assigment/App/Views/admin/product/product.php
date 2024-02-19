<?php
//  var_dump($data )
?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Sản phẩm </h3>
    </div>
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <a href="<?php ROOT_URL ?>?url=ProductController/createProduct" style="text-decoration: none;">
              <p class="card-title"><i class="mdi mdi-library-plus"></i>Thêm sản phẩm</p>
            </a>
            <div class="table-responsive">
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th> ID </th>
                    <th> Tên sản phẩm </th>
                    <th> Hình ảnh </th>
                    <th> Mô tả </th>
                    <th> Ngày mua hàng </th>
                    <th> Số lượng </th>
                    <th> Trạng thái </th>
                    <th> Chức năng </th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $key) : ?>
                    <tr>
                      <td> <?= $key['id'] ?> </td>
                      <td> <?= $key['ProductsName'] ?> </td>
                      <td class="py-1">
                        <img src="<?= $key['ProductsImage'] ?>" alt="image" class="img-fluid rounded" style="width: 150px; height: 150px;" />
                      </td>
                      <td> <?= $key['Description'] ?> </td>
                      <td> <?= $key['PurchaseDate'] ?> </td>
                      <td> <?= $key['Quantity'] ?> </td>
                      <td> <?= ($key['Status'] == 1) ? 'Hoàn thành' : 'Đang sửa' ?> </td>
                      <td>
                        <ul class="nav">
                          <li class="nav-item menu-items">
                            <a class="nav-link" href="<?php ROOT_URL ?>?url=ProductController/detailUpdate/<?= $key['id'] ?>">
                              <span class="menu-icon">
                                <i class="mdi mdi-pencil"></i>
                              </span>
                            </a>
                          </li>
                          <li class="nav-item menu-items">
                            <a class="nav-link" href="<?php ROOT_URL ?>?url=ProductController/deleteProduct/<?= $key['id'] ?>">
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
                    <a class="page-link" href="<?= ROOT_URL ?>?url=ProductController/ProductPage&page=<?= $i ?>"><?= $i ?></a>
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