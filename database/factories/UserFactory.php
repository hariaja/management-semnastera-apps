<?php

namespace Database\Factories;

use App\Helpers\Global\Constant;
use App\Helpers\Global\NameAuto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $firstName = fake()->unique()->firstName('male' | 'female');
    $lastName = fake()->lastName();

    $object = new NameAuto;
    $name = $firstName . " " .  $lastName;
    $email = strtolower($object->firstName($name)) . "@gmail.com";

    return [
      'name' => $name,
      'first_name' => $firstName,
      'last_name' => $lastName,
      'first_title' => fake()->title('male' | 'female') . ' ',
      'last_title' => 'AMD',
      'email' => $email,
      'phone' => fake()->unique()->e164PhoneNumber(),
      'gender' => fake()->randomElement([Constant::MALE, Constant::FEMALE]),
      'institution' => 'POLITEKNIK SUKABUMI',
      'address' => $this->faker->address(),
      'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
      // 'remember_token' => Str::random(10),
      'status' => fake()->randomElement([Constant::ACTIVE, Constant::INACTIVE]),
    ];
  }

  /**
   * Indicate that the model's email address should be unverified.
   */
  public function unverified(): static
  {
    return $this->state(fn (array $attributes) => [
      'email_verified_at' => null,
    ]);
  }
}
