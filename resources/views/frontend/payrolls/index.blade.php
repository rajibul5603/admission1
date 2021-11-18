@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('payroll_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.payrolls.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.payroll.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Payroll', 'route' => 'admin.payrolls.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.payroll.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Payroll">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payroll.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.payroll.fields.payroll_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.payroll.fields.circular') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.payroll.fields.division') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.payroll.fields.district') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.payroll.fields.upazila') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.payroll.fields.total_student') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.payroll.fields.financial_institutaion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.payroll.fields.total_assistance') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.payroll.fields.total_disbursement') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.payroll.fields.disbursement_status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.payroll.fields.activation_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.payroll.fields.deactivation_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.payroll.fields.api_key') }}
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
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($circulars as $key => $item)
                                                <option value="{{ $item->cirucular_name }}">{{ $item->cirucular_name }}</option>
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
                                @foreach($payrolls as $key => $payroll)
                                    <tr data-entry-id="{{ $payroll->id }}">
                                        <td>
                                            {{ $payroll->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $payroll->payroll_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $payroll->circular->cirucular_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $payroll->division->division_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $payroll->district->district_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $payroll->upazila->upazila_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $payroll->total_student ?? '' }}
                                        </td>
                                        <td>
                                            {{ $payroll->financial_institutaion ?? '' }}
                                        </td>
                                        <td>
                                            {{ $payroll->total_assistance ?? '' }}
                                        </td>
                                        <td>
                                            {{ $payroll->total_disbursement ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $payroll->disbursement_status ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $payroll->disbursement_status ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $payroll->activation_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $payroll->deactivation_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $payroll->api_key ?? '' }}
                                        </td>
                                        <td>
                                            @can('payroll_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.payrolls.show', $payroll->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('payroll_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.payrolls.edit', $payroll->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('payroll_delete')
                                                <form action="{{ route('frontend.payrolls.destroy', $payroll->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('payroll_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.payrolls.massDestroy') }}",
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
  let table = $('.datatable-Payroll:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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