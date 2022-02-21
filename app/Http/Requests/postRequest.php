<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class postRequest extends FormRequest
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

        $user = new User();
        $users = $user->all();
        $ids =[];

        return [
        'title'=>['required','min:3',Rule::unique('posts', 'title')->ignore($this->post)],
        'description'=>['required','min:10',],
        // 'post_creator'=> ['required', Rule::in($ids),]
         
        ];



        
        // return [
        //     request()->validate([
        //         'title' => ['required','min:3','unique:posts'],
        //         'description' => ['required',' min:10'],
        //     ])
            
        // ];
     }
}
