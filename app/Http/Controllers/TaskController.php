<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;

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
        $tasks = Task::where('folder_id', $current_folder->id)->get();
        
        // view関数 第1引数：渡すファイル名　第2引数：配列（キーが参照する際の変数名）
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $current_folder->id,
            'tasks' => $tasks,
        ]);
    }
}
