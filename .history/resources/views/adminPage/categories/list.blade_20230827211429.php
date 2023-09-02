@extends('adminPage.index')

@section('mainContent')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Detail</th>
                        <th>Active State</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    {!! \App\Helpers\Helper::listCategories($categories)!!}
                </tbody>
            </table>
        </div>
    </div>
    <!-- a Tag for previous page -->
<a href="{{$categories->previousPageUrl()}}">
    <!-- You can insert logo or text here -->
</a>
@for($i=0;$i<=$categories->lastPage();$i++)
    <!-- a Tag for another page -->
    <a href="{{$categories->url($i)}}">{{$i}}</a>
@endfor
<!-- a Tag for next page -->
<a href="{{$categories->nextPageUrl()}}">
    <!-- You can insert logo or text here -->
</a>
@endsection
