@extends('admin.app')

@section('admin.body')
    <div class="adbl-main-content">
        <div class="adbl-header">
            <div class="adbl-search-bar">
                <form action="/admin/comments" method="GET" id="adbl-search-form">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" id="adbl-comment-search"
                        placeholder="Tìm kiếm bình luận, khách hàng, sản phẩm...">
                    <button type="submit" style="display: none;">Tìm kiếm</button>
                </form>
            </div>
            <div class="adbl-user-profile">
                <div class="adbl-notification-bell">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="adbl-profile-avatar">QT</div>
            </div>
        </div>
        <h1 class="adbl-page-title">Quản lý bình luận</h1>
        <p class="adbl-page-subtitle">Theo dõi và quản lý các bình luận của khách hàng</p>

        <!-- Filters -->
        {{-- <div class="adbl-filters">
            <div class="adbl-filter">
                <label class="adbl-filter-label" for="adbl-status-filter"><i class="fas fa-filter"></i> Trạng thái:</label>
                <form action="/admin/comments" method="GET" id="adbl-status-filter-form">
                    <select name="status" id="adbl-status-filter" class="adbl-form-control" onchange="this.form.submit()">
                        <option value="all">Tất cả</option>
                        <option value="Chờ duyệt">Chờ duyệt</option>
                        <option value="Đã duyệt">Đã duyệt</option>
                        <option value="Bị từ chối">Bị từ chối</option>
                    </select>
                    <button type="submit" style="display: none;">Lọc</button>
                </form>
            </div>
            <div class="adbl-filter">
                <label class="adbl-filter-label" for="adbl-date-filter"><i class="fas fa-calendar-alt"></i> Ngày
                    gửi:</label>
                <form action="/admin/comments" method="GET" id="adbl-date-filter-form">
                    <select name="date" id="adbl-date-filter" class="adbl-form-control" onchange="this.form.submit()">
                        <option value="all">Tất cả</option>
                        <option value="today">Hôm nay</option>
                        <option value="yesterday">Hôm qua</option>
                        <option value="last7days">7 ngày qua</option>
                        <option value="last30days">30 ngày qua</option>
                        <option value="custom">Tùy chọn</option>
                    </select>
                    <button type="submit" style="display: none;">Lọc</button>
                </form>
            </div>
        </div> --}}

        <div class="adbl-data-card">
            <div class="adbl-comment-list" id="adbl-comment-list">
                @foreach ($reviews as $review)
                    <div class="adbl-comment-box" data-comment-id="{{ $review['id'] }}" data-type="comment">
                        <div class="adbl-comment-header">
                            <img src="{{ asset($review['product']['thumbnail']['path'] ?? 'no-image.png') }}"
                                alt="{{ $review['product']['name'] ?? 'Sản phẩm' }}" class="adbl-comment-image">
                            <div class="adbl-comment-title">{{ $review['product']['name'] ?? 'Sản phẩm không xác định' }}
                            </div>
                            <div class="adbl-comment-meta">{{ $review['created_at'] }}</div>
                        </div>
                        <div class="adbl-comment-content">
                            <p><strong>Khách hàng:</strong> {{ $review['user']['name'] ?? 'Ẩn danh' }}</p>
                            <p><strong>Đánh giá:</strong>
                                <span class="adbl-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $review['rating'] ? '' : '-o' }}"></i>
                                    @endfor
                                </span> ({{ $review['rating'] ?? 0 }} sao)
                            </p>
                            <p><strong>Bình luận:</strong> {{ $review['comment'] }}</p>
                        </div>
                        <div class="adbl-comment-actions">
                            <button class="adbl-btn adbl-btn-reply"
                                onclick="replyComment('{{ $review['id'] }}', '{{ $review['user']['name'] }}', '{{ $review['comment'] }}', '{{ $review['product_id'] }}')">
                                Trả lời
                            </button>
                        <a href="{{ route('admin.comment.delete', $review['id']) }}" class="adbl-btn adbl-btn-delete">Xóa</a>
                        </div>
                    </div>

                    {{-- Hiển thị các phản hồi con --}}
                    @foreach ($review['replies'] as $reply)
                        <div class="adbl-comment-box reply" data-comment-id="{{ $reply['id'] }}" data-type="reply">
                            <div class="adbl-comment-header">
                                <div class="adbl-comment-title">{{ $reply['user']['name'] ?? 'Ẩn danh' }}</div>
                                <div class="adbl-comment-meta">{{ $reply['created_at'] }}</div>
                            </div>
                            <div class="adbl-comment-content">{{ $reply['comment'] }}</div>
                            <div class="adbl-comment-actions">
                                <button class="adbl-btn adbl-btn-reply"
                                    onclick="replyComment('{{ $reply['id'] }}', '{{ $reply['user']['name'] ?? 'Ẩn danh' }}', '{{ $reply['comment'] }}', '{{ $reply['product_id'] }}')">
                                    Trả lời
                                </button>
                                <a href="{{ route('admin.comment.delete', $reply['id']) }}" class="adbl-btn adbl-btn-delete">Xóa</a>

                            </div>
                        </div>
                    @endforeach
                @endforeach

            </div>
            <div class="adbl-pagination" id="adbl-pagination"></div>
        </div>

        <!-- Reply Management Box -->
        <div class="adbl-data-card adbl-reply-box" id="adbl-reply-management-box" style="display: none;">
            <div class="adbl-reply-header">
                <h2 class="adbl-reply-title">Trả lời bình luận</h2>
                <span class="adbl-reply-close" onclick="closeReplyBox()">×</span>
            </div>
            <div class="adbl-reply-content">
                <div id="adbl-reply-comment-details">
                    <p><strong>Khách hàng:</strong> <span id="adbl-replyCustomerEdit"></span></p>
                    <p><strong>Nội dung:</strong> <span id="adbl-replyContentEdit"></span></p>
                </div>
            <form action="{{ route('reply-comments') }}" method="POST" id="adbl-replyForm" style="margin-top: 1.5rem;">
                @csrf
                <input type="hidden" id="adbl-replyCommentIdInput" name="parent_id">
                <input type="hidden" id="adbl-replyProductIdInput" name="product_id">

                <label for="adbl-replyAdminReply">Phản hồi:</label>
                <textarea id="adbl-replyAdminReply" name="reply" class="adbl-form-control" rows="4" placeholder="Nhập phản hồi..."></textarea>

                <div class="adbl-reply-footer">
                    <button type="submit" class="adbl-btn adbl-btn-primary">Gửi phản hồi</button>
                    <button type="button" class="adbl-btn" onclick="closeReplyBox()">Hủy</button>
                </div>
            </form>

            </div>
        </div>

        <!-- Toast -->
        <div class="adbl-toast" id="adbl-toast"></div>
    </div>
<script>
    // Xử lý mở và đóng Modal chỉnh sửa
    window.openEditModal = function(commentId) {
        const modal = document.getElementById("adbl-editCommentModal");
        if (modal) modal.classList.add("show");
    };

    window.closeEditModal = function() {
        const modal = document.getElementById("adbl-editCommentModal");
        if (modal) modal.classList.remove("show");
    };

    // Xử lý MỞ form trả lời bình luận
    window.replyComment = function(commentId, customerName, commentContent, productId) {
        const replyBox = document.getElementById("adbl-reply-management-box");
        const customerElement = document.getElementById("adbl-replyCustomerEdit");
        const contentElement = document.getElementById("adbl-replyContentEdit");
        const commentIdInput = document.getElementById("adbl-replyCommentIdInput");
        const productIdInput = document.getElementById("adbl-replyProductIdInput");

        if (replyBox && customerElement && contentElement && commentIdInput && productIdInput) {
            customerElement.textContent = customerName || "Không có thông tin";
            contentElement.textContent = commentContent || "Không có nội dung";
            commentIdInput.value = commentId.replace("#", "");
            productIdInput.value = productId;

            replyBox.style.display = "block";
        }
    };

    // Đóng box trả lời
    window.closeReplyBox = function() {
        const replyBox = document.getElementById("adbl-reply-management-box");
        if (replyBox) replyBox.style.display = "none";
    };

    // Xử lý phân trang cho bình luận
    document.addEventListener('DOMContentLoaded', () => {
        const commentList = document.querySelector("#adbl-comment-list");
        if (!commentList) return;

        const commentBoxes = commentList.querySelectorAll(".adbl-comment-box[data-type='comment']");
        const itemsPerPage = 3;
        let currentPage = 1;

        function renderPagination() {
            const totalPages = Math.ceil(commentBoxes.length / itemsPerPage);
            const pagination = document.getElementById("adbl-pagination");
            if (!pagination) return;

            pagination.innerHTML = "";
            const startPage = Math.max(1, currentPage - 1);
            const endPage = Math.min(totalPages, currentPage + 1);

            for (let i = startPage; i <= endPage; i++) {
                const btn = document.createElement("button");
                btn.className = "adbl-pagination-btn" + (i === currentPage ? " active" : "");
                btn.textContent = i;
                btn.addEventListener("click", () => {
                    currentPage = i;
                    renderPage();
                    renderPagination();
                });
                pagination.appendChild(btn);
            }
        }

        function renderPage() {
            const start = (currentPage - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            commentBoxes.forEach((box, index) => {
                const isVisible = index >= start && index < end;
                box.style.display = isVisible ? "" : "none";

                const commentId = box.getAttribute("data-comment-id");
                const replyBoxes = commentList.querySelectorAll(
                    `.adbl-comment-box[data-comment-id="${commentId}"]:not([data-type="comment"])`);
                replyBoxes.forEach(reply => reply.style.display = isVisible ? "" : "none");
            });
        }

        if (commentBoxes.length > 0) {
            renderPagination();
            renderPage();
        }
    });

 </script>
@endsection
