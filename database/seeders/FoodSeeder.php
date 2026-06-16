<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\Food;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    public function run()
    {
        // Buat Restoran dulu
        $resto1 = Restaurant::create([
            'name' => 'Warung Ngab Bro',
            'address' => 'Jl. Ahmad Yani No. 45, Makassar',
            'phone' => '081234567890',
        ]);

        $resto2 = Restaurant::create([
            'name' => 'Kedai Makanan Padang',
            'address' => 'Jl. Sultan Alauddin, Makassar',
            'phone' => '085712345678',
        ]);

        // Buat Menu Food
        Food::create([
            'restaurant_id' => $resto1->id,
            'name' => 'Nasi Kuning Komplit',
            'price' => 25000,
            'description' => 'Nasi kuning lengkap dengan ayam, telur, dan kerupuk',
        ]);

        Food::create([
            'restaurant_id' => $resto1->id,
            'name' => 'Es Teh Manis',
            'price' => 8000,
            'description' => 'Es teh manis dingin dengan gula aren',
        ]);

        Food::create([
            'restaurant_id' => $resto2->id,
            'name' => 'Rendang Daging',
            'price' => 35000,
            'description' => 'Rendang daging sapi khas Padang empuk',
        ]);

        Food::create([
            'restaurant_id' => $resto2->id,
            'name' => 'Ayam Pop',
            'price' => 28000,
            'description' => 'Ayam pop dengan sambal ijo',
        ]);

        echo "✅ Data contoh NgabFood berhasil dibuat!\n";
    }
}