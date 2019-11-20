@section('js')
    <script>
        $('#add-supplier').on('click', function() {
            alert('test'); 
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
                    '_token': '{!! csrf_token() !!}'
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
                            '<td>' +
                                '<label class="badge ' + item.is_active ? 'badge-success' : 'badge-danger' + '">' + item.is_active ? 'Active' : 'Inactive' + '</label>' +
                            '</td>' +
                            '<td>' +
                                '<button class="btn btn-sm btn-danger">' +
                                    '<i class="fa fa-trash"></i>' +
                                '</button>' +
                            '</td>' +
                        '</tr>';
                    });

                    $('#contacts').append(contacts);
                },
                eeror: function(error) {
                    alert('Opps! Something went wrong please refresh the website');
                }
            });
        }
    </script>
@stop