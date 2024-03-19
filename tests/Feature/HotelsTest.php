<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HotelsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_fetch_all_hotels(): void
    {
        $response = $this->get('/hotels');

        $response->assertStatus(200);
    }
    /**
     * Filter Hotels By Price And Date
    */
    public function test_fetch_all_hotels_and_filter(): void
    {
        $response = $this->get('/hotels?name=Rotana&destination=&minPrice=80&maxPrice=81');

        $response->assertStatus(200);
    }
}
