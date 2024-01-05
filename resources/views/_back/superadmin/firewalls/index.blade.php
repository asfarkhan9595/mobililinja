@extends('layouts._back')
@section('title')
Manage Firewall
@endsection
@push('page_style')
<style>
    td.details-control {
        background: url({{ asset('_back/images/details_open.png') }}) no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('{{asset('_back/images/details_close.png')}}') no-repeat center center;
    }
    .demo-card label{ display: block; position: relative;}
    .demo-card .col-lg-4{ margin-bottom: 30px;}
</style>
@endpush
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h1>Firewall</h1>
            </div>
            <div class="col-md-6 col-sm-12 text-right hidden-xs">
                <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target=".bd-example-modal-lg">Add new</button>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs3 table-nav">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Customers">Network</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Detection">Detection</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Endpoints">Registered Endpoints</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Blocked">Blocked Attackers</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Limited">Rate Limited Hosts</a></li>
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
@include ('_back.superadmin.firewalls.create')
@include ('_back.superadmin.firewalls.edit')
@include ('_back.superadmin.firewalls.delete')
@endsection
@push('page_script')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
