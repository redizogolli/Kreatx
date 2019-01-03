<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    protected $table="chat";
    protected $fillable = array('username','comment');
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
