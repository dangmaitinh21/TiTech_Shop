@extends('adminPage.index')

@section('mainContent')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="sliderName">Name slider</label>
                <input type="text" class="form-control" value="{{ old('sliderName') }}" name="name" id="sliderName" placeholder="Enter name slider">
            </div>
            <div class="form-group">
                <label for="urlSliderName">URL slider</label>
                <input type="text" class="form-control" value="{{ old('urlSliderName') }}" name="url" id="urlSliderName" placeholder="Enter url slider">
            </div>
            <div class="form-group">
                <label for="fileImg">Slider image</label>
                <div class="input-group">
                    <input type="file" id="fileImg">
                    <input type="hidden" name="image" id="sliderImage">
                </div>
                <img src="" alt="previewImg" id="previewImg" class="d-none mt-2" width="100px">
            </div>
            <div class="form-group">
                <label for="productName">Sort by product</label>
                <input type="text" class="form-control" value="{{ old('productName') }}" name="productName" id="productName" placeholder="Enter name product">
            </div>
            <div class="form-group">
                <label for="activeSlider">Active status</label>
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input" name="active"  id="activeSlider" checked >
                    <label class="custom-control-label" for="activeSlider"></label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
        @csrf
    </form>
@endsection




