<?php $__env->startSection('css'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.headers.inventoryCard1', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
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
                                                <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="supplier" data-id="<?php echo e($supplier->supplier_id, false); ?>">
                                                        <td>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p class="mb-0 supplier-name" data-id="<?php echo e($supplier->supplier_id, false); ?>">
                                                                        <?php echo e($supplier->name, false); ?>

                                                                    </p>
                                                                </div>
                                                                <div class="col text-right">
                                                                    <?php if(!$supplier->is_enabled): ?>
                                                                        <i class="fa fa-ban is-enabled" data-id="<?php echo e($supplier->supplier_id, false); ?>"></i>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                                            <h5 class="mb-0">Company Name: </h5>
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
    <?php echo $__env->make('supplier.new-supplier', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startPush('js'); ?>
<script>
    $('#addSupplier').on('click', function() {
        $('#addModalSupplier').modal('show');

        $('#addError').hide();
        $('#addSuccess'),hide();
        $('#addError').empty();
        $('#addSucces'),empty();
    });

    $('#saveSupplier').on('click', function() {
        $.ajax({
            url: '/suppliers',
            type: 'POST',
            data: {
                name: $('#modalAddName').val(),
                email: $('#modalAddEmail').val(),
                landline: $('#modalAddLandline').val(),
                fax: $('#modalAddFax').val(),
                mobile: $('#modalAddMobile').val(),
                payment_terms: $('#modalAddPaymentTerms').val(),
                company_address: $('#modalAddCompanyAddress').val(),
                billing_address: $('#modalAddBillingAddress').val(),
                supplier_type: $('#modalAddType').val(),
                remarks: $('#modalAddRemarks').val(),
                _token: '<?php echo csrf_token(); ?>'
            },
            success: function(data) {
                $('#modalAddName').val('');
                $('#modalAddEmail').val('');
                $('#modalAddLandline').val('');
                $('#modalAddFax').val('');
                $('#modalAddMobile').val('');
                $('#modalAddPaymentTerms').val('');
                $('#modalAddCompanyAddress').val('');
                $('#modalAddBillingAddress').val('');
                $('#modalAddType').val('');
                $('#modalAddRemarks').val('');

                $('#addSuccess').show();
                $('#addSuccess').text('Supplier was added');

                $('#suppliers > tbody ').prepend(
                    '<tr class="supplier" data-id="'+ data.supplier_id +'">' +
                        '<td>' +
                            '<div class="row">' +
                                '<div class="col">' +
                                    '<p class="mb-0 supplier-name" data-id="'+ data.supplier_id +'">'+ data.name +'</p>' +
                                '</div>' +
                            '</div>' +
                        '</td>' +
                    '</tr>'
                );
            },
            error: function(error) {
                $('#addError').show();

                let errors = error.responseJSON.errors;

                Object.keys(errors).forEach(function(key) { 
                    $('#addError').append(errors[key][0] + '<br>');
                });
            }
        });
    });

    $('.edit').on('click', function() {
        $('#supplierName').removeAttr('disabled');
        $('#supplierName').removeAttr('disabled');
        $('#supplierEmail').removeAttr('disabled');
        $('#supplierLandline').removeAttr('disabled');
        $('#supplierFax').removeAttr('disabled');
        $('#supplierMobile').removeAttr('disabled');
        $('#supplierCompanyAddress').removeAttr('disabled');
        $('#supplierBillingAddress').removeAttr('disabled');
        $('#supplierType').removeAttr('disabled');
        $('#supplierPaymentTerms').removeAttr('disabled');
        $('#supplierRemarks').removeAttr('disabled');

        $('.save').show();
        $('.edit').hide();
    });

    $('.disable').on('click', function() {
        let supplier = $('#supplierId').val();

        $.ajax({
            url: '/suppliers/' + supplier + '/state?enable=false',
            type: 'GET',
            success: function() {
                $('.enable').show();
                $('.disable').hide();
                $('.is-enabled[data-id='+ supplier +']').show();
            }
        });
    });

    $('.enable').on('click', function() {
        let supplier = $('#supplierId').val();

        $.ajax({
            url: '/suppliers/' + supplier + '/state?enable=true',
            type: 'GET',
            success: function() {
                $('.disable').show();
                $('.enable').hide();
                $('.is-enabled[data-id='+ supplier +']').hide();
            }
        });
    });


    $('.save').on('click', function() {
        let supplier = $('#supplierId').val();

        $.ajax({
            url: '/suppliers/' + supplier,
            type: 'POST',
            data: {
                'name': $('#supplierName').val(),
                'email': $('#supplierEmail').val(),
                'landline': $('#supplierLandline').val(),
                'fax': $('#supplierFax').val(),
                'mobile': $('#supplierMobile').val(),
                'payment_terms': $('#supplier').val(),
                'company_address': $('#supplierCompanyAddress').val(),
                'billing_address': $('#supplierBillingAddress').val(),
                'payment_terms': $('#supplierPaymentTerms').val(),
                'supplier_type': $('#supplierType').val(),
                'remarks': $('#supplierRemarks').val(),
                '_method': 'PUT',
                '_token': '<?php echo csrf_token(); ?>'
            },
            success: function(data) {
                $('#supplierName').attr('disabled', 'true');
                $('#supplierName').attr('disabled', 'true');
                $('#supplierEmail').attr('disabled', 'true');
                $('#supplierLandline').attr('disabled', 'true');
                $('#supplierFax').attr('disabled', 'true');
                $('#supplierMobile').attr('disabled', 'true');
                $('#supplierCompanyAddress').attr('disabled', 'true');
                $('#supplierBillingAddress').attr('disabled', 'true');
                $('#supplierPaymentTerms').attr('disabled', 'true');
                $('#supplierType').attr('disabled', 'true');
                $('#supplierRemarks').attr('disabled', 'true');

                $('.edit').show();
                $('.save').hide();
                $('.supplier-name[data-id='+ supplier +']').text(
                    $('#supplierName').val()
                );
            },
            error: function(error) {
                alert('Oops Look like something went wrong');
            }
        });
        
    });

    $(document).on('click', 'tr.supplier', function() {
        var selected = $(this).hasClass('active');

        $('tr.supplier').removeClass('active');

        if(!selected)
            $(this).addClass('active');
        
        let id = $(this).data('id');

        getSupplier(id);
    });

    function getSupplier(supplier) {
        $.ajax({
            url: '/suppliers/' + supplier,
            type: 'GET',
            success: function(data) {
                $('#addContact').removeAttr('disabled');
                $('#addContact').attr('data-id', data.supplier_id);
                $('#supplierName').val(data.name);
                $('#supplierEmail').val(data.email);
                $('#supplierLandline').val(data.landline);
                $('#supplierFax').val(data.fax);
                $('#supplierMobile').val(data.mobile);
                $('#supplierCompanyAddress').val(data.company_address);
                $('#supplierBillingAddress').val(data.billing_address);
                $('#supplierType').val(data.supplier_type);
                $('#supplierPaymentTerms').val(data.payment_terms);
                $('#supplierRemarks').val(data.remarks);
                $('#supplierId').val(data.supplier_id);

                if (data.is_enabled) {
                    $('.disable').show();
                    $('.enable').hide();
                } else {
                    $('.enable').show();
                    $('.disable').hide();
                }

                let contacts = '';

                $('#contacts').empty();

                data.contacts.forEach(contact => {
                    contacts += '<div class="card shadow">' +
                        '<div class="card-header">' +
                            '<h3 class="mb-0">'+ contact.name +'</h3>' +
                        '</div>' +
                        '<div class="card-body">' +
                            '<div class="table-responsive">' +
                                '<table class="table">' +
                                    '<tbody>' +
                                        '<tr>' +
                                            '<th>Mobile: </th>' +
                                            '<td>' + contact.mobile + '</td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<th>Landline: </th>' +
                                            '<td>' + contact.landline  + '</td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<th>Email: </th>' +
                                            '<td>'+ contact.email +'</td>' +
                                        '</tr>' +
                                        '<tr>' +
                                            '<th>Fax: </th>' +
                                            '<td>'+ contact.fax +'</td>' +
                                        '</tr>' +
                                    '</tbody>' +
                                '</table>' +
                            '</div>' +
                        '</div>' +
                    '</div>'
                });

                let items = '';

                $('#supplier-items').empty();

                data.items.forEach(item => {
                    items += '<tr>' +
                        '<td>'+ item.item +'</td>' +
                        '<td>'+ item.rate +'</td>' +
                    '</tr>';
                });

                $('#supplier-items').append(items);

                $('#contacts').append(contacts);
            },
            eeror: function(error) {
                alert('Opps! Something went wrong please refresh the website');
            }
        });
    }
</script>

<script>
    $('#addItem').on('click', function() {
        $('#addSupplierItem').modal('show');
    });

    $('#saveSupplierItem').on('click', function() {
        $.ajax({
            url: '/suppliers/' + $('#addContact').data('id') + '/supplier-item',
            type: 'POST',
            data: {
                item: $('#supplierItem').val(),
                rate: $('#supplierRate').val(),
                _token: '<?php echo csrf_token(); ?>'
            },
            success: function(data) {
                $('#supplier-items').append(
                    '<tr>' +
                        '<td>' + data.item + '</td>' +
                        '<td>' + data.rate + '</td>' +
                    '</tr>'
                );

                $('#addSupplierItem').modal('hide');
            }
        });
    });
</script>

<script>
    $('#addContact').on('click', function() {
        $('#addModalContacts').modal('show');
    });

    $('#saveContact').on('click', function() {
        $.ajax({
            url: '/suppliers/' + $('#addContact').data('id') + '/contact-person',
            type: 'POST',
            data: {
                name: $('#contactAddName').val(),
                fax: $('#contactAddFax').val(),
                landline: $('#contactAddLandline').val(),
                mobile: $('#contactAddMobile').val(),
                email: $('#contactAddEmail').val(),
                _token: '<?php echo csrf_token(); ?>'
            },
            success: function(data) {
                let newcontact = '';

                $('#contactAddName').val();
                $('#contactAddFax').val();
                $('#contactAddLandline').val();
                $('#contactAddMobile').val();
                $('#contactAddEmail').val();

                $('#addModalContacts').modal('hide');

                newcontact = '<div class="card shadow">' +
                    '<div class="card-header">' +
                        '<h3 class="mb-0">'+ data.name +'</h3>' +
                    '</div>' +
                    '<div class="card-body">' +
                        '<div class="table-responsive">' +
                            '<table class="table">' +
                                '<tbody>' +
                                    '<tr>' +
                                        '<th>Mobile: </th>' +
                                        '<td>' + data.mobile + '</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                        '<th>Landline: </th>' +
                                        '<td>' + data.landline  + '</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                        '<th>Email: </th>' +
                                        '<td>'+ data.email +'</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                        '<th>Fax: </th>' +
                                        '<td>'+ data.fax +'</td>' +
                                    '</tr>' +
                                '</tbody>' +
                            '</table>' +
                        '</div>' +
                    '</div>' +
                '</div>';

                $('#contacts').prepend(newcontact);
            },
            error: function(error) {

            }
        })
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>