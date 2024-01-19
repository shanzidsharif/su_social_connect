<?php

namespace Modules\AdminModule\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AdminModule\Database\factories\MessageFactory;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'from', 'to', 'message', 'is_read'
    ];

    protected static function newFactory(): MessageFactory
    {
        //return MessageFactory::new();
    }
}
