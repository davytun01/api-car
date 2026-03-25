<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    public function definition(): array
    {
        $brands = ['Toyota', 'Honda', 'Lexus', 'Mercedes', 'Hyundai', 'Ford', 'Nissan'];

        return [
            'brand' => $this->faker->randomElement($brands),
            'model' => $this->faker->word,
            'year' => $this->faker->numberBetween(2010, date('Y')),
            'price' => $this->faker->randomFloat(2, 2000000, 30000000), // Realistic Nigerian prices (Naira)
            'mileage' => $this->faker->numberBetween(0, 200000),
            'fuel_type' => $this->faker->randomElement(['petrol', 'diesel', 'electric', 'hybrid']),
            'transmission' => $this->faker->randomElement(['automatic', 'manual']),
            'color' => $this->faker->safeColorName,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['available', 'reserved', 'sold']),
            'image_url' => null,
        ];
    }
}
