<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Đen', 'hex_code' => '#000000'],
            ['name' => 'Xanh', 'hex_code' => '#0000FF'],
            ['name' => 'Hồng', 'hex_code' => '#FFC0CB'],
            ['name' => 'Xám', 'hex_code' => '#808080'],
            ['name' => 'Trắng', 'hex_code' => '#FFFFFF'],
            ['name' => 'Xanh Than', 'hex_code' => '#001F3F'],
            ['name' => 'Kem', 'hex_code' => '#FFFDD0'],
            ['name' => 'Wash phối đen', 'hex_code' => '#333333'],
            ['name' => 'Be', 'hex_code' => '#F5F5DC'],
            ['name' => 'Nâu', 'hex_code' => '#A52A2A'],
            ['name' => 'Xanh Khói', 'hex_code' => '#708090'],
            ['name' => 'Đỏ', 'hex_code' => '#FF0000'],
            ['name' => 'Xanh Dương', 'hex_code' => '#87CEEB'],
            ['name' => 'Nâu Nhạt', 'hex_code' => '#DEB887'],
            ['name' => 'Xám Đậm', 'hex_code' => '#A9A9A9'],
            ['name' => 'Xanh Lá', 'hex_code' => '#008000'],
            ['name' => 'Xanh Navy', 'hex_code' => '#000080'],
            ['name' => 'Xám phối đen', 'hex_code' => '#696969'],
            ['name' => 'Xám Melane', 'hex_code' => '#BEBEBE'],
            ['name' => 'Xanh Cổ Vịt', 'hex_code' => '#008080'],
            ['name' => 'Xanh Rêu', 'hex_code' => '#8A9A5B'],
            ['name' => 'Vàng', 'hex_code' => '#FFFF00'],
            ['name' => 'Đen phối Kem', 'hex_code' => '#8B4513'],
            ['name' => 'Xám Tiêu', 'hex_code' => '#708090'],
            ['name' => 'Xám Tiêu Đậm', 'hex_code' => '#2F4F4F'],
            ['name' => 'Xám Tiêu Nhạt', 'hex_code' => '#D3D3D3'],
        ];
        DB::table('colors')->insert($colors);

    }
}
