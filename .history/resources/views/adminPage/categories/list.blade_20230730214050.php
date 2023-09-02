@extends('adminPage.index')

@section('listCategory')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Detail</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    {!! \App\Helpers\Helper::categories($categories)!!}
                </tbody>
            </table>
        </div>
    </div>
@endsection
