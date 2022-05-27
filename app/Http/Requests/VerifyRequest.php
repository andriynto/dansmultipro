<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyRequest extends FormRequest
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
            'pin'        => 'required|string|min:6',
            'password'   => 'required|min:6|required_with:password_confirmation|same:password_confirmation'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'Atribut :attribute required.',
            'min'      => 'Atribut minimum :min digit',
            'max'      => 'Atribut minimum :min digit',
            'same'     => 'Password not same'
        ];
    }
}