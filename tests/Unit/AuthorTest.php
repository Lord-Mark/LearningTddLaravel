<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Author;

class AuthorTest extends TestCase
{
	use RefreshDatabase;
    /**
     * @test
     */
    public function an_author_can_be_created_with_name_only()
    {
    	$this->withoutExceptionHandling();

    	Author::firstOrCreate([
            'name' => 'Mark'
        ]);

        $this->assertCount(1, Author::all());
    }
}
