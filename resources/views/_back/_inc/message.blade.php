@if ($errors->any())
    <div class="alert alert-danger mt-4 alert-dismissible fade show auto-dismiss" data-auto-dismiss="5000" role="alert">
        <ul class="pb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(session('message'))
    <div class="alert alert-success mt-4 alert-dismissible fade show auto-dismiss" data-auto-dismiss="5000" role="alert">
        {{ __(session('message')) }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <script>
        setTimeout(function() {
            $('.alert-dismissible').alert('close');
        }, 3000);
    </script>
@endif

