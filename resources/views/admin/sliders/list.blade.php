<script>
    $(document).ready(function() {
        new Table({
            name: "sliders",
            columns: [
                {title: 'Id'},
                {
                    title: '<i class="far fa-image sorting-image"></i>',
                    data: 'main_image',
                    type: 'image',
                },
                
                {
                    title: 'Edit Delete',
                    render: function(data, type, row) {
                        return `<a class="row-title" href="/admin/categories/${row.id}/edit">${row.title}</a>
                                    <div>
                                        <ul class="actions-list">
                                            <li><a  href="/admin/sliders/${row.id}/edit">Edit</i></a></li>
                                            <li><button class="delete-confirm-btn" data-popup="delete-confirm-${data}">Trash</button></li>
                                        </ul>
                                        <div class="text-center delete-popup delete-confirm-${data} d-none">
                                            <div class="mb-1"> Are you sure?</div>
                                            <div class="d-flex justify-content-center">
                                                <form action="/admin/sliders/${row.id}" class="delete-form" method="POST">
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
                {title: 'Created_at'},
                { title: 'Updated_at', }
            ],
        })
    });
</script>
