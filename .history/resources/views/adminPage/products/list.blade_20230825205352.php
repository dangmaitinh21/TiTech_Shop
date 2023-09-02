@extends('adminPage.index')

@section('mainContent')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Detail</th>
                        <th>Price</th>
                        <th>Price Sale</th>
                        <th>Active State</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            <a href="{{ $product->image }}" target="_blank"><img src="{{ $product->image }}" alt="image product" width="50px" /></a>
                        </td>
                        <td>{{ $product->description }}</td>
                        <td>{!! $product->content !!}</td>
                        <td>{{ $product->price }}$</td>
                        <td>{{ $product->price_sale }}$</td>
                        <td>{!! \App\Helpers\Helper::activeState($product->active) !!}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="edit/{{ $product->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="delItem('{{$product->id}}', '/admin/products/delete')">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $products->links() !!}
    </div>
@endsection