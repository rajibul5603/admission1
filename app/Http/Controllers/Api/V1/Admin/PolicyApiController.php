<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePolicyRequest;
use App\Http\Requests\UpdatePolicyRequest;
use App\Http\Resources\Admin\PolicyResource;
use App\Models\Policy;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PolicyApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('policy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PolicyResource(Policy::all());
    }

    public function store(StorePolicyRequest $request)
    {
        $policy = Policy::create($request->all());

        return (new PolicyResource($policy))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Policy $policy)
    {
        abort_if(Gate::denies('policy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PolicyResource($policy);
    }

    public function update(UpdatePolicyRequest $request, Policy $policy)
    {
        $policy->update($request->all());

        return (new PolicyResource($policy))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Policy $policy)
    {
        abort_if(Gate::denies('policy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policy->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
