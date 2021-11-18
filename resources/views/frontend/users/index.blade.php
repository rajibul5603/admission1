@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('user_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.users.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.username') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.guardian_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.brid') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.eiin') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.user_contact') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.email_verified_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.division') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.district') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.roles') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.upazila') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.union') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.user_photo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.user_signature') }}
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
                                            @foreach($roles as $key => $item)
                                                <option value="{{ $item->title }}">{{ $item->title }}</option>
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
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                    <tr data-entry-id="{{ $user->id }}">
                                        <td>
                                            {{ $user->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->username ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->guardian_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->brid ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->eiin ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->user_contact ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->email_verified_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->division->division_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->district->district_name ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($user->roles as $key => $item)
                                                <span>{{ $item->title }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $user->upazila->upazila_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->union->union_name ?? '' }}
                                        </td>
                                        <td>
                                            @if($user->user_photo)
                                                <a href="{{ $user->user_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $user->user_photo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->user_signature)
                                                <a href="{{ $user->user_signature->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $user->user_signature->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('user_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.users.show', $user->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('user_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.users.edit', $user->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('user_delete')
                                                <form action="{{ route('frontend.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.users.massDestroy') }}",
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
  let table = $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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