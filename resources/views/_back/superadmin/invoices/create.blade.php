<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Add new Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="#" id="addInvoiceForm" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="body demo-card">
                                <div class="col-md-12">
                                    <div class="body demo-card">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-12">
                                                <label>Invoice Number</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="number" value="{{ old('number') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <label>Invoice Date</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control datepicker" name="date" value="{{ old('date') }}" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <label>Customer</label>
                                                <div class="form-group">
                                                    <select class="form-control" name="customer_id">
                                                        <option>Select Customer</option>
                                                        @foreach($customers as $key => $customer)
                                                            <option value="{{ $key }}">{{ $customer }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-12">
                                                <label>Payment Mode</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="payment_mode" value="{{ old('payment_mode') }}" placeholder="e.g. Cash, PayPal, Other">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <label>Status</label>
                                                <div class="form-group">
                                                    <select class="form-control" name="status">
                                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <label>Amount</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="amount" value="{{ old('amount') }}" id="amount">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default mb-2" data-dismiss="modal"
                                            aria-label="Close">Cancel</button>
                                        <input type="submit" class="btn btn-outline-info mb-2"
                                            value="Save"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('page_script')
<script>
$(document).ready(function () {
    $('#addInvoiceForm').validate({
        rules: {
            number: {
                required: true,
            },
            date: {
                required: true,
            },
            customer_id: {
                required: true,
            },
            payment_mode: {
                required: true,
            },
            status: {
                required: true,
            },
            amount: {
                required: true,
                number: true, // Assuming 'amount' is a numeric field
            },
        },
        messages: {
            number: {
                required: "Please enter the invoice number",
            },
            date: {
                required: "Please select the invoice date",
            },
            customer_id: {
                required: "Please enter the customer ID",
            },
            payment_mode: {
                required: "Please enter the payment mode",
            },
            status: {
                required: "Please select the status",
            },
            amount: {
                required: "Please enter the invoice amount",
                number: "Please enter a valid numeric amount",
            },
        },
        submitHandler: function(form) {
            // Use AJAX to submit the form data
            $.ajax({
                type: 'POST',
                url: "{{ route('superadmin.invoices.store')}}",
                data: $(form).serialize(), // Serialize the form data
                success: function(response) {
                    // Display a success message or redirect the user
                    if (response.errors) {
                    // Display the overall error message
                        showAutoDismissAlert('error',response.message,5000);
                        // Iterate through each error and display them
                        for (var field in response.errors) {
                            if (response.errors.hasOwnProperty(field)) {
                                var errorMessages = response.errors[field];
                                // Display individual error messages
                                errorMessages.forEach(function (errorMessage) {
                                    // $('#main-content .container-fluid').prepend('<li>' + errorMessage + '</li>');
                                    showAutoDismissAlert('error',errorMessage,5000);
                                });
                            }
                        }
                    }
                    else {
                        var alertHtml = '<div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">' + 'Data submitted successfully' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                        $('#main-content .container-fluid').prepend(alertHtml);
                        // Set a timeout to remove the alert after the specified duration
                        setTimeout(function() {
                            $('.alert-dismissible').alert('close');
                        }, 5000);
                    }
                    window.LaravelDataTables["invoice-table"].ajax.reload();
                    $('.bd-example-modal-lg').modal('hide');
                },
                error: function(error) {
                    // Display an error message
                    showAutoDismissAlert('error',"Error submitting data", 5000);
                }
            });
        }
    });
});
</script>
@endpush
