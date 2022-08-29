@extends('layouts.admin')

@section('title')
    <title>Add new permissions</title>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name'=>'Permissions', 'key'=>'Add']);
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('permissions.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Select module name</label>
                                <select class="form-control" name="module_parent">
                                    <option value="">Select module name</option>
                                    @foreach(config('permissions.table_module') as $moduleItem)
                                        <option value = "{{$moduleItem}}">{{$moduleItem}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    @foreach(config('permissions.module_children') as $moduleItemChildren)
                                        <div class="col-md-3">
                                            <label for="">
                                                <input type="checkbox" value="{{$moduleItemChildren}}" name="module_children[]">
                                                {{ $moduleItemChildren }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
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
