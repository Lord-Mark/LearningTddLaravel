<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BooksController extends Controller
{
	/**
	 * Guarda informações no banco de dados
	 */
    public function store()
    {
    	$book = Book::create($this->validateRequest());
    	
    	return redirect('/books/' . $book->id);
    }

    /**
     * Atualiza informações no banco de dados
     */
    public function update(Book $book)
    {
    	$book->update($this->validateRequest());

    	return redirect('/books/' . $book->id);
    }

    /**
     * Apaga um determinado registro no banco de dados
     */
    public function destroy(Book $book)
    {
    	$book->delete();

    	return redirect('/books');
    }

    /**
     * Valida as informações passadas por formulário
     */
    protected function validateRequest()
    {
    	return request()->validate([
    		'title' => 'required',
    		'author' => 'required',
    	]);
    }
}
