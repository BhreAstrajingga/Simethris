<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class StarredPost extends Model
{
	use HasFactory;

	protected $table = 'starred_posts';

	protected $fillable = [
		'user_id',
		'post_id',
	];

	public function post()
	{
		return $this->hasMany(Post::class);
	}
}
