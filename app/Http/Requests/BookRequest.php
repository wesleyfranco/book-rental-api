<?php

namespace App\Http\Requests;

use App\Interfaces\BookRequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest implements BookRequestInterface
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
            'name' => 'required|string|min:10|max:150|unique:books,name,' . $this->id,
            'synopsis' => 'required|string|min:50',
            'publisher' => 'required|string|min:3|max:150',
            'edition' => 'required|string|max:10',
            'page_number' => 'required|numeric:strict',
            'isbn' => 'required|string|max:30',
            'language' => 'required|string|min:4|max:50',
            'release_date' => 'required|string|min:4|max:15',
        ];
    }
}
