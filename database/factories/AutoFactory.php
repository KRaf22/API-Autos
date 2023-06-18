<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'modelo' => $this->faker->firstName(),
            'marca' => $this->faker->lastName(),
            'color' => $this->faker->safeColorName(),
            'puertas' => $this->faker->randomDigit(),
            'cilindrado' => $this->faker->randomDigit(),
            'automatico' => $this->faker->numberBetween($min=0, $max=1),
            'electrico' => $this->faker->numberBetween($min=0, $max=1)

        ];
    }
}
