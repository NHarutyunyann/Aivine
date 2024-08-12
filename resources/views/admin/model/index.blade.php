@extends('layouts.admin')
@section('title', ucfirst($resource))
@section('content')
    <div class="content-wrapper products-content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header mb-4">
                                <h1 class="card-title">{{ ucfirst($resource) }}</h1>
                                <div class="card-tools">
                                    <a href="{{route($resource . '.create')}}" class="btn">Add New</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-header mb-4">
                                    <div class="card-tools card-tools-list">
                                        @if(\Illuminate\Support\Facades\View::exists('admin.' . $resource . '.list-actions'))
                                            @include('admin.' . $resource . '.list-actions')
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 table-{{ $resource }}" id="table-init"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    @include('admin.' . $resource . '.list')
@endsection
