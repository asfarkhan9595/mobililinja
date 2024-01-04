<!-- larg modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Add new Outbound route</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="#" id="outboundForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="body demo-card">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-12">
                                        <label>Prepend</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="prepend"
                                                value="{{ old('prepend') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-12">
                                        <label>Prefix</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="prefix"
                                                value="{{ old('prefix') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label>Match pattern</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="match_pattern"
                                                value="{{ old('pattern') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label>Trunk</label>
                                        <div class="form-group">
                                            <select class="form-control" name="trunk_id">
                                                <option>Select Trunk</option>
                                                @foreach ($trunks as $key => $trunk)
                                                    <option value="{{ $key }}">{{ $trunk }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">

                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="modal-footer">
                                            <button class="btn btn-default mb-2" data-dismiss="modal"
                                                aria-label="Close">Cancel</button>
                                            <input type="submit" class="btn btn-outline-info mb-2"
                                                value="Save"></button>
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
            $('#outboundForm').validate({
                rules: {
                    prepend: {
                        required: true
                    },
                    prefix: {
                        required: true
                    },
                    match_pattern: {
                        required: true
                    },
                    trunk_id: {
                        required: true
                    }
                },
                messages: {
                    prepend: "Please enter the prepend",
                    prefix: "Please enter the prefix",
                    match_pattern: "Please enter the match pattern",
                    trunk_id: {
                        required: 'The field trunk is required.'
                    }
                },
                submitHandler: function(form) {
                    // Use AJAX to submit the form data
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('superadmin.outbounds.store') }}",
                        data: $(form).serialize(), // Serialize the form data
                        success: function(response) {
                            // Display a success message or redirect the user
                            if (response.errors) {
                                // Display the overall error message
                                showAutoDismissAlert('error', response.message, 5000);
                                // Iterate through each error and display them
                                for (var field in response.errors) {
                                    if (response.errors.hasOwnProperty(field)) {
                                        var errorMessages = response.errors[field];
                                        // Display individual error messages
                                        errorMessages.forEach(function(errorMessage) {
                                            showAutoDismissAlert('error',
                                                errorMessage, 5000);
                                        });
                                    }
                                }
                            } else {
                                $(form)[0].reset();
                                var alertHtml =
                                    '<div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">' +
                                    'Outboun created successfully' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                                $('#main-content .container-fluid').prepend(alertHtml);
                               
                                // Set a timeout to remove the alert after the specified duration
                                setTimeout(function() {
                                    $('.alert-dismissible').alert('close');
                                }, 5000);
                              
                                // Assuming you have a Laravel DataTable named "outbound-table"
                                window.LaravelDataTables["outbound-table"].ajax.reload();
                                // Close the modal if needed
                                $('.bd-example-modal-lg').modal('hide');
                            }
                        },
                        error: function(error) {
                            // Display an error message
                            showAutoDismissAlert('error', "Error submitting data", 5000);
                        }
                    });
                }
            });
        });
    </script>
@endpush
