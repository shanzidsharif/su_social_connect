<?php

namespace Modules\AdminModule\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AdminModule\Database\factories\BlogFactory;

class Blog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): BlogFactory
    {
        //return BlogFactory::new();
    }

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'blog_id', 'id');
    }

    public function scopeActive($query)
    {
        $query->where('is_active', 1);
    }
}
