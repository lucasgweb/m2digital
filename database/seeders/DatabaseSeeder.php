<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Campaign;
use App\Models\CampaignProduct;
use App\Models\City;
use App\Models\Discount;
use App\Models\Group;
use App\Models\Product;
use Database\Factories\CampaignFactory;
use Database\Factories\CampaignProductFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CampaignSeeder::class,
            GroupSeeder::class,
            CitySeeder::class,
            ProductSeeder::class,
            DiscountSeeder::class,
            CampaignProductSeeder::class 
        ]);


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
