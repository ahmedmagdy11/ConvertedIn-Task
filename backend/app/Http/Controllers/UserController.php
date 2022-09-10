<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller {
    public function leaderboard() {
        $users = User::selectRaw("COUNT(assigned_to_id) as tasks_count, users.id, users.name")
            ->leftJoin("tasks", "assigned_to_id", "=", "users.id")
            ->groupBy("users.id")
            ->orderByRaw("tasks_count desc")
            ->limit(10)
            ->get();
        return response(["users" => $users]);
    }
    public function getAdmins() {
        return response (["data" => User::where("admin", true)->get()]);
    }
    public function getUsers() {
        return response(["data" => User::where("admin", false)->get()]);
    }
}
