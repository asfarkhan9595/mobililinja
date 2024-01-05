@extends('layouts._back')

@section('title', 'Manage PhoneBook')

@push('page_style')
    <style>
        td.details-control {
            background: url('../assets/images/details_open.png') no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url('../assets/images/details_close.png') no-repeat center center;
        }

        .demo-card label {
            display: block;
            position: relative;
        }

        .demo-card .col-lg-4 {
            margin-bottom: 30px;
        }
    </style>
@endpush

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h1>PhoneBooks</h1>
            </div>
            @if (auth()->user()->hasPermission('create-phonebook'))
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal"
                        data-target=".bd-example-modal-lg">Add new
                    </button>
                </div>
            @endif
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs3 table-nav">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#PhoneBook">PhoneBooks</a>
                    </li>
                </ul>
                <div class="tab-content mt-0">
                    <div class="tab-pane show active" id="PhoneBook">
                        <div class="table-responsive body">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('_back.customer.phonebooks.create')
    @include('_back.customer.phonebooks.edit')
    @include('_back.customer.phonebooks.delete')
@endsection



@push('page_script')
    <!-- Include the necessary DataTables scripts here -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        function fetchPhoneBookData(id) {
            $.ajax({
                url: "{{ route('customer.phonebooks.edit', ['phonebook' => '__id__']) }}".replace('__id__', id),
                method: 'GET',
                success: function(response) {

                    // Populate the modal input fields with the fetched data
                    $('#myLargeModalText [name="id"]').val(response.data.id);
                    $('#myLargeModalText [name="first_name"]').val(response.data.first_name);
                    $('#myLargeModalText [name="last_name"]').val(response.data.last_name);
                    $('#myLargeModalText [name="phone_number"]').val(response.data.phone_number);
                    $('#myLargeModalText [name="mobile_number"]').val(response.data.mobile_number);
                    $('#myLargeModalText [name="company"]').val(response.data.company);
                    $('#myLargeModalText [name="position"]').val(response.data.position);

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
            fetchPhoneBookData(id);
        });

        $('#saveBtn').on('click', function(e) {
            e.preventDefault();
            const id = $('#myLargeModalText [name="id"]').val();
            if ($('#phonebookEditForm').valid()) {
                // Perform an AJAX POST request to update the data
                $.ajax({
                    url: "{{ route('customer.phonebooks.update', ['phonebook' => '__id__']) }}".replace(
                        '__id__', id),
                    type: "POST", // Change to PUT
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT', // Add this line for Laravel to recognize it as a PUT request
                        first_name: $('#myLargeModalText [name="first_name"]').val(),
                        last_name: $('#myLargeModalText [name="last_name"]').val(),
                        phone_number: $('#myLargeModalText [name="phone_number"]').val(),
                        mobile_number: $('#myLargeModalText [name="mobile_number"]').val(),
                        company: $('#myLargeModalText [name="company"]').val(),
                        position: $('#myLargeModalText [name="position"]').val(),
                    },
                    success: function(response) {
                        // Handle the successful update
                        if (response.errors) {
                            // Display the overall error message
                            $('#main-content .container-fluid').prepend('<li>' + response.message +
                                '</li>');
                            // Iterate through each error and display them
                            for (var field in response.errors) {
                                if (response.errors.hasOwnProperty(field)) {
                                    var errorMessages = response.errors[field];
                                    // Display individual error messages
                                    errorMessages.forEach(function(errorMessage) {
                                        $('#main-content .container-fluid').prepend('<li>' +
                                            errorMessage + '</li>');
                                    });
                                }
                            }
                        } else {
                            var alertHtml =
                                '<div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">' +
                                'PhoneBook updated successfully' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                            $('#main-content .container-fluid').prepend(alertHtml);
                            // Set a timeout to remove the alert after the specified duration
                            setTimeout(function() {
                                $('.alert-dismissible').alert('close');
                            }, 5000);

                            $('#myLargeModalText').modal('hide');
                        }
                       
                        window.LaravelDataTables["phone-book-table"].ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error scenarios
                        console.error(error);
                    }
                });
            }
        });
        $('#phonebookEditForm').validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                phone_number: {
                    required: true,
                    // digits: true
                },
                mobile_number: {
                    required: true,
                    digits: true
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
                phone_number: "Please enter the phone number",
                mobile_number: "Please enter the mobile number",
                company: "Please enter the company",
                position: "Please enter the position"
            },
            errorPlacement: function(error, element) {
               
                error.insertAfter(element); 
            },
            // Add any other options or callback functions as needed
        });

        function deletePhoneBook(id) {
            
            $.ajax({
                url: "{{ route('customer.phonebooks.destroy', ['phonebook' => '__id__']) }}".replace('__id__', id),
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    var alertHtml =
                        '<div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">' +
                        'PhoneBook deleted successfully' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                    $('#main-content .container-fluid').prepend(alertHtml);
                    // Set a timeout to remove the alert after the specified duration
                    setTimeout(function() {
                        $('.alert-dismissible').alert('close');
                    }, 5000);
                  
                    window.LaravelDataTables["phone-book-table"].ajax.reload();
                },
                error: function(error) {
                    console.log(error.responseJSON.message);
                }
            });
        }

        // Open the confirm modal when needed
        $('body').on('click', '.deleteBtn', function() {
            let itemId = $(this).attr('data-record-id');
            // Attach the ID to the delete button
            $('#confirmDeleteBtn').attr('item-id', itemId);
            // Show the confirm modal
            $('#exampleModalCenter').modal('show');
        });

        // Handle the delete action when the user clicks "Delete"
        $('body').on('click', '#confirmDeleteBtn', function() {
            // Retrieve the attached ID
            var id = $(this).attr('item-id');
            deletePhoneBook(id);
            // Close the confirm modal
            $('#exampleModalCenter').modal('hide');
        });
    </script>
@endpush
