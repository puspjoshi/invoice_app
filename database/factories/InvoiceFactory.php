<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number'=> $this->faker->numberBetween(10,100),
            'customer_id' => $this->faker->numberBetween(1,20),
            'date' => $this->faker->date,
            'due_date' => $this->faker->date,
            'reference' => 'REF-'.rand(10,500),
            'terms_and_conditions' => $this->faker->paragraph(),
            'sub_total' => $this->faker->numberBetween(1000,20000),
            'discount' => $this->faker->numberBetween(1,100),
            'total' => $this->faker->numberBetween(10000,200000),

        ];
    }
}
