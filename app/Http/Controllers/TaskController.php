<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Get all tasks
    public function index()
    {
        return response()->json(Task::all());
    }

    // Create a new task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Task::create($validated);
        return response()->json($task, 201);
    }

    // Get a single task
    public function show(Task $task)
    {
        return response()->json($task);
    }

    // Update a task
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $task->update($validated);
        return response()->json($task);
    }

    // Delete a task
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }

    public function update_task_status(Request $request) {
        $request->validate([
            'id' => 'required',
            'status' => 'required'
        ]);

        Task::where('id', $request->id)->update(['status' => $request->status]);
        
        $task = Task::find($request->id);
        return response()->json($task);
    }
}