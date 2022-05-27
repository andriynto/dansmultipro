<?php namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Abstracts\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
        if ($this->getMethod() == 'POST') {
        
            $rules['name']     = 'required|string|min:3';
            $rules['email']    = 'required|email|min:3|string|unique:users,email,NULL,id,deleted_at,NULL';
            $rules['username'] = 'required|string|unique:users,username,NULL,id,deleted_at,NULL|min:3';
            
            return $rules;
        }
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
            'min'      => 'Atribut :attribute minimal :min character',
            'unique'   => 'Atribut :attribute is not unique.',
            'exists'   => 'Atribut :attribute is not available.',
            'string'   => 'Atribut :attribute must be string.'
        ];
    }
}