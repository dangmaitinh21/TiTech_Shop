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
        {{ $categories->render() }}
    </div>
@endsection
