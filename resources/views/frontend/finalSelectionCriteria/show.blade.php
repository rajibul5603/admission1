@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.finalSelectionCriterion.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.final-selection-criteria.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.finalSelectionCriterion.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $finalSelectionCriterion->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.finalSelectionCriterion.fields.final_criteria_name') }}
                                    </th>
                                    <td>
                                        {{ $finalSelectionCriterion->final_criteria_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.finalSelectionCriterion.fields.cirular') }}
                                    </th>
                                    <td>
                                        {{ $finalSelectionCriterion->cirular->cirucular_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.finalSelectionCriterion.fields.division') }}
                                    </th>
                                    <td>
                                        {{ $finalSelectionCriterion->division->division_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.finalSelectionCriterion.fields.district') }}
                                    </th>
                                    <td>
                                        {{ $finalSelectionCriterion->district->district_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.finalSelectionCriterion.fields.upazila') }}
                                    </th>
                                    <td>
                                        {{ $finalSelectionCriterion->upazila->upazila_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.finalSelectionCriterion.fields.active') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $finalSelectionCriterion->active ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.final-selection-criteria.index') }}">
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