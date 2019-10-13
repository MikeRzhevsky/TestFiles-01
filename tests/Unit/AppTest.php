<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testPOST()
    {
        $response = $this->post('api/generate');
        $response->assertStatus(200);
    }

    public function testGET()
    {
        $response = $this->get('/api/retrieve');
        $response->assertStatus(200);
    }
}
