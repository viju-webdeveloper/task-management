<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $user = User::find(Auth::id());

        $query = $user->tasks()->with('category');

        // Search by title or description
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Filter by category
        if ($category = $request->input('category')) {
            $query->where('category_id', $category);
        }

        // paginate 10 per page
        $tasks = $query->paginate(10);
        $categories = Category::all();

        return view('dashboard', compact('tasks', 'categories'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\View\View
     */

    public function create()
    {
        // Logic to show the task creation form
        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }

    /**
     * Store a newly created task in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {
        try{
        // Logic to handle task creation
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date',
            'status'      => 'required|in:pending,in_progress,completed',
            'priority'    => 'required|in:0,1,2', // 0: Low, 1: Medium, 2: High
            'category_id' => 'required|exists:categories,id',
        ]);

        $task = new Task($data);
        $task->user_id = Auth::id();
        $task->save();

        return redirect()->route('task.create')->with('success', 'Task created successfully!');
        } catch (\Exception $e) {
            Log::error('error', 'Failed to create task: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create task. Please try again.');
        }
        
    }

    /**
     * Display the specified task.
     *
     * @param Task $task
     * @return \Illuminate\View\View
     */

    public function show(Task $task)
    {
        // Check if the authenticated user is authorized to view the task
        Gate::authorize('task-access', $task);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param Task $task
     * @return \Illuminate\View\View
     */

    public function edit(Task $task)
    {
        Gate::authorize('task-access', $task);
        $categories = Category::all();
        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified task in storage.
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(Request $request, Task $task)
    {
        try{

        // Check if the authenticated user is authorized to update the task
        Gate::authorize('task-access', $task);

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date',
            'status'      => 'required|in:pending,in_progress,completed',
            'priority'    => 'required|in:0,1,2', // 0: Low, 1: Medium, 2: High
            'category_id' => 'required|exists:categories,id',
        ]);

        $task->update($data);

        return redirect()->route('task.show', $task)->with('success', 'Task updated successfully!');
        }catch (\Exception $e) {
            Log::error('error', 'Failed to update task: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update task. Please try again.');
        }
    }

    /**
     * Remove the specified task from storage.
     *
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy(Task $task)
    {
        // Check if the authenticated user is authorized to delete the task
        Gate::authorize('task-access', $task);
        
        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Task deleted successfully!');
    }
}
