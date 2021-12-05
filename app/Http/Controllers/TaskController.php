<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Task; // ★ 追加
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    //
    public function index(Request $request)
    {
        $id = $request->id;

        // ユーザのフォルダを取得する
        $folders = Auth::user()->folders()->get();

        // 選ばれたフォルダを取得する
        $current_folder = Folder::find($id);

        if (is_null($current_folder)) {
            abort(404);
        }

        // 選ばれたフォルダに紐づくタスクを取得する
        $tasks = $current_folder->tasks()->get(); // ★

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $current_folder->id,
            'tasks' => $tasks,
        ]);
        
    }

    public function showCreateForm(Request $request)
    {
        $id = $request->id;
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    public function create(CreateTask $request)
    {
        $id = $request->id;
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $current_folder->tasks()->save($task);

        if (is_null($current_folder)) {
            abort(404);
        }

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }

    /**
     * GET /folders/tasks/edit
     */
    public function showEditForm(Request $request)
    {
        $id = $request->id;

        $task_id = $request->task_id;

        $task = Task::find($task_id);

        if (is_null($task)) {
            abort(404);
        }

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    public function edit(EditTask $request)
    {
        $id = $request->id;

        $task_id = $request->task_id;
        // 1
        $task = Task::find($task_id);

        if (is_null($task)) {
            abort(404);
        }

        // 2
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        // 3
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }
}
