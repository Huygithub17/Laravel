@extends('layouts.admin')

@section('title')
    <title>Add Products</title>
@endsection


@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header',['name'=>'Products', 'key'=>'list'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('products.create')}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Danh mục</th>
                            </tr>
                            </thead>
                            <tbody>
{{--                            @foreach($categories as $category)--}}
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Iphone 5</td>
                                    <td>2.500.000</td>
                                    <td>
                                        <img src="" alt="">
                                    </td>
                                    <td>Điện thoại</td>
                                    <td>
                                        <a href=""
                                           class="btn btn-default">Edit</a>
                                        <a href=""
                                           class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
{{--                            @endforeach--}}
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
{{--                        {{ $categories->links('pagination::bootstrap-4') }}--}}
                    </div>
                </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
