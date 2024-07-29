<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cliente_nome' => "required|min:3",
            'user_id' => "required|exists:users,id"
        ];
    }

    public function messages(): array
    {
        return [
            'cliente_nome.required' => "O nome é obrigatorio",
            'cliente_nome.min' => "O nome deve ter no minimo 3 caracteres",
            'user_id.required' => "O usuario é obrigatorio",
            'user_id.exists' => 'Esse usuario não existe no banco de dados'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(
            response()->json([
                'message' => "Os dados fornecidos são invalidos",
                "erros" => $errors
            ], 422)
        );
    }
}
