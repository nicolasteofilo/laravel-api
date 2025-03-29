<?php

namespace App\Http\Requests\V1\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
        $method = $this->method();

        return match ($method) {
            "PUT" => [
                "name" => ["required", "string"],
                "type" => ["required", Rule::in(["I", "B", "i", "b"])],
                "email" => ["required", "string", "email"],
                "address" => ["required", "string"],
                "city" => ["required", "string"],
                "state" => ["required", "string"],
                "postalCode" => ["required", "string"],
            ],
            default => [
                "name" => ["sometimes", "string"],
                "type" => ["sometimes", Rule::in(["I", "B", "i", "b"])],
                "email" => ["sometimes", "string", "email"],
                "address" => ["sometimes", "string"],
                "city" => ["sometimes", "string"],
                "state" => ["sometimes", "string"],
                "postalCode" => ["sometimes", "string"],
            ],
        };
    }

    protected function prepareForValidation()
    {
        if ($this->postalCode) {
            $this->merge([
                'postal_code' => $this->postalCode,
            ]);
        }
    }
}
