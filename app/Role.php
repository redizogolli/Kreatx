<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Bican\Roles\Traits\HasRoleAndPermission;

class Role extends Model
{
    protected $table = "roles";
    protected $primaryKey="roleid";
    public $timestamps = false;

    protected $fillable = array('description');

    public function user()
    {
        return $this->hasMany('App\User','role','RoleId');
    }

    
}
