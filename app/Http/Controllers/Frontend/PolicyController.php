<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPolicyRequest;
use App\Http\Requests\StorePolicyRequest;
use App\Http\Requests\UpdatePolicyRequest;
use App\Models\Policy;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PolicyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('policy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policies = Policy::all();

        return view('frontend.policies.index', compact('policies'));
    }

    public function create()
    {
        abort_if(Gate::denies('policy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.policies.create');
    }

    public function store(StorePolicyRequest $request)
    {
        $policy = Policy::create($request->all());

        return redirect()->route('frontend.policies.index');
    }

    public function edit(Policy $policy)
    {
        abort_if(Gate::denies('policy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.policies.edit', compact('policy'));
    }

    public function update(UpdatePolicyRequest $request, Policy $policy)
    {
        $policy->update($request->all());

        return redirect()->route('frontend.policies.index');
    }

    public function show(Policy $policy)
    {
        abort_if(Gate::denies('policy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policy->load('policyCirculars');

        return view('frontend.policies.show', compact('policy'));
    }

    public function destroy(Policy $policy)
    {
        abort_if(Gate::denies('policy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $policy->delete();

        return back();
    }

    public function massDestroy(MassDestroyPolicyRequest $request)
    {
        Policy::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
