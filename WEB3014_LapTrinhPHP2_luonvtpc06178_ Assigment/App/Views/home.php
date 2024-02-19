<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card corona-gradient-card">
          <div class="card-body py-0 px-0 px-sm-3">
            <div class="row align-items-center">
              <h1>Thống kê</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Biểu đồ thống kê từng loại</h4>
            <canvas id="doughnutChart" name="" style="height:250px"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Biểu đồ thống kê thu nhập</h4>
            <canvas id="lineChart" style="height:250px"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <script>
    // Lấy dữ liệu từ PHP
    var doughnutData = <?php echo $doughnutData; ?>;

    // Vẽ biểu đồ Doughnut
    var ctx = document.getElementById('doughnutChart').getContext('2d');
    var doughnutChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        datasets: [{
          data: doughnutData,
          backgroundColor: [
            'rgba(255, 99, 132, 0.5)',
            'rgba(54, 162, 235, 0.5)',
            'rgba(255, 206, 86, 0.5)'
          ]
        }],
        labels: ['Sản phẩm', 'Người dùng', 'Phiếu bảo trì'] // Tên nhãn cho các phần tử trong biểu đồ
      },
      options: {
        responsive: true
      }
    });
  </script>
  <script>
    // Lấy dữ liệu từ PHP
    var lineChartData = <?php echo $lineChartData; ?>; // Đảm bảo rằng bạn đã có dữ liệu cho biểu đồ dạng line

    // Vẽ biểu đồ Line
    var ctx = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: lineChartData.labels, // Danh sách các nhãn trên trục x
        datasets: [{
          label: 'Tổng thu nhập', // Nhãn của dữ liệu trong biểu đồ
          data: lineChartData.data, // Dữ liệu cho biểu đồ
          backgroundColor: 'rgba(75, 192, 192, 0.2)', // Màu nền của biểu đồ
          borderColor: 'rgba(75, 192, 192, 1)', // Màu viền của biểu đồ
          borderWidth: 1 // Độ rộng của đường viền
        }]
      },
      options: {
        responsive: true,
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true // Bắt đầu từ 0 trên trục y
            }
          }]
        }
      }
    });
  </script>