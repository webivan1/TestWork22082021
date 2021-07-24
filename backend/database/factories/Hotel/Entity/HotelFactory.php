<?php

namespace Database\Factories\Hotel\Entity;

use App\Models\Hotel\Entity\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Hotel::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'description' => $this->faker->text(mt_rand(100, 500)),
            'stars' => mt_rand(1, 5),
            'image' => 'images/' . $this->faker->image('public/storage/images', 250, 250, null, false),
        ];
    }
}
