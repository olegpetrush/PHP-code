<table id="NutrientsTable" class="table table-sm-px"
       data-url="{{$data_url}}"
       data-bulk-delete-url="{{$data_bulk_delete_url ?? ''}}"
       data-bulk-detach-url="{{$data_bulk_detach_url ?? ''}}"
       data-action-delete="{{$data_action_delete ?? true}}"
       data-action-update="{{$data_action_update ?? true}}"
       style="width: 100%"
>
    <thead class="bg-info text-light">
    @include('nutrients.table_columns')
    </thead>
    <tfoot class="bg-info text-light">
    @include('nutrients.table_columns')
    </tfoot>
</table>
