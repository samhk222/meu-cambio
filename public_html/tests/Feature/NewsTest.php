<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testWhenTheresNoNews()
    {
        $response = $this->get('/api/v01/2000');
        $response->assertStatus(404);
    }

    public function testSuccessRetrievingSpecificNews()
    {
        $response = $this->get('/api/v01/news/1');
        $response->assertStatus(200);
    }

    public function testValidSingleResponseStructure()
    {
        $response = $this->get('/api/v01/news/1');
        $response->assertJson([
            'feeds_id' => true,
            'id' => true,
            'description' => true,
            'link' => true,
        ]);
    }

    public function testPaginatedNewsResponseStructure()
    {
        $response = $this->get('/api/v01/news');
        $response->assertJson([
            'current_page' => true,
            'from' => true,
            'per_page' => true,
            'total' => true,
        ]);
    }

    public function testNewsIsPopulated()
    {

        $response = $this->json('GET', '/api/v01/news', []);
        $decoded = json_decode($response->content());
        $this->assertGreaterThan(0,$decoded->total);
    }


}
