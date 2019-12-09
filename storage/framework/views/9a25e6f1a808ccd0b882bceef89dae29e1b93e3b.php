<div class="modal fade" id="addModalSupplier">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background: #F5F7F9;">
            <div class="modal-header">
                <h4 class="modal-title">New Supplier</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" style="display:none;" id="addSuccess"></div>
                <div class="alert alert-danger" style="display:none;" id="addError"></div>

                <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Name</span>
                    </div>
                    <input type="text" class="form-control form-control-alternative" value="" id="modalAddName">
                </div>

                <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Email</span>
                    </div>
                    <input type="email" class="form-control form-control-alternative" value="" id="modalAddEmail">
                </div>
                
                <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Landline</span>
                    </div>
                    <input type="text" class="form-control form-control-alternative" value="" id="modalAddLandline">
                </div>
                
                <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Fax</span>
                    </div>
                    <input type="text" class="form-control form-control-alternative" value="" id="modalAddFax">
                </div>
                
                <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Mobile</span>
                    </div>
                    <input type="text" class="form-control form-control-alternative" value="" id="modalAddMobile">
                </div>
                
                <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Company Address</span>
                    </div>
                    <input type="text" class="form-control form-control-alternative" value="" id="modalAddCompanyAddress">
                </div>
                
                <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Billing Address</span>
                    </div>
                    <input type="text" class="form-control form-control-alternative" value="" id="modalAddBillingAddress">
                </div>
                
                <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Payment Terms</span>
                    </div>
                    <input type="text" class="form-control form-control-alternative" value="" id="modalAddPaymentTerms">
                </div>
                
                <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Type</span>
                    </div>
                    <select name="modalAddType" id="modalAddType" class="form-control form-control-alternative">
                        <option value="inventory">Inventory</option>
                        <option value="service">Service</option>
                        <option value="equpment">Equipment</option>
                    </select>
                </div>
                
                <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Remarks</span>
                    </div>
                    <input type="text" class="form-control form-control-alternative" value="" id="modalAddRemarks">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="saveSupplier">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addModalContacts">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Contact Person</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
    
            <div class="modal-body">
                <div class="alert alert-success" style="display:none;" id="addContactSuccess"></div>
                <div class="alert alert-danger" style="display:none;" id="addContactError"></div>

                <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Name</span>
                    </div>
                    <input type="text" required class="form-control form-control-alternative" value="" id="contactAddName">
                </div>
                
                <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Mobile</span>
                    </div>
                    <input type="text" required class="form-control form-control-alternative" value="" id="contactAddMobile">
                </div>
                
                <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Landline</span>
                    </div>
                    <input type="text" required class="form-control form-control-alternative" value="" id="contactAddLandline">
                </div>
                
                <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Email</span>
                    </div>
                    <input type="text" required class="form-control form-control-alternative" value="" id="contactAddEmail">
                </div>
                
                <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Fax</span>
                    </div>
                    <input type="text" required class="form-control form-control-alternative" value="" id="contactAddFax">
                </div>
            </div>
    
            <div class="modal-footer">
                <button class="btn btn-success" id="saveContact">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addSupplierItem">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Supplier Item</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <div class="modal-body">
                <div class="alert alert-success" style="display:none;" id="addItemSuccess"></div>
                <div class="alert alert-danger" style="display:none;" id="addItemError"></div>

                <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Item</span>
                    </div>
                    <input type="text" required class="form-control form-control-alternative" value="" id="supplierItem">
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success" id="saveSupplierItem">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>