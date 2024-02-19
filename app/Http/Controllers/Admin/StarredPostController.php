<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\StarredPost;
use APP\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StarredPostController extends Controller
{
	public function star(Request $request, $id)
	{
		$post = Post::find($id);
		$user = Auth::user();
		$starredPost = new StarredPost;
		$starredPost->user_id = $user->id;
		$starredPost->post_id = $post->id;
		$starredPost->save();
		return back();
	}

	public function unstar(Request $request, $id)
	{
		$post = Post::find($id);
		$user = Auth::user();
		StarredPost::where([
			['user_id', '=', $user->id],
			['post_id', '=', $post->id],
		])->delete();
		return back();
	}
}
