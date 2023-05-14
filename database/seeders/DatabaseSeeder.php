<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Coupons;
use App\Models\Subscribers;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            GroupSeeder::class,
            CategorySeeder::class,
            CategoryGroupSeeder::class,
            CategorySubcategorySeeder::class,
            SizeSeeder::class,
            ProductSeeder::class,
            ProductImgreviewSeeder::class,
            ProductSizeSeeder::class,
            ProductAttributeSeeder::class,
            UserSeeder::class,
            DeliverySeeder::class,
            OrderStatusSeeder::class,
            CartSeeder::class,
            LikeSeeder::class,
            OrderSeeder::class,
            CustomerSeeder::class,
            OrderDetailSeeder::class,
            CouponSeeder::class,
            SettingSeeder::class,
            ContactSeeder::class,
            NewsSeeder::class,
            SubscriberSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
