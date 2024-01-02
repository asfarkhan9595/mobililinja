@if ($errors->any())
    <div class="alert alert-danger mt-4 alert-dismissible fade show" role="alert">
        <ul class="pb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <script>
            // Automatically close the error alert after 5 seconds
            setTimeout(function () {
                $('.alert-danger').alert('close');
            }, 5000);
        </script>
    </div>
@endif

@if(session('message'))
    <div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">
        {{ __(session('message')) }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <script>
            // Automatically close the success alert after 5 seconds
            setTimeout(function () {
                $('.alert-success').alert('close');
            }, 5000);
        </script>
    </div>
@endif
