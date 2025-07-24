@extends('admin.app')
<style>
    .acustomermanagement-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .acustomermanagement-search-bar input {
        padding: 8px 12px;
        width: 280px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }

    .acustomermanagement-subheader {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .acustomermanagement-page-title {
        font-size: 26px;
        font-weight: bold;
        color: #333;
        margin: 0;
    }

    .acustomermanagement-filter-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .acustomermanagement-filter-actions select,
    .acustomermanagement-filter-actions button {
        padding: 8px 12px;
        font-size: 14px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    /* Nâng cấp modal form */
    .acustomermanagement-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .acustomermanagement-modal-content {
        background: #fff;
        width: 100%;
        max-width: 550px;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        max-height: 90vh;
        overflow-y: auto;
    }

    .acustomermanagement-modal-content h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .acustomermanagement-form-group {
        margin-bottom: 15px;
    }

    .acustomermanagement-form-group label {
        font-weight: 600;
        display: block;
        margin-bottom: 5px;
        color: #333;
    }

    .modal-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        transition: 0.3s;
    }

    .modal-input:focus {
        border-color: #409eff;
        outline: none;
    }

    .acustomermanagement-modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
    }
</style>

@section('admin.body')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlykhachhang.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <div class="acustomermanagement-main-content">

        <!-- Phần tìm kiếm và người dùng -->
        <div class="acustomermanagement-header">
            <div class="acustomermanagement-search-bar">
                <input type="text" id="searchInput" placeholder="Tìm theo tên, email, mã KH...">
            </div>

            <div class="ausermanagement-user-profile">
                <div class="ausermanagement-notification-bell">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="ausermanagement-profile-avatar">QT</div>
            </div>
        </div>

        <!-- Tiêu đề -->
        <h1 class="acustomermanagement-page-title">Quản lý khách hàng</h1>

        <!-- Bộ lọc và nút thêm nằm ngay dưới h1 -->
        <div class="acustomermanagement-subheader">
            <div class="acustomermanagement-filter-actions">
                <select id="activityFilter">
                    <option value="">Tất cả trạng thái</option>
                    <option value="1">Hoạt động</option>
                    <option value="0">Tạm khóa</option>
                </select>
                <button id="addCustomerBtn" class="acustomermanagement-btn acustomermanagement-btn-primary">+ Thêm khách
                    hàng</button>
            </div>
        </div>


        <div class="acustomermanagement-data-card">
            <table class="acustomermanagement-data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Trạng thái</th>
                        <th>Kích hoạt</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody id="customerTableBody">
                    @foreach ($customers as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                @if ($user->is_locked)
                                    <span class="acustomermanagement-status-badge acustomermanagement-status-active">Hoạt
                                        động</span>
                                @else
                                    <span class="acustomermanagement-status-badge acustomermanagement-status-inactive">Tạm
                                        khóa</span>
                                @endif
                            </td>
                            <td>{{ $user->is_active ? 'Đã kích hoạt' : 'Chưa kích hoạt' }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                <button onclick="viewUser({{ $user->id }})"
                                    class="acustomermanagement-btn acustomermanagement-btn-secondary">Xem</button>
                                <button onclick="editUser({{ $user->id }})"
                                    class="acustomermanagement-btn acustomermanagement-btn-primary">Sửa</button>
                                <button onclick="deleteUser({{ $user->id }})"
                                    class="acustomermanagement-btn acustomermanagement-btn-danger">Xoá</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="acustomermanagement-pagination mt-3">
                {{ $customers->links() }}
            </div>
        </div>
    </div>

    <!-- Modal sửa/xem -->
    <div class="acustomermanagement-modal" id="customerModal" style="display: none">
        <div class="acustomermanagement-modal-content">
            <h2 id="modalTitle">Thông tin khách hàng</h2>
            <input type="hidden" id="customerId">

            <div class="acustomermanagement-form-group">
                <label>Tên:</label>
                <input type="text" id="modalName" class="modal-input">
            </div>

            <div class="acustomermanagement-form-group">
                <label>Email:</label>
                <input type="email" id="modalEmail" class="modal-input">
            </div>

            <div class="acustomermanagement-form-group">
                <label>SĐT:</label>
                <input type="text" id="modalPhone" class="modal-input">
            </div>

            <div class="acustomermanagement-form-group">
                <label>Địa chỉ:</label>
                <input type="text" id="modalAddress" class="modal-input">
            </div>

            <div class="acustomermanagement-form-group">
                <label>Trạng thái hoạt động:</label>
                <select id="modalLocked" class="modal-input">
                    <option value="1">Hoạt động</option>
                    <option value="0">Tạm khóa</option>
                </select>
            </div>

            <div class="acustomermanagement-form-group">
                <label>Lý do khóa (nếu có):</label>
                <input type="text" id="modalLockReason" class="modal-input">
            </div>

            <div class="acustomermanagement-form-group" id="modalCreatedWrapper" style="display: none;">
                <label>Ngày tạo:</label>
                <input type="text" id="modalCreated" class="modal-input" readonly>
            </div>

            <div class="acustomermanagement-modal-footer">
                <button id="saveCustomerBtn" class="acustomermanagement-btn acustomermanagement-btn-primary">Lưu</button>
                <button onclick="closeModal()"
                    class="acustomermanagement-btn acustomermanagement-btn-secondary">Đóng</button>
            </div>
        </div>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const activityFilter = document.getElementById('activityFilter');
        const tableBody = document.getElementById('customerTableBody');

        searchInput.addEventListener('input', filterTable);
        activityFilter.addEventListener('change', filterTable);

        function filterTable() {
            const keyword = searchInput.value.toLowerCase();
            const status = activityFilter.value;

            Array.from(tableBody.rows).forEach(row => {
                const id = row.cells[0].innerText.toLowerCase();
                const name = row.cells[1].innerText.toLowerCase();
                const email = row.cells[2].innerText.toLowerCase();
                const isActive = row.cells[4].innerText.includes('Hoạt');

                const matchSearch = id.includes(keyword) || name.includes(keyword) || email.includes(keyword);
                const matchStatus = status === "" || (status === "1" && isActive) || (status === "0" && !isActive);

                row.style.display = (matchSearch && matchStatus) ? "" : "none";
            });
        }

        document.getElementById("addCustomerBtn").addEventListener("click", () => {
            openModal();
        });

        function openModal(data = null, viewOnly = false) {
            const modal = document.getElementById("customerModal");
            modal.style.display = "flex";

            document.getElementById("modalTitle").innerText = viewOnly ?
                "Chi tiết khách hàng" :
                (data ? "Sửa khách hàng" : "Thêm khách hàng");

            document.getElementById("customerId").value = data?.id || '';
            document.getElementById("modalName").value = data?.name || '';
            document.getElementById("modalEmail").value = data?.email || '';
            document.getElementById("modalPhone").value = data?.phone || '';
            document.getElementById("modalAddress").value = data?.address || '';
            document.getElementById("modalLocked").value = data?.is_locked ?? 1;
            document.getElementById("modalLockReason").value = data?.lock_reason || '';
            document.getElementById("modalCreated").value = data?.created_at || '';

            document.getElementById("modalCreatedWrapper").style.display = viewOnly ? "block" : "none";

            const inputs = modal.querySelectorAll("input, select");
            inputs.forEach(input => input.disabled = viewOnly);

            if (data) document.getElementById("modalEmail").disabled = true;
            document.getElementById("saveCustomerBtn").style.display = viewOnly ? "none" : "inline-block";
        }

        function closeModal() {
            document.getElementById("customerModal").style.display = "none";
        }

        function viewUser(id) {
            fetch(`/admin/khachhang/${id}`)
                .then(res => res.json())
                .then(user => {
                    openModal(user, true);
                });
        }

        function editUser(id) {
            fetch(`/admin/khachhang/${id}`)
                .then(res => res.json())
                .then(user => {
                    openModal(user, false);
                });
        }

        document.getElementById("saveCustomerBtn").addEventListener("click", () => {
            const id = document.getElementById("customerId").value;
            const data = {
                name: document.getElementById("modalName").value,
                email: document.getElementById("modalEmail").value,
                phone: document.getElementById("modalPhone").value,
                address: document.getElementById("modalAddress").value,
                is_locked: document.getElementById("modalLocked").value,
                lock_reason: document.getElementById("modalLockReason").value
            };

            const url = id ? `/admin/khachhang/${id}` : '/admin/khachhang';
            const method = id ? 'PUT' : 'POST';

            fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                })
                .then(res => res.json())
                .then(data => {
                    alert(data.message || "Thành công!");
                    location.reload();
                })
                .catch(err => {
                    alert("Lỗi khi lưu!");
                    console.error(err);
                });
        });

        function deleteUser(id) {
            if (confirm("Bạn có chắc muốn xoá khách hàng này không?")) {
                fetch(`/admin/khachhang/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert(data.message);
                        location.reload();
                    });
            }
        }
    </script>
@endsection
