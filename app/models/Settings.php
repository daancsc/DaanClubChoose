<?php

class Settings extends Eloquent
{
    protected $table='settings';
    public $timestamps = false;
    protected $fillable = array('status','resultview','resultchange','choosemin','home_post','post_important','noresultchange','resulttitle');

}
