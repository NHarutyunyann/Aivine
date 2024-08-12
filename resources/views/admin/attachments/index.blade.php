@extends('layouts.admin')
@section('title', 'Media')

@section('content')
    <div class="content-wrapper admin-galleries-edit-creat-content">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h1>Media</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <attachments/>
            </div>
        </section>
    </div>
@endsection
