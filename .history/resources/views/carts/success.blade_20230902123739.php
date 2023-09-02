@extends('main')

@section('content')
@php 
sleep(5);
header("Location: /");
@endphp
<div class="p-t-120">
    @include('components.alert')
</div>
@endsection