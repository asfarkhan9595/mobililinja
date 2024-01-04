<div class="modal fade" id="myLargeModalText" tabindex="-1" role="dialog" aria-labelledby="myLargeModalText" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalText">Edit PSTN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="body demo-card">
                            <form action="#" id="editPSTNForm" method="post">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-12">
                                        <input type="hidden" class="form-control" name="id">
                                        <label>Provider</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="provider">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label>Number pool</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="number_pool">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <label>Customer</label>
                                        <div class="form-group">
                                            <select class="form-control" name="customer_id">
                                                <option>Select Customer</option>
                                                @foreach($customers as $key => $customer)
                                                    <option value="{{ $key }}">{{ $customer }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="modal-footer">
                                            <button class="btn btn-default mb-2" data-dismiss="modal" aria-label="Close">Cancel</button>
                                            <input id="saveBtn" type="submit" class="btn btn-outline-info mb-2"
                                                   value="Update PSTN"></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
