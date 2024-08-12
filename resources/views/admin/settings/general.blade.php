@extends('layouts.admin')
@section('title', 'General Settings')
@section('content')
    <div class="content-wrapper admin-pages-edit-content">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h1>General settings</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content container-fluid">
            <form id="create-form" action="{{ route('settings.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-9 main-content--large">
                        <div class="row">
                            <div class="col-12 card card-default main-card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        @foreach ($settings as $key => $value)
                                            <label for="{{ $key}}">{{ $key}}</label>
                                            <input name="{{ $key}}" value="{{$value}}" style="width: 100%; height:45px; margin-bottom:10px; padding-left:10px" type="text" class="form-control" aria-describedby="addon-wrapping">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                                <button class="btn btn-sm btn-primary" form="create-form"
                                                    type="submit">Update</button>
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
