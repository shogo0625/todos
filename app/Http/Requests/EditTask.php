<?php

namespace App\Http\Requests;

use App\Task;
use Illuminate\Validation\Rule;

class EditTask extends CreateTask
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = parent::rules();
        // inルール で入力値が許可リストに含まれているか確認する
        $status_rule = Rule::in(array_keys(Task::STATUS));
        
        return $rule + [
            // required | in(1, 2, 3)
            'status' => 'required |' . $status_rule,
        ];
    }
    
    public function attributes()
    {
        $attributes = parent::attributes();
        
        return $attributes + [
            'status' => '状態',
        ];
    }
    
    public function messages()
    {
        $messages = parent::messages();
        
        $status_labels = array_map(function($item) {
            return $item['label'];
        }, Task::STATUS);
        
        $status_labels = implode('、', $status_labels);
        
        return $messages + [
            'status.in' => ':attribute には ' . $status_labels. ' のいずれかを指定してください。'
        ];
    }
}
