<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Posts extends Model
{
    protected $fillable = ['body'];

    public function likeBy(User $user) {
        return $this->likes->contains('user_id', $user->id);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->hasMany(Like::class, 'post_id', 'id');
    }
}
