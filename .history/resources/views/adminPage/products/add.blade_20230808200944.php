@extends('adminPage.index')

@section('ckeditorHead')
    <script src="/assets/vendor/ckeditor5/ckeditor.js"></script>
@endsection

@section('addCategory')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="productName">Name product</label>
                <input type="text" class="form-control" name="productName" id="productName" placeholder="Enter name product">
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
                    <input type="file" id="fileImg" name="file" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" class="form-control" name="productDescription"  id="description" placeholder="Enter description"></textarea>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea type="text" class="form-control" name="productDetail"  id="content" placeholder="Enter content"></textarea>
            </div>
            <div class="form-group">
                <label for="productPrice">Price product</label>
                <input type="text" class="form-control" name="productPrice" id="productPrice" placeholder="Enter price">
            </div>
            <div class="form-group">
                <label for="productPriceSale">Price sale product</label>
                <input type="text" class="form-control" name="productPriceSale" id="productPriceSale" placeholder="Enter price sale">
            </div>
            <div class="form-group">
                <label for="active">Active status</label>
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input" name="productActive"  id="active" checked>
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

@section('ckeditorFooter')
    <script>
        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection

@section('uploadImg')
<script>
    $("#fileImg").change(function () {
        const form = new FormData();
        form.append("file", $(this)[0].files[0]);
        console.log(form);
        $.ajax({
            type: "POST",
            url: '{{url("admin/upload/services")}}',
            data: form,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
            },
            error: function(err) {
                console.log(err);
            }
        });
    });

</script>
@endsection
