<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'surname' => $this->faker->name(),
            'email' => 'admin@admin.com', //$this->faker->unique()->safeEmail(),
            'username' => 'admin', //$this->faker->unique()->userName(),
            'email_verified_at' => now(),
            'is_admin' => 1,
            'role_id' => 1,
            'password' => '$2a$12$p1SQ5I4gkAgsDEqWxfigpuED3elHNr3heRzABsY5ZEN6AvxXVi5SC', // adminadm
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
