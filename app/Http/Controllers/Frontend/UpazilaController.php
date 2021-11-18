<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUpazilaRequest;
use App\Http\Requests\StoreUpazilaRequest;
use App\Http\Requests\UpdateUpazilaRequest;
use App\Models\District;
use App\Models\Upazila;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpazilaController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('upazila_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $upazilas = Upazila::with(['district'])->get();

        $districts = District::get();

        return view('frontend.upazilas.index', compact('upazilas', 'districts'));
    }

    public function create()
    {
        abort_if(Gate::denies('upazila_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.upazilas.create', compact('districts'));
    }

    public function store(StoreUpazilaRequest $request)
    {
        $upazila = Upazila::create($request->all());

        return redirect()->route('frontend.upazilas.index');
    }

    public function edit(Upazila $upazila)
    {
        abort_if(Gate::denies('upazila_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazila->load('district');

        return view('frontend.upazilas.edit', compact('districts', 'upazila'));
    }

    public function update(UpdateUpazilaRequest $request, Upazila $upazila)
    {
        $upazila->update($request->all());

        return redirect()->route('frontend.upazilas.index');
    }

    public function show(Upazila $upazila)
    {
        abort_if(Gate::denies('upazila_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $upazila->load('district');

        return view('frontend.upazilas.show', compact('upazila'));
    }

    public function destroy(Upazila $upazila)
    {
        abort_if(Gate::denies('upazila_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $upazila->delete();

        return back();
    }

    public function massDestroy(MassDestroyUpazilaRequest $request)
    {
        Upazila::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
