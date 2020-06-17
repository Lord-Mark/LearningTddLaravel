<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;
use App\Author;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_book_can_be_added_to_the_library()
    {

        $this->withoutExceptionHandling();

        $response = $this->post('/books', $this->formInput());

        $book = Book::first();

        $this->assertCount(1, Book::all());
        $response->assertRedirect($book->path());
    }

    /**
     * @test
     */
    public function a_title_is_required()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/books',
            array_merge($this->formInput(), ['title' => ''])
        );

        $response->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function an_author_is_required()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', 
            array_merge($this->formInput(), ['author_id' => ''])
        );

        $response->assertSessionHasErrors('author_id');
    }


    /**
     * @test
     */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', $this->formInput());

        $book = Book::first();

        $response = $this->patch($book->path(), [
            'title' => 'New title',
            'author_id' => 'New author',
        ]);

        $author = Author::all();

        $this->assertEquals('Mark', $author->find(1)->name);
        $this->assertEquals('New author', $author->find(2)->name);
        $this->assertEquals('New title', $book->fresh()->title);
        
        $this->assertCount(2, $author);

        $response->assertRedirect($book->path());
    }

    /**
     * @test
    */
    public function a_book_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', $this->formInput());

        $book = Book::first();
        $response = $this->delete($book->path());


        $this->assertCount(0, Book::all());
        $response->assertRedirect('/books');
    }

    /**
     * @test
     */
    public function an_author_is_automatically_created()
    {
        $this->post('/books', $this->formInput());

        $book = Book::first();
        $author = Author::all();

        $this->assertEquals($author->first()->id, $book->author_id);
        $this->assertCount(1, $author);
    }

    /**
     * Retorna apenas uma array com os inputs
     */
    protected function formInput()
    {
        return 
        [
            'title' => 'Cool title',
            'author_id' => 'Mark',
        ];
    }

}
