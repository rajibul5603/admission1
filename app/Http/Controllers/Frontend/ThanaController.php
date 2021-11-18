<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyThanaRequest;
use App\Http\Requests\StoreThanaRequest;
use App\Http\Requests\UpdateThanaRequest;
use App\Models\District;
use App\Models\Thana;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ThanaController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('thana_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $thanas = Thana::with(['district_name'])->get();

        $districts = District::get();

        return view('frontend.thanas.index', compact('thanas', 'districts'));
    }

    public function create()
    {
        abort_if(Gate::denies('thana_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $district_names = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.thanas.create', compact('district_names'));
    }

    public function store(StoreThanaRequest $request)
    {
        $thana = Thana::create($request->all());

        return redirect()->route('frontend.thanas.index');
    }

    public function edit(Thana $thana)
    {
        abort_if(Gate::denies('thana_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $district_names = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $thana->load('district_name');

        return view('frontend.thanas.edit', compact('district_names', 'thana'));
    }

    public function update(UpdateThanaRequest $request, Thana $thana)
    {
        $thana->update($request->all());

        return redirect()->route('frontend.thanas.index');
    }

    public function show(Thana $thana)
    {
        abort_if(Gate::denies('thana_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $thana->load('district_name');

        return view('frontend.thanas.show', compact('thana'));
    }

    public function destroy(Thana $thana)
    {
        abort_if(Gate::denies('thana_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $thana->delete();

        return back();
    }

    public function massDestroy(MassDestroyThanaRequest $request)
    {
        Thana::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
