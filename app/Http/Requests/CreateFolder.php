<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // デフォルトはfalse
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 必須入力 | 最大文字
            'title' => 'required | max:20',
        ];
    }
    
    public function attributes()
    {
        return [
            'title' => 'フォルダ名',
        ];
    }
}
