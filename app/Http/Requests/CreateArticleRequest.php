<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest
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
            'title' => 'required|max:255',
            'content' => 'required',
            'content_html' => 'required'
        ];
    }

    /**
     * 验证返回信息
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => '请填写文章标题',
            'title.max' => '文章标题最多为255个字符',
            'content.required' => '请填写文章正文',
            'content_html.required' => '请填写文章正文'
        ];
    }
}
