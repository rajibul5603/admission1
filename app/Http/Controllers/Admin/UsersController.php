<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = User::with(['division', 'district', 'roles', 'upazila', 'union'])->select(sprintf('%s.*', (new User())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
                $crudRoutePart = 'users';

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
            $table->editColumn('username', function ($row) {
                return $row->username ? $row->username : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('guardian_name', function ($row) {
                return $row->guardian_name ? $row->guardian_name : '';
            });
            $table->editColumn('brid', function ($row) {
                return $row->brid ? $row->brid : '';
            });
            $table->editColumn('eiin', function ($row) {
                return $row->eiin ? $row->eiin : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('user_contact', function ($row) {
                return $row->user_contact ? $row->user_contact : '';
            });

            $table->addColumn('division_division_name', function ($row) {
                return $row->division ? $row->division->division_name : '';
            });

            $table->addColumn('district_district_name', function ($row) {
                return $row->district ? $row->district->district_name : '';
            });

            $table->editColumn('roles', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('upazila_upazila_name', function ($row) {
                return $row->upazila ? $row->upazila->upazila_name : '';
            });

            $table->addColumn('union_union_name', function ($row) {
                return $row->union ? $row->union->union_name : '';
            });

            $table->editColumn('user_photo', function ($row) {
                if ($photo = $row->user_photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('user_signature', function ($row) {
                if ($photo = $row->user_signature) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'division', 'district', 'roles', 'upazila', 'union', 'user_photo', 'user_signature']);

            return $table->make(true);
        }

        $divisions = Division::get();
        $districts = District::get();
        $roles     = Role::get();
        $upazilas  = Upazila::get();
        $unions    = Union::get();

        return view('admin.users.index', compact('divisions', 'districts', 'roles', 'upazilas', 'unions'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $divisions = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::pluck('title', 'id');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unions = Union::pluck('union_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.users.create', compact('divisions', 'districts', 'roles', 'upazilas', 'unions'));
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

        return redirect()->route('admin.users.index');
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

        return view('admin.users.edit', compact('divisions', 'districts', 'roles', 'upazilas', 'unions', 'user'));
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

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('division', 'district', 'roles', 'upazila', 'union', 'userUserAlerts');

        return view('admin.users.show', compact('user'));
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
