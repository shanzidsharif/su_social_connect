<?php

namespace Modules\AdminModule\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AdminModule\Database\factories\NoticeFactory;

class Notice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): NoticeFactory
    {
        //return NoticeFactory::new();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
