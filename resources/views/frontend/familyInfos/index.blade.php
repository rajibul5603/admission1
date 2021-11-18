@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('family_info_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.family-infos.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.familyInfo.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'FamilyInfo', 'route' => 'admin.family-infos.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.familyInfo.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-FamilyInfo">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.familyInfo.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.familyInfo.fields.application_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.familyInfo.fields.familystatus') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.familyInfo.fields.guardian_occupation') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.familyInfo.fields.guardian_education') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.familyInfo.fields.guardian_land') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.familyInfo.fields.guardian_annual_income') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.familyInfo.fields.family_member') }}
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
                                            @foreach($family_statuses as $key => $item)
                                                <option value="{{ $item->status_name }}">{{ $item->status_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($occupations as $key => $item)
                                                <option value="{{ $item->occupation_name }}">{{ $item->occupation_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\FamilyInfo::GUARDIAN_EDUCATION_SELECT as $key => $item)
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
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($familyInfos as $key => $familyInfo)
                                    <tr data-entry-id="{{ $familyInfo->id }}">
                                        <td>
                                            {{ $familyInfo->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $familyInfo->application_number->application_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $familyInfo->familystatus->status_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $familyInfo->guardian_occupation->occupation_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\FamilyInfo::GUARDIAN_EDUCATION_SELECT[$familyInfo->guardian_education] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $familyInfo->guardian_land ?? '' }}
                                        </td>
                                        <td>
                                            {{ $familyInfo->guardian_annual_income ?? '' }}
                                        </td>
                                        <td>
                                            {{ $familyInfo->family_member ?? '' }}
                                        </td>
                                        <td>
                                            @can('family_info_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.family-infos.show', $familyInfo->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('family_info_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.family-infos.edit', $familyInfo->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('family_info_delete')
                                                <form action="{{ route('frontend.family-infos.destroy', $familyInfo->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('family_info_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.family-infos.massDestroy') }}",
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
  let table = $('.datatable-FamilyInfo:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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