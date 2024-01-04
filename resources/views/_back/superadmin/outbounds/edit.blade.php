    <!-- larg modal -->
    <div class="modal fade" id="myLargeModalText" tabindex="-1" role="dialog" aria-labelledby="myLargeModalText"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalText">Edit Outbound route</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" id="editOutboundForm" method="post">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="body demo-card">
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-12">
                                            <input type="hidden" class="form-control" name="id">
                                            <label>Prepend</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="prepend"
                                                   >
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-12">
                                            <label>Prefix</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="prefix"
                                                    >
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <label>Match pattern</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="match_pattern"
                                                  >
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <label>Trunk</label>
                                            <div class="form-group">
                                                <select class="form-control" name="trunk_id">
                                                    <option>Select Trunk</option>
                                                    @foreach ($trunks as $key => $trunk)
                                                        <option value="{{ $key }}">{{ $trunk }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="modal-footer">
                                                <button class="btn btn-default mb-2" data-dismiss="modal"
                                                    aria-label="Close">Cancel</button>
                                                <input id="saveBtn" type="submit" class="btn btn-outline-info mb-2"
                                                    value="Update Outbound"></button>
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
    </div>
