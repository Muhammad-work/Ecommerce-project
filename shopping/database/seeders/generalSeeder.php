<?php

namespace Database\Seeders;

use App\Models\general;
use App\Models\homeController;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class generalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       general::create([
           's_img' => '20.jpg',
           's_name' => 'Shopping Now',
           's_title' => 'shopping Now',
           's_copyright' => 'Copyright 2024 @ Muhammad reserved',
           's_des' => 'sdfdsgiodnfgningoiengiren',
           's_address' => 'Gulistan-e-johar Block 5',
           's_phone' => '03422754409',
           's_email' => 'balochmuhammad@gmail.com',
       ]);

    }
}
