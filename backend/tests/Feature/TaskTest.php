<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase {
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_create_task() {
        $admin_user = User::where("admin", true)->first();
        $normal_user = User::where("admin", false)->first();

        $response = $this->postJson('/api/task', [
            "title" =>  "New task",
            "description" =>  "Do X,Y,Z",
            "assigned_to_id" => $normal_user->id,
            "assigned_by_id" => $admin_user->id
        ]);
        $response->assertStatus(201);
    }
    public function test_create_task_failure(){
        $admin_user = User::where("admin", true)->first();
        $normal_user = User::where("admin", false)->first();

        $response = $this->postJson('/api/task', [
            "title" =>  "New task",
            "description" =>  "Do X,Y,Z",
            "assigned_to_id" => $admin_user->id,
            "assigned_by_id" => $normal_user->id
        ]);
        $response->assertStatus(401);
    }
}
