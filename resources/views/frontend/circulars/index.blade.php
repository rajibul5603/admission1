@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('circular_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.circulars.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.circular.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.circular.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Circular">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.circular.fields.circular_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.circular.fields.cirucular_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.circular.fields.circular_year') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.circular.fields.academic_year') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.circular.fields.policy') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.circular.fields.sec_stipend_amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.circular.fields.hsec_stipend_amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.circular.fields.hons_stipend_amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.circular.fields.application_deadline') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.circular.fields.circular_file') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\Circular::CIRCULAR_TYPE_SELECT as $key => $item)
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
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($academic_years as $key => $item)
                                                <option value="{{ $item->academic_year }}">{{ $item->academic_year }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($policies as $key => $item)
                                                <option value="{{ $item->policy_name }}">{{ $item->policy_name }}</option>
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
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($circulars as $key => $circular)
                                    <tr data-entry-id="{{ $circular->id }}">
                                        <td>
                                            {{ App\Models\Circular::CIRCULAR_TYPE_SELECT[$circular->circular_type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $circular->cirucular_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $circular->circular_year ?? '' }}
                                        </td>
                                        <td>
                                            {{ $circular->academic_year->academic_year ?? '' }}
                                        </td>
                                        <td>
                                            {{ $circular->policy->policy_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $circular->sec_stipend_amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $circular->hsec_stipend_amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $circular->hons_stipend_amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $circular->application_deadline ?? '' }}
                                        </td>
                                        <td>
                                            @if($circular->circular_file)
                                                <a href="{{ $circular->circular_file->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('circular_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.circulars.show', $circular->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('circular_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.circulars.edit', $circular->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('circular_delete')
                                                <form action="{{ route('frontend.circulars.destroy', $circular->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('circular_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.circulars.massDestroy') }}",
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
  let table = $('.datatable-Circular:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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