<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_a_user_can_create_a_post()
    {
        $user = User::factory()->create();

        $postData = [
            'title' => 'Test Post',
            'excerpt' => 'This is a test post excerpt.',
            'content' => 'This is the main content of the test post.',
            'author' => $user->name,
            'source' => 'Test Source',
            'tags' => 'test, post',
            'date' => now()->format('Y-m-d'),
            'time' => now()->format('H:i:s'),
            'canonical_url' => 'https://example.com/test-post',
            'featured_image' => 'https://example.com/images/test-post.jpg',
        ];

        $response = $this->actingAs($user)->post('/posts', $postData);

        $response->assertRedirect('/posts');
        $this->assertDatabaseHas('posts', $postData);
    }
}
