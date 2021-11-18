<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\District;
use App\Models\Division;
use App\Models\Role;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::with(['division', 'district', 'roles', 'upazila', 'union', 'media'])->get();

        $divisions = Division::get();

        $districts = District::get();

        $roles = Role::get();

        $upazilas = Upazila::get();

        $unions = Union::get();

        return view('frontend.users.index', compact('users', 'divisions', 'districts', 'roles', 'upazilas', 'unions'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $divisions = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::pluck('title', 'id');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unions = Union::pluck('union_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.users.create', compact('divisions', 'districts', 'roles', 'upazilas', 'unions'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('user_photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('user_photo'))))->toMediaCollection('user_photo');
        }

        if ($request->input('user_signature', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('user_signature'))))->toMediaCollection('user_signature');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        return redirect()->route('frontend.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $divisions = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::pluck('title', 'id');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unions = Union::pluck('union_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user->load('division', 'district', 'roles', 'upazila', 'union');

        return view('frontend.users.edit', compact('divisions', 'districts', 'roles', 'upazilas', 'unions', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('user_photo', false)) {
            if (!$user->user_photo || $request->input('user_photo') !== $user->user_photo->file_name) {
                if ($user->user_photo) {
                    $user->user_photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('user_photo'))))->toMediaCollection('user_photo');
            }
        } elseif ($user->user_photo) {
            $user->user_photo->delete();
        }

        if ($request->input('user_signature', false)) {
            if (!$user->user_signature || $request->input('user_signature') !== $user->user_signature->file_name) {
                if ($user->user_signature) {
                    $user->user_signature->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('user_signature'))))->toMediaCollection('user_signature');
            }
        } elseif ($user->user_signature) {
            $user->user_signature->delete();
        }

        return redirect()->route('frontend.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('division', 'district', 'roles', 'upazila', 'union', 'userUserAlerts');

        return view('frontend.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
