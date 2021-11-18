<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreUserCategoryRequest;
use App\Http\Requests\UpdateUserCategoryRequest;
use App\Http\Resources\Admin\UserCategoryResource;
use App\Models\UserCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserCategoryApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserCategoryResource(UserCategory::all());
    }

    public function store(StoreUserCategoryRequest $request)
    {
        $userCategory = UserCategory::create($request->all());

        return (new UserCategoryResource($userCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UserCategory $userCategory)
    {
        abort_if(Gate::denies('user_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserCategoryResource($userCategory);
    }

    public function update(UpdateUserCategoryRequest $request, UserCategory $userCategory)
    {
        $userCategory->update($request->all());

        return (new UserCategoryResource($userCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UserCategory $userCategory)
    {
        abort_if(Gate::denies('user_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
