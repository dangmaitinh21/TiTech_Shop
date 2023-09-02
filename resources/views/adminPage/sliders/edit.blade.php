@extends('adminPage.index')

@section('mainContent')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="nameSlider">Name slider</label>
                <input type="text" class="form-control" name="name" id="nameSlider" placeholder="Enter name slider" value="{{ $slider->name }}">
            </div>
            <div class="form-group">
                <label for="urlSlider">Slider url</label>
                <input type="text" class="form-control" name="url" id="urlSlider" placeholder="Enter slider url" value="{{ $slider->url }}">
            </div>
            <div class="form-group">
                <label for="fileImg">Slider image</label><br>
                <div class="input-group">
                    <input type="file" id="fileImg">
                    <input type="hidden" name="image" value="{{ $slider->image }}" id="dataUrlImage">
                </div>
                <img src="{{ $slider->image }}" alt="previewImg" id="previewImg" class="mt-2" width="100px">
            </div>
            <div class="form-group">
                <label for="sortBySlider">Slider sort by</label>
                <input type="number" class="form-control" name="sort_by" id="sortBySlider" placeholder="Enter sort by of slider" value="{{ $slider->sort_by }}">
            </div>
            <div class="form-group">
                <label for="active">Active status</label>
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input" name="sliderActive"  id="active" {{ $slider->active ? 'checked' : '' }}>
                    <label class="custom-control-label" for="active"></label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Edit</button>
        </div>
        @csrf
    </form>
@endsection

