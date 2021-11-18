<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyApplicationTrackingRequest;
use App\Http\Requests\StoreApplicationTrackingRequest;
use App\Http\Requests\UpdateApplicationTrackingRequest;
use App\Models\ApplicationTracking;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ApplicationTrackingController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('application_tracking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ApplicationTracking::with(['user_id_no'])->select(sprintf('%s.*', (new ApplicationTracking())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'application_tracking_show';
                $editGate = 'application_tracking_edit';
                $deleteGate = 'application_tracking_delete';
                $crudRoutePart = 'application-trackings';

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
            $table->addColumn('user_id_no_name', function ($row) {
                return $row->user_id_no ? $row->user_id_no->name : '';
            });

            $table->editColumn('application_no', function ($row) {
                return $row->application_no ? $row->application_no : '';
            });
            $table->editColumn('is_completed', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_completed ? 'checked' : null) . '>';
            });
            $table->editColumn('is_submitted', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_submitted ? 'checked' : null) . '>';
            });
            $table->editColumn('ih_seen', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->ih_seen ? 'checked' : null) . '>';
            });
            $table->editColumn('ih_approve', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->ih_approve ? 'checked' : null) . '>';
            });
            $table->editColumn('ih_forwarded', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->ih_forwarded ? 'checked' : null) . '>';
            });
            $table->editColumn('useo_forwarded', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->useo_forwarded ? 'checked' : null) . '>';
            });
            $table->editColumn('pmeat_accepted', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->pmeat_accepted ? 'checked' : null) . '>';
            });
            $table->editColumn('pmeat_selected', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->pmeat_selected ? 'checked' : null) . '>';
            });
            $table->editColumn('rejection_reaseon', function ($row) {
                return $row->rejection_reaseon ? $row->rejection_reaseon : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user_id_no', 'is_completed', 'is_submitted', 'ih_seen', 'ih_approve', 'ih_forwarded', 'useo_forwarded', 'pmeat_accepted', 'pmeat_selected']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.applicationTrackings.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('application_tracking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_id_nos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.applicationTrackings.create', compact('user_id_nos'));
    }

    public function store(StoreApplicationTrackingRequest $request)
    {
        $applicationTracking = ApplicationTracking::create($request->all());

        return redirect()->route('admin.application-trackings.index');
    }

    public function edit(ApplicationTracking $applicationTracking)
    {
        abort_if(Gate::denies('application_tracking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_id_nos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $applicationTracking->load('user_id_no');

        return view('admin.applicationTrackings.edit', compact('user_id_nos', 'applicationTracking'));
    }

    public function update(UpdateApplicationTrackingRequest $request, ApplicationTracking $applicationTracking)
    {
        $applicationTracking->update($request->all());

        return redirect()->route('admin.application-trackings.index');
    }

    public function show(ApplicationTracking $applicationTracking)
    {
        abort_if(Gate::denies('application_tracking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applicationTracking->load('user_id_no');

        return view('admin.applicationTrackings.show', compact('applicationTracking'));
    }

    public function destroy(ApplicationTracking $applicationTracking)
    {
        abort_if(Gate::denies('application_tracking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applicationTracking->delete();

        return back();
    }

    public function massDestroy(MassDestroyApplicationTrackingRequest $request)
    {
        ApplicationTracking::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
