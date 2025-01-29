<?php

namespace Database\Factories;

use App\Models\BackPanel\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
{
    protected $model = Program::class;
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'order_number' => $this->faker->unique()->numberBetween(1, 100),
            'details' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(640, 480, 'programs', true),
            'status' => $this->faker->randomElement(['Y', 'N', 'R']),
            'slug' => $this->faker->slug(),
            'created_by' => $this->faker->randomDigitNotNull(),
            'updated_by' => $this->faker->randomDigitNotNull(),
        ];
    }
}