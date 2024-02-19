<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Post::class;

    public function definition(): array
    {

        $title = implode(' ', array_slice(explode(' ', $this->faker->sentence), 0, 5));
        $title = substr($title, 0, 25);
        $slug = Str::slug($title, '-');
        $category = Category::all()->random();
        $category_id = $category->id;
        return [
            'title' => $title,
            'slug' => $slug,
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut malesuada libero lectus, a viverra dui consectetur vel. Ut eu bibendum mauris. Donec erat ante, volutpat et euismod et, semper nec arcu. Nunc scelerisque quam eros, bibendum semper massa ultrices ac. Cras quis mi eget dui pellentesque scelerisque. Integer gravida ligula sed ex bibendum consectetur. Cras feugiat id massa eu congue. Donec id egestas nunc. Integer auctor in enim quis aliquam. Nulla in dictum dolor. Aenean lacinia, ex eu porttitor lacinia, nulla justo vestibulum neque, vitae congue quam dolor a nunc. Maecenas elit diam, consectetur nec congue vitae, dictum vitae risus. Morbi ac arcu velit. Donec ac quam blandit felis ultrices dictum ut eget quam. Pellentesque fringilla mauris ante, ut tincidunt sem scelerisque eget. Proin nulla erat, egestas a elit vitae, aliquam sodales turpis.</p>',
            'user_id' => 1,
            'category_id' => $category_id,
            'tags' => $this->faker->word(),
            'exerpt' => $this->faker->sentence(),
            'priority' => $this->faker->numberBetween(1, 4),
            'is_active' => 'on',
            'published_at' => now(),
            'visibility' => 'on',
        ];
    }
}
