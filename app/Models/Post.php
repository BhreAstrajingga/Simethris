<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\ReadPost;

class Post extends Model
{
	use HasFactory;
	use SoftDeletes;

	public $table = 'posts';

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
		'published_at',
	];

	protected $fillable = [
		'category_id',
		'title',
		'body',
		'img_cover',
		'tags',
		'is_active',
		'visibility',
		'priority',
		'exerpt',
		'tags',
		'created_at',
		'updated_at',
		'deleted_at',
		'published_at',
	];

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function category()
	{
		return $this->belongsTo('App\Models\Category');
	}

	protected function serializeDate(DateTimeInterface $date)
	{
		return $date->format('Y-m-d H:i:s');
	}

	public static function publishCount()
	{
		return Post::whereNotNull('published_at')->count();
	}

	//new update

	public function readposts()
	{
		return $this->hasMany(ReadPost::class);
	}

	public function starredpost()
	{
		return $this->hasMany(StarredPost::class);
	}

	public function starredCount()
	{
		return $this->hasMany('App\Models\StarredPost', 'post_id')->count();
	}
}
