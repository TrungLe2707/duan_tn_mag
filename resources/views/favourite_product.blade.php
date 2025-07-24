@extends('app')

@section('body')
    <div class="pruductall">
        <div class="grid wide container">
            <div class="row">
                <div class="col l-12">
                    <div class="product-box-sp">
                        <div id="box1" class="box-sanpham active-sanpham">
                            <section class="product-thun">
                                <div class="grid wide container">
                                    <style>
                                        .product-sort-mobile {
                                            display: flex;
                                            align-items: center;
                                            justify-content: space-between;
                                        }

                                        .product-sort-mobile>.sort-item {
                                            width: auto;
                                            padding: 3px 7px;
                                        }

                                    </style>
                                    <div class="product-sort-mobile">

                                        <h2 class="product-name product-name-size">Sản phẩm yêu thích</h2>

                                        <div class="delete-favourite-all" style="padding: 18px 0px; width: 150px;">
                                            <a href="" style="color: red; text-decoration: none;" >Xóa tất cả<i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="relative">
                                            <div class="dropdown-container">
                                                <div class="select-trigger" id="sortButton">
                                                    {{-- <span class="select-label">Sắp xếp theo</span> --}}
                                                    <span class="select-value" id="selectedValue">Mặc định</span>
                                                    <i class="fas fa-chevron-down select-icon"></i>
                                                </div>
                                                <ul class="dropdown-menu" id="dropdownMenu">
                                                    <li class="dropdown-item" data-value="Bán chạy">
                                                        <span class="radio"></span> Bán chạy
                                                    </li>
                                                    <li class="dropdown-item" data-value="Giá: Thấp đến Cao">
                                                        <span class="radio"></span> Giá: Thấp đến Cao
                                                    </li>
                                                    <li class="dropdown-item" data-value="Giá: Cao đến Thấp">
                                                        <span class="radio"></span> Giá: Cao đến Thấp
                                                    </li>
                                                    <li class="dropdown-item" data-value="Mới nhất">
                                                        <span class="radio"></span> Mới nhất
                                                    </li>
                                                    <li class="dropdown-item selected" data-value="Nổi bật">
                                                        <span class="radio"></span> Cũ nhất
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <style>

                                    </style>
                                    <div class="row" style="margin-top: 20px">
                                        <div class="col l-3 m-6 c-6 ">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon">
                                                        <i class="fa-solid fa-cart-shopping"></i>
                                                    </div>

                                                    <a href="/detail.html"><img src="img/aothun.webp" alt=""></a>
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price" style="display: flex; justify-content: space-between; align-item: center;">
                                                    <div>
                                                        <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                        <span><del>300.000đ</del></span>
                                                    </div>

                                                    <span ><a href="" style="text-decoration: none; color: red;">Xóa<i class="fa fa-trash" aria-hidden="true"></i></a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                    </div>
                                </div>
                                <div>

                                </div>
                            </section>
                            <div class="chuyentrang">
                                <button class="active-sanpham" id="btn1-1">1</button>
                                <button id="btn1-2">2</button>
                                <button id="btn1-3">3</button>
                            </div>

                        </div>
                        <div id="box2" class="box-sanpham">
                            <section class="product-thun">
                                <h2 class="product-name product-name-size">Tất cả sản phẩm</h2>
                                <div class="grid wide container">
                                    <div class="row">
                                        <div class="col l-4 m-6 c-6 ">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/aokhoac.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/aokhoac.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6 row-mobile">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/aokhoac.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6 ">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/aokhoac.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/aokhoac.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6 row-mobile">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/aokhoac.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6 ">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/aokhoac.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/aokhoac.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6 row-mobile">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/aokhoac.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6 ">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/aokhoac.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/aokhoac.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6 row-mobile">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/aokhoac.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                    </div>
                                </div>
                                <div>

                                </div>
                            </section>
                            <div class="chuyentrang">
                                <button id="btn2-1">1</button>
                                <button class="active-sanpham" id="btn2-2">2</button>
                                <button id="btn2-3">3</button>
                            </div>
                        </div>
                        <div id="box3" class="box-sanpham">
                            <section class="product-thun">
                                <h2 class="product-name product-name-size">Tất cả sản phẩm</h2>
                                <div class="grid wide container">
                                    <div class="row">
                                        <div class="col l-4 m-6 c-6 ">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/phukien.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/phukien.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6 row-mobile">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/phukien.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6 ">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/phukien.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/phukien.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6 row-mobile">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/phukien.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6 ">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/phukien.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/phukien.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6 row-mobile">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/phukien.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6 ">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/phukien.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/phukien.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col l-4 m-6 c-6 row-mobile">
                                            <div class="item product-pading-size">
                                                <div class="item-img">
                                                    <span class="item-giam">-44%</span>
                                                    <div class="item-icon"><i class="fa-solid fa-cart-shopping"></i>
                                                    </div>
                                                    <img src="img/phukien.webp" alt="">
                                                </div>
                                                <div class="item-name">
                                                    <h3><a href="">
                                                            Áo Thun Local Brand Unisex Summer Fresh Tshirt TS282
                                                        </a></h3>
                                                </div>
                                                <div class="item-price">
                                                    <span style="color: red;padding-right: 10px;">195.000đ</span>
                                                    <span><del>300.000đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                    </div>
                                </div>
                                <div>

                                </div>
                            </section>
                            <div class="chuyentrang">
                                <button id="btn3-1">1</button>
                                <button id="btn3-2">2</button>
                                <button class="active-sanpham" id="btn3-3">3</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <script src="{{asset('main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
    <script>
        // lọc sản phẩm
        const sortButton = document.getElementById('sortButton');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const selectedValue = document.getElementById('selectedValue');
        const dropdownItems = document.querySelectorAll('.dropdown-item');

        // Show/hide menu on button click
        sortButton.addEventListener('click', () => {
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });

        // Handle item selection
        dropdownItems.forEach(item => {
            item.addEventListener('click', () => {
                dropdownItems.forEach(i => i.classList.remove('selected'));
                item.classList.add('selected');
                selectedValue.textContent = item.dataset.value;
                dropdownMenu.style.display = 'none';
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', (event) => {
            if (!sortButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.style.display = 'none';
            }
        });




        document.addEventListener('DOMContentLoaded', function () {
            // Lấy các phần tử DOM
            const mobileFilterToggle = document.querySelector('.mobile-filter-toggle');
            const mobileFilterContent = document.querySelector('.mobile-filter-content');
            const desktopFilter = document.querySelector('.product-filter-desktop');
            const filterCount = document.querySelector('.product-filter-count');

            // Sao chép nội dung filter từ desktop sang mobile
            if (desktopFilter && mobileFilterContent) {
                mobileFilterContent.innerHTML = desktopFilter.innerHTML;
            }

            // Xử lý toggle mobile filter
            if (mobileFilterToggle) {
                mobileFilterToggle.addEventListener('click', function () {
                    mobileFilterContent.classList.toggle('active');
                    const icon = this.querySelector('.fa-chevron-down');
                    icon.classList.toggle('fa-rotate-180');
                });
            }

            // Biến lưu trữ các lựa chọn filter
            let selectedFilters = {
                categories: [],
                sizes: [],
                colors: [],
                price: null
            };

            // Hàm cập nhật số lượng filter đã chọn
            function updateFilterCount() {
                let count = 0;

                // Đếm danh mục
                count += selectedFilters.categories.length;

                // Đếm size
                count += selectedFilters.sizes.length;

                // Đếm màu
                count += selectedFilters.colors.length;

                // Đếm giá
                if (selectedFilters.price) count += 1;

                filterCount.textContent = count;
                filterCount.style.display = count > 0 ? 'flex' : 'none';
            }

            // Xử lý lọc danh mục
            const categoryCheckboxes = document.querySelectorAll('.category-options input[type="checkbox"]');
            categoryCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const category = this.nextElementSibling.textContent;

                    if (this.checked) {
                        if (!selectedFilters.categories.includes(category)) {
                            selectedFilters.categories.push(category);
                        }
                    } else {
                        selectedFilters.categories = selectedFilters.categories.filter(item => item !== category);
                    }

                    updateFilterCount();
                });
            });

            // Xử lý lọc size (giữ nguyên từ trước)
            const sizeOptions = document.querySelectorAll('.filter-options .filter-option');
            sizeOptions.forEach(option => {
                option.addEventListener('click', function (e) {
                    if (e.target.tagName === 'INPUT') return;

                    sizeOptions.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');

                    const radio = this.querySelector('input[type="radio"]');
                    radio.checked = true;

                    // Cập nhật selectedFilters
                    selectedFilters.sizes = [this.querySelector('label').textContent];
                    updateFilterCount();
                });
            });

            // Xử lý lọc màu sắc (giữ nguyên từ trước)
            const colorOptions = document.querySelectorAll('.color-options .color-option');
            colorOptions.forEach(option => {
                option.addEventListener('click', function () {
                    colorOptions.forEach(color => color.classList.remove('selected'));
                    this.classList.add('selected');

                    // Cập nhật selectedFilters
                    selectedFilters.colors = [this.getAttribute('title')];
                    updateFilterCount();
                });
            });

            // Xử lý lọc giá (giữ nguyên từ trước)
            const priceOptions = document.querySelectorAll('.price-options .price-option');
            priceOptions.forEach(option => {
                option.addEventListener('click', function (e) {
                    if (e.target.tagName === 'INPUT') return;

                    priceOptions.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');

                    const radio = this.querySelector('input[type="radio"]');
                    radio.checked = true;

                    // Cập nhật selectedFilters
                    selectedFilters.price = this.querySelector('label').textContent;
                    updateFilterCount();
                });
            });

            // Xử lý nút áp dụng bộ lọc
            const filterButtons = document.querySelectorAll('.filter-button');
            filterButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Thu gọn mobile filter nếu đang mở
                    if (mobileFilterContent.classList.contains('active')) {
                        mobileFilterContent.classList.remove('active');
                        mobileFilterToggle.querySelector('.fa-chevron-down').classList.remove('fa-rotate-180');
                    }

                    // Gửi dữ liệu filter đi (có thể là AJAX hoặc filter client-side)
                    console.log('Filters applied:', selectedFilters);

                    // Hiển thị thông báo
                    alert(`Đã áp dụng bộ lọc:
                                    Danh mục: ${selectedFilters.categories.join(', ') || 'Tất cả'}
                                    Size: ${selectedFilters.sizes.join(', ') || 'Tất cả'}
                                    Màu: ${selectedFilters.colors.join(', ') || 'Tất cả'}
                                    Giá: ${selectedFilters.price || 'Tất cả'}`);

                    // Ở đây bạn có thể thêm code để thực sự lọc sản phẩm
                    // filterProducts(selectedFilters);
                });
            });

            // Khởi tạo filter count
            updateFilterCount();
        });
    </script>
@endsection
