<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Controllers\Controller;

use App\Http\Resources\V1\Invoice as InvoiceResource;
use App\Http\Resources\V1\InvoiceCollection as InvoiceResourceCollection;

class InvoiceController extends Controller
{
    public function index()
    {
        return new InvoiceResourceCollection(Invoice::paginate());    }

    public function create()
    {
        //
    }

    public function store(StoreInvoiceRequest $request)
    {
        //
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
