@extends('app')

@section('body')
<link rel="stylesheet" href="{{ asset('css/error.css') }}">
    <div class="error-container">
        <div class="error-logo">
            <img src="./img/logo_MAG.png" alt="MAG Logo" class="error-mag-logo">
        </div>
        <div class="error-image">
            <img src="{{asset('img/gif.gif')}}" alt="sadsa">
        </div>
        <div class="error-title">ĐƯỜNG DẪN KHÔNG TỒN TẠI</div>
        <div class="error-message">
            Trang bạn yêu cầu không thể tìm thấy hoặc đã bị di chuyển.
            <br>
            Vui lòng kiểm tra lại hoặc quay về trang chủ của MAG.
        </div>
        <a href="/" class="home-button">TRANG CHỦ MAG</a>
    </div>
@endsection
