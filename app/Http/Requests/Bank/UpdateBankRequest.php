<?php

namespace App\Http\Requests\Bank;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBankRequest extends FormRequest
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
        # Get model Bank from route.
        $bank = $this->route('bank');
        
        return [
            //
            'req' => 'required',
            'code' => [
                'required',
                'integer',
                # Make sure code is unique diferent.
                ($this->code !== $bank->code) ? 'unique:banks' : ''
            ],
            'nama_bank' => 'required|min:3'
        ];
    }
}
