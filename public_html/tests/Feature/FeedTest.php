<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeedTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIsSystemUp()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        // $this->assertTrue(true);
    }

    public function testIsFeedPopulated()
    {
        $this->assertDatabaseHas('feeds', [
            'url' => 'http://pox.globo.com/rss/g1/economia'
        ]);
    }

    public function testIsFeedIsNotDirty()
    {
        $this->assertDatabaseMissing('feeds', [
            'url' => 'http://pox.globo.com/rss/g1/tecnologia'
        ]);
    }
    
}
