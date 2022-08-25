@extends('layouts.admin')

@section('title')
    <title>Edit User</title>
@endsection

@section('css')
    <link href= "{{ asset('vendors/select_2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('/admins/user/add/add.css')}}" >
@endsection

@section('js')
    <script src="{{ asset('vendors/select_2/select2.min.js') }}"></script>
    <script src="{{ asset('admins/user/add/add.js') }}"></script>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name'=>'Users', 'key'=>'Edit']);
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('users.update', ['id'=>$user->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên user</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       placeholder="Nhập tên User"
                                       value="{{$user->name}}"
                                >
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="email"
                                       placeholder="Nhập tên Email"
                                       value="{{$user->email}}"
                                >
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password"
                                       placeholder="Nhập Password"
                                >
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Chọn vai trò</label>
                                <select name="role_id[]" class="form-control select2_init" multiple>
                                    <option value=""></option>
                                    @foreach($roles as $role)
                                        <option
                                            {{ $rolesOfUser->contains('id', $role->id) ? 'selected' : '' }}
                                            value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
