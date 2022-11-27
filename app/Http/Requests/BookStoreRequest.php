<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
          'title' => 'required|string',
          'author' => 'required|string',
          'release_date' => 'required|string',
          'isbn' => 'required|string',
          'format' => 'required|string',
          'description' => 'required|string',
          'number_of_pages' => 'required|integer',
        ];
    }
}
