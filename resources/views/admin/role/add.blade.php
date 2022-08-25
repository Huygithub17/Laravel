@extends('layouts.admin')

@section('title')
    <title>Add Role</title>
@endsection

@section('css')
    <link href= "{{ asset('vendors/select_2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('/admins/user/add/add.css')}}">
    <style>
        .card-header {
            background-color: #44c0c4;

        }
    </style>

@endsection

@section('js')
    <script src="{{ asset('vendors/select_2/select2.min.js') }}"></script>
    <script src="{{ asset('admins/user/add/add.js') }}"></script>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name'=>'Roles', 'key'=>'Add']);
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{route('roles.store')}}" method="post" enctype="multipart/form-data" style="width: 100%">
                        <div class="col-md-10">
                            @csrf
                            <div class="form-group">
                                <label>Tên Role</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       placeholder="Nhập tên Roles"
                                       value="{{ old('name') }}"
                                >
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Display name</label>
                                <textarea
                                    class="form-control @error('display_name') is-invalid @enderror"
                                    name="display_name" rows="4">{{ old('display_name') }}</textarea>

                                @error('display_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="card text-white bg-secondary mb-3 col-md-12">
                                    <div class="row">
                                        <div class="card-header col-md-12">
                                            <lable>
                                                <input type="checkbox" value="">
                                            </lable>
                                            Module Products
                                        </div>
                                    </div>

                                    <div class="row">
                                        @for($i = 1; $i <=4; $i++)
                                            <div class="card-body col-md-3">
                                                <h5 class="card-title">
                                                    <label>
                                                        <input type="checkbox" value="">
                                                    </label>
                                                    Thêm sản phẩm
                                                </h5>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
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
