<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $statuses = ['active', 'suspended'];
    return [
      'name'        => $this->faker->name(),
      'email'       => $this->faker->unique()->safeEmail(),
      'status'      => $this->faker->randomElement($statuses),
      'created_at'  => $this->faker->dateTimeBetween('-6 months', 'now'),
      'total_spend' => $this->faker->numberBetween(1000, 9000), // for top clients/revenue
      // 'sessions' => $this->faker->numberBetween(1, 20),         // for engagement metrics, etc
    ];
  }
}
