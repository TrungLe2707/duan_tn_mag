@extends('app')

@section('body')
    {{-- <link rel="stylesheet" href="{{asset('/css/cart.css')}}"> --}}
    <link rel="stylesheet" href="/css/cart.css">

    <div class="gh-cart-root">
        <main class="gh-cart-container">
            <div class="gh-cart-layout">
                <div class="gh-cart-items-container">
                    @if($cartItems->isEmpty())
                         <div class="cart-items">
                            <div class="empty-cart-icon">
                                <div class="cart-icon-bg"></div>
                                <i class="fas fa-shopping-cart cart-icon"></i>
                            </div>
                            <h1 class="cart-title">Giỏ hàng của bạn đang trống</h1>
                            <p class="cart-message">
                                Chưa có sản phẩm nào trong giỏ hàng của bạn. Hãy khám phá cửa hàng và thêm những sản phẩm yêu thích vào giỏ hàng để bắt đầu mua sắm!
                            </p>
                            <a href="{{route('home')}}">
                                <button class="continue-btn">
                                <i class="fas fa-arrow-right"></i> Tiếp tục mua sắm
                            </button>
                            </a>
                        </div>
                    @else
                        <div class="gh-cart-items-header">
                            <h2 class="gh-cart-items-title">Sản phẩm</h2>
                            <span class="gh-cart-item-count">{{ $cartItems->count() }} sản phẩm</span>
                        </div>

                        @foreach ($cartItems as $item)
                            @php
                                $variant = $item->productVariant;
                                $product = $variant->product;
                                $color = $variant->color;
                                $size = $variant->size;
                                $img = $variant->product->thumbnail;
                                $stock = $variant->quantity;


                            @endphp
                            <div class="gh-cart-item">
                                <img src="{{  $img?->path }}" alt="" class="gh-cart-item-image">
                                <div class="gh-cart-item-details">
                                    <h3 class="gh-cart-item-title">{{ $product->name }}</h3>
                                    @php
                                        $variant = $item->productVariant;
                                        $product = $variant->product;
                                        $availableVariants = \App\Models\product_variants::with(['color', 'size'])
                                            ->where('product_id', $product->id)
                                            ->where('quantity', '>', 0)
                                            ->get();

                                        $availableColors = $availableVariants->pluck('color')->unique('id');
                                        $availableSizes = $availableVariants->pluck('size')->unique('id');
                                    @endphp

                                     <div class="gh-cart-item-variant">
                                        <form action="{{ route('cart.update', $variant->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            {{-- Màu --}}
                                            <select name="color_id" class="gh-cart-select" onchange="this.form.submit()">
                                                @foreach ($availableColors as $c)
                                                    <option value="{{ $c->id }}" {{ $c->id == $variant->color_id ? 'selected' : '' }}>
                                                        {{ $c->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            {{-- Size --}}
                                            <select name="size_id" class="gh-cart-select" onchange="this.form.submit()">
                                                @foreach ($availableSizes as $s)
                                                    <option value="{{ $s->id }}" {{ $s->id == $variant->size_id ? 'selected' : '' }}>
                                                        {{ $s->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            {{-- Quantity giữ nguyên --}}
                                            <input type="hidden" name="quantity" value="{{ $item->quantity }}">
                                        </form>

                                    </div>



                                    <a href="{{route('cart.remove', $variant->id)}}">
                                        <button class="gh-cart-remove-item">
                                            <i class="fas fa-trash-alt"></i> Xóa
                                        </button>
                                    </a>
                                </div>
                                <div class="gh-cart-item-price">
                                    {{ number_format($variant->price ?? $product->price ?? 0, 0, ',', '.') }}đ
                                </div>
                                <div class="gh-cart-quantity-control">
                                    <form action="{{ route('cart.update', $variant->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                                        <button type="submit" class="gh-cart-quantity-btn minus" {{ $item->quantity <= 1 ? 'disabled' : '' }}>−</button>                                    
                                    </form>
                                    <input type="number" value="{{ $item->quantity }}" min="1" max="{{ $stock }}"readonly class="gh-cart-quantity-input" readonly>
                                    <form action="{{ route('cart.update', $variant->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="quantity" value="{{ min($item->quantity + 1, $stock) }}">
                                        <button type="submit" class="gh-cart-quantity-btn plus"  {{ $item->quantity >= $stock ? 'disabled' : '' }}>+</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif


                </div>

                <div class="gh-cart-summary">
                    <h3 class="gh-cart-summary-title">Tóm tắt đơn hàng</h3>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <div class="gh-cart-summary-row">
                        <span class="gh-cart-summary-label">Tạm tính</span>
                        <span class="gh-cart-summary-value">{{ number_format($subtotal, 0, ',', '.') }}đđ</span>
                    </div>

                    <div class="gh-cart-summary-row">
                        <span class="gh-cart-summary-label">Giảm giá</span>
                        <span
                            class="gh-cart-summary-value gh-cart-discount-value">-{{ number_format($voucherDiscount, 0, ',', '.') }}đ</span>
                    </div>

                    <div class="gh-cart-summary-row">
                        <span class="gh-cart-summary-label">Phí vận chuyển</span>
                        <span class="gh-cart-summary-value">{{ number_format($shippingFee, 0, ',', '.') }}đ</span>
                    </div>

                    

                    @if (Auth::check())
                          @if (!empty($availableVouchers))
                            <form action="{{ route('cart.applyVoucher') }}" method="POST">
                                @csrf
                                <select name="voucher_code" onchange="this.form.submit()" class="gh-cart-voucher-select-field">
                                    <option value="">-- Chọn mã giảm giá --</option>
                                    @foreach ($availableVouchers as $voucher)
                                        <option value="{{ $voucher->code }}">
                                            {{ $voucher->code }} - 
                                            {{ $voucher->value_type == 'percent' ? $voucher->discount_amount . '%' : number_format($voucher->discount_amount, 0, ',', '.') . 'đ' }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                    
                        @endif
                     @else
                    <div class="gh-cart-voucher-box">
                        <h1 class="gh-cart-summary-label">Vui lòng <a href="{{route('showlogin')}}">đăng nhập</a> để sử dụng Voucher</h1>
                    </div>
                    @endif
                  


                    <div class="gh-cart-summary-row gh-cart-total-row">
                        <span class="gh-cart-summary-label">Tổng cộng</span>
                        <span class="gh-cart-summary-value">{{ number_format($total, 0, ',', '.') }}đ</span>
                    </div>

                    <a href="{{route('payment.add')}}"><button class="gh-cart-checkout-btn">
                            <i class="fas fa-lock"></i> Thanh toán an toàn
                        </button></a>

                    <a href="{{route('home')}}" class="gh-cart-continue-shopping">
                        <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
                    </a>
                </div>
            </div>
        </main>
    </div>

@endsection