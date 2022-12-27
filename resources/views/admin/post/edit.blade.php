
@extends('admin.layouts.admin')

@section('title')
    <title>Edit Post</title>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Category Page</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ asset('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Category Page</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{ route('admin.posts.edit', ['id'=>$id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Post Name</label>
                            <input type="text" class="form-control" name="name" placeholder="enter Post name">
                        </div>
                        <div class="form-group">
                            <label>Ảnh bài viết</label>
                            <input type="file" id="upload" onchange="loadFile(event)" name="thumb">
                            <img id="output" style="max-width: 500px; object-fit: cover">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Post Description</label>
                            <input type="text" class="form-control" name="description" placeholder="enter Post description">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Post Content</label>
                            <input type="text" class="form-control" name="content" placeholder="enter Post content">
                        </div>
                        <div class="form-group">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category ID</label>
                            <input type="text" class="form-control" name="category_id" placeholder="enter Category ID name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tag ID</label>
                            <input type="text" class="form-control" name="tag_id" placeholder="enter Tag ID name">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('script')
    <script>
        var loadFile = function (event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
@endsection


