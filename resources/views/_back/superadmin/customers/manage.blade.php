@extends('layouts._back')
@section('title')
Manage Customers
@endsection
@section('title')
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
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Customers</h1>
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
                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Customers">Customers</a></li>
                    </ul>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="tab-content mt-0">
                        
                        <div class="tab-pane show active" id="Customers">
                            <div class="table-responsive body">
                                <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                                    <thead>
                                        <tr>
                                            <th>Customer number</th>
                                            <th>Customer</th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th class="w60">Amount</th>
                                            <th class="w60">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#LA-5218</td>
                                            <td>vPro tec LLC.</td>
                                            <td>07 March, 2018</td>
                                            <td><img src="https://netdesk.fi/platform/assets/images/paypal.png" class="rounded w40" alt="paypal"></td>
                                            <td><span class="badge badge-success">Approved</span></td>
                                            <td>$4,205</td>
                                            <td>
                                                <button class="btn btn-outline-info mb-2" data-toggle="modal" data-target="#myLargeModalText"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-outline-danger mb-2" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#LA-1212</td>
                                            <td>BT Technology</td>
                                            <td>25 Jun, 2018</td>
                                            <td><img src="https://netdesk.fi/platform/assets/images/mastercard.png" class="rounded w40" alt="mastercard"></td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                            <td>$5,205</td>
                                            <td>
                                                <button class="btn btn-outline-info mb-2" data-toggle="modal" data-target="#myLargeModalText"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-outline-danger mb-2" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#LA-0222</td>
                                            <td>More Infoweb Pvt.</td>
                                            <td>12 July, 2018</td>
                                            <td><img src="https://netdesk.fi/platform/assets/images/paypal.png" class="rounded w40" alt="paypal"></td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                            <td>$2,000</td>
                                            <td>
                                                <button class="btn btn-outline-info mb-2" data-toggle="modal" data-target="#myLargeModalText"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-outline-danger mb-2" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#LA-0312</td>
                                            <td>RETO Tech LLC.</td>
                                            <td>13 July, 2018</td>
                                            <td><img src="https://netdesk.fi/platform/assets/images/paypal.png" class="rounded w40" alt="paypal"></td>
                                            <td><span class="badge badge-success">Approved</span></td>
                                            <td>$10,000</td>
                                            <td>
                                                <button class="btn btn-outline-info mb-2" data-toggle="modal" data-target="#myLargeModalText"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-outline-danger mb-2" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>            
                </div>
            </div>
        </div>
    </div>
</div>
@include ('_back.superadmin.customers.add')
@push('page_script')
@endpush
@endsection