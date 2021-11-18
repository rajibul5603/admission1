<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEducationRequest;
use App\Http\Requests\StoreEducationRequest;
use App\Http\Requests\UpdateEducationRequest;
use App\Models\Education;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EducationController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('education_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $education = Education::all();

        return view('frontend.education.index', compact('education'));
    }

    public function create()
    {
        abort_if(Gate::denies('education_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.education.create');
    }

    public function store(StoreEducationRequest $request)
    {
        $education = Education::create($request->all());

        return redirect()->route('frontend.education.index');
    }

    public function edit(Education $education)
    {
        abort_if(Gate::denies('education_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.education.edit', compact('education'));
    }

    public function update(UpdateEducationRequest $request, Education $education)
    {
        $education->update($request->all());

        return redirect()->route('frontend.education.index');
    }

    public function show(Education $education)
    {
        abort_if(Gate::denies('education_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.education.show', compact('education'));
    }

    public function destroy(Education $education)
    {
        abort_if(Gate::denies('education_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $education->delete();

        return back();
    }

    public function massDestroy(MassDestroyEducationRequest $request)
    {
        Education::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
