<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:20'],
            'last_name' => ['required', 'string', 'max:20'],
            'cpf' => ['required', 'integer', 'digits:11',
                Rule::unique((new User)->getTable())->ignore(auth()->id())],
            'email' => ['required', 'string', 'email', 'max:50',
                Rule::unique((new User)->getTable())->ignore(auth()->id())],
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ];
    }
}