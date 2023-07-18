<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $post = DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->select('posts.title', 'posts.image', 'posts.description', 'posts.user_id', 'posts.id', 'users.name', 'users.id as user_id')
            ->get();

        return view('post.index', ['post' => $post]);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(StorePostRequest $request)
    {
        $post = new Post();

        if ($file = $request->image) {
            $fileName = time() . $file->getClientOriginalName();
            $target_path = public_path('uploads/');
            $file->move($target_path, $fileName);
        } else {
            $fileName = null;
        }

        $post->title = $request->input('title');
        $post->image = $fileName;
        $post->description = $request->input('description');
        $post->user_id = Auth::id();
        $post->save();

        return redirect('post/index');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        if (Auth::id() != $post->user_id) {
            abort(404);
        }

        return view('post.edit', ['post' => $post]);
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('post.show', ['post' => $post]);
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);

        if ($file = $request->image) {
            $fileName = time() . $file->getClientOriginalName();
            $target_path = public_path('uploads/');
            $file->move($target_path, $fileName);
        } else {
            $fileName = null;
        }

        $post->title = $request->input('title');
        $post->image = $fileName;
        $post->description = $request->input('description');
        $post->save();

        return redirect('post/index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();

        return redirect('post/index');
    }
}
