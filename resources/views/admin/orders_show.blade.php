@extends('admin.app')

@section('admin.body')
    <div class="aorders-main-content">
        <div class="aorders-header">
            <div class="aorders-search-bar">
                <i class="fas fa-search"></i>
                <input type="text" id="order-search" placeholder="Tìm kiếm mã đơn, khách hàng, trạng thái..." />
            </div>
            <div class="aorders-user-profile">
                <div class="aorders-notification-bell">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="aorders-profile-avatar">QT</div>
            </div>
        </div>
        <h1 class="aorders-page-title">Chi tiết đơn hàng #DH-{{ $order->id }}</h1>
        <p class="aorders-page-subtitle">
            Thông tin chi tiết về đơn hàng và sản phẩm
        </p>

        <!-- Hiển thị thông báo thành công hoặc lỗi -->
        @if (session('success'))
            <div class="aorders-toast aorders-toast-success show">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="aorders-toast aorders-toast-error show">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <div class="aorders-data-card">
            <div class="aorders-order-details">
                <h2>Thông tin đơn hàng</h2>
                <p><strong>Mã đơn:</strong> #DH-{{ $order->id }}</p>
                <p><strong>Khách hàng:</strong> {{ $order->user->name ?? ($order->address_details['receiver_name'] ?? ($order->address->receiver_name ?? 'Không xác định')) }}</p>
                <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d-m-y ') }}</p>
                <p><strong>Trạng thái:</strong> 
                    <span class="aorders-status-badge {{ $order->status == 'Đã hủy' ? 'aorders-status-inactive' : 'aorders-status-active' }}">
                        {{ $order->status }}
                    </span>
                </p>
                @if ($order->address_details && $order->address_details['province_name'] !== 'Không xác định')
                    <!-- Hiển thị địa chỉ từ API nếu API hoạt động -->
                    <p><strong>Số điện thoại:</strong> {{ $order->address_details['phone'] ?? 'N/A' }}</p>
                    <p><strong>Địa chỉ:</strong> 
                        {{ $order->address_details['address'] . ', ' . 
                           $order->address_details['ward_name'] . ', ' . 
                           $order->address_details['district_name'] . ', ' . 
                           $order->address_details['province_name'] }}
                    </p>
                @elseif ($order->address && $order->address->address && $order->address->ward && $order->address->district && $order->address->province)
                    <!-- Hiển thị địa chỉ từ $order->address nếu không có API -->
                    <p><strong>Số điện thoại:</strong> {{ $order->address->phone ?? 'N/A' }}</p>
                    <p><strong>Địa chỉ:</strong> 
                        {{ $order->address->address . ', ' . 
                           $order->address->ward . ', ' . 
                           $order->address->district . ', ' . 
                           $order->address->province }}
                    </p>
                @elseif ($order->user && $order->user->defaultAddress && $order->user->defaultAddress->address)
                    <!-- Hiển thị địa chỉ mặc định của user nếu có -->
                    <p><strong>Số điện thoại:</strong> {{ $order->user->defaultAddress->phone ?? 'N/A' }}</p>
                    <p><strong>Địa chỉ:</strong> 
                        {{ $order->user->defaultAddress->address . ', ' . 
                           $order->user->defaultAddress->ward . ', ' . 
                           $order->user->defaultAddress->district . ', ' . 
                           $order->user->defaultAddress->province }}
                    </p>
                @else
                    <!-- Ẩn thông tin địa chỉ nếu không có dữ liệu -->
                @endif
            </div>

            <div class="aorders-order-items">
                <h2>Sản phẩm trong đơn hàng</h2>
                <table class="aorders-data-table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Size</th>
                            <th>Màu sắc</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderDetails as $detail)
                            <tr>
                                <td>
                                    <img src="{{ asset($detail->productVariant->product->images->first()->path ?? '/images/placeholder.png') }}"
                                        alt="{{ $detail->productVariant->product->name ?? 'Không xác định' }}"
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>{{ $detail->productVariant->product->name ?? 'Không xác định' }}</td>
                                <td>{{ $detail->productVariant->size->name ?? 'N/A' }}</td>
                                <td>{{ $detail->productVariant->color->name ?? 'N/A' }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>{{ number_format($detail->productVariant->product->price ?? 0, 0, ',', '.') }}đ</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 16px; text-align: right;">
                <div style="display: inline-block; padding: 10px 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px; font-weight: bold;">
                    Tổng tiền đơn hàng: {{ number_format($order->total_price, 0, ',', '.') }}đ
                </div>
            </div>

            <div class="aorders-actions">
                <a href="{{ route('admin.orders.index') }}" class="aorders-btn aorders-btn-primary">Quay lại</a>
            </div>

            <!-- Toast thông báo -->
            <div class="aorders-toast" id="toast"></div>
        </div>

        <script src="/js/app.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Xử lý active sidebar
                const sidebarItems = document.querySelectorAll(".aorders-sidebar-item");
                sidebarItems.forEach((item) => {
                    item.addEventListener("click", function(e) {
                        e.preventDefault();
                        sidebarItems.forEach((i) => i.classList.remove("aorders-active"));
                        this.classList.add("aorders-active");
                    });
                });

                // Xử lý modal
                window.openEditModal = function(orderId, currentStatus, customer, total, date) {
                    const modal = document.getElementById("editOrderModal");
                    const statusSelect = document.getElementById("orderStatus");
                    const orderIdInput = document.getElementById("orderId");
                    const form = document.getElementById("editOrderForm");
                    document.getElementById("modalOrderId").textContent = orderId;
                    document.getElementById("modalCustomer").textContent = customer;
                    document.getElementById("modalTotal").textContent = total;
                    document.getElementById("modalDate").textContent = date;
                    orderIdInput.value = orderId.replace('#DH-', '');
                    statusSelect.value = currentStatus;
                    form.action = `/admin/orders/${orderIdInput.value}`;
                    modal.classList.add("show");
                };

                window.closeEditModal = function() {
                    const modal = document.getElementById("editOrderModal");
                    modal.classList.remove("show");
                };

                // Xử lý xóa đơn hàng
                window.deleteOrder = function(orderId) {
                    if (confirm("Bạn có chắc muốn xóa đơn hàng này?")) {
                        window.location.href = `/admin/orders/${orderId.replace('#DH-', '')}/delete`;
                    }
                };

                // Xử lý toast
                function showToast(message, type) {
                    const toast = document.getElementById("toast");
                    toast.innerHTML = message;
                    toast.className = `aorders-toast aorders-toast-${type} show`;
                    setTimeout(() => toast.classList.remove("show"), 3000);
                }
            });
        </script>
    </div>
@endsection