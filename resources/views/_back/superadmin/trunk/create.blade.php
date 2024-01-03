<!-- larg modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Add new Trunk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="#" id="trunkForm" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="body demo-card">
                                <ul class="nav nav-tabs3 table-nav">
                                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab"
                                            href="#General">General</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="General">
                                        <div class="col-md-12">
                                            <div class="body demo-card">
                                                <div class="row clearfix">
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Trunk name</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="tname"
                                                                value="{{ old('tname') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Description</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                name="description" value="{{ old('description') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Secret</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="secret"
                                                                value="{{ old('secret') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Authentication</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                name="authentication"
                                                                value="{{ old('authentication') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Registration</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                name="registration" value="{{ old('registration') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>SIP Server</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="sip_server"
                                                                value="{{ old('sip_server') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>SIP Server Port</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                name="sip_secret_port"
                                                                value="{{ old('sip_secret_port') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Context</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="context"
                                                                value="{{ old('context') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Transport</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="transport"
                                                                value="{{ old('transport') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default mb-2" data-dismiss="modal"
                                            aria-label="Close">Cancel</button>
                                        <input type="submit" class="btn btn-outline-info mb-2" value="Save"></button>
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
            $('#trunkForm').validate({
                rules: {
                    tname: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    secret: {
                        required: true
                    },
                    authentication: {
                        required: true
                    },
                    registration: {
                        required: true
                    },
                    sip_server: {
                        required: true
                    },
                    sip_secret_port: {
                        required: true
                    },
                    context: {
                        required: true
                    },
                    transport: {
                        required: true
                    },
                },
                messages: {
                    tname: "Please enter the trunk nameeee",
                    description: "Please enter the description",
                    secret: "Please enter the secret",
                    authentication: "Please enter the authentication",
                    registration: "Please enter the registration",
                    sip_server: "Please enter the SIP server",
                    sip_secret_port: "Please enter the SIP secret port",
                    context: "Please enter the context",
                    transport: "Please enter the transport",
                },
                submitHandler: function(form) {
                    // Use AJAX to submit the form data
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('superadmin.trunks.store') }}",
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
                                var alertHtml =
                                    '<div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">' +
                                    'Data submitted successfully' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                                $('#main-content .container-fluid').prepend(alertHtml);

                                // Set a timeout to remove the alert after the specified duration
                                setTimeout(function() {
                                    $('.alert-dismissible').alert('close');
                                }, 5000);

                                // Reload the data table after successful creation
                                window.LaravelDataTables["trunk-table"].ajax.reload();
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
