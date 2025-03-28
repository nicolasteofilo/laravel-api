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
        $filterItems = $filters->transform($request);  // [['column', 'operator', 'value']]
        $includeInvoices = $request->query('includeInvoices');

        $customers = Customer::where($filterItems);

        if($includeInvoices) {
            $customers = $customers->with('invoices');
        }

        return new CustomerResourceCollection($customers->paginate(10)->appends($request->query()));
    }

    public function create()
    {
        //
    }

    public function store(StoreCustomerRequest $request)
    {
        //
    }

    public function show(Customer $customer, Request $request)
    {
        $includeInvoices = $request->query('includeInvoices');

        if ($includeInvoices) {
            $customer->loadMissing('invoices');
        }

        return new CustomerResource($customer);
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
