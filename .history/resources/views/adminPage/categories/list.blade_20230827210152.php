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
                    <!-- {!! \App\Helpers\Helper::listCategories($categories)!!} -->
                    @foreach(\App\Helpers\Helper::listCategories($categories)->items() as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->content }}</td>
                            <td>{{ \App\Helpers\Helper::activeState($category->active) }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="edit/{{ $category->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a class="btn btn-danger btn-sm" href="#" onclick="delItem({{ $category->id }}, '/admin/categories/delete')">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! \App\Helpers\Helper::listCategories($categories)->render() !!}
        </div>
    </div>
@endsection
