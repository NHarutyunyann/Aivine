<!-- left column -->
<div class="col-md-9 main-content--large">
    <div class="row">
        <div class="col-12 card card-default main-card">
            <div class="card-body">
                {{-- @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'nickname']) --}}

                {{-- @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'first_name'])  --}}
                @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'name']) 

                {{-- @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'last_name']) --}}

                @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'email'])

                <div class="form-group">
                    <label for="password">
                        <span style="margin-right:10px">Password</span>
                    </label>
                    <div class="input-group-sm">
                        <a href="javascript:" class="btn-outline button mb-3" onclick="generatePassword()">Generate password</a>
                        <input class="form-control @error('password') is-invalid @enderror"
                               id="password" type="text" name="password" value="{{old('password')}}">
                        @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                @include('admin.model.inputs.text', ['entity' => $entity ?? null, 'field' => 'phone_number'])

                {{-- @include('admin.model.inputs.text', ['entity' => $entity->details ?? null, 'field' => 'contact_details'])  --}}

                {{-- @include('admin.model.inputs.text', ['entity' => $entity->details ?? null, 'field' => 'address']) --}}

                {{-- @include('admin.model.inputs.text', ['entity' => $entity->details ?? null, 'field' => 'city']) --}}

                {{-- @include('admin.model.inputs.text', ['entity' => $entity->details ?? null, 'field' => 'shipping_address']) --}}
            </div>
        </div>
    </div>
</div>

<!-- right column -->
<div class="col-md-3 main-content--small">
    <div class="row">
        <div class="col-12">
            @include('admin.model.actions-section', ['entity' => $entity ?? null])
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-default main-card">
                <div data-card-widget="collapse">
                    <div class="card-header">
                        <span>Role</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="input-group-sm">
                        <select class="form-control @error('role') is-invalid @enderror" id="role" name="role">
                            @foreach(\Spatie\Permission\Models\Role::where('name', '<>', 'Super Admin')->get() as $role)
                                <option
                                    value="{{$role->id}}" {{$role->id === old('role', @$entity->roles[0]->id) ? 'selected' : ''}}>{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('role')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
