@extends('layouts.admin')
@section('title', 'Posts')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header mb-4">
                                <h1 class="card-title">Posts</h1>
                                <div class="card-tools">
                                    <a href="{{route('posts.create')}}" class="btn">Add new</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 table-posts" id="table-init"></div>
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
                name: "posts",
                filters: [
                    {
                        name: 'status',
                        options: {
                            'active': 'Active',
                            'draft': 'Draft',
                        }
                    }
                ],
                columns: [
                    {
                        title: 'Title',
                        render: function (data, type, row) {
                            return `<a target="_blank" class="row-title" href="${row.publish_url}">${row.title}</a>
                                    <div>
                                        <ul class="actions-list">
                                            <li><a href="/admin/posts/${row.id}/edit">Edit</i></a></li>
                                            <li><button class="delete-confirm-btn" data-popup="delete-confirm-${data}">Trash</button></li>
                                            <li><a href="${row.publish_url}">View</i></a></li>
                                        </ul>
                                        <div class="text-center delete-popup delete-confirm-${data} d-none">
                                            <div class="mb-1"> Are you sure?</div>
                                            <div class="d-flex justify-content-center">
                                                <form action="/admin/posts/${row.id}" class="delete-form" method="POST">
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
                    {title: 'Slug'},
                 
                    {
                        title: 'Content',
                    },
                    {
                        title:'Date',
                        type:'date',
                        data: 'created_at'
                    },
                    {
                        data: 'SEO',
                        render: function (data, type, row) {
                            let color = 'grey';
                            const seoFields = ['meta_title', 'canonical', 'meta_description'];

                            let filled = [];
                            for (let i = 0; i < seoFields.length; i++){
                                let seoField = seoFields[i];

                                if (row[seoField]) {
                                    filled.push(seoField)
                                }
                            }
                            if (filled.length) {
                                color = 'orange';
                            }

                            if (JSON.stringify(filled) === JSON.stringify(seoFields)) {
                                color = 'green';
                            }

                            return `<i class="fas fa-circle" style="color: ${color}"></i>`;
                        }
                    },
                    {
                        title: 'Last Modified',
                        data: 'updated_at',
                        type:'date',
                    },
                ],
            })
        });
    </script>
@endsection
