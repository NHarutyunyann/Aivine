@extends('layouts.admin')

@section('content')
    <div class="content-wrapper admin-role-creat-content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h1>Add New Role</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form id="create-form" class="row" action="{{route('roles.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- left column -->
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{old('name')}}" placeholder="name">
                                    @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <h4>Select Permissions</h4>
                                    </div>
                                    @foreach($permissions as $permission)
                                        <div class="col-4 pr-0 d-inline-flex align-items-baseline">
                                            <label for="permission_{{$permission->id}}">{{$permission->name}}</label>
                                            <input class="ml-2" type="checkbox" {{in_array($permission->id, old('permissions', [])) ? 'checked' : ''}}
                                                   id="permission_{{$permission->id}}" value="{{$permission->id}}" name="permissions[{{$permission->id}}]">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-5">
                                    <button class="btn btn-primary" form="create-form" type="submit">Save</button>
                                    <!--                                <button id="reset-form" onclick="document.getElementById('create-form').reset()" class="button btn-primary" type="reset">Reset</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        function generatePassword() {
            $('body #password').val(Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15))
        }
    </script>
@endsection
