<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductImgSeeder extends Seeder
{
    public function run(): void
    {
        $dir = public_path('img/products/'); // Copy ảnh vào đây trước
        $files = File::allFiles($dir);

        $orderMap = [];

        foreach ($files as $file) {
            $filename = $file->getFilename(); // vd: dm1-sp10-mini-2.webp

            if (preg_match('/sp(\d+)-mini/', $filename, $matches)) {
                $productId = (int) $matches[1];

                // Tăng thứ tự ảnh cho mỗi sản phẩm
                $orderMap[$productId] = ($orderMap[$productId] ?? 0) + 1;

                DB::table('product_images')->insert([
                    'product_id' => $productId,
                    'path' => 'img/products/' . $filename,
                    'order' => $orderMap[$productId],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
