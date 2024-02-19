<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	protected $model = Category::class;

	public function definition()
	{
		$name = implode(' ', array_slice(explode(' ', $this->faker->sentence), 0, 2));
		$name = substr($name, 0, 15);
		$slug = Str::slug($name, '-');
		return [
			'name' => $name,
			'slug' => $slug,
			'hexcolor' => $this->faker->hexcolor(),
			'textcolor' => '#FFFFFF',
		];
	}
}
