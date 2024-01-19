<?php

namespace Modules\AdminModule\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AdminModule\Database\factories\BlogCommentFactory;

class BlogComment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): BlogCommentFactory
    {
        //return BlogCommentFactory::new();
    }

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
