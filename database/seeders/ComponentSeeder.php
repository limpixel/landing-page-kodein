<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Landing\Component;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Component::create([
            "title" => "Description",
            "component_type_id" => 2,
            "order" => 1
        ]);

        Component::create([
            "title" => "Article",
            "component_type_id" => 1,
            "order" => 2
        ]);

        Component::create([
            "title" => "Galery",
            "component_type_id" => 3,
            "order" => 3
        ]);

        Component::create([
            "title" => "Testimony",
            "component_type_id" => 4,
            "order" => 4
        ]);
    }
}
