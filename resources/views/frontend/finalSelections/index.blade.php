@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('final_selection_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.final-selections.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.finalSelection.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.finalSelection.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-FinalSelection">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.finalSelection.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.finalSelection.fields.app_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.finalSelection.fields.student_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.finalSelection.fields.brid') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.finalSelection.fields.father_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.finalSelection.fields.mother_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.finalSelection.fields.academic_level') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.finalSelection.fields.admission_class') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.finalSelection.fields.education_institute') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.finalSelection.fields.division') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.finalSelection.fields.district') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.finalSelection.fields.upazila') }}
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
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($academic_levels as $key => $item)
                                                <option value="{{ $item->level_name }}">{{ $item->level_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($level_wise_classes as $key => $item)
                                                <option value="{{ $item->class_name }}">{{ $item->class_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($educational_institutes as $key => $item)
                                                <option value="{{ $item->institution_name }}">{{ $item->institution_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($divisions as $key => $item)
                                                <option value="{{ $item->division_name }}">{{ $item->division_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($districts as $key => $item)
                                                <option value="{{ $item->district_name }}">{{ $item->district_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($upazilas as $key => $item)
                                                <option value="{{ $item->upazila_name }}">{{ $item->upazila_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($finalSelections as $key => $finalSelection)
                                    <tr data-entry-id="{{ $finalSelection->id }}">
                                        <td>
                                            {{ $finalSelection->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $finalSelection->app_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $finalSelection->student_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $finalSelection->brid ?? '' }}
                                        </td>
                                        <td>
                                            {{ $finalSelection->father_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $finalSelection->mother_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $finalSelection->academic_level->level_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $finalSelection->admission_class->class_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $finalSelection->education_institute->institution_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $finalSelection->division->division_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $finalSelection->district->district_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $finalSelection->upazila->upazila_name ?? '' }}
                                        </td>
                                        <td>
                                            @can('final_selection_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.final-selections.show', $finalSelection->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('final_selection_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.final-selections.edit', $finalSelection->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('final_selection_delete')
                                                <form action="{{ route('frontend.final-selections.destroy', $finalSelection->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('final_selection_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.final-selections.massDestroy') }}",
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
  let table = $('.datatable-FinalSelection:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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