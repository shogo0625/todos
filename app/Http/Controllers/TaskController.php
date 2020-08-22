<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;
// バリデーション設定クラス読み込み
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
// Authクラスをインポートする
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //
    public function index(Folder $folder)
    {
        // 対象モデルのallクラスメソッドで取得
        $folders = Auth::user()->folders()->get();
        // 選べれたフォルダに紐付いたタスクを取得
        $tasks = $folder->tasks()->get();
        
        // view関数 第1引数：渡すファイル名　第2引数：配列（キーが参照する際の変数名）
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $folder->id,
            'tasks' => $tasks,
        ]);
    }
    
    public function showCreateForm(Folder $folder)
    {
        return view('tasks/create', [
            'folder_id' => $folder->id,
        ]);
    }
    
    public function create(Folder $folder, CreateTask $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;
        
        $folder->tasks()->save($task);
        
        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }
    
    public function showEditForm(Folder $folder, Task $task)
    {
        $this->checkRelation($folder, $task);
        
        return view('tasks/edit', [
            'task' => $task,
        ]);
    }
    
    public function edit(Folder $folder, Task $task, EditTask $request)
    {
        $this->checkRelation($folder, $task);
        
        // 編集対象のタスクに入力値をsave
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();
        
        // 編集したタスクが属するタスク一覧画面へリダイレクト
        return redirect()->route('tasks.index', [
            'folder' => $task->folder_id,
        ]);
    }
    
    public function checkRelation(Folder $folder, Task $task)
    {
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }
    
}
