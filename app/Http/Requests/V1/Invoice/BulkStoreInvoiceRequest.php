<?php

namespace App\Http\Requests\V1\Invoice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreInvoiceRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string,
     */
    public function rules(): array
    {
        return [
            "*.customerId"=> ["required", "integer"],
            "*.amount"=> ["required", "numeric"],
            "*.status"=> ["required", Rule::in(['B', 'P', 'V', 'b', 'p', 'v'])],
            "*.billedDate"=> ["required", "date_format:Y-m-d H:i:s"],
            "*.paidDate"=> ["nullable", "date_format:Y-m-d H:i:s"],
        ];
    }

    protected function prepareForValidation() {
        $data = [];

        foreach ($this->toArray() as $obj) {
            if (isset($obj['customerId'])) {
                $obj['customer_id'] = $obj['customerId'];
            }
            if (isset($obj['billedDate'])) {
                $obj['billed_date'] = $obj['billedDate'];
            }
            if (isset($obj['paidDate'])) {
                $obj['paid_date'] = $obj['paidDate'];
            }

            $data[] = $obj;
        }

        $this->merge($data);
    }
}
