@extends('adminPage.index')

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="productName">Name product</label>
                <input type="text" class="form-control" value="{{ old('productName') }}" name="productName" id="productName" placeholder="Enter name product">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Category of product</label>
                <select class="form-control" name="categoryOfProduct" >
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" >{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="fileImg">Product Image</label>
                <div class="input-group">
                    <input type="file" id="uploadImg">
                    <input type="hidden" name="productImage" id="productImage">
                </div>
                <img src="" alt="previewImg" id="previewImg" class="d-none mt-2" width="100px">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" class="form-control" name="productDescription"  id="description" placeholder="Enter description">{{ old('productDescription') }}</textarea>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea type="text" class="form-control" name="productDetail"  id="content" placeholder="Enter content">{{ old('productDetail') }}</textarea>
            </div>
            <div class="form-group">
                <label for="productPrice">Price product</label>
                <input type="text" class="form-control" name="productPrice" id="productPrice" placeholder="Enter price" value="{{ old('productPrice') }}">
            </div>
            <div class="form-group">
                <label for="productPriceSale">Price sale product</label>
                <input type="text" class="form-control" name="productPriceSale" id="productPriceSale" placeholder="Enter price sale" value="{{ old('productPriceSale') }}">
            </div>
            <div class="form-group">
                <label for="active">Active status</label>
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input" name="productActive"  id="active" checked >
                    <label class="custom-control-label" for="active"></label>
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




