@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('institute_bank_account_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.institute-bank-accounts.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.instituteBankAccount.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.instituteBankAccount.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-InstituteBankAccount">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.instituteBankAccount.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.instituteBankAccount.fields.banking_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.instituteBankAccount.fields.account_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.instituteBankAccount.fields.account_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.instituteBankAccount.fields.bank_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.instituteBankAccount.fields.branch_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.instituteBankAccount.fields.routing_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.instituteBankAccount.fields.eiin') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.educationalInstitute.fields.institution_eiin_no') }}
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
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($banking_service_providers as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($bank_branches as $key => $item)
                                                <option value="{{ $item->branch_name }}">{{ $item->branch_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($bank_branches as $key => $item)
                                                <option value="{{ $item->routing_number }}">{{ $item->routing_number }}</option>
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
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($instituteBankAccounts as $key => $instituteBankAccount)
                                    <tr data-entry-id="{{ $instituteBankAccount->id }}">
                                        <td>
                                            {{ $instituteBankAccount->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $instituteBankAccount->banking_type->banking_type ?? '' }}
                                        </td>
                                        <td>
                                            {{ $instituteBankAccount->account_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $instituteBankAccount->account_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $instituteBankAccount->bank_name->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $instituteBankAccount->branch_name->branch_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $instituteBankAccount->routing_no->routing_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $instituteBankAccount->eiin->institution_eiin_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $instituteBankAccount->eiin->institution_eiin_no ?? '' }}
                                        </td>
                                        <td>
                                            @can('institute_bank_account_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.institute-bank-accounts.show', $instituteBankAccount->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('institute_bank_account_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.institute-bank-accounts.edit', $instituteBankAccount->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('institute_bank_account_delete')
                                                <form action="{{ route('frontend.institute-bank-accounts.destroy', $instituteBankAccount->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('institute_bank_account_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.institute-bank-accounts.massDestroy') }}",
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
  let table = $('.datatable-InstituteBankAccount:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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