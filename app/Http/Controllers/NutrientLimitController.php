<?php

namespace App\Http\Controllers;

use App\Http\Requests\NutrientLimitStoreRequest;
use App\Http\Requests\NutrientLimitUpdateRequest;
use App\Http\Resources\NutrientLimitResource;
use App\Models\Nutrient;
use App\Models\NutrientLimit;
use Illuminate\Http\Request;

class NutrientLimitController extends Controller
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
        $this->authorize('view-any-nutrient-limit');
        if ($request->expectsJson()) {
            $nutrient_limits = NutrientLimit::query()->with('nutrient')
                ->latest()
                ->get();
            return (NutrientLimitResource::collection($nutrient_limits))->response();
        } else {
            return view('nutrient_limits.index');
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
        $this->authorize('create-nutrient-limit');
        $nutrients = Nutrient::all();
        return view('nutrient_limits.create')->with('nutrients', $nutrients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  NutrientLimitStoreRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|object
     */
    public function store(NutrientLimitStoreRequest $request)
    {
        $data = $request->validated();
        $nutrient_limit = new NutrientLimit();
        foreach ($data as $key => $value) {
            $nutrient_limit->{$key} = $value;
        }
        $nutrient_limit->save();
        $nutrient_limit->load('nutrient');

        if ($request->expectsJson()) {
            return (new NutrientLimitResource($nutrient_limit))->response()
                ->setStatusCode(201);
        } else {
            return back()->with('nutrient_limit', $nutrient_limit)
                ->with('status', 'Nutrient Limit '.$nutrient_limit->name
                    .' has been created!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  NutrientLimit  $nutrientLimit
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(NutrientLimit $nutrientLimit)
    {
        $this->authorize('view-nutrient-limit', $nutrientLimit);
        $nutrientLimit->load('nutrient');
        $nutrients = Nutrient::all();
        return view('nutrient_limits.show')
            ->with('nutrient_limit', $nutrientLimit)
            ->with('nutrients', $nutrients);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  NutrientLimit  $nutrientLimit
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(NutrientLimit $nutrientLimit)
    {
        $this->authorize('update-nutrient-limit', $nutrientLimit);
        $nutrientLimit->load('nutrient');
        $nutrients = Nutrient::all();
        return view('nutrient_limits.edit')
            ->with('nutrient_limit', $nutrientLimit)
            ->with('nutrients', $nutrients);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  NutrientLimitUpdateRequest  $request
     * @param  NutrientLimit  $nutrient_limit
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(NutrientLimitUpdateRequest $request, NutrientLimit $nutrient_limit)
    {
        $data = $request->validated();
        foreach ($data as $key => $value) {
            $nutrient_limit->{$key} = $value;
        }
        $nutrient_limit->save();
        $nutrient_limit->load('nutrient');
        if ($request->expectsJson()) {
            return (new NutrientLimitResource($nutrient_limit))->response();
        } else {
            return back()->with('nutrient_limit', $nutrient_limit)
                ->with('status', 'Nutrient Limit '.$nutrient_limit->name
                    .' has been updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NutrientLimit  $nutrientLimit
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(NutrientLimit $nutrientLimit)
    {
        $this->authorize('delete-nutrient-limit', $nutrientLimit);
        $nutrientLimit->delete();
        return response()->noContent();
    }
}
