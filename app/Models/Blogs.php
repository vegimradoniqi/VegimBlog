<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Blogs extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blogs';

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select(['id', 'username','firstname','lastname']);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id')->select(['id', 'name']);
    }
    public function likes()
    {
        return $this->morphToMany(User::class, 'likeable')->whereDeletedAt(null);
    }

    public function getIsLikedAttribute()
    {
        $like = $this->likes()->whereUserId(Auth::id())->first();
        return (!is_null($like)) ? true : false;
    }
}
