<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nestable\NestableTrait;

class Departament extends Model
{
    use NestableTrait;
    //
    protected $table = "departaments";
    protected $primaryKey="DepartamentId";

    protected $fillable = array('name');
    public $timestamps = false;
    

    protected $parent = 'parent_id';

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    public function childs() {
        return $this->hasMany('App\Departament','parent_id','DepartamentId') ;
}

  
}
