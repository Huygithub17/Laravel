@extends('layouts.admin')

@section('title')
    <title>Edit Role</title>
@endsection

@section('css')
    <link href= "{{ asset('vendors/select_2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('admins/role/add/add.css')}}">
@endsection

@section('js')
    <script src="{{ asset('vendors/select_2/select2.min.js') }}"></script>
    <script src="{{ asset('admins/role/add/add.js') }}"></script>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name'=>'Roles', 'key'=>'Edit']);
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{route('roles.update', ['id'=>$role->id])}}" method="post" enctype="multipart/form-data" style="width: 100%">
                        <div class="col-md-10">
                            @csrf
                            <div class="form-group">
                                <label>Tên Role</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       placeholder="Nhập tên Roles"
                                       value="{{ $role->name }}"
                                >
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Display name</label>
                                <textarea
                                    class="form-control @error('display_name') is-invalid @enderror"
                                    name="display_name" rows="4">{{ $role->display_name }}</textarea>

                                @error('display_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>
                                        <input type="checkbox" class="checkall">
                                        Check all
                                    </label>
                                </div>
                                @foreach($permissionsParents as $permissionsParentItem)
                                    <div class="card text-white bg-secondary mb-3 col-md-12">
                                        <div class="row">
                                            <div class="card-header col-md-12">
                                                <lable>
                                                    <input type="checkbox" value="" class="checkbox_wrapper">
                                                </lable>
                                                Module {{$permissionsParentItem->name}}
                                            </div>
                                        </div>

                                        <div class="row">
                                            @foreach($permissionsParentItem->permissionsChildren as $permissionsChildrenItem)
                                                <div class="card-body col-md-3">
                                                    <h5 class="card-title">
                                                        <label>
                                                            <input type="checkbox" name="permission_id[]"
                                                                   {{$permissionChecked->contains('id', $permissionsChildrenItem->id) ? 'checked' : ''}}
                                                                   class="checkbox_children"
                                                                   value="{{$permissionsChildrenItem->id}}">
                                                        </label>
                                                        {{$permissionsChildrenItem->name}}
                                                    </h5>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
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
