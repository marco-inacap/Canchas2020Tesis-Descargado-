<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class PruebasTecnicasTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testExample()
    {
        $response = $this->get('/su-cancha-canchas');

        $response->assertStatus(200);

        
    }

    
}
