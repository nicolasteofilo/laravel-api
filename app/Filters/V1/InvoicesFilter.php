<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class InvoicesFilter extends ApiFilter {
    protected function getAllowedParams(): array {
        return [
            'customerId' => ['eq'],
            'amount' => ['eq', 'gt', 'lt', 'gte', 'lte'],
            'status' => ['eq', 'ne'],
            'billedDate' => ['eq', 'gt', 'lt', 'gte', 'lte'],
            'paidDate' => ['eq', 'gt', 'lt', 'gte', 'lte'],
        ];
    }

    protected function getColumnsDatabaseMapper(): array {
        return [
            'customerId' => 'customer_id',
            'billedDate'=> 'billed_date',
            'paidDate'=> 'paid_date',
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
            'ne'=> '!=',
        ];
    }
}
