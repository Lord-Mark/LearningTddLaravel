<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;

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
            array_merge($this->formInput(), ['author' => ''])
        );

        $response->assertSessionHasErrors('author');
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
            'author' => 'New author',
        ]);

        $this->assertEquals('New title', Book::first()->title);
        $this->assertEquals('New author', Book::first()->author);
        $response->assertRedirect($book->fresh()->path());
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
     * Retorna apenas uma array com os inputs
     */
    protected function formInput()
    {
        return 
        [
            'title' => 'Cool title',
            'author' => 'Mark',
        ];
    }

}
