<?php

namespace Database\Factories;

use App\Models\{
    Sale,
    Seller
};
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sale_value' => $this->faker->numberBetween(000000000000,999999999999),
            'seller_uuid' => Seller::factory()->create()->uuid,
        ];
    }
}
