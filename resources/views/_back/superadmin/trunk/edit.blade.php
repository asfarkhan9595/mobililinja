<!-- larg modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myLargeModalText"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Edit Trunk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="body demo-card">
                                <ul class="nav nav-tabs3 table-nav">
                                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab"
                                            href="#General">General</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="General">
                                        <div class="col-md-12">
                                            <div class="body demo-card">
                                                <div class="row clearfix">
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Trunk name</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="tname"
                                                                value="{{ old('tname') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Description</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                name="description" value="{{ old('description') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Secret</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                name="secret" value="{{ old('secret') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Authentication</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="authentication" value="{{ old('authentication') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Registration</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="registration" value="{{ old('registration') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>SIP Server</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="sip_server" value="{{ old('sip_server') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>SIP Server Port</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="sip_secret_port" value="{{ old('sip_secret_port') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Context</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="context" value="{{ old('context') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <label>Transport</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="transport" value="{{ old('transport') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default mb-2" data-dismiss="modal"
                                            aria-label="Close">Cancel</button>
                                            <button type="submit" class="btn btn-outline-info mb-2">Save</button>
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