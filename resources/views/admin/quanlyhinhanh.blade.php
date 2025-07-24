@extends('admin.app')

@section('admin.body')
    <div class="amanagementimg-main-content">

        <div class="amanagementimg-header">
            <form method="GET" action="{{ route('admin.images.index') }}" class="amanagementimg-filter-bar">
                <div class="amanagementimg-search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm hình ảnh..."
                        id="amanagementimg-searchInput" />
                </div>
            </form>

            <div class="amanagementimg-user-profile">
                <div class="amanagementimg-notification-bell">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="amanagementimg-profile-avatar">QT</div>
            </div>
        </div>
        <h1 class="amanagementimg-page-title">Quản lý hình ảnh sản phẩm</h1>
        <p class="amanagementimg-page-subtitle">
            Quản lý hình ảnh cho sản phẩm
        </p>
        <form method="GET" action="{{ route('admin.images.index') }}" class="amanagementimg-filter-bar">
            <div class="amanagementimg-filter-bar">
                <select name="category" class="amanagementimg-filter-select">
                    <option value="">Tất cả danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ $request->category == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>

                <select name="count" class="amanagementimg-filter-select" id="amanagementimg-imageCountFilter">
                    <option value="">Số lượng hình ảnh</option>
                    <option value="1">1 hình</option>
                    <option value="2">2 hình</option>
                    <option value="3">3 hình</option>
                    <option value="4">4 hình</option>
                    <option value="5">5 hình</option>
                </select>
                <button style="background-color: rgb(229, 115, 115)" class="amanagementimg-filter-select" type="submit">Lọc</button>
            </div>
        </form>


        <div class="amanagementimg-image-grid" id="amanagementimg-imageGrid">

            @foreach ($image as $productId => $images)
                @php
                    $product_name = $images->first()->image_product->name ?? 'Chưa có tên sản phẩm';
                    $primaryImage = $images->where('order', 1)->first();
                    $imageCount = $images->count();
                @endphp

                <div class="amanagementimg-image-item" data-category="mens-clothing" data-image-count="{{ $imageCount }}">
                    <div class="amanagementimg-image-info">
                        <p><strong>SP{{ $productId }}</strong> - {{ $product_name }}</p>

                    </div>
                    <div class="amanagementimg-image-row">

                        @for ($i = 0; $i < 5; $i++)
                            @php $img = $images[$i] ?? null; @endphp
                            @if ($img)
                                <div class="amanagementimg-image-container"
                                    data-primary="{{ $img->order == 1 ? 'true' : 'false' }}">
                                    <img src="{{ asset($img->path) }}"
                                        alt="{{ $img->image_product->name ?? 'Ảnh sản phẩm' }}"
                                        class="amanagementimg-image-preview" />
                                    @if ($img->order == 1)
                                        <i class="fas fa-star amanagementimg-primary-star"></i>
                                    @endif
                                </div>
                            @else
                                <div class="amanagementimg-add-image" data-product-id="{{ $productId }}"
                                    data-product-name="{{ $images[0]->image_product->name }}"
                                    data-add-url="{{ route('admin.images.store') }}">
                                    <i class="fas fa-plus"></i>
                                </div>
                            @endif
                        @endfor
                    </div>




                    <div class="amanagementimg-action-row">
                        @for ($i = 0; $i < 5; $i++)
                            @php $img = $images[$i] ?? null; @endphp
                            @if ($img)
                                <div class="amanagementimg-action-group">
                                    {{-- nút chọn ảnh  --}}

                                    <button class="amanagementimg-btn amanagementimg-btn-primary amanagementimg-edit-btn"
                                        data-tooltip="Chỉnh sửa hình ảnh" data-image-id="{{ $img->id }}"
                                        data-image-path="{{ asset($img->path) }}"
                                        data-product-name="{{ $img->image_product->name }}"
                                        data-order="{{ $img->order }}"
                                        data-edit-url="{{ route('admin.images.update', $img->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    {{-- <button class="amanagementimg-btn amanagementimg-btn-primary amanagementimg-edit-btn"
                                        data-tooltip="Chỉnh sửa hình ảnh">
                                        <i class="fas fa-edit"></i>
                                    </button> --}}

                                    {{-- nút xóa  --}}
                                    <form action="{{ route('admin.images.destroy', $images[$i]->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa ảnh này không?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="amanagementimg-btn amanagementimg-btn-danger amanagementimg-delete-btn"
                                            data-tooltip="Xóa hình ảnh">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            @else
                                <div class="amanagementimg-action-group""></div>
                            @endif
                        @endfor
                    </div>
                </div>
            @endforeach
        </div>

        {{-- phân trang --}}
        <div class="amanagementimg-pagination">
            <div class="amanagementimg-pagination-controls" id="amanagementimg-paginationControls"></div>
        </div>


    </div>




    <!-- Form thêm ảnh mới -->
    <div class="amanagementimg-modal" id="amanagementimg-addImageModal">
        <form id="addImageForm" action="{{ route('admin.images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="product_id" id="amanagementimg-addProductId">

            <div class="amanagementimg-modal-content">
                <div class="amanagementimg-modal-header">
                    <h2 class="amanagementimg-modal-title">Thêm hình ảnh</h2>
                    <span class="amanagementimg-modal-close" id="amanagementimg-addModalClose">×</span>
                </div>
                <div class="amanagementimg-modal-body">
                    <div>
                        <label for="amanagementimg-addProductName">Tên sản phẩm</label>
                        <input type="text" id="amanagementimg-addProductName" disabled />
                    </div>
                    <div>
                        <label for="amanagementimg-addImageUpload">Hình ảnh</label>
                        <input type="file" name="image" id="amanagementimg-addImageUpload" accept="image/*" required />
                    </div>
                </div>
                <div class="amanagementimg-modal-footer">
                    <button type="submit" class="amanagementimg-btn amanagementimg-btn-primary"
                        id="amanagementimg-saveAddImageBtn">Lưu</button>
                    <button type="button" class="amanagementimg-btn amanagementimg-btn-secondary"
                        id="amanagementimg-cancelAddImageBtn">Hủy</button>
                </div>
            </div>
        </form>

    </div>




    <!-- Form sửa ảnh  -->


    <div class="amanagementimg-modal" id="amanagementimg-editImageModal">
        <form id="editImageForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="amanagementimg-modal-content">
                <div class="amanagementimg-modal-header">
                    <h2 class="amanagementimg-modal-title">Chỉnh sửa hình ảnh</h2>
                    <span class="amanagementimg-modal-close" id="amanagementimg-editModalClose">×</span>
                </div>
                <div class="amanagementimg-modal-body">
                    <div>
                        <label for="amanagementimg-editProductName">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="amanagementimg-editProductName"
                            placeholder="ddaay laf ten" disabled />
                    </div>
                    <div>
                        <label for="amanagementimg-editImageUpload">Hình ảnh</label>
                        <input type="file" name="image" id="amanagementimg-editImageUpload" accept="image/*" />
                    </div>
                    <div>
                        <label for="amanagementimg-isPrimary">Trạng thái</label>
                        <select name="is_primary" id="amanagementimg-isPrimary">
                            <option value="1">Hình chính</option>
                            <option value="2">Hình phụ</option>
                        </select>

                    </div>
                </div>
                <div class="amanagementimg-modal-footer">
                    <button type="submit" class="amanagementimg-btn amanagementimg-btn-primary"
                        id="amanagementimg-saveEditImageBtn">Lưu</button>
                    <button type="button" class="amanagementimg-btn amanagementimg-btn-secondary"
                        id="amanagementimg-cancelEditImageBtn">Hủy</button>
                </div>
            </div>
        </form>
    </div>





    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const amanagementimgAddModal = document.getElementById("amanagementimg-addImageModal");
            const amanagementimgEditModal = document.getElementById("amanagementimg-editImageModal");
            const amanagementimgCancelAddImageBtn = document.getElementById("amanagementimg-cancelAddImageBtn");
            const amanagementimgAddModalClose = document.getElementById("amanagementimg-addModalClose");
            const amanagementimgCancelEditImageBtn = document.getElementById("amanagementimg-cancelEditImageBtn");
            const amanagementimgEditModalClose = document.getElementById("amanagementimg-editModalClose");

            // Mở popup thêm ảnh
            function amanagementimgOpenAddModal() {
                amanagementimgAddModal.style.display = "flex";
            }

            // Mở popup sửa ảnh
            function amanagementimgOpenEditModal() {
                amanagementimgEditModal.style.display = "flex";
            }

            // Tắt popup thêm ảnh
            function amanagementimgCloseAddModal() {
                amanagementimgAddModal.style.display = "none";
            }

            // Tắt popup sửa ảnh
            function amanagementimgCloseEditModal() {
                amanagementimgEditModal.style.display = "none";
            }

            // Mở popup khi click
            document.getElementById("amanagementimg-imageGrid").addEventListener("click", (e) => {
                const addButton = e.target.closest(".amanagementimg-add-image");
                const editButton = e.target.closest(".amanagementimg-edit-btn");
                if (addButton) {
                    amanagementimgOpenAddModal();


                    // Lấy dữ liệu từ nút được bấm
                    const productId = addButton.dataset.productId;
                    const productName = addButton.dataset.productName;
                    const addUrl = addButton.dataset.addUrl;

                    // Gán vào form thêm
                    document.getElementById("addImageForm").action = addUrl;
                    document.getElementById("amanagementimg-addProductId").value = productId;
                    document.getElementById("amanagementimg-addProductName").value = productName ||
                        "Không rõ";

                } else if (editButton) {
                    amanagementimgOpenEditModal();


                    // Lấy dữ liệu từ nút được bấm
                    const productName = editButton.dataset.productName;
                    const order = editButton.dataset.order;
                    const formAction = editButton.dataset.editUrl;

                    // Gán vào form sửa
                    document.getElementById("editImageForm").action = formAction;
                    document.getElementById("amanagementimg-editProductName").value = productName ||
                        "Không rõ";
                    document.getElementById("amanagementimg-isPrimary").value = order === "1" ? "1" : "2";

                }
            });

            // Tắt popup khi click
            amanagementimgCancelAddImageBtn.addEventListener("click", amanagementimgCloseAddModal);
            amanagementimgAddModalClose.addEventListener("click", amanagementimgCloseAddModal);
            amanagementimgCancelEditImageBtn.addEventListener("click", amanagementimgCloseEditModal);
            amanagementimgEditModalClose.addEventListener("click", amanagementimgCloseEditModal);
        });

        // js phân trang
        document.addEventListener("DOMContentLoaded", function() {
            const amanagementimgItemsPerPage = 5;
            let amanagementimgCurrentPage = 1;
            const amanagementimgImageGrid = document.getElementById("amanagementimg-imageGrid");
            const amanagementimgItems = Array.from(amanagementimgImageGrid.querySelectorAll(
                ".amanagementimg-image-item"));

            function amanagementimgRenderGrid() {
                const start = (amanagementimgCurrentPage - 1) * amanagementimgItemsPerPage;
                const end = start + amanagementimgItemsPerPage;
                amanagementimgItems.forEach((item, index) => {
                    item.style.display = index >= start && index < end ? "" : "none";
                });
                amanagementimgRenderPagination();
            }

            function amanagementimgRenderPagination() {
                const totalPages = Math.ceil(amanagementimgItems.length / amanagementimgItemsPerPage);
                const paginationControls = document.getElementById("amanagementimg-paginationControls");
                let startPage = Math.max(1, amanagementimgCurrentPage - 1);
                let endPage = Math.min(totalPages, startPage + 2);
                if (endPage - startPage < 2) {
                    startPage = Math.max(1, endPage - 2);
                }
                paginationControls.innerHTML = Array.from({
                    length: endPage - startPage + 1
                }, (_, i) => {
                    const page = startPage + i;
                    return `
                <button class="amanagementimg-pagination-btn ${amanagementimgCurrentPage === page ? "amanagementimg-active" : ""}">${page}</button>
            `;
                }).join("");
                document.querySelectorAll(".amanagementimg-pagination-btn").forEach((btn, index) => {
                    btn.addEventListener("click", () => {
                        amanagementimgCurrentPage = startPage + index;
                        amanagementimgRenderGrid();
                    });
                });
            }

            // Initial render
            amanagementimgRenderGrid();

        });
    </script>
@endsection
