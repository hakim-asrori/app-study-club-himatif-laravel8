<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Learning;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function counting()
    {
        $student = User::where('id_role', 3)->count();
        $lecturer = User::where('id_role', 2)->count();
        $category = Category::count();
        $task = Task::count();
        $learning = Learning::count();

        return response()->json([
            'status' => true,
            'message' => 'Request success!',
            'data' => [
                'student' => $student,
                'lecturer' => $lecturer,
                'category' => $category,
                'task' => $task,
                'learning' => $learning,
            ]
        ]);
    }
}
