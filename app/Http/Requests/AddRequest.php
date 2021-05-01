<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
            'name'=>'required|unique:details,name',
            'birthday'=>'required',
            'tel'=>'required|numeric|unique:details,tel',
            'image'=>'image',
        ];
    }

    public function messages() {
        return [
        "required" => "必須項目です。",
        "numeric" => "数値のみで入力してください。",
        "image" => "画像ファイルを選択してください。",
        "unique"=>"既に使用されています。"
        ];
      }
}

