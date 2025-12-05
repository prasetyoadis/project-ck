<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
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
        # Get model Tag from route.
        $tag = $this->route('tag');
        
        return [
            'nama_tag' => 'required|min:3|max:255',
            'slug' => [
                'required',
                'min:3',
                'max:255',
                # Make rules when slug is diferent.
                ($this->slug !== $tag->slug) ? 'unique:tags' : '',
            ],
        
        ];
    }
}
