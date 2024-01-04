@extends('layouts._back')
@section('title')
    Manage PSTN
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
    .demo-card label{ display: block; position: relative;}
    .demo-card .col-lg-4{ margin-bottom: 30px;}
</style>
@endpush
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h1>PSTN-numbers</h1>
            </div>
            @if(auth()->user()->hasPermission('create-customer'))
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target=".bd-example-modal-lg">Add new</button>
                </div>
            @endif
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs3 table-nav">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#PSTNs">PSTNs</a></li>
                </ul>
                <div class="tab-content mt-0">
                    <div class="tab-pane show active" id="PSTNs">
                        <div class="table-responsive body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include ('_back.superadmin.pstn.create')
    @include ('_back.superadmin.pstn.edit')
    @include ('_back.superadmin.pstn.delete')
@endsection
@push('page_script')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script>
    function fetchData(id) {
        $.ajax({
            url: "{{ route('superadmin.pstn.edit', ['pstn' => '__id__']) }}".replace('__id__', id),
            method: 'GET',
            success: function (response) {
                // Populate the form fields with the fetched data
                $('#myLargeModalText [name="id"]').val(response.data.id);
                $('#myLargeModalText [name="provider"]').val(response.data.provider);
                $('#myLargeModalText [name="number_pool"]').val(response.data.number_pool);
                $('#myLargeModalText [name="customer_id"]').val(response.data.customer_id);
            },
            error: function (xhr, status, error) {
                // Handle error scenarios
                console.error(error);
            }
        });
    }

    $('body').on('click', '.editBtn', function() {
        const id = $(this).attr('data-record-id');
        // Call the function to fetch data via AJAX
        fetchData(id);
    });
    $('#saveBtn').on('click', function(e) {
        e.preventDefault();
        const id = $('#myLargeModalText [name="id"]').val();
        if($('#editPSTNForm').valid()) {
            // Perform an AJAX POST request to update the data
            $.ajax({
                url: '{{ route("superadmin.pstn.update",['pstn' => 'pstn_id']) }}'.replace('pstn_id',id),
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: "PUT",
                    provider: $('#myLargeModalText [name="provider"]').val(),
                    number_pool: $('#myLargeModalText [name="number_pool"]').val(),
                    customer_id: $('#myLargeModalText [name="customer_id"]').val()
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
                    window.LaravelDataTables["pstn-table"].ajax.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error scenarios
                    console.error(error);
                }
            });
        }
    });

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
        deletePSTN(id);
        // Close the confirm modal
        $('#exampleModalCenter').modal('hide');
    });
    function deletePSTN(id) {
        // Make an AJAX request or submit a form to delete the customer
        $.ajax({
            url: "{{ route('superadmin.pstn.destroy', ['pstn' => '__id__']) }}".replace('__id__', id),
            type: "DELETE",
            data: {
                _type : "DELETE",
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                var alertHtml = '<div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">' + 'Data deleted successfully' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                $('#main-content .container-fluid').prepend(alertHtml);
                // Set a timeout to remove the alert after the specified duration
                setTimeout(function() {
                    $('.alert-dismissible').alert('close');
                }, 5000);
                window.LaravelDataTables["pstn-table"].ajax.reload();
            },
            error: function(error) {
                console.log(error.responseJSON.message);
            }
        });
    }
</script>
@endpush
