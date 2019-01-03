<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table="messages";
    protected $fillable = array('user_from','user_to','message');
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    // public function conversation()
    // {
    //     return $this->belongsTo('App\Conversation');
    // }
}
