<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //Nermin
    protected $fillable =  ['sender_name', 'sender_email', 'message', 'replied', 'created_at', 'updated_at'];
    
    protected $table = 'messages';
}
