<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserCategoryRequest;
use App\Http\Requests\StoreUserCategoryRequest;
use App\Http\Requests\UpdateUserCategoryRequest;
use App\Models\UserCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class UserCategoryController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('user_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userCategories = UserCategory::all();

        return view('frontend.userCategories.index', compact('userCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.userCategories.create');
    }

    public function store(StoreUserCategoryRequest $request)
    {
        $userCategory = UserCategory::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $userCategory->id]);
        }

        return redirect()->route('frontend.user-categories.index');
    }

    public function edit(UserCategory $userCategory)
    {
        abort_if(Gate::denies('user_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.userCategories.edit', compact('userCategory'));
    }

    public function update(UpdateUserCategoryRequest $request, UserCategory $userCategory)
    {
        $userCategory->update($request->all());

        return redirect()->route('frontend.user-categories.index');
    }

    public function show(UserCategory $userCategory)
    {
        abort_if(Gate::denies('user_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.userCategories.show', compact('userCategory'));
    }

    public function destroy(UserCategory $userCategory)
    {
        abort_if(Gate::denies('user_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserCategoryRequest $request)
    {
        UserCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_category_create') && Gate::denies('user_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new UserCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
