<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure</p>
                <p>Do you really want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-outline-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>
@push('page_script')
<script>

    function deleteInvoice(id) {
        // Make an AJAX request or submit a form to delete the Invoice
        $.ajax({
            url: "{{ route('superadmin.invoices.destroy', ['invoice' => '__id__']) }}".replace('__id__', id),
            type: "DELETE",
            data: {
                _type : "DELETE",
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                var alertHtml = '<div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">' + 'Data deleted successfully' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                $('#main-content .container-fluid').prepend(alertHtml);
                // Set a timeout to remove the alert after the specified duration
                setTimeout(function() {
                    $('.alert-dismissible').alert('close');
                }, 5000);
                window.LaravelDataTables["invoice-table"].ajax.reload();
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
    });

    // Handle the delete action when the user clicks "Delete"
    $('body').on('click', '#confirmDeleteBtn', function() {
        // Retrieve the attached ID
        var id = $(this).attr('item-id');
        deleteInvoice(id);
        $('#exampleModalCenter').modal('hide');
    });
</script>
@endpush
