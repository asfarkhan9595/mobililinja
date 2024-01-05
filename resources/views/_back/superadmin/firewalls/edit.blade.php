<div id="myLargeModalText" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Edit network</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="#" method="post" id="editFirewallNetwork">
                @csrf
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="body demo-card">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <input type="hidden"  name="id">
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
                    <input type="submit" id="saveBtn" class="btn btn-outline-info mb-2"
                           value="Save Firewall Network">
                </div>
            </form>
        </div>
    </div>
</div>

@push('page_script')
    <script>
        $(document).ready(function () {
            $("#editFirewallNetwork").validate({
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

            function fetchFirewallNetworkData(id) {
                $.ajax({
                    url: '{{ route("superadmin.firewalls.edit", ["firewall" => '__id__']) }}'.replace('__id__',id),
                    method: 'GET',
                    success: function(response) {
                        // Populate the modal input field with the fetched data
                        $('#myLargeModalText [name="id"]').val(response.data.id);
                        $('#myLargeModalText [name="network_host"]').val(response.data.network_host);
                        $('#myLargeModalText [name="assigned_zone"]').val(response.data.assigned_zone);
                        $('#myLargeModalText [name="description"]').val(response.data.description);
                        $('#myLargeModalText [name="customer"]').val(response.data.customer_id);
                    },
                    error: function(xhr, status, error) {
                        // Handle error scenarios
                        console.error(error);
                    }
                });
            }
            $('body').on('click', '.editBtn', function() {
                const id = $(this).attr('data-record-id');
                // Call the function to fetch data via AJAX
                fetchFirewallNetworkData(id);
            });
            $('#saveBtn').on('click', function(e) {
                e.preventDefault();
                const id = $('#myLargeModalText [name="id"]').val();
                if($('#editFirewallNetwork').valid()) {
                    // Perform an AJAX POST request to update the data
                    $.ajax({
                        url: '{{ route("superadmin.firewalls.update",['firewall' => '__id__']) }}'.replace('__id__',id),
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: "PUT",
                            network_host: $('#myLargeModalText [name="network_host"]').val(),
                            assigned_zone: $('#myLargeModalText [name="assigned_zone"]').val(),
                            description: $('#myLargeModalText [name="description"]').val(),
                            customer: $('#myLargeModalText [name="customer"]').val(),
                        },
                        success: function(response) {
                            // Handle the successful update
                            if (response.errors) {
                                // Display the overall error message
                                $('#main-content .container-fluid').prepend('<li>' + response.message + '</li>');
                                // Iterate through each error and display them
                                for (var field in response.errors) {
                                    if (response.errors.hasOwnProperty(field)) {
                                        var errorMessages = response.errors[field];
                                        // Display individual error messages
                                        errorMessages.forEach(function (errorMessage) {
                                            $('#main-content .container-fluid').prepend('<li>' + errorMessage + '</li>');
                                        });
                                    }
                                }
                            } else {
                                var alertHtml = '<div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">' + 'Data updated successfully' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                                $('#main-content .container-fluid').prepend(alertHtml);
                                // Set a timeout to remove the alert after the specified duration
                                setTimeout(function() {
                                    $('.alert-dismissible').alert('close');
                                }, 5000);

                                $('#myLargeModalText').modal('hide');
                            }
                            window.LaravelDataTables["firewallnetwork-table"].ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            // Handle error scenarios
                            console.error(error);
                        }
                    });
                }
            });
        });
    </script>
@endpush

