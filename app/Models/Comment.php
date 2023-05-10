<?php

namespace App\Models;

use app\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body', 'user_id', 'parent_comment_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id')->with('replies');
    }

}
?>
