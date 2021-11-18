@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('application_tracking_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.application-trackings.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.applicationTracking.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'ApplicationTracking', 'route' => 'admin.application-trackings.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.applicationTracking.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ApplicationTracking">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.applicationTracking.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.applicationTracking.fields.user_id_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.applicationTracking.fields.application_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.applicationTracking.fields.is_completed') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.applicationTracking.fields.is_submitted') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.applicationTracking.fields.ih_seen') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.applicationTracking.fields.ih_approve') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.applicationTracking.fields.ih_forwarded') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.applicationTracking.fields.useo_forwarded') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.applicationTracking.fields.pmeat_accepted') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.applicationTracking.fields.pmeat_selected') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.applicationTracking.fields.rejection_reaseon') }}
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
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($users as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applicationTrackings as $key => $applicationTracking)
                                    <tr data-entry-id="{{ $applicationTracking->id }}">
                                        <td>
                                            {{ $applicationTracking->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $applicationTracking->user_id_no->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $applicationTracking->application_no ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $applicationTracking->is_completed ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $applicationTracking->is_completed ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $applicationTracking->is_submitted ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $applicationTracking->is_submitted ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $applicationTracking->ih_seen ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $applicationTracking->ih_seen ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $applicationTracking->ih_approve ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $applicationTracking->ih_approve ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $applicationTracking->ih_forwarded ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $applicationTracking->ih_forwarded ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $applicationTracking->useo_forwarded ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $applicationTracking->useo_forwarded ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $applicationTracking->pmeat_accepted ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $applicationTracking->pmeat_accepted ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $applicationTracking->pmeat_selected ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $applicationTracking->pmeat_selected ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $applicationTracking->rejection_reaseon ?? '' }}
                                        </td>
                                        <td>
                                            @can('application_tracking_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.application-trackings.show', $applicationTracking->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('application_tracking_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.application-trackings.edit', $applicationTracking->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('application_tracking_delete')
                                                <form action="{{ route('frontend.application-trackings.destroy', $applicationTracking->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('application_tracking_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.application-trackings.massDestroy') }}",
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
  let table = $('.datatable-ApplicationTracking:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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