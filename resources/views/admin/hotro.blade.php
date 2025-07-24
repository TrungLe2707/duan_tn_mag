@extends('admin.app')

@section('admin.body')
        <div class="asupport-main-content">
            <div class="asupport-header">
                <div class="asupport-search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Tìm kiếm hỗ trợ..." id="asupport-searchInput">
                </div>
                <div class="asupport-user-profile">
                    <div class="asupport-notification-bell asupport-tooltip" data-tooltip="Thông báo"><i class="fas fa-bell"></i></div>
                    <div class="asupport-profile-avatar">QT</div>
                </div>
            </div>
            <h1 class="asupport-page-title">Hỗ trợ</h1>
            <p class="asupport-page-subtitle">Liên hệ đội ngũ hỗ trợ, xem FAQ, tài liệu hoặc lịch sử yêu cầu</p>
            <div class="asupport-tab-nav">
                <button class="asupport-tab-btn asupport-active" data-tab="asupport-contact">Liên hệ hỗ trợ</button>
                <button class="asupport-tab-btn" data-tab="asupport-faq">FAQ</button>
                <button class="asupport-tab-btn" data-tab="asupport-docs">Tài liệu hướng dẫn</button>
                <button class="asupport-tab-btn" data-tab="asupport-history">Lịch sử yêu cầu</button>
            </div>
            <div class="asupport-tab-content asupport-active" id="asupport-contact">
                <div class="asupport-form-group">
                    <label>Chủ đề <i class="fas fa-comment"></i></label>
                    <input type="text" id="asupport-supportSubject" placeholder="Nhập chủ đề hỗ trợ">
                </div>
                <div class="asupport-form-group">
                    <label>Danh mục <i class="fas fa-list"></i></label>
                    <select id="asupport-supportCategory">
                        <option value="">Chọn danh mục</option>
                        <option value="order">Đơn hàng</option>
                        <option value="product">Sản phẩm</option>
                        <option value="payment">Thanh toán</option>
                        <option value="shipping">Giao hàng</option>
                        <option value="other">Khác</option>
                    </select>
                </div>
                <div class="asupport-form-group">
                    <label>Nội dung <i class="fas fa-file-alt"></i></label>
                    <textarea id="asupport-supportDescription" placeholder="Mô tả vấn đề của bạn"></textarea>
                </div>
                <div class="asupport-form-group asupport-file-group">
                    <div>
                        <label>Đính kèm file <i class="fas fa-paperclip"></i></label>
                        <input type="file" id="asupport-supportFile" accept="image/*,.pdf">
                    </div>
                    <img src="https://via.placeholder.com/80" alt="Preview" id="asupport-filePreview">
                </div>
                <div class="asupport-form-actions">
                    <button class="asupport-btn asupport-btn-primary asupport-tooltip" data-tooltip="Gửi yêu cầu" onclick="asupportSendSupportRequest()">Gửi</button>
                    <button class="asupport-btn asupport-btn-secondary asupport-tooltip" data-tooltip="Hủy" onclick="asupportCancelSupportRequest()">Hủy</button>
                </div>
            </div>
            <div class="asupport-tab-content" id="asupport-faq">
                <div class="asupport-form-group">
                    <label>Tìm kiếm FAQ <i class="fas fa-search"></i></label>
                    <input type="text" id="asupport-faqSearch" placeholder="Nhập từ khóa...">
                </div>
                <div class="asupport-faq-list">
                    <div class="asupport-faq-item">
                        <div class="asupport-faq-question">Làm thế nào để thêm sản phẩm mới? <i class="fas fa-chevron-down"></i></div>
                        <div class="asupport-faq-answer">Vào trang Sản phẩm, nhấp vào nút "Thêm sản phẩm" và điền thông tin cần thiết.</div>
                    </div>
                    <div class="asupport-faq-item">
                        <div class="asupport-faq-question">Làm sao để thay đổi trạng thái đơn hàng? <i class="fas fa-chevron-down"></i></div>
                        <div class="asupport-faq-answer">Trong trang Đơn hàng, chọn đơn hàng và cập nhật trạng thái từ menu hành động.</div>
                    </div>
                    <div class="asupport-faq-item">
                        <div class="asupport-faq-question">Cách cài đặt phương thức thanh toán? <i class="fas fa-chevron-down"></i></div>
                        <div class="asupport-faq-answer">Vào Cài đặt > Thanh toán, chọn phương thức và nhập thông tin ngân hàng.</div>
                    </div>
                    <div class="asupport-faq-item">
                        <div class="asupport-faq-question">Làm thế nào để thêm đơn vị giao hàng? <i class="fas fa-chevron-down"></i></div>
                       وناPage 3
                            <div class="asupport-faq-answer">Vào Cài đặt > Giao hàng, chọn đơn vị vận chuyển và lưu cài đặt.</div>
                    </div>
                    <div class="asupport-faq-item">
                        <div class="asupport-faq-question">Cách quản lý khách hàng? <i class="fas fa-chevron-down"></i></div>
                        <div class="asupport-faq-answer">Vào trang Khách hàng, sử dụng bộ lọc và chỉnh sửa thông tin khách hàng.</div>
                    </div>
                    <div class="asupport-faq-item">
                        <div class="asupport-faq-question">Hỗ trợ xác thực 2 yếu tố (2FA)? <i class="fas fa-chevron-down"></i></div>
                        <div class="asupport-faq-answer">Vào Cài đặt > Bảo mật, kích hoạt 2FA và làm theo hướng dẫn.</div>
                    </div>
                </div>
            </div>
            <div class="asupport-tab-content" id="asupport-docs">
                <div class="asupport-table-container">
                    <table class="asupport-table">
                        <thead>
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Mô tả</th>
                                <th>Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Hướng dẫn quản lý sản phẩm</td>
                                <td>Quy trình duyệt thêm, sửa, xóa sản phẩm.</td>
                                <td><a href="#">Xem</a></td>
                            </tr>
                            <tr>
                                <td>Hướng dẫn xử lý đơn hàng</td>
                                <td>Cách xác nhận và cập nhật trạng thái đơn hàng.</td>
                                <td><a href="#">Xem</a></td>
                            </tr>
                            <tr>
                                <td>Hướng dẫn cài đặt cửa hàng</td>
                                <td>Thiết lập thông tin và tùy chỉnh cửa hàng.</td>
                                <td><a href="#">Xem</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="asupport-tab-content" id="asupport-history">
                <div class="asupport-form-group">
                    <label>Tìm kiếm lịch sử <i class="fas fa-search"></i></label>
                    <input type="text" id="asupport-historySearch" placeholder="Nhập từ khóa...">
                </div>
                <div class="asupport-table-container">
                    <table class="asupport-table">
                        <thead>
                            <tr>
                                <th>Mã yêu cầu</th>
                                <th>Chủ đề</th>
                                <th>Ngày gửi</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>SPT001</td>
                                <td>Lỗi thanh toán</td>
                                <td>2025-06-25</td>
                                <td>Đã xử lý</td>
                            </tr>
                            <tr>
                                <td>SPT002</td>
                                <td>Hỏi về giao hàng</td>
                                <td>2025-06-24</td>
                                <td>Đang xử lý</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Sidebar interaction
            const sidebarItems = document.querySelectorAll(".asupport-sidebar-item");
            sidebarItems.forEach((item) => {
                item.addEventListener("click", function (e) {
                    e.preventDefault();
                    sidebarItems.forEach((i) => i.classList.remove("asupport-active"));
                    this.classList.add("asupport-active");
                });
            });

            // Tab navigation
            const tabButtons = document.querySelectorAll(".asupport-tab-btn");
            const tabContents = document.querySelectorAll(".asupport-tab-content");

            tabButtons.forEach((button) => {
                button.addEventListener("click", () => {
                    tabButtons.forEach((btn) => btn.classList.remove("asupport-active"));
                    tabContents.forEach((content) => content.classList.remove("asupport-active"));

                    button.classList.add("asupport-active");
                    document.getElementById(button.dataset.tab).classList.add("asupport-active");
                });
            });

            // FAQ toggle
            const faqItems = document.querySelectorAll(".asupport-faq-item");
            faqItems.forEach((item) => {
                item.addEventListener("click", () => {
                    const isActive = item.classList.contains("asupport-active");
                    faqItems.forEach((i) => i.classList.remove("asupport-active"));
                    if (!isActive) {
                        item.classList.add("asupport-active");
                    }
                });
            });

            // Search FAQ
            const faqSearch = document.getElementById("asupport-faqSearch");
            faqSearch.addEventListener("input", () => {
                const searchTerm = faqSearch.value.toLowerCase();
                faqItems.forEach((item) => {
                    const question = item.querySelector(".asupport-faq-question").textContent.toLowerCase();
                    const answer = item.querySelector(".asupport-faq-answer").textContent.toLowerCase();
                    item.style.display = searchTerm === "" || question.includes(searchTerm) || answer.includes(searchTerm) ? "" : "none";
                });
            });

            // Search history
            const historySearch = document.getElementById("asupport-historySearch");
            const historyRows = document.querySelectorAll("#asupport-history .asupport-table tbody tr");
            historySearch.addEventListener("input", () => {
                const searchTerm = historySearch.value.toLowerCase();
                historyRows.forEach((row) => {
                    const cells = row.querySelectorAll("td");
                    const text = Array.from(cells).map((cell) => cell.textContent.toLowerCase()).join(" ");
                    row.style.display = searchTerm === "" || text.includes(searchTerm) ? "" : "none";
                });
            });

            // Form validation
            function validateForm() {
                const subject = document.getElementById("asupport-supportSubject");
                const category = document.getElementById("asupport-supportCategory");
                const description = document.getElementById("asupport-supportDescription");
                let hasError = false;

                if (!subject.value.trim()) {
                    subject.closest(".asupport-form-group").classList.add("asupport-error");
                    hasError = true;
                } else {
                    subject.closest(".asupport-form-group").classList.remove("asupport-error");
                }

                if (!category.value) {
                    category.closest(".asupport-form-group").classList.add("asupport-error");
                    hasError = true;
                } else {
                    category.closest(".asupport-form-group").classList.remove("asupport-error");
                }

                if (!description.value.trim()) {
                    description.closest(".asupport-form-group").classList.add("asupport-error");
                    hasError = true;
                } else {
                    description.closest(".asupport-form-group").classList.remove("asupport-error");
                }

                return !hasError;
            }

            // Send support request
            window.asupportSendSupportRequest = function () {
                if (!validateForm()) {
                    alert("Vui lòng điền đầy đủ các trường bắt buộc.");
                    return;
                }
                const sendBtn = document.querySelector("#asupport-contact .asupport-btn-primary");
                sendBtn.classList.add("asupport-loading");
                sendBtn.disabled = true;
                setTimeout(() => {
                    sendBtn.classList.remove("asupport-loading");
                    sendBtn.disabled = false;
                    alert("Yêu cầu hỗ trợ đã được gửi (demo, không lưu thực tế).");
                }, 1000);
            };

            // Cancel support request
            window.asupportCancelRequest = function () {
                alert("Đã hủy yêu cầu hỗ trợ.");
                const inputs = document.querySelectorAll("#asupport-contact input, #asupport-contact select, #asupport-contact textarea");
                inputs.forEach((input) => {
                    input.value = "";
                    input.closest(".asupport-form-group")?.classList.remove("asupport-error");
                });
            };

            // File upload preview
            const fileInput = document.getElementById("asupport-supportFile");
            fileInput.addEventListener("change", () => {
                alert("Chức năng upload file chỉ là demo, không tải lên thực tế.");
            });
        });
    </script>
@endsection