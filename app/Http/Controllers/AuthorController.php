<?php


namespace App\Http\Controllers;

use App\Post;
use App\User;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function profile($username)
    {
        $author = User::where('username', $username)->first();
        $posts = $author->posts()->approved()->published()->paginate(6);
        return view('profile', compact('author', 'posts'));
    }
}