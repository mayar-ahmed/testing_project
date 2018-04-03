<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registrant extends Model
{
    //
    protected $primaryKey="ssn";
    public $incrementing=false;
    protected $fillable =['ssn']; 
   public function courses(){
        return $this->belongsToMany('App\Course')->withPivot('date_time','confirmed','code');
    }
}
