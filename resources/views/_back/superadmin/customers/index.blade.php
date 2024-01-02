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
    .demo-card label{ display: block; position: relative;}
    .demo-card .col-lg-4{ margin-bottom: 30px;}
</style>
@endpush
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h1>Customers</h1>
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
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Customers">Customers</a></li>
                </ul>
                <div class="tab-content mt-0">
                    <div class="tab-pane show active" id="Customers">
                        <div class="table-responsive body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include ('_back.superadmin.customers.create')
@include ('_back.superadmin.customers.edit')
@include ('_back.superadmin.customers.delete')
@endsection
@push('page_script')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script>
    function fetchData(id) {
        $.ajax({
            url: '{{ route("superadmin.customers.edit", ["customer" => 'customer_id']) }}'.replace('customer_id',id),
            method: 'GET',
            success: function(data) {
            // Populate the modal input field with the fetched data
                $('[name="id"]').val(data.id);
                $('[name="name"]').val(data.name);
                $('[name="street_address"]').val(data.street_address);
                $('[name="zip"]').val(data.zip);
                $('[name="city"]').val(data.city);
                $('[name="country"]').val(data.country);
                $('[name="vat"]').val(data.vat);
                $('[name="contact_person_name"]').val(data.contact_person_name);
                $('[name="contact_person_email"]').val(data.contact_person_email);
                $('[name="contact_person_phone"]').val(data.contact_person_phone);
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
        if($('#customerEditForm').valid()) {
            // Perform an AJAX POST request to update the data
            $.ajax({
                url: '{{ route("superadmin.customers.update",['customer' => 'customer_id']) }}'.replace('customer_id',id),
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: "PUT",
                    name: $('#myLargeModalText [name="name"]').val(),
                    street_address: $('#myLargeModalText [name="street_address"]').val(),
                    zip: $('#myLargeModalText [name="zip"]').val(),
                    city: $('#myLargeModalText [name="city"]').val(),
                    country: $('#myLargeModalText [name="country"]').val(),
                    vat: $('#myLargeModalText [name="vat"]').val(),
                    contact_person_name: $('#myLargeModalText [name="contact_person_name"]').val(),
                    contact_person_email: $('#myLargeModalText [name="contact_person_email"]').val(),
                    contact_person_phone: $('#myLargeModalText [name="contact_person_phone"]').val(),
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
                    }
                    console.log('Data updated successfully:', response);
                    // Close the modal
                    $('#main-content .container-fluid').prepend(
                            '<div class="alert alert-success mt-4 alert-dismissible fade show" role="alert"> {{__('Data updated successfully')}} <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                    )
                    $('#myLargeModalText').modal('hide');
                    window.LaravelDataTables["customer-table"].ajax.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error scenarios
                    console.error(error);
                }
            });
        }
    });
    function deleteCustomer(id) {
        // Make an AJAX request or submit a form to delete the customer
        $.ajax({
            url: "{{ route('superadmin.customers.destroy', ['customer' => '__id__']) }}".replace('__id__', id),
            type: "DELETE",
            data: {
                _type : "DELETE",
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                $('#main-content .container-fluid').prepend(
                    '<div class="alert alert-success mt-4 alert-dismissible fade show" role="alert"> {{__('Data deleted successfully')}} <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                )
                window.LaravelDataTables["customer-table"].ajax.reload();
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
        deleteCustomer(id);
        // Close the confirm modal
        $('#exampleModalCenter').modal('hide');
    });
</script>
@endpush
