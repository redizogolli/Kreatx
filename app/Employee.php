<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "employees";
    protected $primaryKey="ssn";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable =['ssn','name','surname','address','photo','DepartamentId','username'];

    // DEFINE RELATIONSHIPS --------------------------------------------------
     public function departament() {
         return $this->hasOne('App\Departament','DepartamentId'); 
     }

     public function user() {
         return $this->hasOne('App\User','username');
     }
}
