<!-- This is for Student Homepage .This Extends Layouts/Main and Partials/Menu -->

@extends('student.layouts.main')
@section('styles')
<style>
    fieldset.border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
    }


    legend.border {
        width: inherit;
        padding: 0 10px;
        border-bottom: none;
        background: #060a6b;
        color: #ffffff;
    }


    .panel-default>.panel-heading {
        color: #fffcfc;
        background-color: #2A1562 !important;
        border-color: #ee1616;
        font-size: 20px;
        text-align: center;
    }

    .required:after {
        content: " *";
        color: red;
    }

    .header-note {

        color: red;
        font-weight: bolder;
    }

    .highlight {

        background-color: #ff4719;
        -webkit-transition: width 0.25s ease-in-out,
            background-color 0.25s ease-in-out;
        transition: width 0.25s ease-in-out, background-color 0.25s ease-in-out;
    }

    .select2 {
        width: 100% !important;
    }
</style>
@endsection

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('student.home')}}">{{ trans('global.home') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ trans('global.home') }}</li>
    </ol>
</nav>
<!-- End of Breadcrumb -->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style=" 
                color:green;">

                <div class="panel-heading">

                    ভর্তি সহায়তার আবেদন ফর্ম
                </div>
                <div class="panel-body">
                    <p class="header-note"> [*] চিহ্নিত ঘরগুলো অবশ্যই পূরণ করতে হবে। সকল তথ্য ইউনিকোড বাংলায় পূরণ করুন। </p>
                    <form method="POST" action="{{ route('student.application.store') }}" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="border">
                            <legend class="border">
                                সাধারণ তথ্য
                            </legend>
                            <div class=" form-row">
                                <div class="col-md-6 {{ $errors->has('user_id_no') ? 'has-error' : '' }}">
                                    <label class="required" for="user_id_no">{{ trans('cruds.generalInfo.fields.user_id_no') }}</label>
                                    <input class="form-control" type="text" name="user_id_no" id="user_id_no" value="{{$user_id_no}}" required>
                                    <span class="highlight"></span>
                                    @if($errors->has('user_id_no'))
                                    <span class="help-block" role="alert">{{ $errors->first('user_id_no') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.user_id_no_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('application_no') ? 'has-error' : '' }}">
                                    <label class="required" for="application_no">{{ trans('cruds.generalInfo.fields.application_no') }}</label>
                                    <input class="form-control" type="text" name="application_no" id="application_no" value="{{ old('application_no', '') }}" required>
                                    @if($errors->has('application_no'))
                                    <span class="help-block" role="alert">{{ $errors->first('application_no') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.application_no_helper') }}</span>
                                </div>
                                <div class="col-md-12 {{ $errors->has('circular_type') ? 'has-error' : '' }}">
                                    <label class="required">{{ trans('cruds.circular.fields.circular_type') }}</label>
                                    <select class="form-control" name="circular_type" id="circular_type" required>
                                        <option value disabled {{ old('circular_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\Circular::CIRCULAR_TYPE_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('circular_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('circular_type'))
                                    <span class="help-block" role="alert">{{ $errors->first('circular_type') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.circular.fields.circular_type_helper') }}</span>
                                </div>


                                <div class="col-md-6{{ $errors->has('grants_name_id') ? 'has-error' : '' }}">
                                    <label class="required" for="grants_name_id">{{ trans('cruds.generalInfo.fields.grants_name') }}</label>
                                    <input class="form-control" type="text" name="grants_name_id" id="grants_name_id" value="{{ old('grants_name_id', '') }}" required>
                                    @if($errors->has('grants_name_id'))
                                    <span class="help-block" role="alert">{{ $errors->first('grants_name_id') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.grants_name_helper') }}</span>
                                </div>

                                <input class="form-control hidden" type="text" name="academic_year" id="academic_year" value="2020">

                                <div class="col-md-6 {{ $errors->has('circular') ? 'has-error' : '' }}">
                                    <label class="required" for="circular_id">{{ trans('cruds.generalInfo.fields.circular') }}</label>
                                    <select class="form-control select2" name="circular_id" id="circular_id" required>
                                        <option value="">{{trans('global.pleaseSelect')}}</option>
                                        @if(!empty($circulars))

                                        @foreach($circulars as $id => $entry)
                                        <option value="{{ $entry->id }}" {{ old('circular_id') == $entry->id? 'selected' : '' }}>{{ $entry->cirucular_name."- (" . $entry->reference_number.")" }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('circular'))
                                    <span class="help-block" role="alert">{{ $errors->first('circular') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.circular_helper') }}</span>
                                </div>
                                <div class="col-md-6{{ $errors->has('brid') ? 'has-error' : '' }}">
                                    <label class="required" for="brid">{{ trans('cruds.generalInfo.fields.brid') }}</label>
                                    <input class="form-control" type="text" name="brid" id="brid" value="{{ old('brid', '') }}" minlength="17" pattern="(.){17,17}" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||  event.charCode == 46 || event.charCode == 0 " onKeyDown="if (this.value.length==17 && event.keyCode!=8) return false" placeholder="১৭ ডিজিটের জন্ম সনদ নম্বর দিন " required>
                                    @if($errors->has('brid'))
                                    <span class="help-block" role="alert">{{ $errors->first('brid') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.brid_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('nid') ? 'has-error' : '' }}">
                                    <label for="nid">{{ trans('cruds.generalInfo.fields.nid') }}</label>
                                    <input class="form-control" type="text" name="nid" id="nid" value="{{ old('nid', '') }}" minlength="10" maxlength="17" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||  event.charCode == 46 || event.charCode == 0 " onKeyDown="if (this.value.length==17 && event.keyCode!=8) return false" placeholder="১০  অথবা ১৭ ডিজিটের জাতীয় পরিচয়পত্র নম্বর দিন " required>
                                    @if($errors->has('nid'))
                                    <span class="help-block" role="alert">{{ $errors->first('nid') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.nid_helper') }}</span>
                                </div>
                                <div class="col-md-6{{ $errors->has('stu_name') ? 'has-error' : '' }}">
                                    <label class="required" for="stu_name">{{ trans('cruds.generalInfo.fields.name') }}</label>
                                    <input class="form-control" type="text" name="stu_name" id="stu_name" value="{{ old('stu_name', '') }}" required>
                                    @if($errors->has('stu_name'))
                                    <span class="help-block" role="alert">{{ $errors->first('stu_name') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.name_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('father_name') ? 'has-error' : '' }}">
                                    <label class="required" for="father_name">{{ trans('cruds.generalInfo.fields.father_name') }}</label>
                                    <input class="form-control" type="text" name="father_name" id="father_name" value="{{ old('father_name', '') }}" required>
                                    @if($errors->has('father_name'))
                                    <span class="help-block" role="alert">{{ $errors->first('father_name') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.father_name_helper') }}</span>
                                </div>
                                <div class="col-md-6{{ $errors->has('father_nid') ? 'has-error' : '' }}">
                                    <label for="father_nid">{{ trans('cruds.generalInfo.fields.father_nid') }}</label>
                                    <input class="form-control" type="number" name="father_nid" id="father_nid" value="{{ old('father_nid', '') }}" step="1">
                                    @if($errors->has('father_nid'))
                                    <span class="help-block" role="alert">{{ $errors->first('father_nid') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.father_nid_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('mother_name') ? 'has-error' : '' }}">
                                    <label class="required" for="mother_name">{{ trans('cruds.generalInfo.fields.mother_name') }}</label>
                                    <input class="form-control" type="text" name="mother_name" id="mother_name" value="{{ old('mother_name', '') }}" required>
                                    @if($errors->has('mother_name'))
                                    <span class="help-block" role="alert">{{ $errors->first('mother_name') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.mother_name_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('mother_nid') ? 'has-error' : '' }}">
                                    <label for="mother_nid">{{ trans('cruds.generalInfo.fields.mother_nid') }}</label>
                                    <input class="form-control" type="number" name="mother_nid" id="mother_nid" value="{{ old('mother_nid', '') }}" step="1">
                                    @if($errors->has('mother_nid'))
                                    <span class="help-block" role="alert">{{ $errors->first('mother_nid') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.mother_nid_helper') }}</span>
                                </div>


                                <div class="col-md-6 {{ $errors->has('dob') ? 'has-error' : '' }}">
                                    <label class="required" for="dob">{{ trans('cruds.generalInfo.fields.dob') }}</label>
                                    <input class="form-control date" type="text" name="dob" id="dob" value="{{ old('dob') }}" required>
                                    @if($errors->has('dob'))
                                    <span class="help-block" role="alert">{{ $errors->first('dob') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.dob_helper') }}</span>
                                </div>

                                <div class="col-md-6 {{ $errors->has('age') ? 'has-error' : '' }}">
                                    <label class="required" for="age">{{ trans('cruds.generalInfo.fields.age') }}</label>
                                    <input class="form-control" type="number" name="age" id="age" value="{{ old('age', '') }}" step="1" required>
                                    @if($errors->has('age'))
                                    <span class="help-block" role="alert">{{ $errors->first('age') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.age_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('division') ? 'has-error' : '' }}">
                                    <label class="required" for="division_id">{{ trans('cruds.generalInfo.fields.division') }}</label>
                                    <select class="form-control select2" name="division_id" id="division_id" required>
                                        @foreach($divisions as $id => $entry)
                                        <option value="{{ $id }}" {{ old('division_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('division'))
                                    <span class="help-block" role="alert">{{ $errors->first('division') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.division_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('district') ? 'has-error' : '' }}">
                                    <label class="required" for="district_id">{{ trans('cruds.generalInfo.fields.district') }}</label>
                                    <select class="form-control select2" name="district_id" id="district_id" required>
                                        <option id="nullValueOption" value='' selected='selected'> {{trans('global.pleaseSelect')}}</option>
                                    </select>
                                    @if($errors->has('district'))
                                    <span class="help-block" role="alert">{{ $errors->first('district') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.district_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('upazila') ? 'has-error' : '' }}">
                                    <label class="required" for="upazila_id">{{ trans('cruds.generalInfo.fields.upazila') }}</label>
                                    <select class="form-control select2" name="upazila_id" id="upazila_id" required>
                                        <option id="nullValueOption" value='' selected='selected'> {{trans('global.pleaseSelect')}}</option>
                                    </select>
                                    @if($errors->has('upazila'))
                                    <span class="help-block" role="alert">{{ $errors->first('upazila') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.upazila_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('union') ? 'has-error' : '' }}">
                                    <label class="required" for="union_id">{{ trans('cruds.generalInfo.fields.union') }}</label>
                                    <select class="form-control select2" name="union_id" id="union_id" required>
                                        <option id="nullValueOption" value='' selected='selected'> {{trans('global.pleaseSelect')}}</option>
                                    </select>
                                    @if($errors->has('union'))
                                    <span class="help-block" role="alert">{{ $errors->first('union') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.union_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('village') ? 'has-error' : '' }}">
                                    <label class="required" for="village">{{ trans('cruds.generalInfo.fields.village') }}</label>
                                    <input class="form-control" type="text" name="village_id" id="village_id" value="{{ old('village', '') }}" required>
                                    @if($errors->has('village'))
                                    <span class="help-block" role="alert">{{ $errors->first('village') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.village_helper') }}</span>
                                </div>

                            </div>
                        </fieldset>

                        <fieldset class="border">
                            <legend class="border">
                                অভিভাবকের আর্থসামাজিক অবস্থা
                            </legend>
                            <div class="form-row">

                                <div class="col-md-6 {{ $errors->has('user_id_no') ? 'has-error' : '' }}">
                                    <label class="required" for="user_id_no">{{ trans('cruds.familyInfo.fields.user_id_no') }}</label>
                                    <input class="form-control" type="text" name="user_id_no" id="user_id_no_family" value="{{ old('user_id_no', '') }}" required>
                                    @if($errors->has('user_id_no'))
                                    <span class="help-block" role="alert">{{ $errors->first('user_id_no') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.familyInfo.fields.user_id_no_helper') }}</span>
                                </div>


                                <div class="col-md-6 {{ $errors->has('application_number') ? 'has-error' : '' }}">
                                    <label class="required" for="application_number_id">{{ trans('cruds.familyInfo.fields.application_number') }}</label>
                                    <input class="form-control" type="number" name="application_number_id" id="application_number_id_family_table" value="{{ old('application_number_id', '') }}">
                                    @if($errors->has('application_number'))
                                    <span class="help-block" role="alert">{{ $errors->first('application_number') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.familyInfo.fields.application_number_helper') }}</span>
                                </div>



                                <div class="col-md-6 {{ $errors->has('familystatus') ? 'has-error' : '' }}">
                                    <label class="required" for="familystatus_id">{{ trans('cruds.familyInfo.fields.familystatus') }}</label>
                                    <select class="form-control select2" name="familystatus_id" id="familystatus_id" required>
                                        @foreach($familystatuses as $id => $entry)
                                        <option value="{{ $id }}" {{ old('familystatus_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('familystatus'))
                                    <span class="help-block" role="alert">{{ $errors->first('familystatus') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.familyInfo.fields.familystatus_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('guardian_occupation') ? 'has-error' : '' }}">
                                    <label class="required" for="guardian_occupation_id">{{ trans('cruds.familyInfo.fields.guardian_occupation') }}</label>
                                    <select class="form-control select2" name="guardian_occupation_id" id="guardian_occupation_id" required>
                                        @foreach($guardian_occupations as $id => $entry)
                                        <option value="{{ $id }}" {{ old('guardian_occupation_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('guardian_occupation'))
                                    <span class="help-block" role="alert">{{ $errors->first('guardian_occupation') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.familyInfo.fields.guardian_occupation_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('guardian_education') ? 'has-error' : '' }}">
                                    <label class="required">{{ trans('cruds.familyInfo.fields.guardian_education') }}</label>
                                    <select class="form-control" name="guardian_education" id="guardian_education" required>
                                        <option value disabled {{ old('guardian_education', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\FamilyInfo::GUARDIAN_EDUCATION_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('guardian_education', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('guardian_education'))
                                    <span class="help-block" role="alert">{{ $errors->first('guardian_education') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.familyInfo.fields.guardian_education_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('guardian_land') ? 'has-error' : '' }}">
                                    <label class="required" for="guardian_land">{{ trans('cruds.familyInfo.fields.guardian_land') }}</label>
                                    <input class="form-control" type="number" name="guardian_land" id="guardian_land" value="{{ old('guardian_land', '') }}" step="0.01" max="10.10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||  event.charCode == 46 || event.charCode == 0 " onKeyDown="if (this.value.length==5 && event.keyCode!=8) return false" required>
                                    @if($errors->has('guardian_land'))
                                    <span class="help-block" role="alert">{{ $errors->first('guardian_land') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.familyInfo.fields.guardian_land_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('guardian_annual_income') ? 'has-error' : '' }}">
                                    <label class="required" for="guardian_annual_income">{{ trans('cruds.familyInfo.fields.guardian_annual_income') }}</label>
                                    <input class="form-control" type="number" name="guardian_annual_income" id="guardian_annual_income" value="{{ old('guardian_annual_income', '') }}" placeholder="এক বছরে অভিভাবকের আয় কত টাকা " onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||  event.charCode == 46 || event.charCode == 0 " onKeyDown="if (this.value.length==6 && event.keyCode!=8) return false" required>

                                    @if($errors->has('guardian_annual_income'))
                                    <span class="help-block" role="alert">{{ $errors->first('guardian_annual_income') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.familyInfo.fields.guardian_annual_income_helper') }}</span>
                                </div>

                            </div>

                        </fieldset>

                        <fieldset class="border">
                            <legend class="border">ভর্তিচ্ছু প্রতিষ্ঠানের তথ্য</legend>

                            <div class="form-row">

                                <div class="col-md-6 {{ $errors->has('user_id_no') ? 'has-error' : '' }}">
                                    <label class="required" for="user_id_no">{{ trans('cruds.educationInstituteInfo.fields.user_id_no') }}</label>
                                    <input class="form-control" type="text" name="user_id_no" id="user_id_no_edu" value="{{ old('user_id_no', '') }}" required>
                                    @if($errors->has('user_id_no'))
                                    <span class="help-block" role="alert">{{ $errors->first('user_id_no') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.educationInstituteInfo.fields.user_id_no_helper') }}</span>
                                </div>


                                <div class="col-md-6 {{ $errors->has('application_number') ? 'has-error' : '' }}">
                                    <label class="required" for="application_number_id">{{ trans('cruds.educationInstituteInfo.fields.application_number') }}</label>
                                    <input class="form-control" type="number" name="application_number_id" id="application_number_id_edu_table" value="{{ old('application_number_id', '') }}">
                                    @if($errors->has('application_number'))
                                    <span class="help-block" role="alert">{{ $errors->first('application_number') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.familyInfo.fields.application_number_helper') }}</span>
                                </div>


                                <div class="col-md-6 {{ $errors->has('institute_division') ? 'has-error' : '' }}">
                                    <label class="required" for="institute_division">{{ trans('cruds.educationInstituteInfo.fields.institute_division') }}</label>
                                    <select class="form-control select2" name="institute_division" id="institute_division" required>
                                        @foreach($divisions as $id => $entry)
                                        <option value="{{ $id }}" {{ old('institute_division') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('institute_division'))
                                    <span class="help-block" role="alert">{{ $errors->first('institute_division') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.educationInstituteInfo.fields.institute_division_helper')}}</span>
                                </div>

                                <div class="col-md-6 {{ $errors->has('institute_district') ? 'has-error' : '' }}">
                                    <label class="required" for="institute_district">{{ trans('cruds.educationInstituteInfo.fields.institute_district') }}</label>
                                    <select class="form-control select2" name="institute_district" id="institute_district" required>
                                        <option id="nullValueOption" value='' selected='selected'> {{trans('global.pleaseSelect')}}</option>
                                    </select>
                                    @if($errors->has('institute_district'))
                                    <span class="help-block" role="alert">{{ $errors->first('institute_district') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.educationInstituteInfo.fields.institute_district_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('institute_upazila') ? 'has-error' : '' }}">
                                    <label class="required" for="institute_upazila">{{ trans('cruds.educationInstituteInfo.fields.institute_upazila') }}</label>

                                    <select class="form-control select2" name="institute_upazila" id="institute_upazila" required>
                                        <option id="nullValueOption" value='' selected='selected'> {{trans('global.pleaseSelect')}}</option>
                                    </select>
                                    @if($errors->has('institute_upazila'))
                                    <span class="help-block" role="alert">{{ $errors->first('institute_upazila') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.educationInstituteInfo.fields.institute_upazila_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('education_level') ? 'has-error' : '' }}">
                                    <label class="required" for="education_level_id">{{ trans('cruds.educationInstituteInfo.fields.education_level') }}</label>
                                    <select class="form-control select2" name="education_level_id" id="education_level_id" required>
                                        @foreach($education_levels as $id => $entry)
                                        <option value="{{ $id }}" {{ old('education_level_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('education_level'))
                                    <span class="help-block" role="alert">{{ $errors->first('education_level') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.educationInstituteInfo.fields.education_level_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('class_name') ? 'has-error' : '' }}">
                                    <label class="required" for="class_name_id">{{ trans('cruds.educationInstituteInfo.fields.class_name') }}</label>
                                    <select class="form-control select2" name="class_name_id" id="class_name_id" required>

                                    </select>
                                    @if($errors->has('class_name'))
                                    <span class="help-block" role="alert">{{ $errors->first('class_name') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.educationInstituteInfo.fields.class_name_helper') }}</span>
                                </div>
                                <div class="col-md-6{{ $errors->has('institute_name') ? 'has-error' : '' }}">
                                    <label class="required" for="institute_name_id">{{ trans('cruds.educationInstituteInfo.fields.institute_name') }}</label>
                                    <select class="form-control select2" name="institute_name_id" id="institute_name_id" required>
                                        <option id="nullValueOption" value='' selected='selected'> {{trans('global.pleaseSelect')}}</option>
                                    </select>
                                    @if($errors->has('institute_name'))
                                    <span class="help-block" role="alert">{{ $errors->first('institute_name') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.educationInstituteInfo.fields.institute_name_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('eiin') ? 'has-error' : '' }}">
                                    <label class="required" for="eiin_id">{{ trans('cruds.educationInstituteInfo.fields.eiin') }}</label>
                                    <input class="form-control" type="text" name="eiin_id" id="eiin_id" value="{{ old('eiin', '') }}" required>
                                    @if($errors->has('eiin'))
                                    <span class="help-block" role="alert">{{ $errors->first('eiin') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.educationInstituteInfo.fields.eiin_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('last_study_class') ? 'has-error' : '' }}">
                                    <label class="required" for="last_study_class_id">{{ trans('cruds.educationInstituteInfo.fields.last_study_class') }}</label>
                                    <select class="form-control select2" name="last_study_class_id" id="last_study_class_id" required>
                                        @foreach($class_names as $id => $entry)
                                        <option value="{{ $id }}" {{ old('class_name_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('last_study_class'))
                                    <span class="help-block" role="alert">{{ $errors->first('last_study_class') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.educationInstituteInfo.fields.last_study_class_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('last_gpa_total') ? 'has-error' : '' }}">
                                    <label class="required" for="last_gpa_total">{{ trans('cruds.educationInstituteInfo.fields.last_gpa_total') }}</label>
                                    <input class="form-control" type="number" name="last_gpa_total" id="last_gpa_total" value="{{ old('last_gpa_total', '5.00') }}" max="5.00" step="0.01" required>
                                    @if($errors->has('last_gpa_total'))
                                    <span class="help-block" role="alert">{{ $errors->first('last_gpa_total') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.educationInstituteInfo.fields.last_gpa_total_helper') }}</span>
                                </div>

                                <div class="col-md-6 {{ $errors->has('last_gpa') ? 'has-error' : '' }}">
                                    <label class="required" for="last_gpa">{{ trans('cruds.educationInstituteInfo.fields.last_gpa') }}</label>
                                    <input class="form-control" type="number" name="last_gpa" id="last_gpa" value="{{ old('last_gpa', '') }}" step="0.01" required>
                                    @if($errors->has('last_gpa'))
                                    <span class="help-block" role="alert">{{ $errors->first('last_gpa') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.educationInstituteInfo.fields.last_gpa_helper') }}</span>
                                </div>


                            </div>
                        </fieldset>

                        <fieldset class="border">
                            <legend class="border">
                                শিক্ষার্থী/অভিভাবকের ব্যাংক একাউন্টের তথ্য
                            </legend>
                            <div class="form-row">




                                <div class="col col-md-6 {{ $errors->has('user') ? 'has-error' : '' }}">
                                    <label class="required" for="user">{{ trans('cruds.accountInfo.fields.user') }}</label>
                                    <input class="form-control" type="text" name="user" id="user" value="{{ old('user', '') }}" required>
                                    @if($errors->has('user'))
                                    <span class="help-block" role="alert">{{ $errors->first('user') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.accountInfo.fields.user_helper') }}</span>
                                </div>
                                <div class="col col-md-6{{ $errors->has('app_number') ? 'has-error' : '' }}">
                                    <label class="required" for="app_number_id">{{ trans('cruds.accountInfo.fields.app_number') }}</label>

                                    <input class="form-control" type="number" name="app_number_id" id="app_number_id" value="{{ old('app_number_id', '') }}">
                                    @if($errors->has('app_number'))
                                    <span class="help-block" role="alert">{{ $errors->first('app_number') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.accountInfo.fields.app_number_helper') }}</span>
                                </div>
                                <div class="col col-md-6 {{ $errors->has('student_name') ? 'has-error' : '' }}" onchange="StuNameChangeFunction(this)">
                                    <label class="required" for="student_name">{{ trans('cruds.accountInfo.fields.student_name') }}</label>
                                    <input class="form-control" type="text" name="student_name" id="student_name" value="{{ old('student_name', '') }}" required>
                                    @if($errors->has('student_name'))
                                    <span class="help-block" role="alert">{{ $errors->first('student_name') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.accountInfo.fields.student_name_helper') }}</span>
                                </div>

                                <div class="col col-md-6 {{ $errors->has('bank_account_owner') ? 'has-error' : '' }}">
                                    <label class="required">{{ trans('cruds.accountInfo.fields.bank_account_owner') }}</label>
                                    <select class="form-control" name="bank_account_owner" id="bank_account_owner" required>
                                        <option value disabled {{ old('bank_account_owner', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\AccountInfo::BANK_ACCOUNT_OWNER_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('bank_account_owner', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('bank_account_owner'))
                                    <span class="help-block" role="alert">{{ $errors->first('bank_account_owner') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.accountInfo.fields.bank_account_owner_helper') }}</span>
                                </div>

                                <div class="col col-md-6 {{ $errors->has('bank_name') ? 'has-error' : '' }}">
                                    <label class="required" for="bank_name_id">{{ trans('cruds.accountInfo.fields.bank_name') }}</label>
                                    <select class="form-control select2" name="bank_name_id" id="bank_name_id" required>
                                        @foreach($bank_names as $id => $entry)
                                        <option value="{{ $id }}" {{ old('bank_name_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('bank_name'))
                                    <span class="help-block" role="alert">{{ $errors->first('bank_name') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.accountInfo.fields.bank_name_helper') }}</span>
                                </div>

                                <div class=" col col-md-6{{ $errors->has('district') ? 'has-error' : '' }}">
                                    <label for="district_id">{{ trans('cruds.accountInfo.fields.district') }}</label>
                                    <select class="form-control select2" name="district_id" id="district_id_account">
                                        @foreach($districts as $id => $entry)
                                        <option value="{{ $id }}" {{ old('district_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('district'))
                                    <span class="help-block" role="alert">{{ $errors->first('district') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.accountInfo.fields.district_helper') }}</span>
                                </div>

                                <div class="col col-md-6 {{ $errors->has('bank_branch') ? 'has-error' : '' }}">
                                    <label for="bank_branch_id">{{ trans('cruds.accountInfo.fields.bank_branch') }}</label>
                                    <select class="form-control select2" name="bank_branch_id" id="bank_branch_id" required>
                                        <option id="nullValueOption" value='' selected='selected'> {{trans('global.pleaseSelect')}}</option>
                                    </select>
                                    @if($errors->has('bank_branch'))
                                    <span class="help-block" role="alert">{{ $errors->first('bank_branch') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.accountInfo.fields.bank_branch_helper') }}</span>
                                </div>


                                <div class="col col-md-6 {{ $errors->has('account_type') ? 'has-error' : '' }}">
                                    <label>{{ trans('cruds.accountInfo.fields.account_type') }}</label>
                                    <select class="form-control" name="account_type" id="account_type">
                                        <option value disabled {{ old('account_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\AccountInfo::ACCOUNT_TYPE_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('account_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('account_type'))
                                    <span class="help-block" role="alert">{{ $errors->first('account_type') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.accountInfo.fields.account_type_helper') }}</span>
                                </div>


                                <div class="col col-md-6 {{ $errors->has('acc_name') ? 'has-error' : '' }}">
                                    <label class="required" for="acc_name">{{ trans('cruds.accountInfo.fields.acc_name') }}</label>
                                    <input class="form-control" type="text" name="acc_name" id="acc_name" value="{{ old('acc_name', '') }}" required>
                                    @if($errors->has('acc_name'))
                                    <span class="help-block" role="alert">{{ $errors->first('acc_name') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.accountInfo.fields.acc_name_helper') }}</span>
                                </div>

                                <div class="col col-md-6{{ $errors->has('acc_no') ? 'has-error' : '' }}">
                                    <label class="required" for="acc_no">{{ trans('cruds.accountInfo.fields.acc_no') }}</label>
                                    <input class="form-control" type="text" name="acc_no" id="acc_no" value="{{ old('acc_no', '') }}" required>
                                    @if($errors->has('acc_no'))
                                    <span class="help-block" role="alert">{{ $errors->first('acc_no') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.accountInfo.fields.acc_no_helper') }}</span>
                                </div>
                                <div class="col col-md-6 {{ $errors->has('account_holder_nid') ? 'has-error' : '' }}">
                                    <label for="account_holder_nid">{{ trans('cruds.accountInfo.fields.account_holder_nid') }}</label>
                                    <input class="form-control" type="number" name="account_holder_nid" id="account_holder_nid" value="{{ old('account_holder_nid', '') }}" step="1" required>
                                    @if($errors->has('account_holder_nid'))
                                    <span class="help-block" role="alert">{{ $errors->first('account_holder_nid') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.accountInfo.fields.account_holder_nid_helper') }}</span>
                                </div>

                                <div class="col col-md-6 {{ $errors->has('routing_no') ? 'has-error' : '' }}">
                                    <label class="required" for="routing_no_id">{{ trans('cruds.accountInfo.fields.routing_no') }}</label>
                                    <input class="form-control" type="number" name="routing_no_id" id="routing_no_id" value="{{ old('routing_no_id', '') }}" step="1" readonly="1" required>
                                    @if($errors->has('routing_no'))
                                    <span class="help-block" role="alert">{{ $errors->first('routing_no') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.accountInfo.fields.routing_no_helper') }}</span>
                                </div>
                                <div class="col col-md-6{{ $errors->has('branch_code') ? 'has-error' : '' }}">
                                    <label class="required" for="branch_code_id">{{ trans('cruds.accountInfo.fields.branch_code') }}</label>
                                    <input class="form-control" type="number" name="branch_code_id" id="branch_code_id" value="{{ old('branch_code', '') }}" step="1" readonly="1" required>
                                    @if($errors->has('branch_code'))
                                    <span class="help-block" role="alert">{{ $errors->first('branch_code') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.accountInfo.fields.branch_code_helper') }}</span>
                                </div>
                                <div class="col col-md-6{{ $errors->has('eiin') ? 'has-error' : '' }}">
                                    <label class="required" for="eiin">{{ trans('cruds.accountInfo.fields.eiin') }}</label>
                                    <input class="form-control" type="text" name="eiin" id="eiin_account" value="{{ old('eiin', '') }}" required>
                                    @if($errors->has('eiin'))
                                    <span class="help-block" role="alert">{{ $errors->first('eiin') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.accountInfo.fields.eiin_helper') }}</span>
                                </div>

                            </div>
                        </fieldset>

                        <div class="col-md-12">
                            <button class="btn btn-danger pull-right" type="submit">
                                <i class="fas fa-save">&nbsp; </i>{{ trans('global.save') }}
                            </button>
                            &nbsp;
                            <button class="btn btn-warning pull-left" type="reset">
                                <i class="fas fa-refresh">&nbsp; </i> রিসেট
                            </button>
                        </div>


                    </form>
                </div>
            </div>



        </div>
    </div>


    @endsection


    @section('scripts')

    <script src="{{ asset('js/locationAjax.js') }}"></script>
    <script src="{{ asset('js/instituteAjax.js') }}"></script>
    <script src="{{ asset('js/levelClassAjax.js') }}"></script>
    <script src="{{ asset('js/bankBranchAjax.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>

    <script>
        // = "if (this.value>'#last_gpa_total'.value) return false"
    </script>
    </script>

    @endsection