<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Post::class, 'favorites', 'user_id', 'post_id')->withTimestamps();
    }

    public function favorite($postId)
    {
        $exist = $this->is_favorite($postId);

        if ($exist) {
            return false;
        } else {
            $this->favorites()->attach($postId);

            return true;
        }
    }

    public function unfavorite($postId)
    {
        $exist = $this->is_favorite($postId);

        if ($exist) {
            $this->favorites()->detach($postId);

            return true;
        } else {
            return false;
        }
    }

    public function is_favorite($postId)
    {
        return $this->favorites()->where('post_id', $postId)->exists();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'followed_id');
    }

    // フォローする
    public function follow($user_id)
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除
    public function unfollow($user_id)
    {
        return $this->follows()->detach($user_id);
    }

    public function isFollowing($user_id)
    {
        return (bool) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }

    public function isFollowed($user_id)
    {
        return (bool) $this->followers()->where('following_id', $user_id)->first(['id']);
    }
}
