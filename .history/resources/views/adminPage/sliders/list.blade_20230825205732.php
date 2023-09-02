@extends('adminPage.index')

@section('mainContent')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Url</th>
                        <th>Image</th>
                        <th>Update At</th>
                        <th>Active State</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $slider)
                    <tr>
                        <td>{{ $slider->id }}</td>
                        <td>{{ $slider->name }}</td>
                        <td>{{ $slider->url }}</td>
                        <td>
                            <a href="{{ $slider->image }}" target="_blank">
                                <img src="{{ $slider->image }}" alt="image slider" width="50px" />
                            </a>
                        </td>
                        <td>{{ $slider->updated_at }}</td>
                        <td>{!! \App\Helpers\Helper::activeState($slider->active) !!}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="edit/{{ $slider->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="delItem('{{$slider->id}}', '/admin/sliders/delete')">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $sliders->links() !!}
    </div>
@endsection