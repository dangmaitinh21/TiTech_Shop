@extends('adminPage.index')

@section('ckeditorHead')
    <script src="/assets/vendor/ckeditor5/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name Product</label>
                <input type="text" class="form-control" name="productName" id="name" placeholder="Enter name product" value="{{ $product->name }}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Product category</label>
                <select class="form-control" name="productCategory" >
                    @foreach($categories as $item)
                        <option value="{{ $item->id }}" {{  $item->id === $product->category_id ? 'selected' : '' }} >{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image">Description</label><br>
                <div class="input-group">
                    <input type="file" id="uploadImg">
                    <input type="hidden" name="productImage" value="{{ $product->image }}" id="productImage">
                </div>
                <img src="{{ $product->image }}" alt="previewImg" id="previewImg" class="mt-2" width="100px">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" class="form-control" name="productDescription"  id="description" placeholder="Enter description">{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea type="text" class="form-control" name="productDetail"  id="content" placeholder="Enter content">{{ $product->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Price product</label>
                <textarea type="text" class="form-control" name="productPrice"  id="price" placeholder="Enter price product">{{ $product->price }}</textarea>
            </div>
            <div class="form-group">
                <label for="priceSale">Price sale</label>
                <textarea type="text" class="form-control" name="productPriceSale"  id="priceSale" placeholder="Enter content">{{ $product->price_sale }}</textarea>
            </div>
            <div class="form-group">
                <label for="active">Active status</label>
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input" name="productActive"  id="active" {{ $product->active ? 'checked' : '' }}>
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

@section('ckeditorFooter')
    <script>
        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
