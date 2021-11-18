@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('banking_service_provider_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.banking-service-providers.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.bankingServiceProvider.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'BankingServiceProvider', 'route' => 'admin.banking-service-providers.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.bankingServiceProvider.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-BankingServiceProvider">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankingServiceProvider.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankingServiceProvider.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankingServiceProvider.fields.bank_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankingServiceProvider.fields.head_office') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankingServiceProvider.fields.known_as') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankingServiceProvider.fields.swift_code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankingServiceProvider.fields.category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankingServiceProvider.fields.website') }}
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
                                            @foreach($banking_types as $key => $item)
                                                <option value="{{ $item->banking_type }}">{{ $item->banking_type }}</option>
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
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\BankingServiceProvider::CATEGORY_SELECT as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bankingServiceProviders as $key => $bankingServiceProvider)
                                    <tr data-entry-id="{{ $bankingServiceProvider->id }}">
                                        <td>
                                            {{ $bankingServiceProvider->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankingServiceProvider->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankingServiceProvider->bank_type->banking_type ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankingServiceProvider->head_office ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankingServiceProvider->known_as ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankingServiceProvider->swift_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\BankingServiceProvider::CATEGORY_SELECT[$bankingServiceProvider->category] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankingServiceProvider->website ?? '' }}
                                        </td>
                                        <td>
                                            @can('banking_service_provider_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.banking-service-providers.show', $bankingServiceProvider->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('banking_service_provider_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.banking-service-providers.edit', $bankingServiceProvider->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('banking_service_provider_delete')
                                                <form action="{{ route('frontend.banking-service-providers.destroy', $bankingServiceProvider->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('banking_service_provider_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.banking-service-providers.massDestroy') }}",
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
  let table = $('.datatable-BankingServiceProvider:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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