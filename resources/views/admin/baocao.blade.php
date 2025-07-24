@extends('admin.app')

@section('admin.body')
      <div class="areports-main-content">
        <div class="areports-header">
          <div class="areports-search-bar">
            <i class="fas fa-search"></i>
            <input
              type="text"
              id="searchInput"
              placeholder="Tìm kiếm báo cáo..."
            />
          </div>
          <div class="areports-user-profile">
            <div class="areports-notification-bell">
              <i class="fas fa-bell"></i>
            </div>
            <div class="areports-profile-avatar">QT</div>
          </div>
        </div>
        <h1 class="areports-page-title">Báo cáo kinh doanh</h1>
        <p class="areports-page-subtitle">Phân tích hiệu suất kinh doanh</p>
        <div class="areports-filter-container">
          <form id="filter-form" action="#" method="POST">
            <div class="areports-filter-group">
              <label for="startDate">Từ ngày</label>
              <input type="date" id="startDate" name="startDate" value="2025-01-01" />
            </div>
            <div class="areports-filter-group">
              <label for="endDate">Đến ngày</label>
              <input type="date" id="endDate" name="endDate" value="2025-06-30" />
            </div>
            <div class="areports-filter-group">
              <label for="reportType">Loại báo cáo</label>
              <select id="reportType" name="reportType">
                <option value="all">All</option>
                <option value="sales">Sales</option>
                <option value="products">Products</option>
              </select>
            </div>
            <div class="areports-filter-group">
              <label>&nbsp;</label><br> <!-- Thêm nhãn trống để căn chỉnh -->
              <button type="submit" class="areports-btn areports-btn-primary" id="applyFilter">
                Áp dụng
              </button>
            </div>
          </form>
          <form id="export-form" action="#" method="POST">
            <div class="areports-filter-group">
              <label>&nbsp;</label><br> <!-- Thêm nhãn trống để căn chỉnh -->
              <button type="submit" class="areports-btn areports-btn-primary" id="export-period">
                Xuất dữ liệu
              </button>
            </div>
          </form>
        </div>
        <div class="areports-summary">
          <div class="areports-summary-card">
            <h4>Tổng doanh thu</h4>
            <p id="totalRevenue">13,900,000 VNĐ</p>
          </div>
          <div class="areports-summary-card">
            <h4>Tổng đơn hàng</h4>
            <p id="totalOrders">230</p>
          </div>
          <div class="areports-summary-card">
            <h4>Sản phẩm bán chạy</h4>
            <p id="topProduct">Áo thun trắng</p>
          </div>
        </div>
        <div class="areports-chart-card">
          <h3>Báo cáo doanh thu</h3>
          <div class="areports-chart-container">
            <canvas id="salesChart"></canvas>
          </div>
        </div>
        <div class="areports-chart-card">
          <h3>Phân bố doanh thu theo danh mục</h3>
          <div class="areports-chart-container">
            <canvas id="categoryChart"></canvas>
          </div>
        </div>
        <div class="areports-chart-card">
          <h3>Top 5 sản phẩm bán chạy</h3>
          <table class="areports-report-table" id="productTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Sản phẩm</th>
                <th>Danh mục</th>
                <th>Số lượng bán</th>
                <th>Doanh thu</th>
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody id="productList">
              <tr class="visible">
                <td>SP001</td>
                <td>Áo thun trắng</td>
                <td>Áo thun</td>
                <td>150</td>
                <td>7,500,000 VNĐ</td>
                <td>
                  <button
                    class="areports-btn areports-btn-primary"
                    data-modal="edit-product"
                    data-id="SP001"
                    data-name="Áo thun trắng"
                    data-category="Áo thun"
                    data-quantity="150"
                    data-revenue="7500000"
                  >
                    Chỉnh sửa
                  </button>
                </td>
              </tr>
              <tr class="visible">
                <td>SP002</td>
                <td>Quần jeans xanh</td>
                <td>Quần jeans</td>
                <td>80</td>
                <td>6,400,000 VNĐ</td>
                <td>
                  <button
                    class="areports-btn areports-btn-primary"
                    data-modal="edit-product"
                    data-id="SP002"
                    data-name="Quần jeans xanh"
                    data-category="Quần jeans"
                    data-quantity="80"
                    data-revenue="6400000"
                  >
                    Chỉnh sửa
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="areports-pagination" id="pagination"></div>
        </div>
      </div>

    <!-- Edit Product Modal -->
    <div id="edit-product-modal" class="areports-modal">
      <div class="areports-modal-content">
        <div class="areports-modal-header">
          <h3 class="areports-modal-title">Chỉnh sửa sản phẩm</h3>
          <span class="areports-modal-close">×</span>
        </div>
        <form id="edit-product-form" action="#" method="POST">
          <div class="areports-modal-form-group">
            <label for="product-id">ID</label>
            <input type="text" id="product-id" name="id" readonly />
          </div>
          <div class="areports-modal-form-group">
            <label for="product-name">Tên sản phẩm</label>
            <input type="text" id="product-name" name="name" required />
          </div>
          <div class="areports-modal-form-group">
            <label for="product-category">Danh mục</label>
            <select id="product-category" name="category" required>
              <option value="Áo thun">Áo thun</option>
              <option value="Quần jeans">Quần jeans</option>
              <option value="Áo khoác">Áo khoác</option>
              <option value="Giày">Giày</option>
              <option value="Váy">Váy</option>
              <option value="Phụ kiện">Phụ kiện</option>
            </select>
          </div>
          <div class="areports-modal-form-group">
            <label for="product-quantity">Số lượng bán</label>
            <input type="number" id="product-quantity" name="quantity" required />
          </div>
          <div class="areports-modal-form-group">
            <label for="product-revenue">Doanh thu</label>
            <input type="number" id="product-revenue" name="revenue" required />
          </div>
          <button type="submit" class="areports-btn areports-btn-primary">
            Lưu thay đổi
          </button>
        </form>
      </div>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Kiểm tra tải Chart.js
        if (typeof Chart === "undefined") {
          console.error("Chart.js không tải được. Vui lòng kiểm tra kết nối CDN.");
          return;
        }

        // Sidebar navigation
        const sidebarItems = document.querySelectorAll(".areports-sidebar-item");
        const modals = document.querySelectorAll(".areports-modal");
        const modalButtons = document.querySelectorAll("[data-modal]");
        const closeButtons = document.querySelectorAll(".areports-modal-close");

        sidebarItems.forEach((item) => {
          item.addEventListener("click", function (e) {
            e.preventDefault();
            sidebarItems.forEach((i) => i.classList.remove("areports-active"));
            this.classList.add("areports-active");
          });
        });

        // Modal handling
        modalButtons.forEach((button) => {
          button.addEventListener("click", function () {
            const modalId = this.getAttribute("data-modal");
            const modal = document.getElementById(`${modalId}-modal`);
            if (modal) {
              modal.style.display = "flex";

              // Populate modal fields for edit product
              if (modalId === "edit-product") {
                document.getElementById("product-id").value =
                  this.getAttribute("data-id") || "";
                document.getElementById("product-name").value =
                  this.getAttribute("data-name") || "";
                document.getElementById("product-category").value =
                  this.getAttribute("data-category") || "";
                document.getElementById("product-quantity").value =
                  this.getAttribute("data-quantity") || "";
                document.getElementById("product-revenue").value =
                  this.getAttribute("data-revenue") || "";
              }
            }
          });
        });

        closeButtons.forEach((button) => {
          button.addEventListener("click", function () {
            const modal = this.closest(".areports-modal");
            if (modal) {
              modal.style.display = "none";
            }
          });
        });

        // Close modal when clicking outside
        window.addEventListener("click", function (e) {
          modals.forEach((modal) => {
            if (e.target === modal) {
              modal.style.display = "none";
            }
          });
        });

        // Sales Chart (Line Chart)
        const salesChartCtx = document.getElementById("salesChart").getContext("2d");
        new Chart(salesChartCtx, {
          type: "line",
          data: {
            labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6"],
            datasets: [
              {
                label: "Doanh thu (VNĐ)",
                data: [2000000, 3500000, 2800000, 4200000, 5000000, 3900000],
                borderColor: "#4f46e5",
                backgroundColor: "rgba(79, 70, 229, 0.1)",
                fill: true,
                tension: 0.4,
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              y: {
                beginAtZero: true,
                title: {
                  display: true,
                  text: "Doanh thu (VNĐ)",
                },
              },
              x: {
                title: {
                  display: true,
                  text: "Tháng",
                },
              },
            },
          },
        });

        // Category Chart (Pie Chart)
        const categoryChart = document.getElementById("categoryChart").getContext("2d");
        new Chart(categoryChart, {
          type: "pie",
          data: {
            labels: ["Áo thun", "Quần jeans", "Áo khoác", "Giày", "Váy", "Phụ kiện"],
            datasets: [
              {
                label: "Doanh thu theo danh mục",
                data: [7500000, 6400000, 2000000, 1500000, 1000000, 500000],
                backgroundColor: [
                  "#4f46e5",
                  "#22c55e",
                  "#ef4444",
                  "#f59e0b",
                  "#8b5cf6",
                  "#ec4899",
                ],
                borderColor: "#ffffff",
                borderWidth: 2,
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                position: "right",
              },
            },
          },
        });
      });
    </script>
@endsection