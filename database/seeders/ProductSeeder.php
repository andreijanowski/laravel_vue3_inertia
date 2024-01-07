<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $laptops = Product::factory(5)->create();
        $headphones = Product::factory(4)->create();
        $phones = Product::factory(4)->create();

        $bags = Product::factory(3)->create();
        $shoes = Product::factory(3)->create();
        $cups = Product::factory(2)->create();
        $hats = Product::factory(2)->create();

        foreach ($laptops as $laptop) {
            $laptop->images()->create(['url' => 'laptop.png']);
        }

        foreach ($headphones as $headphone) {
            $headphone->images()->create(['url' => 'headphone.jpg']);
        }

        foreach ($phones as $phone) {
            $phone->images()->create(['url' => 'iphone.jpg']);
        }

        foreach ($bags as $bag) {
            $bag->images()->create(['url' => 'bag.jpg']);
        }

        foreach ($shoes as $shoe) {
            $shoe->images()->create(['url' => 'shoes.jpg']);
        }

        foreach ($cups as $cup) {
            $cup->images()->create(['url' => 'cup.jpg']);
        }

        foreach ($hats as $hat) {
            $hat->images()->create(['url' => 'hat.jpg']);
        }
    }
}
