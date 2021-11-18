<?php

namespace App\Http\Controllers\Frontend;

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

class ApplicationTrackingController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('application_tracking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applicationTrackings = ApplicationTracking::with(['user_id_no'])->get();

        $users = User::get();

        return view('frontend.applicationTrackings.index', compact('applicationTrackings', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('application_tracking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_id_nos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.applicationTrackings.create', compact('user_id_nos'));
    }

    public function store(StoreApplicationTrackingRequest $request)
    {
        $applicationTracking = ApplicationTracking::create($request->all());

        return redirect()->route('frontend.application-trackings.index');
    }

    public function edit(ApplicationTracking $applicationTracking)
    {
        abort_if(Gate::denies('application_tracking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_id_nos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $applicationTracking->load('user_id_no');

        return view('frontend.applicationTrackings.edit', compact('user_id_nos', 'applicationTracking'));
    }

    public function update(UpdateApplicationTrackingRequest $request, ApplicationTracking $applicationTracking)
    {
        $applicationTracking->update($request->all());

        return redirect()->route('frontend.application-trackings.index');
    }

    public function show(ApplicationTracking $applicationTracking)
    {
        abort_if(Gate::denies('application_tracking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applicationTracking->load('user_id_no');

        return view('frontend.applicationTrackings.show', compact('applicationTracking'));
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
