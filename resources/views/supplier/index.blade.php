@extends('supplier.layout.dashboard')

@section('css')
    <style>
        tr.supplier {
            cursor: pointer;
        }

        tr.active, tr.supplier:hover {
            background: #0D5007;
            color: white;
        }
        .suppliers-list {
            height: 500px;
            overflow-y: scroll;
        }

        #contacts {
            height: 400px;
            overflow-y: scroll;
        }
    </style>
@endsection

@section('content')
    <div class="header bg-gradient-logo-color pb-8 pt-5 pt-md-8">
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-0">Suppliers</h3>
                            </div>
                            <div class="col text-right">
                                <button id="addSupplier" class="btn btn-sm btn-success">Add New Supplier</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="card shadow">
                                    <div class="table-responsive suppliers-list">
                                        <table class="table" id="suppliers">
                                            <thead class="table-light table-flush">
                                                <tr class="text-center">
                                                    <th scope="col">List of Suppliers</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($suppliers as $supplier)
                                                    <tr class="supplier" data-id="{{ $supplier->supplier_id }}">
                                                        <td>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p class="mb-0 supplier-name" data-id="{{ $supplier->supplier_id }}">
                                                                        {{ $supplier->name }}
                                                                    </p>
                                                                </div>
                                                                <div class="col text-right">
                                                                    @if (!$supplier->is_enabled)
                                                                        <i class="fa fa-ban is-enabled" data-id="{{ $supplier->supplier_id }}"></i>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-8">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col">
                                                <h4 class="mb-0">Supplier Info</h4>
                                            </div>
                                            <div class="col text-right">
                                                <button class="btn btn-sm btn-success edit">Edit</button>
                                                <button style="display: none;" class="btn btn-sm btn-primary save">Save</button>
                                                <button class="btn btn-sm btn-danger disable">Disable</button>
                                                <button style="display: none;" class="btn btn-sm btn-success enable">Enable</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-bordered">
                                                <tbody>
                                                    <input type="hidden" name="supplier-id" id="supplierId" value="">
                                                    <tr>
                                                        <th scope="col">
                                                            <h5 class="mb-0">Name: </h5>
                                                        </th>
                                                        <td>
                                                            <input class="form-control" type="text" name="supplier-name" id="supplierName" value="" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr style="display: none;">
                                                        <th>
                                                            <h5 class="mb-0">Email: </h5>
                                                        </th>
                                                        <td>
                                                            <input type="text" name="supplier-email" id="supplierEmail" class="form-control" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr style="display: none;">
                                                        <th>
                                                            <h5 class="mb-0">Landline: </h5>
                                                        </th>
                                                        <td>
                                                            <input type="text" name="supplier-landline" id="supplierLandline" class="form-control" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr style="display: none;">
                                                        <th>
                                                            <h5 class="mb-0">Fax: </h5>
                                                        </th>
                                                        <td>
                                                            <input type="text" name="supplier-fax" id="supplierFax" class="form-control" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr style="display: none;">
                                                        <th>
                                                            <h5 class="mb-0">Mobile: </h5>
                                                        </th>
                                                        <td>
                                                            <input type="text" name="supplier-mobile" id="supplierMobile" class="form-control" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <h5 class="mb-0">Company Address: </h5>
                                                        </th>
                                                        <td>
                                                            <input type="text" name="supplier-company-address" id="supplierCompanyAddress" class="form-control" value="" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <h5 class="mb-0">Billing Address: </h5>
                                                        </th>
                                                        <td>
                                                            <input type="text" name="supplier-billing-address" id="supplierBillingAddress" class="form-control" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <h5 class="mb-0">Payment Terms</h5>
                                                        </th>
                                                        <td>
                                                            <input type="text" name="supplier-payment-terms" id="supplierPaymentTerms" class="form-control" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <h5 class="mb-0">Type: </h5>
                                                        </th>
                                                        <td>
                                                            <input type="text" name="supplier-type" id="supplierType" class="form-control" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <h5 class="mb-0">Remarks: </h5>
                                                        </th>
                                                        <td>
                                                            <input type="text" name="supplier-remarks" id="supplierRemarks" class="form-control" disabled>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="card shadow" style="margin-top: 20px">
                                    <div class="card-header">
                                        <div class="col">
                                            <h4 class="mb-0">
                                                Contact Persons
                                            </h4>
                                        </div>
                                        <div class="col text-right">
                                            <button id="addContact" class="btn btn-sm btn-success" disabled>Add Contact Person</button>
                                        </div>
                                    </div> 
                                    <div class="card-body" id="contacts">
                                        
                                    </div>
                                </div>

                                <div class="card shadow" style="margin-top: 20px">
                                    <div class="card-header">
                                        <div class="col">
                                            <h4 class="mb-0">
                                                Supplier Item
                                            </h4>
                                        </div>
                                        <div class="col text-right">
                                            <button id="addItem" class="btn btn-sm btn-success">Add Item</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Item</th>
                                                        <th>Rate</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="supplier-items">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('supplier.new-supplier')
@stop

@include('supplier.js')