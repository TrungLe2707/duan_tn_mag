@extends('admin.app')

@section('admin.body')
    <style>
        .apromotions-checkbox-container {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 4px;
        }
        .apromotions-checkbox-item {
            margin-bottom: 8px;
        }
        .error-message {
            color: red;
            font-size: 12px;
            display: none;
        }
    </style>
    <div class="apromotions-main-content">
        <div class="apromotions-header">
            <div class="apromotions-search-bar">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Tìm kiếm khuyến mãi..." />
            </div>
            <div class="apromotions-user-profile">
                <div class="apromotions-notification-bell">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="apromotions-profile-avatar">QT</div>
            </div>
        </div>
        <h1 class="apromotions-page-title">Quản lý khuyến mãi</h1>
        <p class="apromotions-page-subtitle">
            Tạo và quản lý các chương trình khuyến mãi
        </p>
        <div class="apromotions-actions-container">
            <button class="apromotions-btn apromotions-btn-primary" id="createPromotionBtn">
                Tạo khuyến mãi
            </button>
        </div>
        <table class="apromotions-promotion-table" id="promotionTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên chương trình</th>
                    <th>Giảm giá</th>
                    <th>Giờ bắt đầu</th>
                    <th>Giờ kết thúc</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="promotionList">
                @foreach ($promotions as $program)
                <tr>
                    <td>{{ $program->id }}</td>
                    <td>{{ $program->name }}</td>
                    <td>{{ $program->percent_discount }}%</td>
                    <td>{{ \Carbon\Carbon::parse($program->start_hour)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($program->end_hour)->format('H:i') }}</td>
                    <td class="{{ $program->status == 'active' ? 'status-active' : 'status-inactive' }}">{{ $program->status == 'active' ? 'Kích hoạt' : 'Không kích hoạt' }}</td>
                    <td class="actions">
                        <button class="apromotions-btn apromotions-btn-primary edit-btn"
                                data-id="{{ $program->id }}"
                                data-products="{{ $program->products->pluck('id')->implode(',') }}"
                                data-name="{{ $program->name }}"
                                data-discount="{{ $program->percent_discount }}"
                                data-start-hour="{{ \Carbon\Carbon::parse($program->start_hour)->format('H:i') }}"
                                data-end-hour="{{ \Carbon\Carbon::parse($program->end_hour)->format('H:i') }}"
                                data-status="{{ $program->status }}">
                            <i class="fas fa-edit"></i> Sửa
                        </button>
                        <form action="{{ route('admin.countdown.destroy', $program->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="apromotions-btn apromotions-btn-danger" onclick="return confirm('Bạn có chắc muốn xóa khuyến mãi này?')">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="apromotions-pagination" id="pagination"></div>
    </div>

    <!-- Create Promotion Modal -->
    <div class="apromotions-modal" id="createPromotionModal">
        <div class="apromotions-modal-content">
            <span class="apromotions-modal-close" id="createCloseModal">×</span>
            <h2 id="createModalTitle">Tạo chương trình khuyến mãi</h2>
            <form id="createPromotionForm" action="{{ route('admin.countdown.store') }}" method="POST">
                @csrf
                <div class="apromotions-form-group">
                    <label>Tên chương trình</label>
                    <input type="text" name="name" id="createPromotionName" placeholder="Nhập tên chương trình" value="{{ old('name') }}" required />
                    <span class="error-message" id="createPromotionNameError">@error('name') {{ $message }} @else Vui lòng nhập tên chương trình @enderror</span>
                </div>
                <div class="apromotions-form-group">
                    <label>Giảm giá (%)</label>
                    <input type="number" name="percent_discount" id="createPromotionDiscount" placeholder="Nhập phần trăm giảm giá" min="1" max="100" value="{{ old('percent_discount') }}" required />
                    <span class="error-message" id="createPromotionDiscountError">@error('percent_discount') {{ $message }} @else Vui lòng nhập giá trị từ 1 đến 100 @enderror</span>
                </div>
                <div class="apromotions-form-group">
                    <label>Giờ bắt đầu (mỗi ngày)</label>
                    <input type="time" name="start_hour" id="createStartHour" value="{{ old('start_hour') }}" required />
                    <span class="error-message" id="createStartHourError">@error('start_hour') {{ $message }} @else Vui lòng chọn giờ bắt đầu @enderror</span>
                </div>
                <div class="apromotions-form-group">
                    <label>Giờ kết thúc (mỗi ngày)</label>
                    <input type="time" name="end_hour" id="createEndHour" value="{{ old('end_hour') }}" required />
                    <span class="error-message" id="createEndHourError">@error('end_hour') {{ $message }} @else Vui lòng chọn giờ kết thúc @enderror</span>
                </div>
                <div class="apromotions-form-group">
                    <label>Sản phẩm áp dụng</label>
                    <div class="apromotions-checkbox-container">
                        @foreach ($products as $product)
                            <div class="apromotions-checkbox-item" style="display: flex; gap: 5px; align-items: center;">
                                <input style="width: 30px" type="checkbox" name="product_ids[]" id="create_product_{{ $product->id }}" value="{{ $product->id }}" {{ in_array($product->id, old('product_ids', [])) ? 'checked' : '' }} />
                                <label for="create_product_{{ $product->id }}">{{ $product->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <span class="error-message" id="createPromotionProductsError">@error('product_ids') {{ $message }} @else Vui lòng chọn ít nhất một sản phẩm @enderror</span>
                </div>
                <div class="apromotions-form-group">
                    <label>Trạng thái</label>
                    <select name="status" id="createPromotionStatus" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Không kích hoạt</option>
                    </select>
                </div>
                <div class="apromotions-modal-actions">
                    <button class="apromotions-btn apromotions-btn-primary" type="submit" id="createSubmitPromotion">
                        Tạo
                    </button>
                    <button type="button" class="apromotions-btn apromotions-btn-secondary" id="createCancelModal">
                        Hủy
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Update Promotion Modal -->
    <div class="apromotions-modal" id="updatePromotionModal">
        <div class="apromotions-modal-content">
            <span class="apromotions-modal-close" id="updateCloseModal">×</span>
            <h2 id="updateModalTitle">Cập nhật chương trình khuyến mãi</h2>
            <form id="updatePromotionForm" method="POST">
                @csrf
                @method('PUT')
                <div class="apromotions-form-group">
                    <label>Tên chương trình</label>
                    <input type="text" name="name" id="updatePromotionName" placeholder="Nhập tên chương trình" value="{{ old('name') }}" required />
                    <span class="error-message" id="updatePromotionNameError">@error('name') {{ $message }} @else Vui lòng nhập tên chương trình @enderror</span>
                </div>
                <div class="apromotions-form-group">
                    <label>Giảm giá (%)</label>
                    <input type="number" name="percent_discount" id="updatePromotionDiscount" placeholder="Nhập phần trăm giảm giá" min="1" max="100" value="{{ old('percent_discount') }}" required />
                    <span class="error-message" id="updatePromotionDiscountError">@error('percent_discount') {{ $message }} @else Vui lòng nhập giá trị từ 1 đến 100 @enderror</span>
                </div>
                <div class="apromotions-form-group">
                    <label>Giờ bắt đầu (mỗi ngày)</label>
                    <input type="time" name="start_hour" id="updateStartHour" value="{{ old('start_hour') }}" required />
                    <span class="error-message" id="updateStartHourError">@error('start_hour') {{ $message }} @else Vui lòng chọn giờ bắt đầu @enderror</span>
                </div>
                <div class="apromotions-form-group">
                    <label>Giờ kết thúc (mỗi ngày)</label>
                    <input type="time" name="end_hour" id="updateEndHour" value="{{ old('end_hour') }}" required />
                    <span class="error-message" id="updateEndHourError">@error('end_hour') {{ $message }} @else Vui lòng chọn giờ kết thúc @enderror</span>
                </div>
                <div class="apromotions-form-group">
                    <label>Sản phẩm áp dụng</label>
                    <div class="apromotions-checkbox-container">
                        @foreach ($products as $product)
                            <div class="apromotions-checkbox-item" style="display: flex; gap: 5px; align-items: center;">
                                <input style="width: 30px" type="checkbox" name="product_ids[]" id="update_product_{{ $product->id }}" value="{{ $product->id }}" {{ in_array($product->id, old('product_ids', [])) ? 'checked' : '' }} />
                                <label for="update_product_{{ $product->id }}">{{ $product->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <span class="error-message" id="updatePromotionProductsError">@error('product_ids') {{ $message }} @else Vui lòng chọn ít nhất một sản phẩm @enderror</span>
                </div>
                <div class="apromotions-form-group">
                    <label>Trạng thái</label>
                    <select name="status" id="updatePromotionStatus" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Không kích hoạt</option>
                    </select>
                </div>
                <div class="apromotions-modal-actions">
                    <button class="apromotions-btn apromotions-btn-primary" type="submit" id="updateSubmitPromotion">
                        Cập nhật
                    </button>
                    <button type="button" class="apromotions-btn apromotions-btn-secondary" id="updateCancelModal">
                        Hủy
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarItems = document.querySelectorAll(".apromotions-sidebar-item");
            const createPromotionBtn = document.getElementById("createPromotionBtn");
            const createPromotionModal = document.getElementById("createPromotionModal");
            const updatePromotionModal = document.getElementById("updatePromotionModal");
            const createCloseModal = document.getElementById("createCloseModal");
            const updateCloseModal = document.getElementById("updateCloseModal");
            const createCancelModal = document.getElementById("createCancelModal");
            const updateCancelModal = document.getElementById("updateCancelModal");
            const createPromotionForm = document.getElementById("createPromotionForm");
            const updatePromotionForm = document.getElementById("updatePromotionForm");
            const promotionList = document.getElementById("promotionList");
            const pagination = document.getElementById("pagination");
            const searchInput = document.getElementById("searchInput");
            const promotionRows = promotionList.querySelectorAll("tr");

            const itemsPerPage = 5;
            let currentPage = 1;

            // Display server-side success message
            @if (session('success'))
                alert("{{ session('success') }}");
            @endif

            // Xử lý active sidebar item
            sidebarItems.forEach((item) => {
                item.addEventListener("click", function(e) {
                    e.preventDefault();
                    sidebarItems.forEach((i) => i.classList.remove("apromotions-active"));
                    this.classList.add("apromotions-active");
                });
            });

            // Hàm validate form phía client
            function validateForm(formType) {
                let isValid = true;
                const prefix = formType === 'create' ? 'create' : 'update';
                const name = document.getElementById(`${prefix}PromotionName`).value.trim();
                const discount = document.getElementById(`${prefix}PromotionDiscount`).value;
                const startHour = document.getElementById(`${prefix}StartHour`).value;
                const endHour = document.getElementById(`${prefix}EndHour`).value;
                const products = Array.from(
                    document.querySelectorAll(`#${prefix}PromotionForm input[name="product_ids[]"]:checked`)
                ).map((checkbox) => checkbox.value);

                document.getElementById(`${prefix}PromotionNameError`).style.display = name ? "none" : "block";
                document.getElementById(`${prefix}PromotionDiscountError`).style.display =
                    (discount >= 1 && discount <= 100) ? "none" : "block";
                document.getElementById(`${prefix}PromotionStartDateError`).style.display =
                    startDate ? "none" : "block";
                document.getElementById(`${prefix}PromotionEndDateError`).style.display =
                    endDate ? "none" : "block";
                document.getElementById(`${prefix}StartHourError`).style.display =
                    startHour ? "none" : "block";
                document.getElementById(`${prefix}EndHourError`).style.display =
                    endHour ? "none" : "block";
                document.getElementById(`${prefix}PromotionProductsError`).style.display =
                    products.length > 0 ? "none" : "block";

                if (
                    !name ||
                    !(discount >= 1 && discount <= 100) ||
                    !startHour ||
                    !endHour ||
                    products.length === 0
                ) {
                    isValid = false;
                }

                return isValid;
            }

            // Mở modal tạo
            function openCreateModal() {
                createPromotionModal.style.display = "flex";
                updatePromotionModal.style.display = "none";
                document.getElementById("createPromotionName").value = "";
                document.getElementById("createPromotionDiscount").value = "";
                document.getElementById("createStartHour").value = "";
                document.getElementById("createEndHour").value = "";
                document.querySelectorAll('#createPromotionForm input[name="product_ids[]"]').forEach((checkbox) => {
                    checkbox.checked = false;
                });
                document.getElementById("createPromotionStatus").value = "active";
                document.querySelectorAll("#createPromotionForm .error-message").forEach((error) => {
                    error.style.display = "none";
                });
                document.querySelector(".apromotions-modal-content").scrollTop = 0;
            }

            // Mở modal cập nhật
            function openUpdateModal(promotion) {
                updatePromotionModal.style.display = "flex";
                createPromotionModal.style.display = "none";
                document.getElementById("updatePromotionName").value = promotion.name;
                document.getElementById("updatePromotionDiscount").value = promotion.discount;
                document.getElementById("updateStartHour").value = promotion.startHour;
                document.getElementById("updateEndHour").value = promotion.endHour;
                document.getElementById("updatePromotionStatus").value = promotion.status;
                document.querySelectorAll('#updatePromotionForm input[name="product_ids[]"]').forEach((checkbox) => {
                    checkbox.checked = promotion.products.includes(checkbox.value);
                });
                updatePromotionForm.action = `/admin/countdown/${promotion.id}`;
                document.querySelectorAll("#updatePromotionForm .error-message").forEach((error) => {
                    error.style.display = "none";
                });
                document.querySelector(".apromotions-modal-content").scrollTop = 0;
            }

            // Đóng modal
            function closeModal(modalId) {
                document.getElementById(modalId).style.display = "none";
                document.querySelectorAll(`#${modalId} .error-message`).forEach((error) => {
                    error.style.display = "none";
                });
            }

            createPromotionBtn.addEventListener("click", openCreateModal);
            createCloseModal.addEventListener("click", () => closeModal("createPromotionModal"));
            createCancelModal.addEventListener("click", () => closeModal("createPromotionModal"));
            updateCloseModal.addEventListener("click", () => closeModal("updatePromotionModal"));
            updateCancelModal.addEventListener("click", () => closeModal("updatePromotionModal"));
            createPromotionModal.addEventListener("click", (e) => {
                if (e.target === createPromotionModal) closeModal("createPromotionModal");
            });
            updatePromotionModal.addEventListener("click", (e) => {
                if (e.target === updatePromotionModal) closeModal("updatePromotionModal");
            });

            // Modal submit
            createPromotionForm.addEventListener("submit", (e) => {
                if (!validateForm('create')) {
                    e.preventDefault();
                }
            });
            updatePromotionForm.addEventListener("submit", (e) => {
                if (!validateForm('update')) {
                    e.preventDefault();
                }
            });

            // Xử lý nút sửa
            promotionRows.forEach((row) => {
                const editBtn = row.querySelector(".edit-btn");
                editBtn.addEventListener("click", () => {
                    const promotion = {
                        id: editBtn.dataset.id,
                        name: editBtn.dataset.name,
                        discount: parseInt(editBtn.dataset.discount),
                        startHour: editBtn.dataset.startHour,
                        endHour: editBtn.dataset.endHour,
                        products: editBtn.dataset.products ? editBtn.dataset.products.split(",") : [],
                        status: editBtn.dataset.status
                    };
                    openUpdateModal(promotion);
                });
            });

            // Tìm kiếm khuyến mãi
            searchInput.addEventListener("input", () => {
                const searchTerm = searchInput.value.toLowerCase();
                let visibleRows = 0;

                promotionRows.forEach((row) => {
                    const name = row.cells[1].textContent.toLowerCase();
                    if (
                        searchTerm === "" ||
                        name.includes(searchTerm)
                    ) {
                        row.style.display = "";
                        visibleRows++;
                    } else {
                        row.style.display = "none";
                    }
                });

                console.log(`Search term: "${searchTerm}", Visible rows: ${visibleRows}`);
                currentPage = 1;
                renderPromotions(currentPage, visibleRows);
                renderPagination(visibleRows);
            });

            // Hiển thị các hàng khuyến mãi theo trang
            function renderPromotions(page, visibleRows) {
                console.log(`Rendering page ${page}, Total visible rows: ${visibleRows}`);
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                let visibleCount = 0;

                promotionRows.forEach((row) => {
                    if (row.style.display !== "none") {
                        if (visibleCount >= start && visibleCount < end) {
                            row.classList.add("visible");
                            console.log(`Showing row ID: ${row.cells[0].textContent}`);
                        } else {
                            row.classList.remove("visible");
                        }
                        visibleCount++;
                    } else {
                        row.classList.remove("visible");
                    }
                });

                if (visibleRows === 0) {
                    promotionList.innerHTML =
                        '<tr><td colspan="9" style="text-align: center;">Không tìm thấy khuyến mãi nào.</td></tr>';
                    console.log("No promotions found, displaying empty message");
                } else if (
                    promotionList.innerHTML.includes("Không tìm thấy khuyến mãi nào") &&
                    visibleRows > 0
                ) {
                    location.reload(); // Temporary fix for static data
                }
            }

            // Hiển thị phân trang
            function renderPagination(visibleRows) {
                pagination.innerHTML = "";
                const totalPages = Math.ceil(visibleRows / itemsPerPage);
                const maxVisiblePages = 5;
                const halfVisible = Math.floor(maxVisiblePages / 2);
                let startPage = Math.max(1, currentPage - halfVisible);
                let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

                if (endPage - startPage + 1 < maxVisiblePages) {
                    startPage = Math.max(1, endPage - maxVisiblePages + 1);
                }

                console.log(`Total pages: ${totalPages}, Start page: ${startPage}, End page: ${endPage}`);
                for (let i = startPage; i <= endPage; i++) {
                    const btn = document.createElement("button");
                    btn.className = "apromotions-pagination-btn";
                    btn.textContent = i;
                    if (i === currentPage) btn.classList.add("active");
                    btn.addEventListener("click", () => {
                        currentPage = i;
                        console.log(`Switching to page ${currentPage}`);
                        renderPromotions(currentPage, visibleRows);
                        renderPagination(visibleRows);
                    });
                    pagination.appendChild(btn);
                }
            }

            // Khởi tạo giao diện
            const initialVisibleRows = promotionRows.length;
            console.log(`Initial visible rows: ${initialVisibleRows}`);
            promotionRows.forEach((row) => {
                row.style.display = "";
            });
            renderPromotions(currentPage, initialVisibleRows);
            renderPagination(initialVisibleRows);
        });
    </script>
@endsection
