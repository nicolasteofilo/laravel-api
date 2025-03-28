<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class ApiFilter {
    abstract protected function getAllowedParams(): array;
    abstract protected function getColumnsDatabaseMapper(): array;
    abstract protected function getOperatorMap(): array;

    public function transform(Request $request) {
        $eloquentQuery = [];
        $allowedParams = $this->getAllowedParams();
        $columnsDatabaseMapper = $this->getColumnsDatabaseMapper();
        $operatorMap = $this->getOperatorMap();

        foreach($allowedParams as $parm => $operators) {
            $query = $request->query($parm);

            if(!isset($query)) {
                continue;
            };

            $columName = $columnsDatabaseMapper[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if(isset($query[$operator])) {
                    switch ($operator) {
                        case 'like':
                            $value = '%' . $query[$operator] . '%';
                            $eloquentQuery[] = [$columName, $operatorMap[$operator], $value];
                            break;
                        default:
                            $eloquentQuery[] = [$columName, $operatorMap[$operator], $query[$operator]];
                            break;
                    }
                }
            }
        }

        return $eloquentQuery;
    }
}
