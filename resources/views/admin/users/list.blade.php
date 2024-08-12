<script>
    $(document).ready(function() {
        new Table({
            name: "users",
            bulkActions: ['export', 'delete'],
            filters: [{
                name: 'status',
                options: {
                    'active': 'Active',
                    'inactive': 'Inactive',
                }
            }],
            columns: [{
                    title: 'Full Name',
                    render: function(data, type, row) {
                        return `<a class="row-title" href="/admin/users/${row.id}/edit">${row.name}</a>
                                    <div>
                                        <ul class="actions-list">
                                            <li><a  href="/admin/users/${row.id}/edit">Edit</i></a></li>
                                            <li><button class="delete-confirm-btn" data-popup="delete-confirm-${data}">Trash</button></li>
                                        </ul>
                                        <div class="text-center delete-popup delete-confirm-${data} d-none">
                                            <div class="mb-1"> Are you sure?</div>
                                            <div class="d-flex justify-content-center">
                                                <form action="/admin/users/${row.id}" class="delete-form" method="POST">
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
                {
                    title: 'Email'
                },
                {
                    title: 'Role',
                    render: function(data, type, row) {
                        return row.roles[0] ? row.roles[0].name : ''
                    }
                },
                {
                    title: 'status',
                },
                {
                    title: 'phone_number',
                },
                {
                    title: 'Created At',
                },

            ],
        })
    });
</script>
