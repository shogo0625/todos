<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;
// バリデーション設定クラス読み込み
use App\Http\Requests\CreateFolder;
// Authクラスをインポートする
use Illuminate\Support\Facades\Auth;

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
        // ユーザーに紐付けて保存
        Auth::user()->folders()->save($folder);
        
        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }
}
