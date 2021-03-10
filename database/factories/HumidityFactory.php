<?php

namespace Database\Factories;

use App\Models\Humidity;
use Illuminate\Database\Eloquent\Factories\Factory;

class HumidityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Humidity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cities = \App\Models\City::pluck('id')->toArray();

        return [
            'humidity' => $this->faker->numberBetween(1,100),
            'city_id' => $this->faker->randomElement($cities),
            'created_at' => $this->faker->dateTime,
        ];
    }
}
