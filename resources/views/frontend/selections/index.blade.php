@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('selection_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.selections.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.selection.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.selection.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Selection">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.selection.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.selection.fields.app_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.selection.fields.user') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.selection.fields.ih_comments') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.selection.fields.ih_approval') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.selection.fields.ih_submission') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.selection.fields.useo_approval') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.selection.fields.useo_submission') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.selection.fields.pmeat_comments') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.selection.fields.pmeat_approval') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.selection.fields.eiin') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.selection.fields.division') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.selection.fields.district') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.selection.fields.upazila') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\Selection::USEO_APPROVAL_SELECT as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\Selection::PMEAT_APPROVAL_SELECT as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($selections as $key => $selection)
                                    <tr data-entry-id="{{ $selection->id }}">
                                        <td>
                                            {{ $selection->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $selection->app_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $selection->user ?? '' }}
                                        </td>
                                        <td>
                                            {{ $selection->ih_comments ?? '' }}
                                        </td>
                                        <td>
                                            {{ $selection->ih_approval ?? '' }}
                                        </td>
                                        <td>
                                            {{ $selection->ih_submission ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Selection::USEO_APPROVAL_SELECT[$selection->useo_approval] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $selection->useo_submission ?? '' }}
                                        </td>
                                        <td>
                                            {{ $selection->pmeat_comments ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Selection::PMEAT_APPROVAL_SELECT[$selection->pmeat_approval] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $selection->eiin ?? '' }}
                                        </td>
                                        <td>
                                            {{ $selection->division ?? '' }}
                                        </td>
                                        <td>
                                            {{ $selection->district ?? '' }}
                                        </td>
                                        <td>
                                            {{ $selection->upazila ?? '' }}
                                        </td>
                                        <td>
                                            @can('selection_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.selections.show', $selection->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('selection_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.selections.edit', $selection->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('selection_delete')
                                                <form action="{{ route('frontend.selections.destroy', $selection->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('selection_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.selections.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Selection:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection