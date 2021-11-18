@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('education_institute_info_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.education-institute-infos.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.educationInstituteInfo.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.educationInstituteInfo.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-EducationInstituteInfo">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.educationInstituteInfo.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationInstituteInfo.fields.application_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationInstituteInfo.fields.education_level') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationInstituteInfo.fields.eiin') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationInstituteInfo.fields.last_gpa') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationInstituteInfo.fields.last_gpa_total') }}
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
                                            @foreach($general_infos as $key => $item)
                                                <option value="{{ $item->application_no }}">{{ $item->application_no }}</option>
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
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($educational_institutes as $key => $item)
                                                <option value="{{ $item->institution_eiin_no }}">{{ $item->institution_eiin_no }}</option>
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
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($educationInstituteInfos as $key => $educationInstituteInfo)
                                    <tr data-entry-id="{{ $educationInstituteInfo->id }}">
                                        <td>
                                            {{ $educationInstituteInfo->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $educationInstituteInfo->application_number->application_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $educationInstituteInfo->education_level->level_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $educationInstituteInfo->eiin->institution_eiin_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $educationInstituteInfo->last_gpa ?? '' }}
                                        </td>
                                        <td>
                                            {{ $educationInstituteInfo->last_gpa_total ?? '' }}
                                        </td>
                                        <td>
                                            @can('education_institute_info_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.education-institute-infos.show', $educationInstituteInfo->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('education_institute_info_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.education-institute-infos.edit', $educationInstituteInfo->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('education_institute_info_delete')
                                                <form action="{{ route('frontend.education-institute-infos.destroy', $educationInstituteInfo->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('education_institute_info_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.education-institute-infos.massDestroy') }}",
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
  let table = $('.datatable-EducationInstituteInfo:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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