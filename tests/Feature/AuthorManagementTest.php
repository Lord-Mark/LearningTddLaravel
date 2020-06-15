<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;
use App\Author;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function an_author_can_be_added()
    {
        $this->withoutExceptionHandling();

        $this->post('/author', $this->inputData());

        $author = Author::all();

        /**
         * Teste para ver se um author foi inserido
         */
        $this->assertCount(1, $author);
    }

    /**
     * @test
     */
    public function dob_is_a_carbon_instance()
    {
        $this->withoutExceptionHandling();

        $this->post('/author', $this->inputData());

        $author = Author::all();

        /**
         * Teste para ver se 'dob' é uma instancia de Carbon
         */
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);

        /**
         * Teste para ver se a instancia foi feita corretamente
         */
        $this->assertEquals('1998/14/11', $author->first()->dob->format('Y/d/m'));
    }

    protected function inputData()
    {
        return [
            'name' => 'Lord Mark',
            'dob' => '14/11/1998'
        ];
    }
}
