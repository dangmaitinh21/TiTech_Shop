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
        {{ Session::get('error') }}
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif