@extends('admin.app')

@section('admin.body')
    <div class="adsupot-main-content">
        <div class="adsupot-header">
            <div class="adsupot-search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Tìm kiếm cài đặt..." id="adsupot-searchInput">
            </div>
            <div class="adsupot-user-profile">
                <div class="adsupot-notification-bell adsupot-tooltip" data-tooltip="Thông báo"><i class="fas fa-bell"></i></div>
                <div class="adsupot-profile-avatar">QT</div>
            </div>
        </div>
        <h1 class="adsupot-page-title">Cài đặt cửa hàng</h1>
        <p class="adsupot-page-subtitle">Quản lý thông tin, tùy chỉnh và bảo mật cửa hàng</p>
        <div class="adsupot-tab-nav">
            <button class="adsupot-tab-btn adsupot-active" data-tab="adsupot-store-info">Thông tin cửa hàng</button>
            <button class="adsupot-tab-btn" data-tab="adsupot-payment">Thanh toán</button>
            <button class="adsupot-tab-btn" data-tab="adsupot-shipping">Giao hàng</button>
            <button class="adsupot-tab-btn" data-tab="adsupot-notifications">Thông báo</button>
            <button class="adsupot-tab-btn" data-tab="adsupot-theme">Giao diện</button>
            <button class="adsupot-tab-btn" data-tab="adsupot-security">Bảo mật</button>
        </div>
        <div class="adsupot-tab-content adsupot-active" id="adsupot-store-info">
            <div class="adsupot-form-group">
                <label>Tên cửa hàng <i class="fas fa-store"></i></label>
                <input type="text" value="Fashion Store" id="adsupot-storeName">
            </div>
            <div class="adsupot-form-group">
                <label>Địa chỉ email <i class="fas fa-envelope"></i></label>
                <input type="email" value="store@fashionstore.com" id="adsupot-storeEmail">
            </div>
            <div class="adsupot-form-group">
                <label>Số điện thoại <i class="fas fa-phone"></i></label>
                <input type="tel" value="0901234567" id="adsupot-storePhone">
            </div>
            <div class="adsupot-form-group">
                <label>Địa chỉ <i class="fas fa-map-marker-alt"></i></label>
                <input type="text" value="123 Nguyễn Huệ, TP.HCM" id="adsupot-storeAddress">
            </div>
            <div class="adsupot-form-group">
                <label>Giờ làm việc <i class="fas fa-clock"></i></label>
                <input type="text" value="08:00 - 20:00" id="adsupot-storeHours">
            </div>
            <div class="adsupot-form-group">
                <label>Mô tả cửa hàng <i class="fas fa-info-circle"></i></label>
                <textarea id="adsupot-storeDescription">Cửa hàng thời trang cao cấp với các sản phẩm hiện đại.</textarea>
            </div>
            <div class="adsupot-form-group adsupot-file-group">
                <div>
                    <label>Logo cửa hàng <i class="fas fa-image"></i></label>
                    <input type="file" id="adsupot-storeLogo" accept="image/*">
                </div>
                <img src="https://via.placeholder.com/80" alt="Logo" id="adsupot-logoPreview">
            </div>
            <div class="adsupot-form-actions">
                <button class="adsupot-btn adsupot-btn-primary adsupot-tooltip" data-tooltip="Lưu cài đặt" onclick="saveSettings('adsupot-store-info')">Lưu</button>
                <button class="adsupot-btn adsupot-btn-secondary adsupot-tooltip" data-tooltip="Hủy thay đổi" onclick="cancelSettings('adsupot-store-info')">Hủy</button>
            </div>
        </div>
        <div class="adsupot-tab-content" id="adsupot-payment">
            <div class="adsupot-form-group adsupot-checkbox-group">
                <label><input type="checkbox" checked> Tiền mặt</label>
                <label><input type="checkbox" checked> Chuyển khoản</label>
                <label><input type="checkbox"> Thẻ tín dụng</label>
            </div>
            <div class="adsupot-form-group">
                <label>Ngân hàng <i class="fas fa-university"></i></label>
                <input type="text" value="Vietcombank" id="adsupot-bankName">
            </div>
            <div class="adsupot-form-group">
                <label>Số tài khoản <i class="fas fa-credit-card"></i></label>
                <input type="text" value="1234567890" id="adsupot-bankAccount">
            </div>
            <div class="adsupot-form-group">
                <label>Chủ tài khoản <i class="fas fa-user"></i></label>
                <input type="text" value="Fashion Store" id="adsupot-bankHolder">
            </div>
            <div class="adsupot-form-group">
                <label>API Key cổng thanh toán <i class="fas fa-key"></i></label>
                <input type="text" value="abc123xyz" id="adsupot-paymentApiKey">
            </div>
            <div class="adsupot-form-actions">
                <button class="adsupot-btn adsupot-btn-primary adsupot-tooltip" data-tooltip="Lưu cài đặt" onclick="saveSettings('adsupot-payment')">Lưu</button>
                <button class="adsupot-btn adsupot-btn-secondary adsupot-tooltip" data-tooltip="Hủy thay đổi" onclick="cancelSettings('adsupot-payment')">Hủy</button>
            </div>
        </div>
        <div class="adsupot-tab-content" id="adsupot-shipping">
            <div class="adsupot-form-group adsupot-checkbox-group">
                <label><input type="checkbox" checked> GHN</label>
                <label><input type="checkbox"> GHTK</label>
                <label><input type="checkbox"> Viettel Post</label>
            </div>
            <div class="adsupot-form-group">
                <label>Phí giao hàng mặc định (VND) <i class="fas fa-truck"></i></label>
                <input type="number" value="30000" id="adsupot-shippingFee">
            </div>
            <div class="adsupot-form-group">
                <label>Thời gian giao hàng ước tính (ngày) <i class="fas fa-clock"></i></label>
                <input type="number" value="3" id="adsupot-shippingTime">
            </div>
            <div class="adsupot-form-actions">
                <button class="adsupot-btn adsupot-btn-primary adsupot-tooltip" data-tooltip="Lưu cài đặt" onclick="saveSettings('adsupot-shipping')">Lưu</button>
                <button class="adsupot-btn adsupot-btn-secondary adsupot-tooltip" data-tooltip="Hủy thay đổi" onclick="cancelSettings('adsupot-shipping')">Hủy</button>
            </div>
        </div>
        <div class="adsupot-tab-content" id="adsupot-notifications">
            <div class="adsupot-form-group adsupot-checkbox-group">
                <label><input type="checkbox" checked> Đơn hàng mới</label>
                <label><input type="checkbox"> Hủy đơn</label>
                <label><input type="checkbox" checked> Khách hàng mới</label>
                <label><input type="checkbox"> Thông báo qua SMS</label>
            </div>
            <div class="adsupot-form-group">
                <label>Email nhận thông báo <i class="fas fa-envelope"></i></label>
                <input type="email" value="notify@fashionstore.com" id="adsupot-notifyEmail">
            </div>
            <div class="adsupot-form-group">
                <label>Mẫu thông báo đơn hàng mới <i class="fas fa-comment"></i></label>
                <textarea id="adsupot-orderTemplate">Chào [Tên khách hàng], đơn hàng #[Mã đơn hàng] của bạn đã được xác nhận.</textarea>
            </div>
            <div class="adsupot-form-actions">
                <button class="adsupot-btn adsupot-btn-primary adsupot-tooltip" data-tooltip="Lưu cài đặt" onclick="saveSettings('adsupot-notifications')">Lưu</button>
                <button class="adsupot-btn adsupot-btn-secondary adsupot-tooltip" data-tooltip="Hủy thay đổi" onclick="cancelSettings('adsupot-notifications')">Hủy</button>
            </div>
        </div>
        <div class="adsupot-tab-content" id="adsupot-theme">
            <div class="adsupot-form-group">
                <label>Màu chủ đạo <i class="fas fa-palette"></i></label>
                <input type="color" value="#4f46e5" id="adsupot-themeColor">
            </div>
            <div class="adsupot-form-group">
                <label>Font chữ <i class="fas fa-font"></i></label>
                <select id="adsupot-themeFont">
                    <option value="Inter" selected>Inter</option>
                    <option value="Roboto">Roboto</option>
                    <option value="Open Sans">Open Sans</option>
                </select>
            </div>
            <div class="adsupot-form-group adsupot-file-group">
                <div>
                    <label>Banner trang chủ <i class="fas fa-image"></i></label>
                    <input type="file" id="adsupot-bannerImage" accept="image/*">
                </div>
                <img src="https://via.placeholder.com/80" alt="Banner" id="adsupot-bannerPreview">
            </div>
            <div class="adsupot-form-actions">
                <button class="adsupot-btn adsupot-btn-primary adsupot-tooltip" data-tooltip="Lưu cài đặt" onclick="saveSettings('adsupot-theme')">Lưu</button>
                <button class="adsupot-btn adsupot-btn-secondary adsupot-tooltip" data-tooltip="Hủy thay đổi" onclick="cancelSettings('adsupot-theme')">Hủy</button>
            </div>
        </div>
        <div class="adsupot-tab-content" id="adsupot-security">
            <div class="adsupot-form-group adsupot-checkbox-group">
                <label><input type="checkbox"> Kích hoạt xác thực 2 yếu tố (2FA)</label>
            </div>
            <div class="adsupot-form-group">
                <label>Mật khẩu tối thiểu (ký tự) <i class="fas fa-lock"></i></label>
                <input type="number" value="8" id="adsupot-minPassword">
            </div>
            <div class="adsupot-form-group">
                <label>Nhật ký đăng nhập <i class="fas fa-history"></i></label>
                <table class="adsupot-activity-table">
                    <thead>
                        <tr>
                            <th>Thời gian</th>
                            <th>Thiết bị</th>
                            <th>Địa chỉ IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2025-06-12 09:00</td>
                            <td>Chrome - Windows</td>
                            <td>192.168.1.1</td>
                        </tr>
                        <tr>
                            <td>2025-06-11 15:30</td>
                            <td>Safari - iPhone</td>
                            <td>192.168.1.2</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="adsupot-form-actions">
                <button class="adsupot-btn adsupot-btn-primary adsupot-tooltip" data-tooltip="Lưu cài đặt" onclick="saveSettings('adsupot-security')">Lưu</button>
                <button class="adsupot-btn adsupot-btn-secondary adsupot-tooltip" data-tooltip="Hủy thay đổi" onclick="cancelSettings('adsupot-security')">Hủy</button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Sidebar interaction (bỏ qua nếu không có sidebar trong admin.app)
            const adsupotSidebarItems = document.querySelectorAll(".adsupot-sidebar-item");
            if (adsupotSidebarItems.length > 0) {
                adsupotSidebarItems.forEach((item) => {
                    item.addEventListener("click", function (e) {
                        e.preventDefault();
                        adsupotSidebarItems.forEach((i) => i.classList.remove("adsupot-active"));
                        this.classList.add("adsupot-active");
                    });
                });
            }

            // Tab navigation
            const adsupotTabButtons = document.querySelectorAll(".adsupot-tab-btn");
            const adsupotTabContents = document.querySelectorAll(".adsupot-tab-content");

            adsupotTabButtons.forEach((button) => {
                button.addEventListener("click", () => {
                    adsupotTabButtons.forEach((btn) => btn.classList.remove("adsupot-active"));
                    adsupotTabContents.forEach((content) => content.classList.remove("adsupot-active"));

                    button.classList.add("adsupot-active");
                    document.getElementById(button.dataset.tab).classList.add("adsupot-active");
                });
            });

            // Search functionality
            const adsupotSearchInput = document.getElementById("adsupot-searchInput");
            const adsupotFormGroups = document.querySelectorAll(".adsupot-form-group");

            adsupotSearchInput.addEventListener("input", () => {
                const searchTerm = adsupotSearchInput.value.toLowerCase();
                adsupotFormGroups.forEach((group) => {
                    const label = group.querySelector("label")?.textContent.toLowerCase() || "";
                    const inputs = group.querySelectorAll("input, select, textarea");
                    let inputMatch = false;
                    inputs.forEach((input) => {
                        if (input.value.toLowerCase().includes(searchTerm)) {
                            inputMatch = true;
                        }
                    });
                    group.style.display = searchTerm === "" || label.includes(searchTerm) || inputMatch ? "" : "none";
                });
            });

            // File upload preview
            const adsupotLogoInput = document.getElementById("adsupot-storeLogo");
            const adsupotBannerInput = document.getElementById("adsupot-bannerImage");

            adsupotLogoInput.addEventListener("change", () => {
                alert("Chức năng upload logo chỉ là demo, không lưu thực tế.");
            });

            adsupotBannerInput.addEventListener("change", () => {
                alert("Chức năng upload banner chỉ là demo, không lưu thực tế.");
            });

            // Form validation
            function validateForm(tabId) {
                const inputs = document.querySelectorAll(
                    `#${tabId} .adsupot-form-group input:not([type="file"]), #${tabId} .adsupot-form-group textarea`
                );
                let hasError = false;
                inputs.forEach((input) => {
                    const group = input.closest(".adsupot-form-group");
                    if (!input.value.trim()) {
                        group.classList.add("adsupot-error");
                        hasError = true;
                    } else {
                        group.classList.remove("adsupot-error");
                    }
                });
                return !hasError;
            }

            // Save settings with loading state
            window.saveSettings = function (tab) {
                if (!validateForm(tab)) {
                    alert("Vui lòng điền đầy đủ các trường bắt buộc.");
                    return;
                }
                const saveBtn = document.querySelector(`#${tab} .adsupot-btn-primary`);
                saveBtn.classList.add("adsupot-loading");
                saveBtn.disabled = true;
                setTimeout(() => {
                    saveBtn.classList.remove("adsupot-loading");
                    saveBtn.disabled = false;
                    alert(`Chức năng lưu cài đặt cho tab "${tab}" chỉ là demo, không lưu thực tế.`);
                }, 1000);
            };

            // Cancel settings
            window.cancelSettings = function (tab) {
                alert(`Đã hủy thay đổi cho tab "${tab}".`);
                const inputs = document.querySelectorAll(
                    `#${tab} input, #${tab} textarea, #${tab} select`
                );
                inputs.forEach((input) =>
                    input.closest(".adsupot-form-group")?.classList.remove("adsupot-error")
                );
            };
        });
    </script>
@endsection

    