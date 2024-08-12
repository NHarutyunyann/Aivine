@extends('layouts.admin')

@section('title', 'Edit ' . $modelName ?? '')

@section('content')
    <div class="content-wrapper admin-pages-edit-content">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h1>Edit {{ $modelName ?? '' }} #{{$entity->id}}</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content container-fluid">
            <form id="create-form" style="width: 100%;" action="{{isset($entity) ? route($resource . '.update', $entity->id) : route($resource . '.store')}}" method="post">
                @csrf
                @if(isset($entity)) @method('PUT') @endif

                <div class="row">
                    @include('admin.' . $resource . '._form', ['entity' => $entity])
                </div>
            </form>
        </section>
    </div>
@endsection
