<?php

namespace App\Http\Controllers;

use App\Http\Requests\EffectStoreRequest;
use App\Http\Requests\EffectUpdateRequest;
use App\Http\Resources\EffectResource;
use App\Models\Effect;
use Illuminate\Http\Request;

class EffectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('view-any-effect');
        if ($request->expectsJson()) {
            $effects = Effect::query()->latest()
                ->get();
            return (EffectResource::collection($effects))->response();
        } else {
            return view('effects.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create-effect');
        return view('effects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EffectStoreRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|object
     */
    public function store(EffectStoreRequest $request)
    {
        $data = $request->validated();
        $effect = new Effect();
        foreach ($data as $key => $value) {
            $effect->{$key} = $value;
        }
        $effect->save();
        if ($request->expectsJson()) {
            return (new EffectResource($effect))->response()
                ->setStatusCode(201);
        } else {
            return back()->with('effect', $effect)
                ->with('status', 'Effect '.$effect->name.' has been created!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Effect  $effect
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Effect $effect)
    {
        $this->authorize('view-effect', $effect);
        return view('effects.show')->with('effect', $effect);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Effect  $effect
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Effect $effect)
    {
        $this->authorize('update-effect', $effect);
        return view('effects.edit')->with('effect', $effect);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EffectUpdateRequest  $request
     * @param  Effect  $effect
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(EffectUpdateRequest $request, Effect $effect)
    {
        $data = $request->validated();
        foreach ($data as $key => $value) {
            $effect->{$key} = $value;
        }
        $effect->save();
        if ($request->expectsJson()) {
            return (new EffectResource($effect))->response();
        } else {
            return back()->with('effect', $effect)
                ->with('status', 'Effect '.$effect->name.' has been updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Effect  $effect
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Effect $effect)
    {
        $this->authorize('delete-effect', $effect);
        $effect->delete();
        return response()->noContent();
    }
}
