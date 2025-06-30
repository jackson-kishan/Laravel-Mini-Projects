<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hasLiked($postId)
    {
        return $this->likes()->where('post_id', $postId)->where('like', true)->exists();
    }

    public function hasDisliked($postId)
    {
        return $this->likes()->where('post_id', $postId)->where('like', false)->exists();
    }

    public function toggleLikeDislike($postId, $like)
    {
       // Check if the like/dislike already exists
       $existingLike = $this->likes()->where('post_id', $postId)->first();

       if($existingLike){
         if($existingLike->like == $like) {
            $existingLike->delete();

            return [
               'hasLiked' => false,
               'hasDisliked' => false
            ];
         } else {
            $this->likes()->create([
              'post_id' => $postId,
              'like' => $like
            ]);
         }
       }

       return [
         'hasLiked' => $this->hasLiked($postId),
         'hasDisliked' => $this->hasDisliked($postId)
       ];
    }
}
