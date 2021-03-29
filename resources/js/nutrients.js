$(function () {
    let datatable = $('#NutrientsTable');
    let page_length = 50;
    let pages_default = 10;
    let sort_by_column = 17;
    let sort_by_column_order = 'desc'; // asc|desc

    let options = {
        scrollX: true,
        serverSide: false,
        processing: true,
        stateSave: false
    };
    if (datatable.length > 0) {
        let is_action_update_allowed = (!!datatable.data('action-update'));
        let is_action_delete_allowed = (!!datatable.data('action-delete'));
        let columns = [
            {
                data: null,
                className: 'nowrap',
                orderable: false,
                searchable: false,
                render: function (data, type, full, meta) {
                    if (type === 'display') {
                        let html = '';
                        if (full.update_url && is_action_update_allowed) {
                            html += '<a title="Edit" href="' + full.update_url + '" role="button" class="btn btn-warning btn-sm mr-1""><i class="mdi mdi-database-edit"></i></a>';
                        }
                        if (full.delete_url && is_action_delete_allowed) {
                            html += '<button title="Delete" data-delete class="btn btn-danger btn-sm mr-1"><i class="mdi mdi-database-remove"></i></button>';
                        }
                        return html;
                    } else {
                        return null;
                    }
                }
            },
            {
                data: 'id',
                className: "nowrap",
                visible:false
            },
            {
                data: 'name',
                className: "nowrap",
                render: function (data, type, full, meta) {
                    if (type === 'display') {
                        if (full.view_url) {
                            return data?'<a href="' + full.view_url + '">' + data + '</a>':'&mdash;';
                        } else {
                            return data ? data : '&mdash;';
                        }
                    } else {
                        return data;
                    }
                }
            },
            {
                data: 'other_name',
                className: "nowrap",
            },
            {
                data: 'type',
                className: "nowrap",
            },
            {
                data: 'daily_value_men',
                className: "nowrap",
            },
            {
                data: 'daily_value_women',
                className: "nowrap",
            },
            {
                data: 'upper_limit',
                className: "nowrap",
            },
            {
                data: 'daily_value_unit',
                className: "nowrap",
            },
            {
                data: 'primary_sources',
                className: "fixedtitle150",
            },
            {
                data: 'secondary_sources',
                className: "fixedtitle150",
            },
            {
                data: 'benefits',
                className: "fixedtitle150",
            },
            {
                data: 'side_effects',
                className: "fixedtitle150",
            },
            {
                data: 'interactions',
                className: "fixedtitle150",
            },
            {
                data: 'risks',
                className: "fixedtitle150",
            },
            {
                data: 'notes',
                className: "fixedtitle150",
            },
            {
                data: 'created_at',
                className: "nowrap",
                render: function (data, type, full, meta) {
                    if(type==='display' || type==='export') {
                        return data ? moment(data).format('lll') : '&mdash;';
                    }
                    else{
                        return data;
                    }
                }
            },
            {
                data: 'updated_at',
                className: "nowrap",
                render: function (data, type, full, meta) {
                    if(type==='display' || type==='export') {
                        return data ? moment(data).format('lll') : '&mdash;';
                    }
                    else{
                        return data;
                    }
                }

            }
        ];

        let url = datatable.data('url');
        let query_string = new URLSearchParams(window.location.search).toString();
        url = (url.indexOf("?") > 0) ? (url + '&' + query_string) : (url + '?' + query_string);
        datatable.data('url', url);

        common.fillDataTable(
            null,
            datatable,
            columns,
            sort_by_column,
            sort_by_column_order,
            page_length,
            options
        );

        datatable
            .on('click', 'button[data-delete]', function (e) {
                e.preventDefault();
                let tr = $(this).closest('tr');
                let row = $(e.delegateTarget).DataTable().row(tr);
                let full = row.data();
                swal.fire({
                    title: 'Are you sure to delete Nutrient "' + full.name + '"?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-alt-success',
                    cancelButtonClass: 'btn btn-alt-danger ml-1',
                    confirmButtonText: 'Yes, delete it!',
                }).then(function (result) {
                    // submit
                    if (result.value) {
                        //$('[role="status"]').show();
                        common.ajaxRequest(full.delete_url, 'delete')
                            .then(function (response) {
                                $(e.delegateTarget).DataTable().row(row).remove().draw();
                                //$('[role="status"]').hide();
                            }, function (error) {
                                //$('[role="status"]').hide();
                                swal.fire({
                                    type: 'error',
                                    text: common.axiosErrorMsg(error)
                                })
                            });
                    }
                });

            })
    }

});
