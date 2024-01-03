<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Add new PSTN pool</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="#" id="pstnForm">
            @csrf
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="body demo-card">
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-12">
                                    <label>Provider</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="provider" value="{{ old('provider') }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <label>Number pool</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="number_pool" value="{{ old('number_pool') }}">
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
                                <div class="col-lg-4 col-md-12">

                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="modal-footer">
                                        <button class="btn btn-default mb-2" data-dismiss="modal" aria-label="Close">Cancel</button>
                                        <button class="btn btn-outline-info mb-2">Save</button>
                                    </div>
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
$(document).ready(function() {
    $('#pstnForm, #editPSTNForm').validate({
        rules: {
            provider: 'required',
            number_pool: 'required',
            customer_id: {
                required: true
            }
        },
        messages: {
            provider: 'The field provider is required.',
            number_pool: 'The field number pool is required.',
            customer_id: {
                required: 'The field customer is required.'
            }
        },
        submitHandler: function(form) {
            $.ajax({
                type: 'POST',
                url: "{{ route('superadmin.pstn.store')}}",
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
                    window.LaravelDataTables["pstn-table"].ajax.reload();
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
