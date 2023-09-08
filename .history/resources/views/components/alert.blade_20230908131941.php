@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger">
        <h5>{{ Session::get('error') }}</h5>
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">
        <h5>{{ Session::get('success') }}</h5>
    </div>
@endif

@if(Session::has('sweetAlertSuccess'))
    echo "<script>Swal.fire({title: 'Success!', text:" . {{ Session::get('sweetAlertSuccess') }} . ", icon: 'success',confirmButtonText: 'Cool'})</script>";
@endif