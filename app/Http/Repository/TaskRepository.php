<?php
namespace App\Http\Repository;

use App\Models\Category;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class TaskRepository
{
    public function getAllTasks($request)
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
        return compact('tasks', 'categories');
    }

    public function createTask($data)
    {
        DB::beginTransaction();
        try {
        $task = new Task($data);
        $task->user_id = Auth::id();
        $task->save();
        DB::commit();
        return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating task: ' . $e->getMessage());
            return false;
        }
    }
}