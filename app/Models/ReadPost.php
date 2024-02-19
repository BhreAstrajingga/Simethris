<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;
use App\Models\Post;

class ReadPost extends Model
{
	use HasFactory;
	use SoftDeletes;

	public $table = 'readposts';

	protected $fillable = [
		'user_id', 'post_id', 'read_flag', 'read_count', 'starred',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function post()
	{
		return $this->belongsTo(Post::class);
	}
}
