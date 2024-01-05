 <!-- larg modal -->
 <div class="modal fade" id="myLargeModalText" tabindex="-1" role="dialog" aria-labelledby="myLargeModalText"
     aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title h4" id="myLargeModalText">Edit contact</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <form action="#" method="post" id="phonebookEditForm">
                 @csrf
                 <div class="modal-body">
                     <div class="row clearfix">
                         <div class="col-md-12">
                             <div class="body demo-card">
                                 <div class="row clearfix">
                                     <div class="col-lg-4 col-md-12">
                                         <label>First name</label>
                                         <div class="form-group">
                                            <input type="hidden" class="form-control" name="id">
                                             <input type="text" class="form-control" name="first_name"
                                                 value="">
                                         </div>
                                     </div>
                                     <div class="col-lg-4 col-md-12">
                                         <label>Last name</label>
                                         <div class="form-group">
                                             <input type="text" class="form-control" name="last_name" value="">
                                         </div>
                                     </div>
                                     <div class="col-lg-4 col-md-12">
                                         <label>Phone number</label>
                                         <div class="form-group">
                                             <input type="text" class="form-control" name="phone_number"
                                                 value="">
                                         </div>
                                     </div>
                                     <div class="col-lg-4 col-md-12">
                                         <label>Mobile number</label>
                                         <div class="form-group">
                                             <input type="text" class="form-control"name="mobile_number"
                                                 value="">
                                         </div>
                                     </div>
                                     <div class="col-lg-4 col-md-12">
                                         <label>Company</label>
                                         <div class="form-group">
                                             <input type="text" class="form-control" name="company" value="">
                                         </div>
                                     </div>
                                     <div class="col-lg-4 col-md-12">
                                         <label>Position</label>
                                         <div class="form-group">
                                             <input type="text" class="form-control"name="position" value="">
                                         </div>
                                     </div>
                                     <div class="col-lg-12 col-md-12">
                                         <div class="modal-footer">
                                             <button class="btn btn-sm btn-default" data-dismiss="modal"
                                                 aria-label="Close">Cancel</button>
                                             <input type="submit" class="btn btn-outline-info mb-2" id="saveBtn" value="Save">
                                         </div>
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
