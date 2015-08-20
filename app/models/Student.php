<?php

class Student extends Eloquent
{
    protected $table='student';
    public $timestamps = false;

    public function choose()
    {
        return $this->hasOne('Choose','stu_id');
    }
    protected $fillable = array('change2','chosen','account','password','name','class','seat','stage','forced');
}
