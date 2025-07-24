<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_variants = [
            ['product_id' => 1, 'color_id' => 1, 'size_id' => 2, 'sku' => 'TS174-M-Đen', 'quantity' => 10], // M
            ['product_id' => 1, 'color_id' => 1, 'size_id' => 3, 'sku' => 'TS174-L-Đen', 'quantity' => 10], // L
            ['product_id' => 1, 'color_id' => 1, 'size_id' => 4, 'sku' => 'TS174-XL-Đen', 'quantity' => 10], // XL

            // Product 2: Áo Thun TS161 - Đen, Kem
            ['product_id' => 2, 'color_id' => 1, 'size_id' => 2, 'sku' => 'TS161-M-Đen', 'quantity' => 10], // M, Đen
            ['product_id' => 2, 'color_id' => 1, 'size_id' => 3, 'sku' => 'TS161-L-Đen', 'quantity' => 10], // L, Đen
            ['product_id' => 2, 'color_id' => 1, 'size_id' => 4, 'sku' => 'TS161-XL-Đen', 'quantity' => 10], // XL, Đen
            ['product_id' => 2, 'color_id' => 7, 'size_id' => 2, 'sku' => 'TS161-M-Kem', 'quantity' => 10], // M, Kem
            ['product_id' => 2, 'color_id' => 7, 'size_id' => 3, 'sku' => 'TS161-L-Kem', 'quantity' => 10], // L, Kem
            ['product_id' => 2, 'color_id' => 7, 'size_id' => 4, 'sku' => 'TS161-XL-Kem', 'quantity' => 10], // XL, Kem

            // Product 3: Áo Thun TS170 - Wash phối đen
            ['product_id' => 3, 'color_id' => 8, 'size_id' => 2, 'sku' => 'TS170-M-WashPhốiĐen', 'quantity' => 10], // M
            ['product_id' => 3, 'color_id' => 8, 'size_id' => 3, 'sku' => 'TS170-L-WashPhốiĐen', 'quantity' => 10], // L
            ['product_id' => 3, 'color_id' => 8, 'size_id' => 4, 'sku' => 'TS170-XL-WashPhốiĐen', 'quantity' => 10], // XL

            // Product 4: Áo Thun TS232 - Đen
            ['product_id' => 4, 'color_id' => 1, 'size_id' => 2, 'sku' => 'TS232-M-Đen', 'quantity' => 10], // M
            ['product_id' => 4, 'color_id' => 1, 'size_id' => 3, 'sku' => 'TS232-L-Đen', 'quantity' => 10], // L
            ['product_id' => 4, 'color_id' => 1, 'size_id' => 4, 'sku' => 'TS232-XL-Đen', 'quantity' => 10], // XL

            // Product 5: Áo Thun TS001 - Đen
            ['product_id' => 5, 'color_id' => 1, 'size_id' => 2, 'sku' => 'TS001-M-Đen', 'quantity' => 10], // M
            ['product_id' => 5, 'color_id' => 1, 'size_id' => 3, 'sku' => 'TS001-L-Đen', 'quantity' => 10], // L
            ['product_id' => 5, 'color_id' => 1, 'size_id' => 4, 'sku' => 'TS001-XL-Đen', 'quantity' => 10], // XL

            // Product 6: Áo Thun TS176 - Đen
            ['product_id' => 6, 'color_id' => 1, 'size_id' => 2, 'sku' => 'TS176-M-Đen', 'quantity' => 10], // M
            ['product_id' => 6, 'color_id' => 1, 'size_id' => 3, 'sku' => 'TS176-L-Đen', 'quantity' => 10], // L
            ['product_id' => 6, 'color_id' => 1, 'size_id' => 4, 'sku' => 'TS176-XL-Đen', 'quantity' => 10], // XL

            // Product 7: Áo Thun TS268 - Đen, Be, Nâu, Xanh Khói
            ['product_id' => 7, 'color_id' => 1, 'size_id' => 2, 'sku' => 'TS268-M-Đen', 'quantity' => 10], // M, Đen
            ['product_id' => 7, 'color_id' => 1, 'size_id' => 3, 'sku' => 'TS268-L-Đen', 'quantity' => 10], // L, Đen
            ['product_id' => 7, 'color_id' => 1, 'size_id' => 4, 'sku' => 'TS268-XL-Đen', 'quantity' => 10], // XL, Đen
            ['product_id' => 7, 'color_id' => 9, 'size_id' => 2, 'sku' => 'TS268-M-Be', 'quantity' => 10], // M, Be
            ['product_id' => 7, 'color_id' => 9, 'size_id' => 3, 'sku' => 'TS268-L-Be', 'quantity' => 10], // L, Be
            ['product_id' => 7, 'color_id' => 9, 'size_id' => 4, 'sku' => 'TS268-XL-Be', 'quantity' => 10], // XL, Be
            ['product_id' => 7, 'color_id' => 10, 'size_id' => 2, 'sku' => 'TS268-M-Nâu', 'quantity' => 10], // M, Nâu
            ['product_id' => 7, 'color_id' => 10, 'size_id' => 3, 'sku' => 'TS268-L-Nâu', 'quantity' => 10], // L, Nâu
            ['product_id' => 7, 'color_id' => 10, 'size_id' => 4, 'sku' => 'TS268-XL-Nâu', 'quantity' => 10], // XL, Nâu
            ['product_id' => 7, 'color_id' => 11, 'size_id' => 2, 'sku' => 'TS268-M-XanhKhói', 'quantity' => 10], // M, Xanh Khói
            ['product_id' => 7, 'color_id' => 11, 'size_id' => 3, 'sku' => 'TS268-L-XanhKhói', 'quantity' => 10], // L, Xanh Khói
            ['product_id' => 7, 'color_id' => 11, 'size_id' => 4, 'sku' => 'TS268-XL-XanhKhói', 'quantity' => 10], // XL, Xanh Khói

            // Product 8: Áo Thun TS257 - Đen, Xám, Kem
            ['product_id' => 8, 'color_id' => 1, 'size_id' => 2, 'sku' => 'TS257-M-Đen', 'quantity' => 10], // M, Đen
            ['product_id' => 8, 'color_id' => 1, 'size_id' => 3, 'sku' => 'TS257-L-Đen', 'quantity' => 10], // L, Đen
            ['product_id' => 8, 'color_id' => 1, 'size_id' => 4, 'sku' => 'TS257-XL-Đen', 'quantity' => 10], // XL, Đen
            ['product_id' => 8, 'color_id' => 4, 'size_id' => 2, 'sku' => 'TS257-M-Xám', 'quantity' => 10], // M, Xám
            ['product_id' => 8, 'color_id' => 4, 'size_id' => 3, 'sku' => 'TS257-L-Xám', 'quantity' => 10], // L, Xám
            ['product_id' => 8, 'color_id' => 4, 'size_id' => 4, 'sku' => 'TS257-XL-Xám', 'quantity' => 10], // XL, Xám
            ['product_id' => 8, 'color_id' => 7, 'size_id' => 2, 'sku' => 'TS257-M-Kem', 'quantity' => 10], // M, Kem
            ['product_id' => 8, 'color_id' => 7, 'size_id' => 3, 'sku' => 'TS257-L-Kem', 'quantity' => 10], // L, Kem
            ['product_id' => 8, 'color_id' => 7, 'size_id' => 4, 'sku' => 'TS257-XL-Kem', 'quantity' => 10], // XL, Kem

            // Product 9: Áo Thun TS198 - Đen, Kem
            ['product_id' => 9, 'color_id' => 1, 'size_id' => 2, 'sku' => 'TS198-M-Đen', 'quantity' => 10], // M, Đen
            ['product_id' => 9, 'color_id' => 1, 'size_id' => 3, 'sku' => 'TS198-L-Đen', 'quantity' => 10], // L, Đen
            ['product_id' => 9, 'color_id' => 1, 'size_id' => 4, 'sku' => 'TS198-XL-Đen', 'quantity' => 10], // XL, Đen
            ['product_id' => 9, 'color_id' => 7, 'size_id' => 2, 'sku' => 'TS198-M-Kem', 'quantity' => 10], // M, Kem
            ['product_id' => 9, 'color_id' => 7, 'size_id' => 3, 'sku' => 'TS198-L-Kem', 'quantity' => 10], // L, Kem
            ['product_id' => 9, 'color_id' => 7, 'size_id' => 4, 'sku' => 'TS198-XL-Kem', 'quantity' => 10], // XL, Kem

            // Product 10: Áo Thun TS239 - Đen, Kem
            ['product_id' => 10, 'color_id' => 1, 'size_id' => 2, 'sku' => 'TS239-M-Đen', 'quantity' => 10], // M, Đen
            ['product_id' => 10, 'color_id' => 1, 'size_id' => 3, 'sku' => 'TS239-L-Đen', 'quantity' => 10], // L, Đen
            ['product_id' => 10, 'color_id' => 1, 'size_id' => 4, 'sku' => 'TS239-XL-Đen', 'quantity' => 10], // XL, Đen
            ['product_id' => 10, 'color_id' => 7, 'size_id' => 2, 'sku' => 'TS239-M-Kem', 'quantity' => 10], // M, Kem
            ['product_id' => 10, 'color_id' => 7, 'size_id' => 3, 'sku' => 'TS239-L-Kem', 'quantity' => 10], // L, Kem
            ['product_id' => 10, 'color_id' => 7, 'size_id' => 4, 'sku' => 'TS239-XL-Kem', 'quantity' => 10], // XL, Kem

            // Product 11: Sơ mi SS079 - Đen, Xám, Đỏ
            ['product_id' => 11, 'color_id' => 1, 'size_id' => 2, 'sku' => 'SS079-M-Đen', 'quantity' => 10], // M, Đen
            ['product_id' => 11, 'color_id' => 1, 'size_id' => 3, 'sku' => 'SS079-L-Đen', 'quantity' => 10], // L, Đen
            ['product_id' => 11, 'color_id' => 1, 'size_id' => 4, 'sku' => 'SS079-XL-Đen', 'quantity' => 10], // XL, Đen
            ['product_id' => 11, 'color_id' => 4, 'size_id' => 2, 'sku' => 'SS079-M-Xám', 'quantity' => 10], // M, Xám
            ['product_id' => 11, 'color_id' => 4, 'size_id' => 3, 'sku' => 'SS079-L-Xám', 'quantity' => 10], // L, Xám
            ['product_id' => 11, 'color_id' => 4, 'size_id' => 4, 'sku' => 'SS079-XL-Xám', 'quantity' => 10], // XL, Xám
            ['product_id' => 11, 'color_id' => 12, 'size_id' => 2, 'sku' => 'SS079-M-Đỏ', 'quantity' => 10], // M, Đỏ
            ['product_id' => 11, 'color_id' => 12, 'size_id' => 3, 'sku' => 'SS079-L-Đỏ', 'quantity' => 10], // L, Đỏ
            ['product_id' => 11, 'color_id' => 12, 'size_id' => 4, 'sku' => 'SS079-XL-Đỏ', 'quantity' => 10], // XL, Đỏ

            // Product 12: Sơ mi SS068 - Đen, Hồng, Xanh Than, Xanh Dương, Trắng
            ['product_id' => 12, 'color_id' => 1, 'size_id' => 2, 'sku' => 'SS068-M-Đen', 'quantity' => 10], // M, Đen
            ['product_id' => 12, 'color_id' => 1, 'size_id' => 3, 'sku' => 'SS068-L-Đen', 'quantity' => 10], // L, Đen
            ['product_id' => 12, 'color_id' => 1, 'size_id' => 4, 'sku' => 'SS068-XL-Đen', 'quantity' => 10], // XL, Đen
            ['product_id' => 12, 'color_id' => 3, 'size_id' => 2, 'sku' => 'SS068-M-Hồng', 'quantity' => 10], // M, Hồng
            ['product_id' => 12, 'color_id' => 3, 'size_id' => 3, 'sku' => 'SS068-L-Hồng', 'quantity' => 10], // L, Hồng
            ['product_id' => 12, 'color_id' => 3, 'size_id' => 4, 'sku' => 'SS068-XL-Hồng', 'quantity' => 10], // XL, Hồng
            ['product_id' => 12, 'color_id' => 6, 'size_id' => 2, 'sku' => 'SS068-M-XanhThan', 'quantity' => 10], // M, Xanh Than
            ['product_id' => 12, 'color_id' => 6, 'size_id' => 3, 'sku' => 'SS068-L-XanhThan', 'quantity' => 10], // L, Xanh Than
            ['product_id' => 12, 'color_id' => 6, 'size_id' => 4, 'sku' => 'SS068-XL-XanhThan', 'quantity' => 10], // XL, Xanh Than
            ['product_id' => 12, 'color_id' => 13, 'size_id' => 2, 'sku' => 'SS068-M-XanhDương', 'quantity' => 10], // M, Xanh Dương
            ['product_id' => 12, 'color_id' => 13, 'size_id' => 3, 'sku' => 'SS068-L-XanhDương', 'quantity' => 10], // L, Xanh Dương
            ['product_id' => 12, 'color_id' => 13, 'size_id' => 4, 'sku' => 'SS068-XL-XanhDương', 'quantity' => 10], // XL, Xanh Dương
            ['product_id' => 12, 'color_id' => 5, 'size_id' => 2, 'sku' => 'SS068-M-Trắng', 'quantity' => 10], // M, Trắng
            ['product_id' => 12, 'color_id' => 5, 'size_id' => 3, 'sku' => 'SS068-L-Trắng', 'quantity' => 10], // L, Trắng
            ['product_id' => 12, 'color_id' => 5, 'size_id' => 4, 'sku' => 'SS068-XL-Trắng', 'quantity' => 10], // XL, Trắng

            // Product 13: Sơ mi SS066 - Trắng, Đen, Xanh Than, Xanh Dương
            ['product_id' => 13, 'color_id' => 5, 'size_id' => 2, 'sku' => 'SS066-M-Trắng', 'quantity' => 10], // M, Trắng
            ['product_id' => 13, 'color_id' => 5, 'size_id' => 3, 'sku' => 'SS066-L-Trắng', 'quantity' => 10], // L, Trắng
            ['product_id' => 13, 'color_id' => 5, 'size_id' => 4, 'sku' => 'SS066-XL-Trắng', 'quantity' => 10], // XL, Trắng
            ['product_id' => 13, 'color_id' => 1, 'size_id' => 2, 'sku' => 'SS066-M-Đen', 'quantity' => 10], // M, Đen
            ['product_id' => 13, 'color_id' => 1, 'size_id' => 3, 'sku' => 'SS066-L-Đen', 'quantity' => 10], // L, Đen
            ['product_id' => 13, 'color_id' => 1, 'size_id' => 4, 'sku' => 'SS066-XL-Đen', 'quantity' => 10], // XL, Đen
            ['product_id' => 13, 'color_id' => 6, 'size_id' => 2, 'sku' => 'SS066-M-XanhThan', 'quantity' => 10], // M, Xanh Than
            ['product_id' => 13, 'color_id' => 6, 'size_id' => 3, 'sku' => 'SS066-L-XanhThan', 'quantity' => 10], // L, Xanh Than
            ['product_id' => 13, 'color_id' => 6, 'size_id' => 4, 'sku' => 'SS066-XL-XanhThan', 'quantity' => 10], // XL, Xanh Than
            ['product_id' => 13, 'color_id' => 13, 'size_id' => 2, 'sku' => 'SS066-M-XanhDương', 'quantity' => 10], // M, Xanh Dương
            ['product_id' => 13, 'color_id' => 13, 'size_id' => 3, 'sku' => 'SS066-L-XanhDương', 'quantity' => 10], // L, Xanh Dương
            ['product_id' => 13, 'color_id' => 13, 'size_id' => 4, 'sku' => 'SS066-XL-XanhDương', 'quantity' => 10], // XL, Xanh Dương

            // Product 14: Sơ mi SS052 - Xanh, Hồng, Xám
            ['product_id' => 14, 'color_id' => 2, 'size_id' => 2, 'sku' => 'SS052-M-Xanh', 'quantity' => 10], // M, Xanh
            ['product_id' => 14, 'color_id' => 2, 'size_id' => 3, 'sku' => 'SS052-L-Xanh', 'quantity' => 10], // L, Xanh
            ['product_id' => 14, 'color_id' => 2, 'size_id' => 4, 'sku' => 'SS052-XL-Xanh', 'quantity' => 10], // XL, Xanh
            ['product_id' => 14, 'color_id' => 3, 'size_id' => 2, 'sku' => 'SS052-M-Hồng', 'quantity' => 10], // M, Hồng
            ['product_id' => 14, 'color_id' => 3, 'size_id' => 3, 'sku' => 'SS052-L-Hồng', 'quantity' => 10], // L, Hồng
            ['product_id' => 14, 'color_id' => 3, 'size_id' => 4, 'sku' => 'SS052-XL-Hồng', 'quantity' => 10], // XL, Hồng
            ['product_id' => 14, 'color_id' => 4, 'size_id' => 2, 'sku' => 'SS052-M-Xám', 'quantity' => 10], // M, Xám
            ['product_id' => 14, 'color_id' => 4, 'size_id' => 3, 'sku' => 'SS052-L-Xám', 'quantity' => 10], // L, Xám
            ['product_id' => 14, 'color_id' => 4, 'size_id' => 4, 'sku' => 'SS052-XL-Xám', 'quantity' => 10], // XL, Xám

            // Product 15: Sơ mi SS049 - Xanh
            ['product_id' => 15, 'color_id' => 2, 'size_id' => 2, 'sku' => 'SS049-M-Xanh', 'quantity' => 10], // M
            ['product_id' => 15, 'color_id' => 2, 'size_id' => 3, 'sku' => 'SS049-L-Xanh', 'quantity' => 10], // L
            ['product_id' => 15, 'color_id' => 2, 'size_id' => 4, 'sku' => 'SS049-XL-Xanh', 'quantity' => 10], // XL

            // Product 16: Sơ mi SS047 - Xanh, Hồng, Xám
            ['product_id' => 16, 'color_id' => 2, 'size_id' => 2, 'sku' => 'SS047-M-Xanh', 'quantity' => 10], // M, Xanh
            ['product_id' => 16, 'color_id' => 2, 'size_id' => 3, 'sku' => 'SS047-L-Xanh', 'quantity' => 10], // L, Xanh
            ['product_id' => 16, 'color_id' => 2, 'size_id' => 4, 'sku' => 'SS047-XL-Xanh', 'quantity' => 10], // XL, Xanh
            ['product_id' => 16, 'color_id' => 3, 'size_id' => 2, 'sku' => 'SS047-M-Hồng', 'quantity' => 10], // M, Hồng
            ['product_id' => 16, 'color_id' => 3, 'size_id' => 3, 'sku' => 'SS047-L-Hồng', 'quantity' => 10], // L, Hồng
            ['product_id' => 16, 'color_id' => 3, 'size_id' => 4, 'sku' => 'SS047-XL-Hồng', 'quantity' => 10], // XL, Hồng
            ['product_id' => 16, 'color_id' => 4, 'size_id' => 2, 'sku' => 'SS047-M-Xám', 'quantity' => 10], // M, Xám
            ['product_id' => 16, 'color_id' => 4, 'size_id' => 3, 'sku' => 'SS047-L-Xám', 'quantity' => 10], // L, Xám
            ['product_id' => 16, 'color_id' => 4, 'size_id' => 4, 'sku' => 'SS047-XL-Xám', 'quantity' => 10], // XL, Xám

            // Product 17: Áo khoác AK122 - Xám Tiêu, Xanh Than
            ['product_id' => 17, 'color_id' => 17, 'size_id' => 2, 'sku' => 'AK122-M-XámTiêu', 'quantity' => 10], // M, Xám Tiêu
            ['product_id' => 17, 'color_id' => 17, 'size_id' => 3, 'sku' => 'AK122-L-XámTiêu', 'quantity' => 10], // L, Xám Tiêu
            ['product_id' => 17, 'color_id' => 17, 'size_id' => 4, 'sku' => 'AK122-XL-XámTiêu', 'quantity' => 10], // XL, Xám Tiêu
            ['product_id' => 17, 'color_id' => 6, 'size_id' => 2, 'sku' => 'AK122-M-XanhThan', 'quantity' => 10], // M, Xanh Than
            ['product_id' => 17, 'color_id' => 6, 'size_id' => 3, 'sku' => 'AK122-L-XanhThan', 'quantity' => 10], // L, Xanh Than
            ['product_id' => 17, 'color_id' => 6, 'size_id' => 4, 'sku' => 'AK122-XL-XanhThan', 'quantity' => 10], // XL, Xanh Than

            // Product 18: Áo khoác AK125 - Đen, Kem
            ['product_id' => 18, 'color_id' => 1, 'size_id' => 2, 'sku' => 'AK125-M-Đen', 'quantity' => 10], // M, Đen
            ['product_id' => 18, 'color_id' => 1, 'size_id' => 3, 'sku' => 'AK125-L-Đen', 'quantity' => 10], // L, Đen
            ['product_id' => 18, 'color_id' => 1, 'size_id' => 4, 'sku' => 'AK125-XL-Đen', 'quantity' => 10], // XL, Đen
            ['product_id' => 18, 'color_id' => 7, 'size_id' => 2, 'sku' => 'AK125-M-Kem', 'quantity' => 10], // M, Kem
            ['product_id' => 18, 'color_id' => 7, 'size_id' => 3, 'sku' => 'AK125-L-Kem', 'quantity' => 10], // L, Kem
            ['product_id' => 18, 'color_id' => 7, 'size_id' => 4, 'sku' => 'AK125-XL-Kem', 'quantity' => 10], // XL, Kem

            // Product 19: Áo khoác AK120 - Đen, Xám, Nâu Nhạt
            ['product_id' => 19, 'color_id' => 1, 'size_id' => 2, 'sku' => 'AK120-M-Đen', 'quantity' => 10], // M, Đen
            ['product_id' => 19, 'color_id' => 1, 'size_id' => 3, 'sku' => 'AK120-L-Đen', 'quantity' => 10], // L, Đen
            ['product_id' => 19, 'color_id' => 1, 'size_id' => 4, 'sku' => 'AK120-XL-Đen', 'quantity' => 10], // XL, Đen
            ['product_id' => 19, 'color_id' => 4, 'size_id' => 2, 'sku' => 'AK120-M-Xám', 'quantity' => 10], // M, Xám
            ['product_id' => 19, 'color_id' => 4, 'size_id' => 3, 'sku' => 'AK120-L-Xám', 'quantity' => 10], // L, Xám
            ['product_id' => 19, 'color_id' => 4, 'size_id' => 4, 'sku' => 'AK120-XL-Xám', 'quantity' => 10], // XL, Xám
            ['product_id' => 19, 'color_id' => 14, 'size_id' => 2, 'sku' => 'AK120-M-NâuNhạt', 'quantity' => 10], // M, Nâu Nhạt
            ['product_id' => 19, 'color_id' => 14, 'size_id' => 3, 'sku' => 'AK120-L-NâuNhạt', 'quantity' => 10], // L, Nâu Nhạt
            ['product_id' => 19, 'color_id' => 14, 'size_id' => 4, 'sku' => 'AK120-XL-NâuNhạt', 'quantity' => 10], // XL, Nâu Nhạt

            // Product 20: Áo khoác AK117 - Đen, Be, Xanh Than, Xám Đậm
            ['product_id' => 20, 'color_id' => 1, 'size_id' => 2, 'sku' => 'AK117-M-Đen', 'quantity' => 10], // M, Đen
            ['product_id' => 20, 'color_id' => 1, 'size_id' => 3, 'sku' => 'AK117-L-Đen', 'quantity' => 10], // L, Đen
            ['product_id' => 20, 'color_id' => 1, 'size_id' => 4, 'sku' => 'AK117-XL-Đen', 'quantity' => 10], // XL, Đen
            ['product_id' => 20, 'color_id' => 9, 'size_id' => 2, 'sku' => 'AK117-M-Be', 'quantity' => 10], // M, Be
            ['product_id' => 20, 'color_id' => 9, 'size_id' => 3, 'sku' => 'AK117-L-Be', 'quantity' => 10], // L, Be
            ['product_id' => 20, 'color_id' => 9, 'size_id' => 4, 'sku' => 'AK117-XL-Be', 'quantity' => 10], // XL, Be
            ['product_id' => 20, 'color_id' => 6, 'size_id' => 2, 'sku' => 'AK117-M-XanhThan', 'quantity' => 10], // M, Xanh Than
            ['product_id' => 20, 'color_id' => 6, 'size_id' => 3, 'sku' => 'AK117-L-XanhThan', 'quantity' => 10], // L, Xanh Than
            ['product_id' => 20, 'color_id' => 6, 'size_id' => 4, 'sku' => 'AK117-XL-XanhThan', 'quantity' => 10], // XL, Xanh Than
            ['product_id' => 20, 'color_id' => 15, 'size_id' => 2, 'sku' => 'AK117-M-XámĐậm', 'quantity' => 10], // M, Xám Đậm
            ['product_id' => 20, 'color_id' => 15, 'size_id' => 3, 'sku' => 'AK117-L-XámĐậm', 'quantity' => 10], // L, Xám Đậm
            ['product_id' => 20, 'color_id' => 15, 'size_id' => 4, 'sku' => 'AK117-XL-XámĐậm', 'quantity' => 10], // XL, Xám Đậm

            // Product 21: Áo khoác AK114 - Đỏ, Đen, Xanh Navy, Xanh Lá
            ['product_id' => 21, 'color_id' => 12, 'size_id' => 2, 'sku' => 'AK114-M-Đỏ', 'quantity' => 10], // M, Đỏ
            ['product_id' => 21, 'color_id' => 12, 'size_id' => 3, 'sku' => 'AK114-L-Đỏ', 'quantity' => 10], // L, Đỏ
            ['product_id' => 21, 'color_id' => 12, 'size_id' => 4, 'sku' => 'AK114-XL-Đỏ', 'quantity' => 10], // XL, Đỏ
            ['product_id' => 21, 'color_id' => 1, 'size_id' => 2, 'sku' => 'AK114-M-Đen', 'quantity' => 10], // M, Đen
            ['product_id' => 21, 'color_id' => 1, 'size_id' => 3, 'sku' => 'AK114-L-Đen', 'quantity' => 10], // L, Đen
            ['product_id' => 21, 'color_id' => 1, 'size_id' => 4, 'sku' => 'AK114-XL-Đen', 'quantity' => 10], // XL, Đen
            ['product_id' => 21, 'color_id' => 6, 'size_id' => 2, 'sku' => 'AK114-M-XanhNavy', 'quantity' => 10], // M, Xanh Navy
            ['product_id' => 21, 'color_id' => 6, 'size_id' => 3, 'sku' => 'AK114-L-XanhNavy', 'quantity' => 10], // L, Xanh Navy
            ['product_id' => 21, 'color_id' => 6, 'size_id' => 4, 'sku' => 'AK114-XL-XanhNavy', 'quantity' => 10], // XL, Xanh Navy
            ['product_id' => 21, 'color_id' => 16, 'size_id' => 2, 'sku' => 'AK114-M-XanhLá', 'quantity' => 10], // M, Xanh Lá
            ['product_id' => 21, 'color_id' => 16, 'size_id' => 3, 'sku' => 'AK114-L-XanhLá', 'quantity' => 10], // L, Xanh Lá
            ['product_id' => 21, 'color_id' => 16, 'size_id' => 4, 'sku' => 'AK114-XL-XanhLá', 'quantity' => 10], // XL, Xanh Lá

            // Product 22: Áo khoác AK111 - Xanh Than
            ['product_id' => 22, 'color_id' => 6, 'size_id' => 2, 'sku' => 'AK111-M-XanhThan', 'quantity' => 10], // M
            ['product_id' => 22, 'color_id' => 6, 'size_id' => 3, 'sku' => 'AK111-L-XanhThan', 'quantity' => 10], // L
            ['product_id' => 22, 'color_id' => 6, 'size_id' => 4, 'sku' => 'AK111-XL-XanhThan', 'quantity' => 10], // XL

            // Product 23: Áo khoác AK093 - Đen
            ['product_id' => 23, 'color_id' => 1, 'size_id' => 2, 'sku' => 'AK093-M-Đen', 'quantity' => 10], // M
            ['product_id' => 22, 'color_id' => 1, 'size_id' => 3, 'sku' => 'AK093-L-Đen', 'quantity' => 10], // L
            ['product_id' => 22, 'color_id' => 1, 'size_id' => 4, 'sku' => 'AK093-XL-Đen', 'quantity' => 10], // XL

            // Product 24: Áo khoác AK079 - Đen, Kem
            ['product_id' => 24, 'color_id' => 1, 'size_id' => 2, 'sku' => 'AK079-M-Đen', 'quantity' => 10], // M, Đen
            ['product_id' => 24, 'color_id' => 1, 'size_id' => 3, 'sku' => 'AK079-L-Đen', 'quantity' => 10], // L, Đen
            ['product_id' => 24, 'color_id' => 1, 'size_id' => 4, 'sku' => 'AK079-XL-Đen', 'quantity' => 10], // XL, Đen
            ['product_id' => 24, 'color_id' => 7, 'size_id' => 2, 'sku' => 'AK079-M-Kem', 'quantity' => 10], // M, Kem
            ['product_id' => 24, 'color_id' => 7, 'size_id' => 3, 'sku' => 'AK079-L-Kem', 'quantity' => 10], // L, Kem
            ['product_id' => 24, 'color_id' => 7, 'size_id' => 4, 'sku' => 'AK079-XL-Kem', 'quantity' => 10], // XL, Kem

            // Product 25: Áo khoác AK074 - Đen
            ['product_id' => 25, 'color_id' => 1, 'size_id' => 2, 'sku' => 'AK074-M-Đen', 'quantity' => 10], // M
            ['product_id' => 25, 'color_id' => 1, 'size_id' => 3, 'sku' => 'AK074-L-Đen', 'quantity' => 10], // L
            ['product_id' => 25, 'color_id' => 1, 'size_id' => 4, 'sku' => 'AK074-XL-Đen', 'quantity' => 10], // XL

            // Product 26: Áo khoác AK063 - Xám phối đen
            ['product_id' => 26, 'color_id' => 4, 'size_id' => 2, 'sku' => 'AK063-M-XámPhốiĐen', 'quantity' => 10], // M
            ['product_id' => 26, 'color_id' => 4, 'size_id' => 3, 'sku' => 'AK063-L-XámPhốiĐen', 'quantity' => 10], // L
            ['product_id' => 26, 'color_id' => 4, 'size_id' => 4, 'sku' => 'AK063-XL-XámPhốiĐen', 'quantity' => 10], // XL
            
            // Product 27: Áo Polo AP069 - Đen, M,L,XL
            ['product_id' => 27, 'color_id' => 1, 'size_id' => 2, 'sku' => 'AP069-M-Đen','quantity' => 10],
            ['product_id' => 27, 'color_id' => 1, 'size_id' => 3, 'sku' => 'AP069-L-Đen','quantity' => 10],
            ['product_id' => 27, 'color_id' => 1, 'size_id' => 4, 'sku' => 'AP069-XL-Đen','quantity' => 10],

            // Product 28: Áo Polo AP068 - Đen, Xám Melane, S,M,L,XL
            ['product_id' => 28, 'color_id' => 1, 'size_id' => 1, 'sku' => 'AP068-S-Đen','quantity' => 10],
            ['product_id' => 28, 'color_id' => 1, 'size_id' => 2, 'sku' => 'AP068-M-Đen','quantity' => 10],
            ['product_id' => 28, 'color_id' => 1, 'size_id' => 3, 'sku' => 'AP068-L-Đen','quantity' => 10],
            ['product_id' => 28, 'color_id' => 1, 'size_id' => 4, 'sku' => 'AP068-XL-Đen','quantity' => 10],
            ['product_id' => 28, 'color_id' => 14, 'size_id' => 1, 'sku' => 'AP068-S-XámMelane','quantity' => 10],
            ['product_id' => 28, 'color_id' => 14, 'size_id' => 2, 'sku' => 'AP068-M-XámMelane','quantity' => 10],
            ['product_id' => 28, 'color_id' => 14, 'size_id' => 3, 'sku' => 'AP068-L-XámMelane','quantity' => 10],
            ['product_id' => 28, 'color_id' => 14, 'size_id' => 4, 'sku' => 'AP068-XL-XámMelane','quantity' => 10],

            // Product 29: Áo Polo AP061 - Đen, Xanh, Hồng, M,L,XL
            ['product_id' => 29, 'color_id' => 1, 'size_id' => 2, 'sku' => 'AP061-M-Đen','quantity' => 10],
            ['product_id' => 29, 'color_id' => 1, 'size_id' => 3, 'sku' => 'AP061-L-Đen','quantity' => 10],
            ['product_id' => 29, 'color_id' => 1, 'size_id' => 4, 'sku' => 'AP061-XL-Đen','quantity' => 10],
            ['product_id' => 29, 'color_id' => 2, 'size_id' => 2, 'sku' => 'AP061-M-Xanh','quantity' => 10],
            ['product_id' => 29, 'color_id' => 2, 'size_id' => 3, 'sku' => 'AP061-L-Xanh','quantity' => 10],
            ['product_id' => 29, 'color_id' => 2, 'size_id' => 4, 'sku' => 'AP061-XL-Xanh','quantity' => 10],
            ['product_id' => 29, 'color_id' => 3, 'size_id' => 2, 'sku' => 'AP061-M-Hồng','quantity' => 10],
            ['product_id' => 29, 'color_id' => 3, 'size_id' => 3, 'sku' => 'AP061-L-Hồng','quantity' => 10],
            ['product_id' => 29, 'color_id' => 3, 'size_id' => 4, 'sku' => 'AP061-XL-Hồng','quantity' => 10],

            // Product 30: Áo Polo AP055 - Đen, M,L,XL
            ['product_id' => 30, 'color_id' => 1, 'size_id' => 2, 'sku' => 'AP055-M-Đen','quantity' => 10],
            ['product_id' => 30, 'color_id' => 1, 'size_id' => 3, 'sku' => 'AP055-L-Đen','quantity' => 10],
            ['product_id' => 30, 'color_id' => 1, 'size_id' => 4, 'sku' => 'AP055-XL-Đen','quantity' => 10],

            // Product 31: Áo Polo AP053 - Đen, Hồng, M,L,XL
            ['product_id' => 31, 'color_id' => 1, 'size_id' => 2, 'sku' => 'AP053-M-Đen','quantity' => 10],
            ['product_id' => 31, 'color_id' => 1, 'size_id' => 3, 'sku' => 'AP053-L-Đen','quantity' => 10],
            ['product_id' => 31, 'color_id' => 1, 'size_id' => 4, 'sku' => 'AP053-XL-Đen','quantity' => 10],
            ['product_id' => 31, 'color_id' => 3, 'size_id' => 2, 'sku' => 'AP053-M-Hồng','quantity' => 10],
            ['product_id' => 31, 'color_id' => 3, 'size_id' => 3, 'sku' => 'AP053-L-Hồng','quantity' => 10],
            ['product_id' => 31, 'color_id' => 3, 'size_id' => 4, 'sku' => 'AP053-XL-Hồng','quantity' => 10],

            // Product 32: Áo Polo AP049 - Kem, Đen, Xám, M,L,XL
            ['product_id' => 32, 'color_id' => 7, 'size_id' => 2, 'sku' => 'AP049-M-Kem','quantity' => 10],
            ['product_id' => 32, 'color_id' => 7, 'size_id' => 3, 'sku' => 'AP049-L-Kem','quantity' => 10],
            ['product_id' => 32, 'color_id' => 7, 'size_id' => 4, 'sku' => 'AP049-XL-Kem','quantity' => 10],
            ['product_id' => 32, 'color_id' => 1, 'size_id' => 2, 'sku' => 'AP049-M-Đen','quantity' => 10],
            ['product_id' => 32, 'color_id' => 1, 'size_id' => 3, 'sku' => 'AP049-L-Đen','quantity' => 10],
            ['product_id' => 32, 'color_id' => 1, 'size_id' => 4, 'sku' => 'AP049-XL-Đen','quantity' => 10],
            ['product_id' => 32, 'color_id' => 4, 'size_id' => 2, 'sku' => 'AP049-M-Xám','quantity' => 10],
            ['product_id' => 32, 'color_id' => 4, 'size_id' => 3, 'sku' => 'AP049-L-Xám','quantity' => 10],
            ['product_id' => 32, 'color_id' => 4, 'size_id' => 4, 'sku' => 'AP049-XL-Xám','quantity' => 10],

            // Product 33: Áo Babytee Polo BT012 - Đen, Trắng, S,M
            ['product_id' => 33, 'color_id' => 1, 'size_id' => 1, 'sku' => 'BT012-S-Đen','quantity' => 10],
            ['product_id' => 33, 'color_id' => 1, 'size_id' => 2, 'sku' => 'BT012-M-Đen','quantity' => 10],
            ['product_id' => 33, 'color_id' => 5, 'size_id' => 1, 'sku' => 'BT012-S-Trắng','quantity' => 10],
            ['product_id' => 33, 'color_id' => 5, 'size_id' => 2, 'sku' => 'BT012-M-Trắng','quantity' => 10],

            // Product 34: Áo Polo AP035 - Đen, Xám, M,L,XL
            ['product_id' => 34, 'color_id' => 1, 'size_id' => 2, 'sku' => 'AP035-M-Đen','quantity' => 10],
            ['product_id' => 34, 'color_id' => 1, 'size_id' => 3, 'sku' => 'AP035-L-Đen','quantity' => 10],
            ['product_id' => 34, 'color_id' => 1, 'size_id' => 4, 'sku' => 'AP035-XL-Đen','quantity' => 10],
            ['product_id' => 34, 'color_id' => 4, 'size_id' => 2, 'sku' => 'AP035-M-Xám','quantity' => 10],
            ['product_id' => 34, 'color_id' => 4, 'size_id' => 3, 'sku' => 'AP035-L-Xám','quantity' => 10],
            ['product_id' => 34, 'color_id' => 4, 'size_id' => 4, 'sku' => 'AP035-XL-Xám','quantity' => 10],

            // Product 35: Áo Polo AP031 - Đen, M,L,XL
            ['product_id' => 35, 'color_id' => 1, 'size_id' => 2, 'sku' => 'AP031-M-Đen','quantity' => 10],
            ['product_id' => 35, 'color_id' => 1, 'size_id' => 3, 'sku' => 'AP031-L-Đen','quantity' => 10],
            ['product_id' => 35, 'color_id' => 1, 'size_id' => 4, 'sku' => 'AP031-XL-Đen','quantity' => 10],

            // Product 36: Áo Polo AP022 - Đen phối Kem, Xanh Cổ Vịt, M,L,XL
            ['product_id' => 36, 'color_id' => 25, 'size_id' => 2, 'sku' => 'AP022-M-ĐenKem','quantity' => 10],
            ['product_id' => 36, 'color_id' => 25, 'size_id' => 3, 'sku' => 'AP022-L-ĐenKem','quantity' => 10],
            ['product_id' => 36, 'color_id' => 25, 'size_id' => 4, 'sku' => 'AP022-XL-ĐenKem','quantity' => 10],
            ['product_id' => 36, 'color_id' => 24, 'size_id' => 2, 'sku' => 'AP022-M-XanhCổVịt','quantity' => 10],
            ['product_id' => 36, 'color_id' => 24, 'size_id' => 3, 'sku' => 'AP022-L-XanhCổVịt','quantity' => 10],
            ['product_id' => 36, 'color_id' => 24, 'size_id' => 4, 'sku' => 'AP022-XL-XanhCổVịt','quantity' => 10],





            ['product_id' => 37, 'color_id' => 1, 'size_id' => null, 'sku' => 'PS113-Đen', 'quantity' => 10],
            ['product_id' => 37, 'color_id' => 12, 'size_id' => null, 'sku' => 'PS113-XanhRêu', 'quantity' => 10],
            ['product_id' => 37, 'color_id' => 13, 'size_id' => null, 'sku' => 'PS113-XámĐậm', 'quantity' => 10],

            // Product 2: PS106 - Đen, Xám Melane - không kích cỡ
            ['product_id' => 38, 'color_id' => 1, 'size_id' => null, 'sku' => 'PS106-Đen', 'quantity' => 10],
            ['product_id' => 38, 'color_id' => 14, 'size_id' => null, 'sku' => 'PS106-XámMelane', 'quantity' => 10],

            // Product 3: PS105 - Đen - không kích cỡ
            ['product_id' => 39, 'color_id' => 1, 'size_id' => null, 'sku' => 'PS105-Đen', 'quantity' => 10],

            // Product 4: PS104 - Nâu, Xám, Xanh Navy, Đỏ, Đen - không kích cỡ
            ['product_id' => 40, 'color_id' => 10, 'size_id' => null, 'sku' => 'PS104-Nâu', 'quantity' => 10],
            ['product_id' => 40, 'color_id' => 4, 'size_id' => null, 'sku' => 'PS104-Xám', 'quantity' => 10],
            ['product_id' => 40, 'color_id' => 17, 'size_id' => null, 'sku' => 'PS104-XanhNavy', 'quantity' => 10],
            ['product_id' => 40, 'color_id' => 18, 'size_id' => null, 'sku' => 'PS104-Đỏ', 'quantity' => 10],
            ['product_id' => 40, 'color_id' => 1, 'size_id' => null, 'sku' => 'PS104-Đen', 'quantity' => 10],

            // Product 5: PS101 - Đen, Xám, Be - không kích cỡ
            ['product_id' => 41, 'color_id' => 1, 'size_id' => null, 'sku' => 'PS101-Đen', 'quantity' => 10],
            ['product_id' => 41, 'color_id' => 4, 'size_id' => null, 'sku' => 'PS101-Xám', 'quantity' => 10],
            ['product_id' => 41, 'color_id' => 9, 'size_id' => null, 'sku' => 'PS101-Be', 'quantity' => 10],

            // Product 6: PS096 - Xám Tiêu Đậm, Xám Tiêu Nhạt, Đen - không kích cỡ
            ['product_id' => 42, 'color_id' => 15, 'size_id' => null, 'sku' => 'PS096-XámTiêuĐậm', 'quantity' => 10],
            ['product_id' => 42, 'color_id' => 16, 'size_id' => null, 'sku' => 'PS096-XámTiêuNhạt', 'quantity' => 10],
            ['product_id' => 42, 'color_id' => 1, 'size_id' => null, 'sku' => 'PS096-Đen', 'quantity' => 10],

            // Product 7: PS091 - Trắng, Đỏ, Đen - không kích cỡ
            ['product_id' => 43, 'color_id' => 5, 'size_id' => null, 'sku' => 'PS091-Trắng', 'quantity' => 10],
            ['product_id' => 43, 'color_id' => 18, 'size_id' => null, 'sku' => 'PS091-Đỏ', 'quantity' => 10],
            ['product_id' => 43, 'color_id' => 1, 'size_id' => null, 'sku' => 'PS091-Đen', 'quantity' => 10],

            // Product 8: PS090 - Đen, Đỏ, Vàng, Xanh Lá, Xanh Dương - không kích cỡ
            ['product_id' => 44, 'color_id' => 1, 'size_id' => null, 'sku' => 'PS090-Đen', 'quantity' => 10],
            ['product_id' => 44, 'color_id' => 18, 'size_id' => null, 'sku' => 'PS090-Đỏ', 'quantity' => 10],
            ['product_id' => 44, 'color_id' => 23, 'size_id' => null, 'sku' => 'PS090-Vàng', 'quantity' => 10],
            ['product_id' => 44, 'color_id' => 19, 'size_id' => null, 'sku' => 'PS090-XanhLá', 'quantity' => 10],
            ['product_id' => 44, 'color_id' => 20, 'size_id' => null, 'sku' => 'PS090-XanhDương', 'quantity' => 10],

            // Product 9: PSS026 - Đen, Kem, Xám, Nâu, Xanh Rêu - không kích cỡ
            ['product_id' => 45, 'color_id' => 1, 'size_id' => null, 'sku' => 'PSS026-Đen', 'quantity' => 10],
            ['product_id' => 45, 'color_id' => 4, 'size_id' => null, 'sku' => 'PSS026-Xám', 'quantity' => 10],
            ['product_id' => 45, 'color_id' => 7, 'size_id' => null, 'sku' => 'PSS026-Kem', 'quantity' => 10],
            ['product_id' => 45, 'color_id' => 10, 'size_id' => null, 'sku' => 'PSS026-Nâu', 'quantity' => 10],
            ['product_id' => 45, 'color_id' => 12, 'size_id' => null, 'sku' => 'PSS026-XanhRêu', 'quantity' => 10],

            // Product 10: PS086 - Xanh Than, Kem, Xám, Đen - không kích cỡ
            ['product_id' => 46, 'color_id' => 6, 'size_id' => null, 'sku' => 'PS086-XanhThan', 'quantity' => 10],
            ['product_id' => 46, 'color_id' => 7, 'size_id' => null, 'sku' => 'PS086-Kem', 'quantity' => 10],
            ['product_id' => 46, 'color_id' => 4, 'size_id' => null, 'sku' => 'PS086-Xám', 'quantity' => 10],
            ['product_id' => 46, 'color_id' => 1, 'size_id' => null, 'sku' => 'PS086-Đen', 'quantity' => 10],
            // Danh mục 6: Phụ kiện
            // Product 11: AC099 - Đen, không kích cỡ
            ['product_id' => 47, 'color_id' => 1, 'size_id' => null, 'sku' => 'AC099-Đen', 'quantity' => 10],

            // Product 12: AC103 - Đen, Xanh, Hồng, không kích cỡ
            ['product_id' => 48, 'color_id' => 1, 'size_id' => null, 'sku' => 'AC103-Đen', 'quantity' => 10],
            ['product_id' => 48, 'color_id' => 2, 'size_id' => null, 'sku' => 'AC103-Xanh', 'quantity' => 10],
            ['product_id' => 48, 'color_id' => 3, 'size_id' => null, 'sku' => 'AC103-Hồng', 'quantity' => 10],

            // Product 13: AC100 - Đen, không kích cỡ
            ['product_id' => 49, 'color_id' => 1, 'size_id' => null, 'sku' => 'AC100-Đen', 'quantity' => 10],

            // Product 14: AC094 - Đen, không kích cỡ
            ['product_id' => 50, 'color_id' => 1, 'size_id' => null, 'sku' => 'AC094-Đen', 'quantity' => 10],

            // Product 15: AC085 - Đen, không kích cỡ
            ['product_id' => 51, 'color_id' => 1, 'size_id' => null, 'sku' => 'AC085-Đen', 'quantity' => 10],

            // Product 16: AC077 - Đen, không kích cỡ
            ['product_id' => 52, 'color_id' => 1, 'size_id' => null, 'sku' => 'AC077-Đen', 'quantity' => 10],

            // Product 17: AC076 - Đen, Xám, Trắng, Xanh Than; M, L, XL
            ['product_id' => 53, 'color_id' => 1, 'size_id' => 2, 'sku' => 'AC076-M-Đen', 'quantity' => 10],
            ['product_id' => 53, 'color_id' => 1, 'size_id' => 3, 'sku' => 'AC076-L-Đen', 'quantity' => 10],
            ['product_id' => 53, 'color_id' => 1, 'size_id' => 4, 'sku' => 'AC076-XL-Đen', 'quantity' => 10],
            ['product_id' => 53, 'color_id' => 4, 'size_id' => 2, 'sku' => 'AC076-M-Xám', 'quantity' => 10],
            ['product_id' => 53, 'color_id' => 4, 'size_id' => 3, 'sku' => 'AC076-L-Xám', 'quantity' => 10],
            ['product_id' => 53, 'color_id' => 4, 'size_id' => 4, 'sku' => 'AC076-XL-Xám', 'quantity' => 10],
            ['product_id' => 53, 'color_id' => 5, 'size_id' => 2, 'sku' => 'AC076-M-Trắng', 'quantity' => 10],
            ['product_id' => 53, 'color_id' => 5, 'size_id' => 3, 'sku' => 'AC076-L-Trắng', 'quantity' => 10],
            ['product_id' => 53, 'color_id' => 5, 'size_id' => 4, 'sku' => 'AC076-XL-Trắng', 'quantity' => 10],
            ['product_id' => 53, 'color_id' => 6, 'size_id' => 2, 'sku' => 'AC076-M-XanhThan', 'quantity' => 10],
            ['product_id' => 53, 'color_id' => 6, 'size_id' => 3, 'sku' => 'AC076-L-XanhThan', 'quantity' => 10],
            ['product_id' => 53, 'color_id' => 6, 'size_id' => 4, 'sku' => 'AC076-XL-XanhThan', 'quantity' => 10],

            // Product 18: AC058 - Đen, không kích cỡ
            ['product_id' => 54, 'color_id' => 1, 'size_id' => null, 'sku' => 'AC058-Đen', 'quantity' => 10],

            // Product 19: AC061 - Đen, không kích cỡ
            ['product_id' => 55, 'color_id' => 1, 'size_id' => null, 'sku' => 'AC061-Đen', 'quantity' => 10],

            // Product 20: AC059 - Trắng, Đen, không kích cỡ
            ['product_id' => 56, 'color_id' => 5, 'size_id' => null, 'sku' => 'AC059-Trắng', 'quantity' => 10],
            ['product_id' => 56, 'color_id' => 1, 'size_id' => null, 'sku' => 'AC059-Đen', 'quantity' => 10],
        ];
        DB::table('product_variants')->insert($product_variants);

    }
}
