<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;
use App\User;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)-> with('user')->latest()-> paginate(5);

        return view('posts.index', compact('posts'))->with('user', $user);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([

            'caption'=>'required',
            'image'=>'required|image'

        ]);

        $imagepath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagepath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->post()->create([
            'caption' => $data['caption'],
            'image' => $imagepath
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
