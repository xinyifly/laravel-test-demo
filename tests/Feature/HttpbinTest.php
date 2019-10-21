<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HttpbinTest extends TestCase
{
    public function testIndex()
    {
        $client = $this->mock(\GuzzleHttp\Client::class, function ($mock) {
            $response = new \GuzzleHttp\Psr7\Response(
                200, [], json_encode(['url' => 'https://httpbin.org/get'])
            );
            $mock->shouldReceive('get')->once()
                 ->with('https://httpbin.org/get')
                 ->andReturn($response);
        });
        $this->app->instance('guzzle', $client);

        $response = $this->get('/api/httpbin');

        $response->assertStatus(200);
        $response->assertJson(['url' => 'https://httpbin.org/get']);
    }
}
