<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Add new PhoneBook</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="#" id="phonebookForm" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="body demo-card">
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-12">
                                        <label>First name</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="first_name" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label>Last name</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="last_name" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label>Phone number</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="phone_number"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label>Mobile number</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control"name="mobile_number"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label>Company</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="company" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label>Position</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control"name="position" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="modal-footer">
                                            <button class="btn btn-sm btn-default" data-dismiss="modal"
                                                aria-label="Close">Cancel</button>
                                            <input type="submit" class="btn btn-outline-info mb-2" value="Save">
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
            $('#phonebookForm').validate({
                rules: {
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    phone_number: {
                        required: true,
                        // maxlength: 1,
                        // number: true,
                        
                    },
                    mobile_number: {
                        required: true,
                        number: true,
                        // minlength: 10,
                        maxlength: 10

                    },
                    company: {
                        required: true
                    },
                    position: {
                        required: true
                    }
                },
                messages: {
                    first_name: "Please enter the your first name",
                    last_name: "Please enter the your last name",
                    phone_number: {
                        required: 'Please enter a mobile number',
                        // number: 'Please enter a valid numeric mobile number',
                        // minlength: 'Mobile number must be 10 digits long',
                        // maxlength: 'Mobile number must be 10 digits long'
                      
                    },
                    mobile_number: {
                        required: 'Please enter a mobile number',
                        number: 'Please enter a valid numeric mobile number',
                        minlength: 'Mobile number must be 10 digits long',
                        maxlength: 'Mobile number must be 10 digits long'
                        // Customize messages for additional rules if needed
                    },

                    company: "Please enter the company",
                    position: "Please enter the position"
                },
                submitHandler: function(form) {
                    // Use AJAX to submit the form data
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('customer.phonebooks.store') }}",
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
                                    'PhoneBook submitted successfully' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                                $('#main-content .container-fluid').prepend(alertHtml);
                                // Set a timeout to remove the alert after the specified duration
                                setTimeout(function() {
                                    $('.alert-dismissible').alert('close');
                                }, 5000);
                            }
                            window.LaravelDataTables["phone-book-table"].ajax.reload();
                            $('.bd-example-modal-lg').modal('hide');
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
