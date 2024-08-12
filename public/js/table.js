
const Table = function (params) {
    const instance = this
    const options = {...{
            actions: true,
            bulkActions: ['delete'],
            filters: [],
            datatableOptions: {}
        },
        ...params
    }

    instance.data = {
        filters: {},
        filterLinks: {},
    }

    instance.init = () => {

        const tableContainer = $('body #table-init')
        tableContainer.html(`<table class="table table-striped table-bordered dataTable  datatable w-100"
                                              role="grid" aria-describedby="datatable_info">
                                            <thead><tr role="row"><th><input type='checkbox' id='select-all'></th>
                                                ${renderColumnHeaders()}
                                            </tr></thead>
                                            <tfoot><tr role="row"><th><input type='checkbox' id='select-all'></th>
                                                ${renderColumnHeaders()}
                                            </tr></tfoot>
                                            </table>`)



        instance.dataTable = $('.datatable').DataTable({...{
            columnDefs: [{"orderable": false, "targets": [0]}],
            "dom": '<"top row align-center"<"#filter-links-container.col-12.filter-links"><"col-12 searchBox"f><"#action-container.col-2"><"#filter-container.col-6"><"col-1 text-right"l><"col-3"p>>rt<"bottom row"<"col-7"i><"col-3 ml-auto"p>><"clear">',
            processing: true,
            search: {return: true},
            language: { search: "", sLengthMenu: "Show _MENU_" },
            lengthMenu: [
                [10, 25, 50, 100, 500],
                [10, 25, 50, 100, 500],
            ],
            serverSide: true,
            pageLength: 25,
            ajax: {
                url: `/admin/${options.name}/draw`,
                data: function (data) {
                    data.filters = {}
                    let filters = Array.from($('body select.filter-select'))
                    for(let i = 0; i < filters.length; i++) {
                        instance.data.filters[filters[i].getAttribute('name')] = filters[i].value
                    }

                    data.filters = instance.data.filters
                    data.filterLinks = instance.data.filterLinks
                },
            },
            columns: columnOptions(),

            initComplete : function() {
                let input = $('.dataTables_filter input').unbind()
                        .keypress(function(event){
                        if((event.keyCode || event.which) === 13){
                            self.search($(this).val()).draw();
                        }
                    }),
                    self = this.api(),
                    $searchButton = $('<button class="btn-outline">')
                        .text('Search')
                        .click(function() {
                            self.search(input.val()).draw();
                        })
                $('.dataTables_filter').append($searchButton);
            },
            drawCallback: function({json} ) {
                const filterLinksContainer = $('body #filter-links-container')
                filterLinksContainer.html('');
               if(json.filterLinks) {
                   const filterKeys = Object.keys(json.filterLinks);
                   if(filterKeys.length) {
                       filterLinksContainer.html(`<a href="javascript:" class="filter-link-item">All<span class="count">(${json.iTotalRecords})</span><span class="line">|</span></a>`);
                   }
                   for (let i = 0; i < filterKeys.length; i++) {
                       Object.keys(json.filterLinks[filterKeys[i]])
                           .map(link => filterLinksContainer.append(
                               `<a href="javascript:" class="filter-link-item" data-filter="${filterKeys[i]}" data-value="${json.filterLinks[filterKeys[i]][link].value}">${link}<span class="count">(${json.filterLinks[filterKeys[i]][link].count})</span><span class="line">|</span></a>`
                           ));
                   }
               }
            }
        }, ...options.datatableOptions});

        const body = $('body')

        body.find('#action-container').html(renderTableContent())
        body.find('#filter-container').html(renderFilters())

        body.on("change", "#select-all", function () {
            $('.select-row').prop('checked', $(this).is(':checked'))
        });

        body.on('change', '.filter-select', function () {
            instance.dataTable.draw();
        });

        body.on('click', '.filter-link-item', function (e) {
            if($(this).attr('data-filter')) {
                instance.data.filterLinks = {...{}, ...{[$(this).attr('data-filter')]: $(this).attr('data-value')}}
            } else {
                instance.data.filterLinks = {}
            }

            instance.dataTable.draw();
        });

        body.on("click", "#bulk-apply", function () {
            const selected = $("body .select-row:checked").map(function(){return $(this).val()}).get()
            const action = $('body #bulk-action').val()
            console.log('selected: ', selected)
            console.log('action: ', action)

            if(action === 'export') {
                location.href = `/admin/${options.name}/bulk-actions?action=${action}&${selected.map(i => 'selected[]=' + i).join('&')}`;
            }

            if(selected.length && action) {
                axios.post(`/admin/${options.name}/bulk-actions`, {
                    selected,
                    action
                }).then(({data}) => {
                    $('.datatable').DataTable().ajax.reload();
                    $('body #select-all').prop('checked', false)
                })
            }
        });

        body.on('click', '.delete-confirm-btn', function () {
            $(`body .${$(this).attr('data-popup')}`).removeClass('d-none')
        })

        body.on('click', '.delete-popup-close', function () {
            $('body .delete-popup').addClass('d-none')
        })
    }

    function renderColumnHeaders() {
        let content = ''

        for(let i = 0; i < options.columns.length; i++) {
            const column = options.columns[i]
            content += `<th>${column.title || capitalize(column.data.replace('_', ' '))}</th>`
        }


        return content
    }

    function renderTableContent() {
        const modalContent = document.createElement('div');
              modalContent.innerHTML = `<div class="modal modal-sm bulk-confirm" id="bulk-confirm"><div class="modal-dialog"><div class="modal-content">
                    <div class="modal-body"><p>Are you sure to apply action?</p></div>
                    <div class="modal-footer justify-content-between"><button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" id="bulk-apply" data-dismiss="modal" class="btn btn-danger">Apply</button></div></div></div></div>`;
        document.body.append(modalContent);

        let actions = ''

        for(let i = 0; i < options.bulkActions.length; i++) {
            const action = options.bulkActions[i]
            actions += `<option value="${action}">${capitalize(action.replaceAll('_', ' '))}</option>`
        }

        return `<select id="bulk-action" class="form-control">
                                                    <option>Bulk actions</option>
                                                    ${actions}
                                                </select><button data-toggle="modal" data-target="#bulk-confirm" class="btn bulk-apply">Apply</button>`;
    }

    function renderFilters() {

        let filters = '<div class="row" style="margin-left: 10px">'

        for(let i = 0; i < options.filters.length; i++) {
            const filter = options.filters[i]
            let filterOptions = ''
            if (typeof filter.options === 'string'){
                filterOptions = filter.options
            } else {
                filterOptions = Object.keys(filter.options).map(key => `<option value="${key}">${filter.options[key]}</option>`)
            }


            filters += `<div class=""><select name="${filter.name}" class="form-control filter-select">
                                                    <option value selected="selected">Filter by ${capitalize(filter.name.replace('_', ' '))}</option>
                                                    ${filterOptions}
                                                </select></div>`
        }

        filters += '</div>'

        return filters
    }

    function columnOptions() {
        let result = [
            {
                data: 'id', render: function (data) {
                    return `<input type="checkbox" class="select-row" value="${data}">`
                }
            }
        ]

        for(let i = 0; i < options.columns.length; i++) {
            const column = options.columns[i]

            let field

            if(column.data) {
                field = column.data
            } else if(column.render){
                field = 'id'
            } else {
                field = column.title.replace(' ', '_').toLowerCase()
            }

            const row = {
                orderable: column.orderable !== false,
                data: field,
            }

            if(column.render) {
                row.render = column.render
            } else {
                switch (column.type) {
                    case 'date': {
                        row.render = function (data, type, row) {
                            return moment(data).format("YYYY/MM/DD HH:mm a")
                        }
                        break;
                    }
                    case 'image': {
                        row.render = function (data, type, row) {
                            return data ? `<img loading="lazy"  width="110" src="${data.urls && data.urls.medium}">` : 'no image'
                        }
                        break;
                    }
                    case 'price': {
                        row.render = function (data, type, row) {
                            return priceFormatter(data)
                        }
                        break;
                    }
                    case 'boolean': {
                        row.render = function (data, type, row) {
                            return data ? 'Yes' : 'No'
                        }
                        break;
                    }
                }
            }

            result.push(row)
        }

        return result
    }

    instance.init()
}
