<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create()
    {
        // Retrieve all categories to populate the dropdown
        $categories = Category::all();
        return view('todo', compact('categories'));
    }

    public function store(Request $request)
    {
        // Create or find the user based on email
        $user = User::firstOrCreate(
            ['email' => $request->email],
            ['name' => $request->name],
            ['username' => $request->username]
        );

        // Save each task associated with the user
        foreach ($request->tasks as $taskData) {
            Task::create([
                'user_id' => $user->id,
                'category_id' => $taskData['category_id'],
                'description' => $taskData['description'],
            ]);
        }

        return redirect()->back()->with('success', 'To Do List saved successfully!');
    }
}
