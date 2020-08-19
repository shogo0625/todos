<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;
// バリデーション設定クラス読み込み
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;

class TaskController extends Controller
{
    //
    public function index(int $id)
    {
        // 対象モデルのallクラスメソッドで取得
        $folders = Folder::all();
        // 選ばれたフォルダを取得
        $current_folder = Folder::find($id);
        // 選べれたフォルダに紐付いたタスクを取得
        $tasks = $current_folder->tasks()->get();
        
        // view関数 第1引数：渡すファイル名　第2引数：配列（キーが参照する際の変数名）
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $current_folder->id,
            'tasks' => $tasks,
        ]);
    }
    
    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id,
        ]);
    }
    
    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);
        
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;
        
        $current_folder->tasks()->save($task);
        
        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }
    
    public function showEditForm(int $id, int $task_id)
    {
        $task = Task::find($task_id);
        
        return view('tasks/edit', [
            'task' => $task,
        ]);
    }
    
    public function edit(int $id, int $task_id, EditTask $request)
    {
        // リクエストされたIDでタスクデータを取得
        $task = Task::find($task_id);
        
        // 編集対象のタスクに入力値をsave
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();
        
        // 編集したタスクが属するタスク一覧画面へリダイレクト
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }
    
}
