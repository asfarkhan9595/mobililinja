<!-- larg modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Add new customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('superadmin.customer.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="body demo-card">
                                <ul class="nav nav-tabs3 table-nav">
                                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#General">General</a></li>
                                    {{-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Features">Features</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Billing">Billing</a></li> --}}
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="General">
                                        <div class="col-md-12">
                                            <div class="body demo-card">
                                                <div class="row clearfix">
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Customer name</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Street address</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="street_address" value="{{ old('street_address') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>ZIP</label>
                                                        <div class="form-group">
                                                            <input minlength="5" maxlength="9" type="text" class="form-control" name="zip" value="{{ old('zip') }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row clearfix">
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>City</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="city" value="{{ old('city') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Select country</label>
                                                        <div class="form-group">
                                                            <select class="form-control" name="country">
                                                                <option value="selected">AF - Afghanistan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>VAT</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="vat"
                                                                value="{{ old('vat') }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row clearfix">
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Contact person</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" name="contact_person_name" value="{{ old('contact_person_name') }}" placeholder="Ex: John Doe">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Email</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-envelope-o"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" name="contact_person_email" value="{{ old('contact_person_email') }}" placeholder="Ex: yourname@domain.com">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Phone number</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" name="contact_person_phone" value="{{ old('contact_person_phone') }}" placeholder="Ex: +00 (000) 000-00-00">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="tab-pane" id="Features">
                                        <div class="col-md-12">
                                            <div class="body demo-card">
                                                <div class="row clearfix">
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>PBX</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                value="">
                                                        </div>
                                                        <label>Extensions</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                value="">
                                                        </div>
                                                        <label>IVR</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                value="">
                                                        </div>
                                                        <label>Voicemail</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                value="">
                                                        </div>
                                                        <label>Ring Groups</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                value="">
                                                        </div>
                                                        <label>Conferences</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                value="">
                                                        </div>
                                                        <label>Call Recording</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                value="">
                                                        </div>
                                                        <label>Callback</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                value="">
                                                        </div>
                                                        <label>Calendar</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                value="">
                                                        </div>
                                                        <label>Reports</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                value="">
                                                        </div>
                                                        <label>Dashboard</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                value="">
                                                        </div>
                                                        <label>Speech to Text</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                value="">
                                                        </div>
                                                        <label>AI</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Street address</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>ZIP
                                                            <div class="form-group">
                                                                <input type="text" class="form-control"
                                                                    value="">
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="Billing">
                                        <div class="col-md-12">
                                            <div class="body demo-card">
                                                <div class="row clearfix">
                                                    <form>
                                                        <div class="form-group row mt-5">
                                                            <label class="col-sm-2 col-form-label">Payment
                                                                Information</label>
                                                            <div class="col-md-6 col-sm-10">
                                                                <div class="form-group">
                                                                    <label>Full name (on the card)</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i
                                                                                    class="fa fa-user"></i></span>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            name="username" placeholder=""
                                                                            required="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Card number</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i
                                                                                    class="fa fa-credit-card"></i></span>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            name="cardNumber" placeholder="">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <div class="form-group">
                                                                            <label><span
                                                                                    class="hidden-xs">Expiration</span>
                                                                            </label>
                                                                            <div class="form-inline">
                                                                                <select class="form-control"
                                                                                    style="width:45%">
                                                                                    <option>MM</option>
                                                                                    <option>01 - Janiary</option>
                                                                                    <option>02 - February</option>
                                                                                    <option>03 - February</option>
                                                                                </select>
                                                                                <span
                                                                                    style="width:10%; text-align: center">
                                                                                    / </span>
                                                                                <select class="form-control"
                                                                                    style="width:45%">
                                                                                    <option>YY</option>
                                                                                    <option>2018</option>
                                                                                    <option>2019</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label data-toggle="tooltip"
                                                                                title=""
                                                                                data-original-title="3 digits code on back side of the card">CVV
                                                                                <i
                                                                                    class="fa fa-question-circle"></i></label>
                                                                            <input class="form-control" required=""
                                                                                type="text">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button class="subscribe btn btn-primary btn-block"
                                                                    type="button"> Confirm </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default mb-2" data-dismiss="modal"
                                            aria-label="Close">Cancel</button>
                                        <input type="submit" class="btn btn-outline-info mb-2"
                                            value="Save"></button>
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
