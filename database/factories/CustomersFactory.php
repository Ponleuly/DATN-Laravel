<?php

namespace Database\Factories;

use App\Models\Customers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Validation\Rules\Unique;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Customers::class;
    public function definition()
    {
        /*
        return [
            'c_name' => fake()->word(),
            'c_phone' => fake()->phoneNumber(),
            'c_email' => fake()->unique()->safeEmail(),
            'c_address' => fake()->address(),
            'order_id' => rand(1, 50),
        ];
        */
    }
}
