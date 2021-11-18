@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('government_office_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.government-offices.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.governmentOffice.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'GovernmentOffice', 'route' => 'admin.government-offices.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.governmentOffice.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-GovernmentOffice">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.governmentOffice.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.governmentOffice.fields.ministry_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.ministryDivision.fields.division_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.governmentOffice.fields.govt_ogranization_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.governmentOffice.fields.active') }}
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
                                            @foreach($ministry_divisions as $key => $item)
                                                <option value="{{ $item->ministry_name }}">{{ $item->ministry_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($governmentOffices as $key => $governmentOffice)
                                    <tr data-entry-id="{{ $governmentOffice->id }}">
                                        <td>
                                            {{ $governmentOffice->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $governmentOffice->ministry_name->ministry_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $governmentOffice->ministry_name->division_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $governmentOffice->govt_ogranization_name ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $governmentOffice->active ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $governmentOffice->active ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('government_office_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.government-offices.show', $governmentOffice->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('government_office_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.government-offices.edit', $governmentOffice->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('government_office_delete')
                                                <form action="{{ route('frontend.government-offices.destroy', $governmentOffice->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('government_office_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.government-offices.massDestroy') }}",
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
  let table = $('.datatable-GovernmentOffice:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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