<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUnionRequest;
use App\Http\Requests\StoreUnionRequest;
use App\Http\Requests\UpdateUnionRequest;
use App\Models\Union;
use App\Models\Upazila;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UnionController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('union_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unions = Union::with(['upazila'])->get();

        $upazilas = Upazila::get();

        return view('frontend.unions.index', compact('unions', 'upazilas'));
    }

    public function create()
    {
        abort_if(Gate::denies('union_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.unions.create', compact('upazilas'));
    }

    public function store(StoreUnionRequest $request)
    {
        $union = Union::create($request->all());

        return redirect()->route('frontend.unions.index');
    }

    public function edit(Union $union)
    {
        abort_if(Gate::denies('union_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $union->load('upazila');

        return view('frontend.unions.edit', compact('upazilas', 'union'));
    }

    public function update(UpdateUnionRequest $request, Union $union)
    {
        $union->update($request->all());

        return redirect()->route('frontend.unions.index');
    }

    public function show(Union $union)
    {
        abort_if(Gate::denies('union_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $union->load('upazila');

        return view('frontend.unions.show', compact('union'));
    }

    public function destroy(Union $union)
    {
        abort_if(Gate::denies('union_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $union->delete();

        return back();
    }

    public function massDestroy(MassDestroyUnionRequest $request)
    {
        Union::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
