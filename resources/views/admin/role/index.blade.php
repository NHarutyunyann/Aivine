@extends('layouts.admin')
@section('title', 'Role')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header mb-4">
                                <h1 class="card-title">Roles</h1>
                                <div class="card-tools">
                                    <a class="btn" href="{{route('roles.create')}}">Add new</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-striped table-bordered dataTable datatable" role="grid"
                                               aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr role="row">
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('.datatable').DataTable({
                order: [[ 0, "desc" ]],
                "dom": '<"top row"<"col-12 searchBox"f><"#action-container.col-2"><"#filter-container.col-6"><"col-3 ml-auto"p>>rt<"bottom row"<"col-9"i><"col-3"p>><"clear">',
                processing: true,
                serverSide: true,
                search: {return: true},
                language: { search: "" },
                ajax: "{{route('admin.role.draw')}}",
                columns: [
                    { data: 'id' },
                    {
                        data: 'Name',
                        render: function (data, type, row) {
                            return `<a class="row-title" href="/admin/role/${row.id}/edit">${row.name}</a>
                                    <div>
                                        <ul class="actions-list">
                                            <li><a class="btn btn-info" href="/admin/role/${row.id}/edit">Edit</i></a></li>
                                            <li><button class="btn btn-raised btn-icon btn-danger delete-confirm-btn" data-popup="delete-confirm-${data}">Trash</button></li>
                                        </ul>
                                        <div class="text-center delete-popup delete-confirm-${data} d-none">
                                            <div class="mb-1"> Are you sure?</div>
                                            <div class="d-flex justify-content-center">
                                                <form action="/admin/role/${row.id}" class="delete-form" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                                            <button type="submit" class="btn btn-raised btn-danger mr-1 delete_form">
                                                                Yes
                                                            </button>
                                                </form>
                                                <button class="btn btn-raised btn-secondary mr-1 delete-popup-close" type="button">
                                                    No
                                                </button>
                                            </div>
                                        </div>
                                    </div>`;
                        }
                    },
                ],
                initComplete : function() {
                    let input = $('.dataTables_filter input').unbind(),
                        self = this.api(),
                        $searchButton = $('<button class="btn-outline">')
                            .text('Search')
                            .click(function() {
                                self.search(input.val()).draw();
                            })
                    $('.dataTables_filter').append($searchButton);
                }
            });
        });
    </script>
@endsection
