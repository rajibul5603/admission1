<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExamVersionRequest;
use App\Http\Requests\StoreExamVersionRequest;
use App\Http\Requests\UpdateExamVersionRequest;
use App\Models\ExamVersion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ExamVersionController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('exam_version_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ExamVersion::query()->select(sprintf('%s.*', (new ExamVersion())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'exam_version_show';
                $editGate = 'exam_version_edit';
                $deleteGate = 'exam_version_delete';
                $crudRoutePart = 'exam-versions';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('exam_version_name', function ($row) {
                return $row->exam_version_name ? $row->exam_version_name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.examVersions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('exam_version_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.examVersions.create');
    }

    public function store(StoreExamVersionRequest $request)
    {
        $examVersion = ExamVersion::create($request->all());

        return redirect()->route('admin.exam-versions.index');
    }

    public function edit(ExamVersion $examVersion)
    {
        abort_if(Gate::denies('exam_version_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.examVersions.edit', compact('examVersion'));
    }

    public function update(UpdateExamVersionRequest $request, ExamVersion $examVersion)
    {
        $examVersion->update($request->all());

        return redirect()->route('admin.exam-versions.index');
    }

    public function show(ExamVersion $examVersion)
    {
        abort_if(Gate::denies('exam_version_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.examVersions.show', compact('examVersion'));
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
