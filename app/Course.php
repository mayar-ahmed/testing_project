<?php

namespace App;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded=array('id','_token','material','submit');
    
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function registrants(){
        return $this->belongsToMany('App\Registrant')->withPivot('date_time', 'confirmed','code');
    }

    public function reviews(){
        return $this->hasMany('App\Review');
    }

    public function ratings(){
        return $this->hasMany('App\Rating');
    }

    public function addCourse($request,$file)
    {
      // $this->category_id=$request['category_id'];
       // $this->material=$file;
      //  return $this->save($request);

    }
}
