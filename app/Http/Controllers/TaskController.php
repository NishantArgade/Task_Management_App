<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Display all tasks
    public function allTasks(Request $request)
    {
        $searchTerm = $request->search_query ?? '';

        // Get all tasks from pivot table
        $tasks = Task::with('users')->get();

        // Flash the search query to the session
        $request->flash();
        return view('tasks/all', compact('tasks', 'searchTerm'));
    }

    // Display all users tasks
    public function allUserTasks(Request $request)
    {
        $searchTerm = $request->search_query ?? '';

        // Get all tasks from pivot table
        $tasks = Task::with('users')->get();
        $request->flash();

        return view('tasks/all_users', compact('tasks', 'searchTerm'));
    }

    // Display all my tasks
    public function myTasks(Request $request)
    {
        $searchTerm = $request->search_query ?? '';

        $curr_userid = Auth::user()->id;
        $tasks = User::find($curr_userid)->tasks->toArray();

        $request->flash();

        return view('tasks/my', compact('tasks', 'searchTerm'));
    }

    // Delete user task
    public function deleteUserTask(Request $request)
    {
        // delete task by user_id and task_id
        $task_id =  $request->task_id;
        $user_id =  $request->user_id;

        Task::find($task_id)->users()->detach($user_id);

        return redirect()->route('task.all-users')->withStatus('Task deleted successfully!');
    }

    // Update task status
    public function updateTaskStatus(Request $request)
    {
        // update task status by user_id and task_id
        $task_id =  $request->task_id;
        $user_id =  Auth::user()->id;
        $status =  $request->status;

        Task::find($task_id)->users()->updateExistingPivot($user_id, ['status' => $status]);

        return redirect()->route('task.my')->withStatus('Task status changed successfully!');
    }

    // Show the form for creating a task.
    public function create()
    {
        $users = User::all();

        return view('tasks.create', compact('users'));
    }

    // Store a newly created task in storage.
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string|nullable',
            'due_date' => 'required|date',
            'selectedInputs' => 'required|string'
        ]);

        // Create a new task
        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->save();


        // Get the user IDs from the selectedInputs array
        $userIds = explode(',', $request->selectedInputs);

        // pivot table 'task_user' to attach the user IDs to the task ID  
        $task->users()->attach($userIds, ['created_at' => now(), 'updated_at' => now()]);

        return redirect()->route('task.all')->withStatus('Task created successfully!');
    }

    // Show the form for editing the specified task.
    public function edit(Task $task)
    {
        $taskData = Task::find($task->id)->users()->get();
        $selectedUsers = $taskData->pluck('name', 'id')->toArray();
        $allUsers = User::all()->toArray();

        return view('tasks.edit', compact('task', 'allUsers', 'selectedUsers'));
    }

    // Update the specified task in storage.
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string|nullable',
            'due_date' => 'required|date',
            'selectedInputs' => 'required|string'
        ]);

        // Update the task
        $task = Task::find($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->save();

        // Get the user IDs from the selectedInputs array
        $userIds = explode(',', $request->selectedInputs);

        // pivot table 'task_user' to attach the user IDs to the task ID  
        $task->users()->sync($userIds, ['created_at' => now(), 'updated_at' => now()]);

        return redirect()->route('task.all')->withStatus('Task updated successfully!');
    }

    // Remove the specified task from storage.
    public function destroy(string $id, Request $request)
    {
        Task::find($request->task_id)->delete();

        return redirect()->route('task.all')->withStatus('Task deleted successfully!');
    }
}
