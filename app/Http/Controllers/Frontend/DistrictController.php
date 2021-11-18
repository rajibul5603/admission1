<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDistrictRequest;
use App\Http\Requests\StoreDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;
use App\Models\District;
use App\Models\Division;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DistrictController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('district_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $districts = District::with(['division_name'])->get();

        $divisions = Division::get();

        return view('frontend.districts.index', compact('districts', 'divisions'));
    }

    public function create()
    {
        abort_if(Gate::denies('district_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $division_names = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.districts.create', compact('division_names'));
    }

    public function store(StoreDistrictRequest $request)
    {
        $district = District::create($request->all());

        return redirect()->route('frontend.districts.index');
    }

    public function edit(District $district)
    {
        abort_if(Gate::denies('district_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $division_names = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $district->load('division_name');

        return view('frontend.districts.edit', compact('division_names', 'district'));
    }

    public function update(UpdateDistrictRequest $request, District $district)
    {
        $district->update($request->all());

        return redirect()->route('frontend.districts.index');
    }

    public function show(District $district)
    {
        abort_if(Gate::denies('district_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $district->load('division_name', 'districtNameThanas');

        return view('frontend.districts.show', compact('district'));
    }

    public function destroy(District $district)
    {
        abort_if(Gate::denies('district_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $district->delete();

        return back();
    }

    public function massDestroy(MassDestroyDistrictRequest $request)
    {
        District::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
