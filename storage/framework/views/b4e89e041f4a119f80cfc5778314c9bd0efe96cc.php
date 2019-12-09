<?php $__env->startSection('content'); ?>
    <div class="header bg-gradient-logo-color pb-8 pt-5 pt-md-8"></div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-0">Purchase Order</h3>
                            </div>
                            <div class="col text-right">
                                <button id="addPO" class="btn btn-sm btn-success">Add New Purchase Order</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table" id="purchase-orders">
                                    <thead class="table-light table-flush">
                                        <tr class="text-center">
                                            <th>Reference Number</th>
                                            <th>Expected Delivery Date</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                                <tbody>
                                    <?php $__currentLoopData = $purchaseOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($order->reference_number); ?></td>
                                            <td><?php echo e($order->expected_delivery_date); ?></td>
                                            <td></td>
                                            <th></th>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPO">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Purchase Order</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <div class="modal-body">
                    <div class="input-group input-group-alternative mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Supplier</span>
                        </div>
                        <select name="supplier" id="supplierID" class="form-control">
                            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($supplier->id); ?>"><?php echo e($supplier->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="input-group input-group-alternative mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Delivery To</span>
                        </div>
                        <textarea name="delivery-address" id="deliveryAddress" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="input-group input-group-alternative mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Reference Number</span>
                        </div>
                        <input type="text" name="referenceNumber" id="referenceNumber" class="form-control">
                    </div>

                    <div class="input-group input-group-alternative mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Expected Delivery Date</span>
                        </div>
                        <input type="date" name="expectedDelDate" id="expectedDelDate" class="form-control">
                    </div>

                    <div class="input-group input-group-alternative mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Shipment Preference</span>
                            </div>
                            <input type="text" name="shipmentPreference" id="shipmentPreference" class="form-control">
                        </div>

                    <table class="table">
                        <thead class="table-light table-flush">
                            <tr class="text-center">
                                <th>Item</th>
                                <th>Rate</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="itemName" id="itemName" class="form-control"></td>
                                <td><input type="text" name="itemRate" id="itemRate" class="form-control"></td>
                                <td><input type="text" name="itemQuantity" id="itemQuantity" class="form-control"></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-sm btn-success" id="addItem">
                                        Add Item
                                    </button>
                                </td>
                            </tr>
                        </thead>
                        <tbody id="POItem">
                        </tbody>
                    </table>
                </div>
    
                <div class="modal-footer">
                    <button class="btn btn-success" id="savePO">Save</button>
                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>
    <script>
        $('#addPO').on('click', function() {
            $('#modalPO').modal('show');
        });

        $('#addItem').on('click', function() {
            let item = '<tr>'+
                '<td class="item-name">'+ $('#itemName').val() +'</td>' +
                '<td class="item-rate">'+ $('#itemRate').val() +'</td>' +
                '<td class="item-quantity">'+ $('#itemQuantity').val() +'</td>' +
                '<td class="item-total">'+ ($('#itemRate').val() * $('#itemQuantity').val()) +'</td>' +
            '</td>';

            $('#POItem').prepend(item);

            $('#itemName').val('');
            $('#itemRate').val('');
            $('#itemQuantity').val('');
        });
        
        $('#supplierID').on('change', function() {
            console.log($(this).find(':selected').attr('value'));
        });

        $('#savePO').on('click', function() {
            let inputItem = [];

            $('#POitem').find('tr').each(function (key, value) {
                $(this).find('td').each(function(key, value) {
                    inputItem.push({
                        item:'',
                        rate:'',
                        quantity:'',
                        total:''
                    });
                });
            })
            
            let input = {
                'reference_number': $('#referenceNumber').val(),
                'billing_address': $('#deliveryAddress').val(),
                'expected_delivery_date': $('#expectedDelDate').val(),
                'shipment_preference': $('#shipmentPreference').val(),
                'supplier_id': $('#supplierID').find(':selected').val(),
                'items': inputItem
            };

            console.log(input);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('supplier.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>