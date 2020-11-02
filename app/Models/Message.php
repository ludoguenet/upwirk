<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'conversation_id', 'content'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function conversation()
    {
        return $this->belongsTo('App\Models\Conversation');
    }
}
