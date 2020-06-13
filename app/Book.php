<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'author',
    ];


    /**
     * Retorna a 'url' do livro
     */
    public function path()
    {
    	return ('/books/' . $this->id);
    }

}
