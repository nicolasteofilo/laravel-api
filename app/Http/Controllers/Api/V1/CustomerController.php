<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\CustomersFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\V1\Customer as CustomerResource;
use App\Http\Resources\V1\CustomerCollection as CustomerResourceCollection;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * @return CustomerResourceCollection
    */
    public function index(Request $request)
    {
        $filters = new CustomersFilter();
        $queryItems = $filters->transform($request);  // [['column', 'operator', 'value']]

        if(count($queryItems) < 1) {
            return new CustomerResourceCollection(Customer::paginate(10));
        }

        $customers = Customer::where($queryItems)->paginate(10);
        return new CustomerResourceCollection($customers->appends($request->query()));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    public function show(Customer $customer)
    {
        $customer = new CustomerResource($customer);
        return $customer;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
