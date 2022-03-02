<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender =['남성', '여성'];
        $slug=$this->faker->name;
        return [
            'slug' => Str::of($slug) -> slug('-'),
            'gender' => Arr::random($gender),
        ];
    }
}
