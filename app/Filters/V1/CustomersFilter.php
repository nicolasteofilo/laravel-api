<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class CustomersFilter extends ApiFilter {
    protected function getAllowedParams(): array {
        return [
            'name' => ['eq', 'like'],
            'type' => ['eq'],
            'email' => ['eq', 'like'],
            'adddress' => ['eq', 'like'],
            'city' => ['eq', 'like'],
            'state' => ['eq', 'like'],
            'postalCode' => ['eq', 'gt', 'lt']
        ];
    }

    protected function getColumnsDatabaseMapper(): array {
        return [
            'postalCode' => 'postal_code'
        ];
    }

    protected function getOperatorMap(): array {
        return [
            'eq' => '=',
            'like' => 'like',
            'lt' => '<',
            'lte' => '<=',
            'gt' => '>',
            'gte' => '>=',
        ];
    }
}
