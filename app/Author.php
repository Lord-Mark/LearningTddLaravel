<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Author extends Model
{
    protected $guarded = [];

    protected $dates = ['dob'];


    /**
     * Define o formato de hora e define 'dob' como uma instância de Carbon 
     */
    public function setDobAttribute($dob)
    {	
    	$this->attributes['dob'] = Carbon::createFromFormat('d/m/Y', $dob);
    }
}
