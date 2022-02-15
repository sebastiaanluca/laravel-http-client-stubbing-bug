<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public function it can make an http request(): void
    {
        $this->expectsEvents('my-event');

        $response = $this->get(route('home'));

        $response->assertOk();

        $this->assertNotNull($response->getContent());
    }

    /**
     * @test
     */
    public function it can stub http endpoints 1(): void
    {
        $this->expectsEvents('my-event');

        Http::fake([
            'https://www.google.com' => Http::response('stubbed'),
            '*' => Http::response(null, 404),
        ]);

        $response = $this->get(route('home'));

        $response->assertOk();

        $this->assertSame('stubbed', $response->getContent());
    }

    /**
     * @test
     */
    public function it can stub http endpoints 2(): void
    {
        Http::fake([
            'https://www.google.com' => Http::response('stubbed'),
            '*' => Http::response(null, 404),
        ]);

        $this->expectsEvents('my-event');

        $response = $this->get(route('home'));

        $response->assertOk();

        $this->assertSame('stubbed', $response->getContent());
    }
}
