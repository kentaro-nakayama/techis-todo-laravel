<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    protected $tasks;
    public function __construct(TaskRepository $tasks) {
        $this->middleware("auth");
        $this->tasks = $tasks;
    }

    /**
     * タスク一覧を取得する
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request) {
        $tasks = $this->tasks->forUser($request->user());
        return view('tasks.index', compact('tasks'));
    }

    /**
     * タクスを作成する
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createTask(Request $request) {
        $request->validate([
            'name'=> 'required|max: 255',
        ]);
        $request->user()->tasks()->create([
            'name'=> $request->name,
        ]);
        return redirect('/tasks');
    }

    public function deleteTask($taskId) {
        $task = Task::findOrFail($taskId);
        // Policyで定義したdeleteメソッドを実行
        // 第一引数である現在ログイン中のユーザー（$user）は、Laravelが自動的に取得して引き渡してくれる
        // $user->idと$task->user_idが一致するかチェック
        $this->authorize('delete', $task); 
        $task->delete();
        return redirect('/tasks');
    }
}
