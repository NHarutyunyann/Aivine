@extends('layouts.admin')

@section('title', 'General News')

@section('content')
    <div class="content-wrapper admin-pages-edit-content">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h1>General News</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content container-fluid">
            <form id="create-form" style="width: 100%;" action="{{route('users.generalNews.store')}}" method="post">
                @csrf

                <div class="row">
                    <!-- left column -->
                    <div class="col-md-9 main-content--large">

                        <div class="row">
                            <div class="col-12 card card-default main-card">
                                <div class="card-body">
                                    <div class="ml-5 form-group-sm">
                                        <label for="set_as_new" class="mr-2">Set As New</label>
                                        <input type="checkbox" class="form-control" id="set_as_new" name="set_as_new" value="1">
                                    </div>

                                    <div class="card card-default collapsed-card main-card">
                                        <div class="card-header" data-card-widget="collapse">News Content</div>
                                        <div class="card-body tinymce-box">
                                            <textarea class="form-control tinymce" name="general_news" rows="{{ $rows ?? 20 }}">{{ $settings->get('general_news') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- right column -->
                    <div class="col-md-3 main-content--small">
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-default main-card">
                                    <div class="card-header" data-card-widget="collapse">
                                        <span>Actions</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4 text-right">
                                                <button class="btn btn-sm btn-primary" form="create-form" type="submit">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-default main-card">
                                    <div data-card-widget="collapse">
                                        <div class="card-header">
                                            <span>Disable for Users</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 category-search-box">
                                                <user-select :prop-selected="{{ \App\Models\UserNewsDisabled::all()->pluck('user_id') }}"/>
                                                @error('users')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
