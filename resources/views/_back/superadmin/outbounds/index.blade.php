@extends('layouts._back')
@section('title')
    Manage Outbound
@endsection
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
                <h1>Outbounds</h1>
            </div>
            @if (auth()->user()->hasPermission('create-outbound'))
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal"
                        data-target=".bd-example-modal-lg">Add new</button>
                </div>
            @endif
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs3 table-nav">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Outbound">Outbounds</a>
                    </li>
                </ul>
                <div class="tab-content mt-0">
                    <div class="tab-pane show active" id="Outbound">
                        <div class="table-responsive body">
                            {{ $dataTable->table() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include ('_back.superadmin.outbounds.create')
    @include ('_back.superadmin.outbounds.edit')
    @include ('_back.superadmin.outbounds.delete')
@endsection
@push('page_script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        
        function fetchOutboundData(id) {
            $.ajax({
                url: "{{ route('superadmin.outbounds.edit', ['outbound' => '__id__']) }}".replace('__id__', id),
                method: 'GET',
                success: function (response) {
                   
                        // Populate the modal input fields with the fetched data
                        $('#myLargeModalText [name="id"]').val(response.data.id);
                        $('#myLargeModalText [name="prepend"]').val(response.data.prepend);
                        $('#myLargeModalText [name="prefix"]').val(response.data.prefix);
                        $('#myLargeModalText [name="match_pattern"]').val(response.data.match_pattern);
                        $('#myLargeModalText [name="trunk_id"]').val(response.data.trunk_id);
                  
                },
                error: function (xhr, status, error) {
                    // Handle error scenarios
                    console.error(error);
                }
            });
        }

        $('body').on('click', '.editBtn', function () {
            const id = $(this).attr('data-record-id');
            // Call the function to fetch data via AJAX
            fetchOutboundData(id);
        });

        $('#saveBtn').on('click', function (e) {
            e.preventDefault();
            const id = $('#myLargeModalText [name="id"]').val();
            if ($('#editOutboundForm').valid()) {
                // Perform an AJAX POST request to update the data
                $.ajax({
                    url: "{{ route('superadmin.outbounds.update', ['outbound' => '__id__']) }}".replace('__id__', id),
                    type: "POST", // Change to PUT
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT', // Add this line for Laravel to recognize it as a PUT request
                        prepend: $('#editOutboundForm [name="prepend"]').val(),
                        prefix: $('#editOutboundForm [name="prefix"]').val(),
                        match_pattern: $('#editOutboundForm [name="match_pattern"]').val(),
                        trunk_id: $('#editOutboundForm [name="trunk_id"]').val(),
                    },
                    success: function (response) {
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
                            var alertHtml =
                                '<div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">' +
                                'Outbound updated successfully' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                            $('#main-content .container-fluid').prepend(alertHtml);
                            // Set a timeout to remove the alert after the specified duration
                            setTimeout(function () {
                                $('.alert-dismissible').alert('close');
                            }, 5000);

                            $('#myLargeModalText').modal('hide');
                        }
                        // Assuming you have a Laravel DataTable named "outbound-table"
                        window.LaravelDataTables["outbound-table"].ajax.reload();
                    },
                    error: function (xhr, status, error) {
                        // Handle error scenarios
                        console.error(error);
                    }
                });
            }
        });
        $('#editOutboundForm').validate({
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
                errorPlacement: function (error, element) {
        // Customize the placement of error messages
        error.insertAfter(element); // Default behavior: display the error after the input field
    },
    // Add any other options or callback functions as needed
});
        function deleteOutbound(id) {
            // Make an AJAX request or submit a form to delete the outbound data
            $.ajax({
                url: "{{ route('superadmin.outbounds.destroy', ['outbound' => '__id__']) }}".replace('__id__', id),
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    var alertHtml =
                        '<div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">' +
                        'Outbound deleted successfully' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                    $('#main-content .container-fluid').prepend(alertHtml);
                    // Set a timeout to remove the alert after the specified duration
                    setTimeout(function() {
                        $('.alert-dismissible').alert('close');
                    }, 5000);
                    // Assuming you have a Laravel DataTable named "outbound-table"
                    window.LaravelDataTables["outbound-table"].ajax.reload();
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
            deleteOutbound(id);
            // Close the confirm modal
            $('#exampleModalCenter').modal('hide');
        });
    </script>
@endpush
