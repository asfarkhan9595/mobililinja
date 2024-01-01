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
                            {{-- <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Customer number</th>
                                        <th>Name</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Zip</th>
                                        <th class="w60">Contact Person</th>
                                        <th class="w60">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->customer_number}}</td>
                                        <td>{{ $customer->name}}</td>
                                        <td>{{ $customer->country}}</td>
                                        <td>{{ $customer->city}}</td>
                                        <td>{{ $customer->zip}}</td>
                                        <td>{{ $customer->contact_person_name}}</td>
                                        <td>
                                            <button class="btn btn-outline-info mb-2" data-toggle="modal" data-target="#myLargeModalText"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-outline-danger mb-2" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot></tfoot>
                            </table> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include ('_back.superadmin.customers.create')
@include ('_back.superadmin.customers.edit')
@endsection
@push('page_script')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script>
    function fetchData(id) {
        $.ajax({
            url: '{{ route("superadmin.customer.edit", ["customer" => '+id+']) }}' ,
            method: 'GET',
            success: function(data) {
            // Populate the modal input field with the fetched data
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
        var id = $(this).attr('data-record-id');

        // Call the function to fetch data via AJAX
        fetchData(id);

        // Display the modal
        $('#editModal').css('display', 'block');
    });
    $('#saveBtn').on('click', function() {
        var updatedData = {
            name: $('[name="name"]').val(),
            street_address: $('[name="street_address"]').val(),
            zip: $('[name="zip"]').val(),
            city: $('[name="city"]').val(),
            country: $('[name="country"]').val(),
            vat: $('[name="vat"]').val(),
            contact_person_name: $('[name="contact_person_name"]').val(),
            contact_person_email: $('[name="contact_person_email"]').val(),
            contact_person_phone: $('[name="contact_person_phone"]').val(),
        };

        // Perform an AJAX POST request to update the data
        $.ajax({
            url: "{{ route('superadmin.customer.update',['id',"+id+"]) }}",
            method: 'POST',
            data: updatedData,
            success: function(response) {
            // Handle the successful update
                console.log('Data updated successfully:', response);
            // Close the modal
            $('#editModal').modal('close');
            },
            error: function(xhr, status, error) {
                // Handle error scenarios
                console.error(error);
            }
        });
    });
</script>
@endpush
