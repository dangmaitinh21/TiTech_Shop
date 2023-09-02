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
                    @if($categories->count() > 0)
                        {!! \App\Helpers\Helper::listCategories($categories)!!}
                    @else
                        <tr><td colspan="6" class="text-center font-weight-bold">No categories</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
        {!! $categories->links('pagination::bootstrap-4') !!}
    </div>
@endsection
