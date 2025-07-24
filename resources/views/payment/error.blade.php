<div class="tt-container">
        <h1 class="tt-heading-1">Lỗi Thanh Toán</h1>
        <div class="alert alert-danger">
            <p>{{ $error_message ?? 'Có lỗi xảy ra. Vui lòng liên hệ hỗ trợ.' }}</p>
        </div>
        <a href="{{ route('cart.view') }}" class="tt-btn">Quay lại giỏ hàng</a>
        <p>Hỗ trợ: <a href="mailto:support@example.com">support@example.com</a></p>
    </div>