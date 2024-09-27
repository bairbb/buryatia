<?php

namespace Database\Factories;

use App\Models\Space;
use App\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Space>
 */
class SpaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Space::class;

    public function definition(): array
    {
        $title = $this->faker->company;

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'district_id' => District::inRandomOrder()->first()->id,
            'description' => $this->faker->paragraph,
            // 'image_path' => $this->faker->imageUrl(),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'phone' => $this->faker->phoneNumber,
            'website' => $this->faker->url,
            'email' => $this->faker->companyEmail,
            'address' => $this->faker->address,
            'how_to_get' => $this->faker->text,
        ];
    }
}
