<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource(User::with(['division', 'district', 'roles', 'upazila', 'union'])->get());
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

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource($user->load(['division', 'district', 'roles', 'upazila', 'union']));
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

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
