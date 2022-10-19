<?php

namespace Modules\Dashboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserWalletRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'file_user_wallet' => 'required|mimes:xlsx,csv,txt'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'file_user_wallet.mimes' => 'O arquivo dever ser .xlsx, csv ou txt',
            'file_user_wallet.required' => 'Necessário selecionar um arquivo'
        ];
    }
}
