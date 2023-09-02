@extends('adminPage.index')

@section('mainContent')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Note</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if($customers->count() > 0)
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{!! $customer->note !!}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="/admin/orders/edit/{{ $customer->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a class="btn btn-danger btn-sm" href="#" onclick="delItem('{{$customer->id}}', '/admin/orders/delete')">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr><td colspan="9" class="text-center font-weight-bold">No products</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
        {!! $customers->links('pagination::bootstrap-4') !!}
    </div>
@endsection