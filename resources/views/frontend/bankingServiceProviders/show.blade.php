@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.bankingServiceProvider.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.banking-service-providers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankingServiceProvider.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $bankingServiceProvider->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankingServiceProvider.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $bankingServiceProvider->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankingServiceProvider.fields.bank_type') }}
                                    </th>
                                    <td>
                                        {{ $bankingServiceProvider->bank_type->banking_type ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankingServiceProvider.fields.head_office') }}
                                    </th>
                                    <td>
                                        {{ $bankingServiceProvider->head_office }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankingServiceProvider.fields.known_as') }}
                                    </th>
                                    <td>
                                        {{ $bankingServiceProvider->known_as }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankingServiceProvider.fields.swift_code') }}
                                    </th>
                                    <td>
                                        {{ $bankingServiceProvider->swift_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankingServiceProvider.fields.category') }}
                                    </th>
                                    <td>
                                        {{ App\Models\BankingServiceProvider::CATEGORY_SELECT[$bankingServiceProvider->category] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankingServiceProvider.fields.website') }}
                                    </th>
                                    <td>
                                        {{ $bankingServiceProvider->website }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.banking-service-providers.index') }}">
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