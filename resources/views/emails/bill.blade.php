@component('mail::message')
# Cảm ơn bạn đã mua hàng!

Đơn hàng của bạn đã được thanh toán thành công. Dưới đây là thông tin chi tiết:

—  
**Mã đơn hàng:** {{ $order->id }}  
**Ngày đặt:** {{ $order->created_at->format('d/m/Y H:i') }}  
**Tổng tiền:** {{ number_format($order->total_price, 0, ',', '.') }}₫  
—

| Sản phẩm       | Đơn giá        | Số lượng | Thành tiền       |
|----------------|----------------|----------|------------------|
@foreach($details as $item)
| {{ $item->productVariant->product->name }} | {{ number_format($item->productVariant->product->price) }}₫ | {{ $item->quantity }} | {{ number_format($order->total_price) }}₫ |
@endforeach

**Phí vận chuyển:** 40.000₫  
**Giảm giá (nếu có):** -{{ number_format($order->voucherDiscount ?? 0, 0, ',', '.') }}₫  

{{-- @component('mail::button', ['url' => route('orders.show', $order->id)])
Xem chi tiết đơn hàng
@endcomponent --}}

Trân trọng,<br>
M A G
@endcomponent
