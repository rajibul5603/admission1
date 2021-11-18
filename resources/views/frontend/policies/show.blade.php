@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.policy.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.policies.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.policy.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $policy->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.policy.fields.policy_name') }}
                                    </th>
                                    <td>
                                        {{ $policy->policy_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.policy.fields.policy_year') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Policy::POLICY_YEAR_SELECT[$policy->policy_year] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.policy.fields.last_gpa') }}
                                    </th>
                                    <td>
                                        {{ $policy->last_gpa }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.policy.fields.max_annual_income') }}
                                    </th>
                                    <td>
                                        {{ $policy->max_annual_income }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.policy.fields.active') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $policy->active ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.policies.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection