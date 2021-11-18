@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('educational_institute_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.educational-institutes.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.educationalInstitute.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'EducationalInstitute', 'route' => 'admin.educational-institutes.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.educationalInstitute.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-EducationalInstitute">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.educationalInstitute.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationalInstitute.fields.institution_eiin_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationalInstitute.fields.institution_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationalInstitute.fields.legal_status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationalInstitute.fields.academic_level') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationalInstitute.fields.institute_head') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationalInstitute.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationalInstitute.fields.mobile_phone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationalInstitute.fields.phone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationalInstitute.fields.division') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationalInstitute.fields.district') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationalInstitute.fields.upazila') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationalInstitute.fields.union') }}
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
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($institut_legal_statuses as $key => $item)
                                                <option value="{{ $item->institute_legal_status }}">{{ $item->institute_legal_status }}</option>
                                            @endforeach
                                        </select>
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
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($unions as $key => $item)
                                                <option value="{{ $item->union_name }}">{{ $item->union_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($educationalInstitutes as $key => $educationalInstitute)
                                    <tr data-entry-id="{{ $educationalInstitute->id }}">
                                        <td>
                                            {{ $educationalInstitute->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $educationalInstitute->institution_eiin_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $educationalInstitute->institution_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $educationalInstitute->legal_status->institute_legal_status ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($educationalInstitute->academic_levels as $key => $item)
                                                <span>{{ $item->level_name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $educationalInstitute->institute_head ?? '' }}
                                        </td>
                                        <td>
                                            {{ $educationalInstitute->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $educationalInstitute->mobile_phone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $educationalInstitute->phone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $educationalInstitute->division->division_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $educationalInstitute->district->district_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $educationalInstitute->upazila->upazila_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $educationalInstitute->union->union_name ?? '' }}
                                        </td>
                                        <td>
                                            @can('educational_institute_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.educational-institutes.show', $educationalInstitute->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('educational_institute_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.educational-institutes.edit', $educationalInstitute->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('educational_institute_delete')
                                                <form action="{{ route('frontend.educational-institutes.destroy', $educationalInstitute->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('educational_institute_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.educational-institutes.massDestroy') }}",
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
  let table = $('.datatable-EducationalInstitute:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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