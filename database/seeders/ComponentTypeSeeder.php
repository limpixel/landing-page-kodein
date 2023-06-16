<?php

namespace Database\Seeders;

use App\Models\Landing\ComponentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComponentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ComponentType::create([
            "type" => "Article Component"
        ]);

        ComponentType::create([
            "type" => "Description Component"
        ]);

        ComponentType::create([
            "type" => "Galery Component"
        ]);

        ComponentType::create([
            "type" => "Testimony Component"
        ]);
    }
}
