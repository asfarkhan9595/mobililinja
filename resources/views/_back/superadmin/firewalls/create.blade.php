<!-- larg modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Add new network</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="#" method="post" id="addFirewallNetwork">
                @csrf
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="body demo-card">
                                    <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <label>Network/Host</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="network_host" id="networkHost">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <label>Assigned Zone</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="assigned_zone" id="assignedZone">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <label>Customer</label>
                                        <div class="form-group">
                                            <select class="form-control" id="customer" name="customer">
                                                    <option>Select customer</option>
                                                @foreach($customers as $key => $customer )
                                                    <option value="{{$key}}"> {{ $customer }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <label>Description</label>
                                        <div class="form-group">
                                            <textarea type="text" class="form-control" name="description" id="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default mb-2" data-dismiss="modal" aria-label="Close">Cancel</button>
                    <input type="submit" class="btn btn-outline-info mb-2"
                           value="Save Firewall Network">
                </div>
            </form>
        </div>
    </div>
</div>

@push('page_script')
    <script>
        $(document).ready(function () {
            $("#addFirewallNetwork").validate({
                rules: {
                    networkHost: {
                        required: true,
                        minlength: 3,
                    },
                    assignedZone: {
                        required: true,
                        minlength: 3,
                    },
                    customer: {
                        required: true,
                    },
                    description: {
                        required: true,
                        minlength: 3,
                    },
                },
                messages: {
                    networkHost: {
                        required: "Please enter network/host",
                        minlength: "Must be at least 3 characters long",
                    },
                    assignedZone: {
                        required: "Please enter assigned zone",
                        minlength: "Must be at least 3 characters long",
                    },
                    customer: {
                        required: "Please select customer",
                    },
                    description: {
                        required: "Please enter description",
                        minlength: "Must be at least 3 characters long",
                    },
                },
                submitHandler: function (form) {
                    if ($(form).valid()) {
                        // If the form is valid, serialize the data and submit via AJAX
                        $.ajax({
                            type: "POST",
                            url: "{{ route('superadmin.firewalls.store') }}",
                            data: $(form).serialize(),
                            success: function (response) {
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
                                    if(response.status == 'error') {
                                        var alertHtml = '<div class="alert alert-danger mt-4 alert-dismissible fade show" role="alert">' + 'Error submitting data' +
                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                                        $('#main-content .container-fluid').prepend(alertHtml);
                                        // Set a timeout to remove the alert after the specified duration
                                        setTimeout(function() {
                                            $('.alert-dismissible').alert('close');
                                        }, 5000);
                                    } else {
                                        var alertHtml = '<div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">' + 'Data submitted successfully' +
                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                                        $('#main-content .container-fluid').prepend(alertHtml);
                                        // Set a timeout to remove the alert after the specified duration
                                        setTimeout(function () {
                                            $('.alert-dismissible').alert('close');
                                        }, 5000);
                                    }
                                }
                                window.LaravelDataTables["customer-table"].ajax.reload();
                                $('.bd-example-modal-lg').modal('hide');
                            },
                            error: function (error) {
                                var alertHtml = '<div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">' + 'Error submitting data' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                                $('#main-content .container-fluid').prepend(alertHtml);
                                // Set a timeout to remove the alert after the specified duration
                                setTimeout(function() {
                                    $('.alert-dismissible').alert('close');
                                }, 5000);
                            }
                        });
                    } else {
                        var alertHtml = '<div class="alert alert-danger mt-4 alert-dismissible fade show" role="alert">' + 'Please fill the required field' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                        $('#main-content .container-fluid').prepend(alertHtml);
                        // Set a timeout to remove the alert after the specified duration
                        setTimeout(function() {
                            $('.alert-dismissible').alert('close');
                        }, 5000);
                    }
                }
            });

            $("#submitBtn").on("click", function () {

            });
        });
    </script>
@endpush
