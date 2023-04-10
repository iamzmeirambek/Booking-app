<?php

namespace Database\Seeders;

use App\Models\ApartmentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ApartmentType::create([
            'name' => 'Default',
        ]);
        ApartmentType::create([
            'name' => 'luxury',
        ]);
        ApartmentType::create([
           'name' => 'presidential'
        ]);
    }
}
