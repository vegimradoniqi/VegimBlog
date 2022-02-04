<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use SoftDeletes;

    protected $table = 'likeables';

    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
    ];


    /**
     * Get all of the blogs that are assigned this like.
     */
    public function blogs()
    {
        return $this->morphedByMany(Blogs::class, 'likeable');
    }
}
