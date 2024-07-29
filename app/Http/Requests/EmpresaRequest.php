<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmpresaRequest extends FormRequest
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
            "empresa_nome" => "required|min:4"
        ];
    }

    public function messages(): array
    {
        return [
            'empresa_nome.nome' => "O nome da empresa é obrigatório",
            'empresa_nome.min' => "O nome da empresa deve ter 4 caracteres"
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
