<?php

namespace App\Models\Magazine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Magazine\Post;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'mag_comments';

    protected $fillable = [
        'body',
        'name',
        'email',
        'status'
    ];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
