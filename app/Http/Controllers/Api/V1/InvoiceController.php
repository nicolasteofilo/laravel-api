<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\InvoicesFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Requests\V1\Invoice\BulkStoreInvoiceRequest;
use App\Http\Resources\V1\Invoice as InvoiceResource;
use App\Http\Resources\V1\InvoiceCollection as InvoiceResourceCollection;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $filters = new InvoicesFilter();
        $filterItems = $filters->transform($request);  // [['column', 'operator', 'value']]

        if(count($filterItems) < 1) {
            return new InvoiceResourceCollection(Invoice::paginate());
        }

        $invoices = Invoice::where($filterItems)->paginate(10);
        return new InvoiceResourceCollection($invoices->appends($request->query()));
    }

    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    public function bulkStore(BulkStoreInvoiceRequest $request)
    {
        $bulkInvoices = collect($request->all())->map(fn($arr) => Arr::except($arr, ['customerId', 'billedDate', 'paidDate']));

        Invoice::insert($bulkInvoices->toArray());
        return response()->json([
            'message' => 'Invoices created successfully',
        ], 201);
    }

    public function show(Invoice $invoice)
    {
        $invoice = new InvoiceResource($invoice);
        return $invoice;
    }

    public function edit(Invoice $invoice)
    {
        //
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    public function destroy(Invoice $invoice)
    {
        //
    }
}
