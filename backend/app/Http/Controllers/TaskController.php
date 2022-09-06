<?php

namespace App\Http\Controllers;

use App\Http\Requests\createTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller {
    public function create(createTask $request) {
        $validated = $request->validated();
        $assignedToUser = User::where("id", $validated["assigned_to_id"])
            ->first();
        if ($assignedToUser->admin) {
            return response(["message" => "assigned to user can't be admin"], 401);
        }
        $assignedByUser = User::where("id", $validated["assigned_by_id"])->first();
        if (!$assignedByUser->admin) {
            return response(["message" => "assigned to admin is non-admin user"], 401);
        }

        $task = Task::create($validated);
        return response(["message" => "Task has been created successfully", "task" => $task], 201);
    }

    public function get(Request $request) {
        $tasks = Task::select(["title", "description", "assigned_by_id", "assigned_to_id"])
            ->with(["admin:id,name", "user:id,name"])
            ->paginate($request->query("number", 10))
            ->withQueryString();
        return response(["tasks" => $tasks]);
    }
}
