export function axiosErrorMsg(error) {
    // stuff & things
    if (error.response) {
        // The request was made and the server responded with a status code
        // that falls out of the range of 2xx
        //error_msg=error.response.status;
        console.log(error.response.data);
        console.log(error.response.status);
        if (error.response.status === 419) {
            // authentication timeout. refresh page.
            document.location.reload(true);
        } else {
            console.log(error.response.headers);
            // parse laravel validation errors object
            if (error.response.data.errors) {
                let errors = [];
                Object.values(error.response.data.errors).forEach(function (value, index) {
                    errors.push(value.join('<br>'));
                });
                return errors.join('<br>');
            } else {
                return error.response.data.message || error.response.data;
            }
        }
    } else if (error.request) {
        // The request was made but no response was received
        // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
        // http.ClientRequest in node.js
        console.log(error.request);
        return error.request;
    } else {
        // Something happened in setting up the request that triggered an Error
        console.log(error);
        return error.message ? error.message : error;
    }
}

export function fillDataTable(response, table_selector, columns, order_by = 0, order_mode = 'asc', page_length = 100, options = null) {
    table_selector.DataTable().clear();
    $('[data-tool-alert]')
        .removeClass()
        .empty();
    datatableDeselectAllButtonDefinition();
    datatableSelectAllButtonDefinition();
    let bulk_buttons = [];
    if (table_selector.data('bulk-delete-url') && table_selector.data('bulk-delete-url').length > 0) {
        bulk_buttons.push('bulkDelete');
        datatableBulkDeleteButtonDefinition();
    }
    if (table_selector.data('bulk-detach-url') && table_selector.data('bulk-detach-url').length > 0) {
        datatableBulkDetachButtonDefinition();
        bulk_buttons.push('bulkDetach');
    }

    let parameters = {
        createdRow: options ? (options.createdRow ? options.createdRow : null) : null,
        fixedColumns: options ? (options.fixedColumns ? options.fixedColumns : false) : false,
        fixedHeader: options ? ((options.fixedHeader === true)) : false,
        order: [[order_by, order_mode]],
        destroy: true,
        select: true, // buttons
        pageLength: page_length,
        lengthMenu: [25, 50, 100],
        scrollX: options ? ((options.scrollX === true)) : true,
        paging: true,
        pagingType: options ? (options.pagingType?options.pagingType:'simple_numbers'):'simple_numbers',
        stateSave: options ? ((options.stateSave === true)):true,
        stateDuration: 0,// sessionStorage -1, or >=0 = localStorage, 0 is unlimited
        stateSaveParams: function (setting, data){
            if(options && options.displayStart!==null) {
                data.start = options.displayStart;
            }
        },
        initComplete: options ? (options.initComplete ? options.initComplete : null) : null,
        deferRender: true,
        info: true,
        processing: true,
        buttons: [
            'copyHtml5',
            {
                extend: 'csvHtml5',
                exportOptions: {orthogonal: 'export'}
            },
            {
                extend: 'excelHtml5',
                exportOptions: {orthogonal: 'export'},
                // 15 digits issue excel https://datatables.net/forums/discussion/49957/excel-csv-export-for-long-number-like-strings-large-numbers
                customizeData: function (data) {
                    for (var i = 0; i < data.body.length; i++) {
                        for (var j = 0; j < data.body[i].length; j++) {
                            data.body[i][j] = '\u200C' + data.body[i][j];
                        }
                    }
                }
            },
            //'pdfHtml5',
            'print',
            {
                extend: 'colvis',
                //collectionLayout: "two-column",
                columnText: function (dt, idx, title) {
                    let column = $(dt.column(idx).header());
                    if (column.data('colvis')) {
                        return column.data('colvis');
                    } else {
                        return title;
                    }
                }
            },
            'selectAll',
            'deselectAll',
        ],
        'columns': columns,
    };
    if (bulk_buttons.length > 0) {
        parameters.buttons.push({
            extend: 'collection',
            text: 'Bulk Action',
            buttons: bulk_buttons
        })
    }


    // default dom
    parameters.dom='<"d-flex flex-wrap justify-content-center"<"mr-auto"B><"mr-2"f><l>><"row"<"col-sm-12"r>><"row"<"col-sm-12"t>><"d-flex"<"mr-auto"i><p>>';
    //parameters.dom = 'Blfrtip';
    if (options) {
        if (options.dom) {
            parameters.dom = options.dom;
        }
        if (options.select) {
            parameters.select = options.select;
        }
        if (options.rowCallback) {
            parameters.rowCallback = options.rowCallback;
        }
        if(options.serverSide!==null){
            parameters.serverSide=options.serverSide;
        }
        if(options.processing!==null){
            parameters.processing=options.processing;
        }
        if(options.displayStart!==null){
            parameters.displayStart=options.displayStart;
        }

        if(options.ajax) {
            parameters.ajax = options.ajax;
        }
        else{
            if(!response && table_selector.data('url').length>0){
                parameters.ajax= $.fn.dataTable.pipeline( {
                    url: table_selector.data('url'),
                    type: 'get',
                    dataSrc:table_selector.data('ajax-data-src')?table_selector.data('ajax-data-src'):"",
                    pages: table_selector.data('ajax-data-pipeline-pages')?table_selector.data('ajax-data-pipeline-pages'):10 // number of pages to cache
                } )
            }
            else{
                parameters.data=response;
            }
        }
    } else {
        if(!response && table_selector.data('url').length>0){
            parameters.ajax= $.fn.dataTable.pipeline( {
                url: table_selector.data('url'),
                type: 'get',
                dataSrc:table_selector.data('ajax-data-src')?table_selector.data('ajax-data-src'):"",
                pages: table_selector.data('ajax-data-pipeline-pages')?table_selector.data('ajax-data-pipeline-pages'):10 // number of pages to cache
            } )
        }
        else {
            parameters.data = response;
        }
    }
    console.log(parameters);
    table_selector.show();
    table_selector.DataTable(parameters);
    if (options && options.search_query) {
        table_selector.DataTable().search(options.search_query).draw();
    }
}

export function toggleCheckboxes(selector) {
    selector.prop('checked', selector.prop("checked"));
    return true;
}

export function escapeHtml(text) {
    if (!text) return text;
    let map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };

    return text.replace(/[&<>"']/g, function (m) {
        return map[m];
    });
}

export function setRadioSelector(selector, value) {
    selector.each(function (index, selector_value) {
        console.log($(selector_value).val());
        if (parseInt($(selector_value).val()) === parseInt(value)) {
            $(this)
                .prop('checked', true)
                .closest('label')
                .addClass('active');
        } else {
            $(this)
                .prop('checked', false)
                .closest('label')
                .removeClass('active'); // uncheck all conditions
        }
    });
}

export function ajaxRequest(action, method, data = null, response_selector = null) {
    if (response_selector) {
        $(response_selector)
            .removeClass()
            .empty();
    }

    let axiosParams = {
        method: method,
        url: action,
    };
    if ((method.toLowerCase() === 'post' || method.toLowerCase() === 'put' || method.toLowerCase() === 'patch') && data) {
        axiosParams.data = data;
    }

    return axios(
        axiosParams
    )
        .then(
            function (response) {
                $('#preloader').fadeOut();
                $('#status').fadeOut();

                if (response_selector) {
                    $(response_selector)
                        .empty()
                        .removeClass()
                        .addClass('alert alert-success m-t-10')
                        .html(response.data);
                }
                return response;
            },
            function (error) {
                $('#preloader').fadeOut();
                $('#status').fadeOut();

                if (response_selector) {
                    $(response_selector)
                        .empty()
                        .removeClass()
                        .addClass('alert alert-danger mt-1')
                        .html(axiosErrorMsg(error));
                }
                throw error;
            });

}

export function goToTop() {
    $('html, body').animate({
        scrollTop: 0
    }, 200);
}

export function datatableSelectAllButtonDefinition() {
    //custom button to select all rows of a data table
    $.fn.dataTable.ext.buttons.selectAll = {
        text: 'Select All',
        className: "selectAllButton",
        action: function (e, dt, button, config) {
            dt.rows().select();
        }
    };
}

export function datatableDeselectAllButtonDefinition() {
    //custom button to select all rows of a data table
    $.fn.dataTable.ext.buttons.deselectAll = {
        text: 'Clear All',
        className: "deselectAllButton",
        action: function (e, dt, button, config) {
            dt.rows().deselect();
        }
    };
}

//
// Pipelining function for DataTables. To be used to the `ajax` option of DataTables
//
$.fn.dataTable.pipeline = function ( opts ) {
    // Configuration options
    var conf = $.extend( {
        pages: 5,     // number of pages to cache
        url: '',      // script url
        data: null,   // function or object with parameters to send to the server
                      // matching how `ajax.data` works in DataTables
        method: 'GET' // Ajax HTTP method
    }, opts );

    // Private variables for storing the cache
    var cacheLower = -1;
    var cacheUpper = null;
    var cacheLastRequest = null;
    var cacheLastJson = null;

    return function ( request, drawCallback, settings ) {
        var ajax          = false;
        var requestStart  = request.start;
        var drawStart     = request.start;
        var requestLength = request.length;
        var requestEnd    = requestStart + requestLength;

        if ( settings.clearCache ) {
            // API requested that the cache be cleared
            ajax = true;
            settings.clearCache = false;
        }
        else if ( cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper ) {
            // outside cached data - need to make a request
            ajax = true;
        }
        else if ( JSON.stringify( request.order )   !== JSON.stringify( cacheLastRequest.order ) ||
            JSON.stringify( request.columns ) !== JSON.stringify( cacheLastRequest.columns ) ||
            JSON.stringify( request.search )  !== JSON.stringify( cacheLastRequest.search )
        ) {
            // properties changed (ordering, columns, searching)
            ajax = true;
        }

        // Store the request for checking next time around
        cacheLastRequest = $.extend( true, {}, request );

        if ( ajax ) {
            // Need data from the server
            if ( requestStart < cacheLower ) {
                requestStart = requestStart - (requestLength*(conf.pages-1));

                if ( requestStart < 0 ) {
                    requestStart = 0;
                }
            }

            cacheLower = requestStart;
            cacheUpper = requestStart + (requestLength * conf.pages);

            request.start = requestStart;
            request.length = requestLength*conf.pages;

            // Provide the same `data` options as DataTables.
            if ( typeof conf.data === 'function' ) {
                // As a function it is executed with the data object as an arg
                // for manipulation. If an object is returned, it is used as the
                // data object to submit
                var d = conf.data( request );
                if ( d ) {
                    $.extend( request, d );
                }
            }
            else if ( $.isPlainObject( conf.data ) ) {
                // As an object, the data given extends the default
                $.extend( request, conf.data );
            }

            return $.ajax( {
                "type":     conf.method,
                "url":      conf.url,
                "data":     request,
                "dataType": "json",
                "cache":    false,
                "success":  function ( json ) {
                    cacheLastJson = $.extend(true, {}, json);

                    if ( cacheLower != drawStart ) {
                        json.data.splice( 0, drawStart-cacheLower );
                    }
                    if ( requestLength >= -1 ) {
                        json.data.splice( requestLength, json.data.length );
                    }

                    drawCallback( json );
                }
            } );
        }
        else {
            let json = $.extend( true, {}, cacheLastJson );
            json.draw = request.draw; // Update the echo for each response
            json.data.splice( 0, requestStart-cacheLower );
            json.data.splice( requestLength, json.data.length );

            drawCallback(json);
        }
    }
};

// Register an API method that will empty the pipelined data, forcing an Ajax
// fetch on the next draw (i.e. `table.clearPipeline().draw()`)
$.fn.dataTable.Api.register( 'clearPipeline()', function () {
    return this.iterator( 'table', function ( settings ) {
        settings.clearCache = true;
    } );
} );
