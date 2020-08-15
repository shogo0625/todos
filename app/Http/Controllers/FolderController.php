<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;
// バリデーション設定クラス読み込み
use App\Http\Requests\CreateFolder;

class FolderController extends Controller
{
    // フォームの表示（getメソッド）
    public function showCreateForm()
    {
        return view('folders/create');
    }
    // 引数にインポートしたRequestクラスを受け入れる
    public function create(CreateFolder $request) // validation設定のクラスで型指定
    {
        // フォルダモデルのインスタンス作成
        $folder = new Folder();
        // タイトルに入力値を代入する
        $folder->title = $request->title;
        // インスタンスの状態をデータベースに書き込む
        $folder->save();
        
        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}