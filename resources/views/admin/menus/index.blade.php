@extends('layouts.admin')
@section('title', 'Menus')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header mb-4">
                                <h1 class="card-title">Menus</h1>
                                <div class="card-tools">
                                    <a class="btn" href="{{route('menus.create')}}">Add new</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12" id="table-init"></div>
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
    <script>
        $(document).ready(function () {
            new Table({
                name: "menus",
                columns: [
                    {data: 'id'},
                    {data: 'type'},
                    {
                        data: 'Title',
                        render: function (data, type, row) {
                            return `<a class="row-title" href="/admin/menus/${row.id}/edit">${row.title}</a>
                                    <div>
                                        <ul class="actions-list">
                                            <li><a  href="/admin/menus/${row.id}/edit">Edit</i></a></li>
                                            <li><button class="delete-confirm-btn" data-popup="delete-confirm-${data}">Trash</button></li>
                                        </ul>
                                        <div class="text-center delete-popup delete-confirm-${data} d-none">
                                            <div class="mb-1"> Are you sure?</div>
                                            <div class="d-flex justify-content-center">
                                                <form action="/admin/menus/${row.id}" class="delete-form" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                                            <button type="submit" class="mr-1 delete_form">
                                                                Yes
                                                            </button>
                                                </form>
                                                <button class="mr-1 delete-popup-close" type="button">
                                                    No
                                                </button>
                                            </div>
                                        </div>
                                    </div>`;
                        }
                    },
                    {data: 'active', type: 'boolean'},
                ],
            })
        });
    </script>
@endsection
