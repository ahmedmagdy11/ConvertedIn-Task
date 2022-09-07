<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function leaderboard(){
        $users = User::selectRaw("COUNT(assigned_to_id) as tasks_count, users.id, users.name")
                ->leftJoin("tasks", "assigned_to_id", "=", "users.id")
                ->groupBy("users.id")
                ->orderByRaw("tasks_count desc")
                ->limit(10)
                ->get();
        return response(["users" => $users]);
    }
}
