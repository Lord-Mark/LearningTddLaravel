<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorsController extends Controller
{

	/**
	 * Faz mass assignment para o db dos dados passados
	 * @fillable 'name', 'dob'.
	 */
    public function store()
    {
    	Author::create(request()->only([
    		'name',
    		'dob',
    	]));
    }
}
