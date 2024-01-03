@extends('layouts._back')
@section('title')
    Manage Customers
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
                <h1>Trunks</h1>
            </div>
            @if (auth()->user()->hasPermission('create-trunk'))
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal"
                        data-target=".bd-example-modal-lg">Add new trunk</button>
                </div>
            @endif
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs3 table-nav">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Trunk">Trunks</a></li>
                </ul>
                <div class="tab-content mt-0">
                    <div class="tab-pane show active" id="Trunk">
                        <div class="table-responsive body">
                            {{ $dataTable->table() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include ('_back.superadmin.trunk.create')
    @include ('_back.superadmin.trunk.edit')
    @include ('_back.superadmin.trunk.delete')
@endsection
@push('page_script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        function fetchData(id) {
            $.ajax({
                url: '{{ route('superadmin.trunks.edit', ['trunk' => 'trunk_id']) }}'.replace('trunk_id', id),
                method: 'GET',
                success: function(data) {
                    // Populate the modal input field with the fetched data
                    $('#myLargeModalText [name="id"]').val(data.id);
                    $('#myLargeModalText [name="tname"]').val(data.tname);
                    $('#myLargeModalText [name="description"]').val(data.description);
                    $('#myLargeModalText [name="authentication"]').val(data.authentication);
                    $('#myLargeModalText [name="secret"]').val(data.secret);
                    $('#myLargeModalText [name="registration"]').val(data.registration);
                    $('#myLargeModalText [name="sip_server"]').val(data.sip_server);
                    $('#myLargeModalText [name="sip_secret_port"]').val(data.sip_secret_port);
                    $('#myLargeModalText [name="context"]').val(data.context);
                    $('#myLargeModalText [name="transport"]').val(data.transport);
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
        fetchData(id);
        // Display the modal
        $('#editModal').css('display', 'block');
    });

        $('#saveBtn').on('click', function(e) {
            e.preventDefault();
            const id = $('[name="id"]').val();
            if ($('#trunkEditForm').valid()) {
                // Perform an AJAX POST request to update the data
                $.ajax({
                    url: '{{ route('superadmin.trunks.update', ['trunk' => 'trunk_id']) }}'.replace(
                        'trunk_id', id),
                    type: "PUT",
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: "PUT",
                        tname: $('#myLargeModalText [name="tname"]').val(),
                        description: $('#myLargeModalText [name="description"]').val(),
                        secret: $('#myLargeModalText [name="secret"]').val(),
                        authentication: $('#myLargeModalText [name="authentication"]').val(),
                        registration: $('#myLargeModalText [name="registration"]').val(),
                        sip_server: $('#myLargeModalText [name="sip_server"]').val(),
                        sip_secret_port: $('#myLargeModalText [name="sip_secret_port"]').val(),
                        context: $('#myLargeModalText [name="context"]').val(),
                        transport: $('#myLargeModalText [name="transport"]').val(),
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
                        }
                        console.log('Dataaaa updated successfully:', response);
                        // Close the modal
                        $('#main-content .container-fluid').prepend(
                            '<div class="alert alert-success mt-4 alert-dismissible fade show" role="alert"> {{ __('Data updated successfully') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                        )
                        $('.bd-example-modal-lg').modal('hide');
                        window.LaravelDataTables["trunk-table"].ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error scenarios
                        console.error(error);
                    }
                });
            }
        });

        function deleteTrunk(id) {
    // Make an AJAX request to delete the trunk
    $.ajax({
        url: "{{ route('superadmin.trunks.destroy', ['trunk' => '__id__']) }}".replace('__id__', id),
        type: "DELETE",
        data: {
            _method: "DELETE",
            _token: "{{ csrf_token() }}",
        },
        success: function(response) {
            // Check the response from the server
            console.log(response);

            // Check if the server returns a success message
            if (response && response.message === 'Data deleted successfully') {
                var alertHtml = '<div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">' + 'Data Delete successfully' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                        $('#main-content .container-fluid').prepend(alertHtml);
                        // Set a timeout to remove the alert after the specified duration
                        setTimeout(function() {
                            $('.alert-dismissible').alert('close');
                        }, 5000);
                // Reload the data table
                window.LaravelDataTables["trunk-table"].ajax.reload();
            } else {
                // Handle the case where deletion failed
                console.error('Deletion failed:', response);
            }
        },
        error: function(error) {
            // Handle AJAX request errors
            console.log('AJAX request error:', error);
        }
    });
}

// Open the confirm modal when needed
$('body').on('click', '.btn-outline-danger', function() {
    let itemId = $(this).data('record-id');
    // Attach the ID to the delete button
    $('#confirmDeleteTrunkBtn').attr('item-id', itemId);
    // Show the confirm modal
    $('#exampleModalCenter').modal('show');
});

// Handle the delete action when the user clicks "Delete"
$('body').on('click', '#confirmDeleteTrunkBtn', function() {
    // Retrieve the attached ID
    var id = $(this).attr('item-id');
    deleteTrunk(id);
    // Close the confirm modal
    $('#exampleModalCenter').modal('hide');
});

    </script>
@endpush
