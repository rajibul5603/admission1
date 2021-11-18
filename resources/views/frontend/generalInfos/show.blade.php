@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.generalInfo.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.general-infos.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.user_id_no') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->user_id_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.application_no') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->application_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.grants_name') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->grants_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.circular') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->circular->cirucular_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.brid') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->brid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.nid') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->nid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.father_name') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->father_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.father_nid') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->father_nid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.mother_name') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->mother_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.mother_nid') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->mother_nid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.dob') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->dob }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.age') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->age }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.gender') }}
                                    </th>
                                    <td>
                                        {{ App\Models\GeneralInfo::GENDER_SELECT[$generalInfo->gender] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.division') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->division->division_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.district') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->district->district_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.upazila') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->upazila->upazila_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.union') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->union->union_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.generalInfo.fields.village') }}
                                    </th>
                                    <td>
                                        {{ $generalInfo->village }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.general-infos.index') }}">
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