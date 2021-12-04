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
            //titleはinputのnameと同じにすることでバリデーションをつける
            'title' => 'required|max:20',
        ];
    }
    //バリデーションの表示名を変更するメソッド
    public function attributes()
    {
        return [
            'title' => 'フォルダ名',
        ];
    }
}
