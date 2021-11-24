<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreDestinationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['name' => "string", 'category_id' => "string", 'price' => "string", 'vicinity' => "string"])]
    public function rules(): array {
        return [
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'vicinity' =>'required'
        ];
    }
}
