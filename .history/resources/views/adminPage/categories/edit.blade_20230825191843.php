@extends('adminPage.index')

@section('ckeditorHead')
    <script src="/assets/vendor/ckeditor5/ckeditor.js"></script>
@endsection

@section('editPart')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="categoryName">Name category</label>
                <input type="text" class="form-control" name="categoryName" id="categoryName" placeholder="Enter name category" value="{{ $category->name }}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Parent category</label>
                <select class="form-control" name="parentCategory" >
                    <option value="0" {{ $category->parent_id === 0 ? 'selected' : '' }}>Set as parent</option>
                    @foreach($categories as $item)
                        <option value="{{ $item->id }}" {{  $category->parent_id === $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" class="form-control" name="categoryDescription"  id="description" placeholder="Enter description">{{ $category->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea type="text" class="form-control" name="categoryDetail"  id="content" placeholder="Enter content">{{ $category->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="active">Active status</label>
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input" name="categoryActive"  id="active" {{ $category->active ? 'checked' : '' }}>
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