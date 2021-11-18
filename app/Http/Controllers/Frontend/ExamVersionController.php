<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExamVersionRequest;
use App\Http\Requests\StoreExamVersionRequest;
use App\Http\Requests\UpdateExamVersionRequest;
use App\Models\ExamVersion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExamVersionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('exam_version_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $examVersions = ExamVersion::all();

        return view('frontend.examVersions.index', compact('examVersions'));
    }

    public function create()
    {
        abort_if(Gate::denies('exam_version_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.examVersions.create');
    }

    public function store(StoreExamVersionRequest $request)
    {
        $examVersion = ExamVersion::create($request->all());

        return redirect()->route('frontend.exam-versions.index');
    }

    public function edit(ExamVersion $examVersion)
    {
        abort_if(Gate::denies('exam_version_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.examVersions.edit', compact('examVersion'));
    }

    public function update(UpdateExamVersionRequest $request, ExamVersion $examVersion)
    {
        $examVersion->update($request->all());

        return redirect()->route('frontend.exam-versions.index');
    }

    public function show(ExamVersion $examVersion)
    {
        abort_if(Gate::denies('exam_version_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.examVersions.show', compact('examVersion'));
    }

    public function destroy(ExamVersion $examVersion)
    {
        abort_if(Gate::denies('exam_version_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $examVersion->delete();

        return back();
    }

    public function massDestroy(MassDestroyExamVersionRequest $request)
    {
        ExamVersion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
