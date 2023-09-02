@extends('main')

@section('content')
@php 
sleep(5);
redirect('/');
@endphp
<div class="p-t-120">
    @include('components.alert')
</div>
@endsection