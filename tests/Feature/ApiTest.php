<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test retrieving all comments.
     *
     * @return void
     */
    public function testGetAllComments()
    {
        // Seed the database with some test data
        DB::table('comments')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'comment' => 'This is a test comment.',
                'parent_comment_id' => null,
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'comment' => 'This is another test comment.',
                'parent_comment_id' => null,
            ],
        ]);

        // Make an HTTP GET request to the comments endpoint
        $response = $this->get('/api/comments');

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert that the response contains the test comments
        $response->assertJson([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'comment' => 'This is a test comment.',
                'parent_comment_id' => null,
                'replies' => [],
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'comment' => 'This is another test comment.',
                'parent_comment_id' => null,
                'replies' => [],
            ],
        ]);
    }

    /**
     * Test creating a new comment.
     *
     * @return void
     */
    public function testCreateComment()
    {
        // Make an HTTP POST request to the comments endpoint with some test data
        $response = $this->post('/api/comments', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'comment' => 'This is a new test comment.',
        ]);

        // Assert that the response is successful
        $response->assertStatus(201);

        // Assert that the response contains the new comment
        $response->assertJson([
            'success' => true
        ]);
    }
}
?>

