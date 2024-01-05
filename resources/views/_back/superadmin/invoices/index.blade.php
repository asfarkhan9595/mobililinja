@extends('layouts._back')
@section('title')
Manage Invoices
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
                <h1>Invoices</h1>
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
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Invoices">Invoices</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Payments">Payments</a></li>
                </ul>
                <div class="tab-content mt-0">
                    <div class="tab-pane show active" id="Invoices">
                        <div class="table-responsive body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                    <div class="tab-pane show active" id="Payments">
                    </div>
                </div>
            </div>
        </div>
    </div>
@include ('_back.superadmin.invoices.create')
@include ('_back.superadmin.invoices.edit')
@include ('_back.superadmin.invoices.delete')
@endsection
@push('page_script')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
