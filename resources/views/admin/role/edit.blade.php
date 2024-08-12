@extends('layouts.admin')

@section('content')
    <div class="content-wrapper admin-role-edit-content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-6">
                        <h1>Edit Role - {{$role->name}}</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form id="edit-form" class="row" action="{{route('roles.update', $role->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- left column -->
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{$role->name}}" placeholder="name">
                                    @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row mt-4 mb-4">
                                    <div class="col-12">
                                        <h4>Select Permissions</h4>
                                    </div>
                                    @foreach($permissions as $permission)
                                        <div class="col-4">
                                            <label for="permission_{{$permission->id}}">{{$permission->name}}</label>
                                            <input class="ml-2" type="checkbox" {{in_array($permission->id, $role->permissions()->pluck('id')->toArray()) ? 'checked' : ''}}
                                            id="permission_{{$permission->id}}" value="{{$permission->id}}" name="permissions[{{$permission->id}}]">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-5">
                                <button class="btn btn-sm btn-primary" form="edit-form" type="submit">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
