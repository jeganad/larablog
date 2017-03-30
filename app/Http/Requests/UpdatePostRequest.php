<?php

namespace Naoray\Larablog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Post to update.
     */
    private $post;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->can('edit post', request()->post);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $post = request()->post;

        return [
            'title' => 'required|unique:posts,title,'.$post->id,
            'slug' => 'required|min:5|unique:posts,slug,'.$post->id,
            'body' => 'required',
        ];
    }
}
