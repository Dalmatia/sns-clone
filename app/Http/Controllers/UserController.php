<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show(Request $request, $id)
    {
        $user = User::find($id);

        $user_flg = $request->path();
        $user_flg = preg_replace('/[^0-10000]/', '', $user_flg);

        // ユーザー自身が投稿したデータのみ表示
        $post = DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->select('posts.title', 'posts.image', 'posts.description', 'posts.user_id', 'posts.id', 'users.name', 'users.id as user_id')
            ->where('user_id', $id)
            ->get();

        return view('user.show', ['user' => $user, 'user_flg' => $user_flg, 'post' => $post]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->save();
    }

    public function follow(User $user)
    {
        $follower = auth()->user();

        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if (!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);

            return back();
        }
    }

    public function unfollow(User $user)
    {
        $follower = auth()->user();

        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if ($is_following) {
            //フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }
}
