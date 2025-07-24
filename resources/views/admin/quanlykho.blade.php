@extends('admin.app')

@section('admin.body')
        <div class="awarehousemanagement-main-content">
            <div class="awarehousemanagement-header">
                <div class="awarehousemanagement-search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Tìm kiếm sản phẩm trong kho..."
                        id="awarehousemanagement-searchInput" />
                </div>
                <div class="awarehousemanagement-user-profile">
                    <div class="awarehousemanagement-notification-bell">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="awarehousemanagement-profile-avatar">QT</div>
                </div>
            </div>
            <h1 class="awarehousemanagement-page-title">Quản lý kho</h1>
            <p class="awarehousemanagement-page-subtitle">
                Theo dõi và quản lý số lượng tồn kho của cửa hàng
            </p>
            <div class="awarehousemanagement-filter-bar">
                <select class="awarehousemanagement-filter-select" id="awarehousemanagement-categoryFilter">
                    <option value="">Tất cả danh mục</option>
                    <option value="áo">Áo</option>
                    <option value="quần">Quần</option>
                    <option value="phụ kiện">Phụ kiện</option>
                </select>
                <button class="awarehousemanagement-btn awarehousemanagement-btn-primary"
                    id="awarehousemanagement-addProductBtn">
                    Thêm sản phẩm
                </button>
            </div>
            <div class="awarehousemanagement-data-card">
                <table class="awarehousemanagement-data-table" id="awarehousemanagement-inventoryTable">
                    <thead>
                        <tr>
                            <th data-label="Hình ảnh">Hình ảnh</th>
                            <th data-label="Mã sản phẩm">Mã sản phẩm</th>
                            <th data-label="Sản phẩm">Sản phẩm</th>
                            <th data-label="Danh mục">Danh mục</th>
                            <th data-label="Biến thể">Biến thể</th>
                            <th data-label="Số lượng">Số lượng</th>
                            <th data-label="Giá (VNĐ)">Giá (VNĐ)</th>
                            <th data-label="Hành động">Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="awarehousemanagement-inventoryTableBody">
                        <tr>
                            <td data-label="Hình ảnh">
                                <img src="https://placehold.co/50x50" alt="Áo thun nam cổ tròn"
                                    class="awarehousemanagement-image" />
                            </td>
                            <td data-label="Mã sản phẩm">SP001</td>
                            <td data-label="Sản phẩm">Áo thun nam cổ tròn</td>
                            <td data-label="Danh mục">Áo</td>
                            <td data-label="Biến thể" class="awarehousemanagement-variants" data-tooltip="S: Đen, M: Trắng">
                                S: Đen, M: Trắng
                            </td>
                            <td data-label="Số lượng">120</td>
                            <td data-label="Giá (VNĐ)" class="awarehousemanagement-price">
                                150,000
                            </td>
                            <td data-label="Hành động">
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-primary awarehousemanagement-edit-btn"
                                    data-tooltip="Chỉnh sửa sản phẩm">
                                    Cập nhật
                                </button>
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-secondary awarehousemanagement-view-btn"
                                    data-tooltip="Xem chi tiết sản phẩm">
                                    Xem
                                </button>
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-danger awarehousemanagement-delete-btn"
                                    data-tooltip="Xóa sản phẩm">
                                    Xóa
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td data-label="Hình ảnh">
                                <img src="https://placehold.co/50x50" alt="Quần jeans nam slimfit"
                                    class="awarehousemanagement-image" />
                            </td>
                            <td data-label="Mã sản phẩm">SP002</td>
                            <td data-label="Sản phẩm">Quần jeans nam slimfit</td>
                            <td data-label="Danh mục">Quần</td>
                            <td data-label="Biến thể" class="awarehousemanagement-variants" data-tooltip="30: Xanh đậm">
                                30: Xanh đậm
                            </td>
                            <td data-label="Số lượng">15</td>
                            <td data-label="Giá (VNĐ)" class="awarehousemanagement-price">
                                350,000
                            </td>
                            <td data-label="Hành động">
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-primary awarehousemanagement-edit-btn"
                                    data-tooltip="Chỉnh sửa sản phẩm">
                                    Cập nhật
                                </button>
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-secondary awarehousemanagement-view-btn"
                                    data-tooltip="Xem chi tiết sản phẩm">
                                    Xem
                                </button>
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-danger awarehousemanagement-delete-btn"
                                    data-tooltip="Xóa sản phẩm">
                                    Xóa
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td data-label="Hình ảnh">
                                <img src="https://placehold.co/50x50" alt="Mũ lưỡi trai unisex"
                                    class="awarehousemanagement-image" />
                            </td>
                            <td data-label="Mã sản phẩm">SP003</td>
                            <td data-label="Sản phẩm">Mũ lưỡi trai unisex</td>
                            <td data-label="Danh mục">Phụ kiện</td>
                            <td data-label="Biến thể" class="awarehousemanagement-variants" data-tooltip="Đen">
                                Đen
                            </td>
                            <td data-label="Số lượng">0</td>
                            <td data-label="Giá (VNĐ)" class="awarehousemanagement-price">
                                80,000
                            </td>
                            <td data-label="Hành động">
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-primary awarehousemanagement-edit-btn"
                                    data-tooltip="Chỉnh sửa sản phẩm">
                                    Cập nhật
                                </button>
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-secondary awarehousemanagement-view-btn"
                                    data-tooltip="Xem chi tiết sản phẩm">
                                    Xem
                                </button>
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-danger awarehousemanagement-delete-btn"
                                    data-tooltip="Xóa sản phẩm">
                                    Xóa
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td data-label="Hình ảnh">
                                <img src="https://placehold.co/50x50" alt="Áo sơ mi nữ tay dài"
                                    class="awarehousemanagement-image" />
                            </td>
                            <td data-label="Mã sản phẩm">SP004</td>
                            <td data-label="Sản phẩm">Áo sơ mi nữ tay dài</td>
                            <td data-label="Danh mục">Áo</td>
                            <td data-label="Biến thể" class="awarehousemanagement-variants"
                                data-tooltip="S: Hồng, M: Trắng">
                                S: Hồng, M: Trắng
                            </td>
                            <td data-label="Số lượng">80</td>
                            <td data-label="Giá (VNĐ)" class="awarehousemanagement-price">
                                200,000
                            </td>
                            <td data-label="Hành động">
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-primary awarehousemanagement-edit-btn"
                                    data-tooltip="Chỉnh sửa sản phẩm">
                                    Cập nhật
                                </button>
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-secondary awarehousemanagement-view-btn"
                                    data-tooltip="Xem chi tiết sản phẩm">
                                    Xem
                                </button>
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-danger awarehousemanagement-delete-btn"
                                    data-tooltip="Xóa sản phẩm">
                                    Xóa
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td data-label="Hình ảnh">
                                <img src="https://placehold.co/50x50" alt="Quần short kaki nam"
                                    class="awarehousemanagement-image" />
                            </td>
                            <td data-label="Mã sản phẩm">SP005</td>
                            <td data-label="Sản phẩm">Quần short kaki nam</td>
                            <td data-label="Danh mục">Quần</td>
                            <td data-label="Biến thể" class="awarehousemanagement-variants" data-tooltip="30: Be">
                                30: Be
                            </td>
                            <td data-label="Số lượng">30</td>
                            <td data-label="Giá (VNĐ)" class="awarehousemanagement-price">
                                180,000
                            </td>
                            <td data-label="Hành động">
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-primary awarehousemanagement-edit-btn"
                                    data-tooltip="Chỉnh sửa sản phẩm">
                                    Cập nhật
                                </button>
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-secondary awarehousemanagement-view-btn"
                                    data-tooltip="Xem chi tiết sản phẩm">
                                    Xem
                                </button>
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-danger awarehousemanagement-delete-btn"
                                    data-tooltip="Xóa sản phẩm">
                                    Xóa
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td data-label="Hình ảnh">
                                <img src="https://placehold.co/50x50" alt="Túi xách da nữ"
                                    class="awarehousemanagement-image" />
                            </td>
                            <td data-label="Mã sản phẩm">SP006</td>
                            <td data-label="Sản phẩm">Túi xách da nữ</td>
                            <td data-label="Danh mục">Phụ kiện</td>
                            <td data-label="Biến thể" class="awarehousemanagement-variants" data-tooltip="Nâu">
                                Nâu
                            </td>
                            <td data-label="Số lượng">25</td>
                            <td data-label="Giá (VNĐ)" class="awarehousemanagement-price">
                                500,000
                            </td>
                            <td data-label="Hành động">
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-primary awarehousemanagement-edit-btn"
                                    data-tooltip="Chỉnh sửa sản phẩm">
                                    Cập nhật
                                </button>
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-secondary awarehousemanagement-view-btn"
                                    data-tooltip="Xem chi tiết sản phẩm">
                                    Xem
                                </button>
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-danger awarehousemanagement-delete-btn"
                                    data-tooltip="Xóa sản phẩm">
                                    Xóa
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td data-label="Hình ảnh">
                                <img src="https://placehold.co/50x50" alt="Áo khoác nam bomber"
                                    class="awarehousemanagement-image" />
                            </td>
                            <td data-label="Mã sản phẩm">SP007</td>
                            <td data-label="Sản phẩm">Áo khoác nam bomber</td>
                            <td data-label="Danh mục">Áo</td>
                            <td data-label="Biến thể" class="awarehousemanagement-variants" data-tooltip="M: Đen">
                                M: Đen
                            </td>
                            <td data-label="Số lượng">10</td>
                            <td data-label="Giá (VNĐ)" class="awarehousemanagement-price">
                                400,000
                            </td>
                            <td data-label="Hành động">
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-primary awarehousemanagement-edit-btn"
                                    data-tooltip="Chỉnh sửa sản phẩm">
                                    Cập nhật
                                </button>
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-secondary awarehousemanagement-view-btn"
                                    data-tooltip="Xem chi tiết sản phẩm">
                                    Xem
                                </button>
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-danger awarehousemanagement-delete-btn"
                                    data-tooltip="Xóa sản phẩm">
                                    Xóa
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td data-label="Hình ảnh">
                                <img src="https://placehold.co/50x50" alt="Áo polo nam"
                                    class="awarehousemanagement-image" />
                            </td>
                            <td data-label="Mã sản phẩm">SP008</td>
                            <td data-label="Sản phẩm">Áo polo nam</td>
                            <td data-label="Danh mục">Áo</td>
                            <td data-label="Biến thể" class="awarehousemanagement-variants" data-tooltip="S: Xanh navy">
                                S: Xanh navy
                            </td>
                            <td data-label="Số lượng">50</td>
                            <td data-label="Giá (VNĐ)" class="awarehousemanagement-price">
                                220,000
                            </td>
                            <td data-label="Hành động">
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-primary awarehousemanagement-edit-btn"
                                    data-tooltip="Chỉnh sửa sản phẩm">
                                    Cập nhật
                                </button>
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-secondary awarehousemanagement-view-btn"
                                    data-tooltip="Xem chi tiết sản phẩm">
                                    Xem
                                </button>
                                <button
                                    class="awarehousemanagement-btn awarehousemanagement-btn-danger awarehousemanagement-delete-btn"
                                    data-tooltip="Xóa sản phẩm">
                                    Xóa
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="awarehousemanagement-pagination">
                <div class="awarehousemanagement-pagination-controls" id="awarehousemanagement-paginationControls"></div>
            </div>
        </div>
    </div>
    <div class="awarehousemanagement-modal" id="awarehousemanagement-productModal">
        <div class="awarehousemanagement-modal-content">
            <div class="awarehousemanagement-modal-header">
                <h2 class="awarehousemanagement-modal-title" id="awarehousemanagement-modalTitle">
                    Thêm sản phẩm
                </h2>
                <span class="awarehousemanagement-modal-close" id="awarehousemanagement-modalClose">×</span>
            </div>
            <div class="awarehousemanagement-modal-body">
                <div>
                    <label for="awarehousemanagement-productImage">Hình ảnh</label>
                    <input type="file" id="awarehousemanagement-productImage" accept="image/*" />
                    <img id="awarehousemanagement-imagePreview" class="awarehousemanagement-image-preview"
                        alt="Xem trước hình ảnh" />
                </div>
                <div>
                    <label for="awarehousemanagement-productCode">Mã sản phẩm</label>
                    <input type="text" id="awarehousemanagement-productCode"
                        placeholder="Nhập mã sản phẩm (VD: SP001)" />
                </div>
                <div>
                    <label for="awarehousemanagement-productName">Tên sản phẩm</label>
                    <input type="text" id="awarehousemanagement-productName" placeholder="Nhập tên sản phẩm" />
                </div>
                <div>
                    <label for="awarehousemanagement-productCategory">Danh mục</label>
                    <select id="awarehousemanagement-productCategory">
                        <option value="áo">Áo</option>
                        <option value="quần">Quần</option>
                        <option value="phụ kiện">Phụ kiện</option>
                    </select>
                </div>
                <div id="awarehousemanagement-variantContainer">
                    <label>Biến thể</label>
                    <div class="awarehousemanagement-variant-field">
                        <input type="text" class="awarehousemanagement-variant-size" placeholder="Kích cỡ (VD: S)" />
                        <input type="text" class="awarehousemanagement-variant-color"
                            placeholder="Màu sắc (VD: Đen)" />
                        <button class="awarehousemanagement-remove-variant-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <button class="awarehousemanagement-add-variant-btn" id="awarehousemanagement-addVariantBtn">
                    Thêm biến thể
                </button>
                <div>
                    <label for="awarehousemanagement-productQuantity">Số lượng</label>
                    <input type="number" id="awarehousemanagement-productQuantity" placeholder="Nhập số lượng"
                        min="0" />
                </div>
                <div>
                    <label for="awarehousemanagement-productPrice">Giá (VNĐ)</label>
                    <input type="number" id="awarehousemanagement-productPrice" placeholder="Nhập giá (VD: 150000)"
                        min="0" />
                </div>
            </div>
            <div class="awarehousemanagement-modal-footer">
                <button class="awarehousemanagement-btn awarehousemanagement-btn-primary"
                    id="awarehousemanagement-saveProductBtn">
                    Lưu
                </button>
                <button class="awarehousemanagement-btn awarehousemanagement-btn-secondary"
                    id="awarehousemanagement-cancelProductBtn">
                    Hủy
                </button>
            </div>
        </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Sidebar interaction
            const awarehousemanagementSidebarItems = document.querySelectorAll(
                ".awarehousemanagement-sidebar-item"
            );
            awarehousemanagementSidebarItems.forEach((item) => {
                item.addEventListener("click", function(e) {
                    e.preventDefault();
                    awarehousemanagementSidebarItems.forEach((i) =>
                        i.classList.remove("awarehousemanagement-active")
                    );
                    this.classList.add("awarehousemanagement-active");
                });
            });

            // Modal handling
            const awarehousemanagementModal = document.getElementById(
                "awarehousemanagement-productModal"
            );
            const awarehousemanagementModalTitle = document.getElementById(
                "awarehousemanagement-modalTitle"
            );
            const awarehousemanagementProductImageInput = document.getElementById(
                "awarehousemanagement-productImage"
            );
            const awarehousemanagementImagePreview = document.getElementById(
                "awarehousemanagement-imagePreview"
            );
            const awarehousemanagementProductCodeInput = document.getElementById(
                "awarehousemanagement-productCode"
            );
            const awarehousemanagementProductNameInput = document.getElementById(
                "awarehousemanagement-productName"
            );
            const awarehousemanagementProductCategorySelect =
                document.getElementById("awarehousemanagement-productCategory");
            const awarehousemanagementProductQuantityInput =
                document.getElementById("awarehousemanagement-productQuantity");
            const awarehousemanagementProductPriceInput = document.getElementById(
                "awarehousemanagement-productPrice"
            );
            const awarehousemanagementVariantContainer = document.getElementById(
                "awarehousemanagement-variantContainer"
            );
            const awarehousemanagementAddVariantBtn = document.getElementById(
                "awarehousemanagement-addVariantBtn"
            );
            const awarehousemanagementSaveProductBtn = document.getElementById(
                "awarehousemanagement-saveProductBtn"
            );
            const awarehousemanagementCancelProductBtn = document.getElementById(
                "awarehousemanagement-cancelProductBtn"
            );
            const awarehousemanagementModalClose = document.getElementById(
                "awarehousemanagement-modalClose"
            );
            const awarehousemanagementAddProductBtn = document.getElementById(
                "awarehousemanagement-addProductBtn"
            );

            // Image preview
            awarehousemanagementProductImageInput.addEventListener(
                "change",
                function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            awarehousemanagementImagePreview.src = e.target.result;
                            awarehousemanagementImagePreview.style.display = "block";
                        };
                        reader.readAsDataURL(file);
                    } else {
                        awarehousemanagementImagePreview.style.display = "none";
                        awarehousemanagementImagePreview.src = "";
                    }
                }
            );

            function awarehousemanagementAddVariantField(size = "", color = "") {
                const variantField = document.createElement("div");
                variantField.className = "awarehousemanagement-variant-field";
                variantField.innerHTML = `
                    <input type="text" class="awarehousemanagement-variant-size" placeholder="Kích cỡ (VD: S)" value="${size}">
                    <input type="text" class="awarehousemanagement-variant-color" placeholder="Màu sắc (VD: Đen)" value="${color}">
                    <button class="awarehousemanagement-remove-variant-btn"><i class="fas fa-trash"></i></button>
                `;
                awarehousemanagementVariantContainer.appendChild(variantField);
                variantField
                    .querySelector(".awarehousemanagement-remove-variant-btn")
                    .addEventListener("click", () => {
                        if (
                            awarehousemanagementVariantContainer.querySelectorAll(
                                ".awarehousemanagement-variant-field"
                            ).length > 1
                        ) {
                            variantField.remove();
                        }
                    });
            }

            function awarehousemanagementOpenModal(mode, row = null) {
                awarehousemanagementModalTitle.textContent =
                    mode === "edit" ? "Sửa sản phẩm" : "Thêm sản phẩm";
                awarehousemanagementVariantContainer.innerHTML =
                    "<label>Biến thể</label>";
                if (row) {
                    awarehousemanagementImagePreview.src =
                        row.cells[0].querySelector("img").src;
                    awarehousemanagementImagePreview.style.display = "block";
                    awarehousemanagementProductImageInput.value = ""; // Clear file input
                    awarehousemanagementProductCodeInput.value =
                        row.cells[1].textContent;
                    awarehousemanagementProductNameInput.value =
                        row.cells[2].textContent;
                    awarehousemanagementProductCategorySelect.value =
                        row.cells[3].textContent.toLowerCase();
                    awarehousemanagementProductQuantityInput.value =
                        row.cells[5].textContent;
                    awarehousemanagementProductPriceInput.value =
                        row.cells[6].textContent.replace(/[^0-9]/g, "");
                    const variants = row.cells[4].textContent.split(", ").map((v) => {
                        const [size, color] = v.split(": ").map((s) => s.trim());
                        return {
                            size,
                            color
                        };
                    });
                    variants.forEach((v) =>
                        awarehousemanagementAddVariantField(v.size, v.color)
                    );
                } else {
                    awarehousemanagementImagePreview.src = "";
                    awarehousemanagementImagePreview.style.display = "none";
                    awarehousemanagementProductImageInput.value = "";
                    awarehousemanagementProductCodeInput.value = "";
                    awarehousemanagementProductNameInput.value = "";
                    awarehousemanagementProductCategorySelect.value = "áo";
                    awarehousemanagementProductQuantityInput.value = "";
                    awarehousemanagementProductPriceInput.value = "";
                    awarehousemanagementAddVariantField();
                }
                awarehousemanagementModal.style.display = "flex";
            }

            function awarehousemanagementCloseModal() {
                awarehousemanagementModal.style.display = "none";
            }

            awarehousemanagementAddProductBtn.addEventListener("click", () =>
                awarehousemanagementOpenModal("add")
            );
            awarehousemanagementAddVariantBtn.addEventListener("click", () =>
                awarehousemanagementAddVariantField()
            );
            awarehousemanagementCancelProductBtn.addEventListener(
                "click",
                awarehousemanagementCloseModal
            );
            awarehousemanagementModalClose.addEventListener(
                "click",
                awarehousemanagementCloseModal
            );
            awarehousemanagementSaveProductBtn.addEventListener("click", () => {
                alert("Chức năng lưu chỉ là demo, không lưu thực tế.");
                awarehousemanagementCloseModal();
            });

            // Pagination
            const awarehousemanagementItemsPerPage = 5;
            let awarehousemanagementCurrentPage = 1;
            const awarehousemanagementInventoryTableBody = document.getElementById(
                "awarehousemanagement-inventoryTableBody"
            );
            const awarehousemanagementRows = Array.from(
                awarehousemanagementInventoryTableBody.querySelectorAll("tr")
            );
            const awarehousemanagementPaginationControls = document.getElementById(
                "awarehousemanagement-paginationControls"
            );

            function awarehousemanagementRenderTable(filteredRows) {
                const start =
                    (awarehousemanagementCurrentPage - 1) *
                    awarehousemanagementItemsPerPage;
                const end = start + awarehousemanagementItemsPerPage;
                awarehousemanagementRows.forEach((row, index) => {
                    row.style.display =
                        filteredRows.includes(row) && index >= start && index < end ?
                        "" :
                        "none";
                });
                awarehousemanagementRenderPagination(filteredRows.length);
            }

            function awarehousemanagementRenderPagination(totalItems) {
                const totalPages = Math.ceil(
                    totalItems / awarehousemanagementItemsPerPage
                );
                awarehousemanagementPaginationControls.innerHTML = Array.from({
                        length: totalPages
                    },
                    (_, i) => `
                    <button class="awarehousemanagement-pagination-btn ${
                      awarehousemanagementCurrentPage === i + 1
                        ? "awarehousemanagement-active"
                        : ""
                    }">${i + 1}</button>
                `
                ).join("");
                document
                    .querySelectorAll(".awarehousemanagement-pagination-btn")
                    .forEach((btn, index) => {
                        btn.addEventListener("click", () => {
                            awarehousemanagementCurrentPage = index + 1;
                            awarehousemanagementRenderTable(
                                awarehousemanagementApplyFilters()
                            );
                        });
                    });
            }

            // Search and filter
            const awarehousemanagementSearchInput = document.getElementById(
                "awarehousemanagement-searchInput"
            );
            const awarehousemanagementCategoryFilter = document.getElementById(
                "awarehousemanagement-categoryFilter"
            );

            function awarehousemanagementApplyFilters() {
                const searchTerm =
                    awarehousemanagementSearchInput.value.toLowerCase();
                const category = awarehousemanagementCategoryFilter.value;

                return awarehousemanagementRows.filter((row) => {
                    const code = row.cells[1].textContent.toLowerCase();
                    const name = row.cells[2].textContent.toLowerCase();
                    const rowCategory = row.cells[3].textContent.toLowerCase();
                    const nameMatch =
                        code.includes(searchTerm) || name.includes(searchTerm);
                    const categoryMatch = !category || rowCategory === category;
                    return nameMatch && categoryMatch;
                });
            }

            awarehousemanagementSearchInput.addEventListener("input", () => {
                awarehousemanagementCurrentPage = 1;
                awarehousemanagementRenderTable(awarehousemanagementApplyFilters());
            });

            awarehousemanagementCategoryFilter.addEventListener("change", () => {
                awarehousemanagementCurrentPage = 1;
                awarehousemanagementRenderTable(awarehousemanagementApplyFilters());
            });

            // Table actions
            awarehousemanagementInventoryTableBody.addEventListener(
                "click",
                (e) => {
                    const row = e.target.closest("tr");
                    if (!row) return;

                    if (e.target.classList.contains("awarehousemanagement-edit-btn")) {
                        awarehousemanagementOpenModal("edit", row);
                    } else if (
                        e.target.classList.contains("awarehousemanagement-view-btn")
                    ) {
                        alert(
                            `Mã: ${row.cells[1].textContent}, Tên: ${row.cells[2].textContent}, Danh mục: ${row.cells[3].textContent}, Biến thể: ${row.cells[4].textContent}, Số lượng: ${row.cells[5].textContent}, Giá: ${row.cells[6].textContent}`
                        );
                    } else if (
                        e.target.classList.contains("awarehousemanagement-delete-btn")
                    ) {
                        alert("Chức năng xóa chỉ là demo, không xóa thực tế.");
                    }
                }
            );

            // Initial render
            awarehousemanagementRenderTable(awarehousemanagementRows);
        });
    </script>
@endsection
