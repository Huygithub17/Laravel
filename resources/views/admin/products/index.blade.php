@extends('layouts.admin')

@section('title')
    <title>Add Products</title>
@endsection

@section('css')
   <link rel="stylesheet" href="{{ asset('admins/product/index/list.css')}}">
@endsection

@section('js')
    <script src="{{asset('vendors/sweet_Alert_2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/main_delete.js')}}"></script>
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
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $productItem)
                                <tr>
                                    <th scope="row">{{$productItem->id}}</th>
                                    <td>{{$productItem->name}}</td>
                                    <td>{{number_format($productItem->price)}}</td>
                                    <td>
                                        <img class="product_image_150_100" src="{{ $productItem->feature_image_path }}" alt="">
                                    </td>
                                    <td>{{optional($productItem->category)->name}}</td>
                                    <td>
                                        <a href="{{route('products.edit',['id'=>$productItem->id])}}"
                                           class="btn btn-default">Edit</a>
                                        <a href=""
                                           data-url="{{route('products.delete', ['id'=>$productItem->id])}}"
                                           class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
