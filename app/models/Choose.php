<?php

class Choose extends Eloquent
{
    protected $table='choose';
    public $timestamps = false;
    protected $fillable = array('stu_id', 'choose1','choose2','choose2','choose3','choose4','choose5','choose6','choose7','choose8','choose9','choose10','choose11','choose12','choose13','choose14','choose14','result');

    public function student()
    {
        return $this->hasOne('Student','id','stu_id');
    }
}
