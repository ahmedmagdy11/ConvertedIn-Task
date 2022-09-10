<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserTest extends TestCase {
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_admins() {
        $response = $this->get('/api/user/admins');
        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has('data')
        );
    }
    public function test_get_users() {
        $response = $this->get('/api/user/users');
        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has('data')
        );
    }
}
