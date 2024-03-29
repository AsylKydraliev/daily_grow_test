<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\mailing>
 */
class MailingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'message' => $this->faker->text,
            'sent_count' =>rand(50, 100),
            'delivered_count' => rand(1, 50),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
