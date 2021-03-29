<?php

namespace App\Http\Controllers;

use App\Http\Requests\NutrientStoreRequest;
use App\Http\Requests\NutrientUpdateRequest;
use App\Http\Resources\NutrientResource;
use App\Models\Nutrient;
use Illuminate\Http\Request;

class NutrientController extends Controller
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
        $this->authorize('view-any-nutrient');
        if ($request->expectsJson()) {
            $nutrients = Nutrient::query()->latest()
                ->get();
            return (NutrientResource::collection($nutrients))->response();
        } else {
            return view('nutrients.index');
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
        $this->authorize('create-nutrient');
        return view('nutrients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  NutrientStoreRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|object
     */
    public function store(NutrientStoreRequest $request)
    {
        $data = $request->validated();
        $nutrient = new Nutrient();
        foreach ($data as $key => $value) {
            $nutrient->{$key} = $value;
        }
        $nutrient->save();
        if ($request->expectsJson()) {
            return (new NutrientResource($nutrient))->response()
                ->setStatusCode(201);
        } else {
            return back()->with('nutrient', $nutrient)
                ->with('status', 'Nutrient '.$nutrient->name.' has been created!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  Nutrient  $nutrient
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Nutrient $nutrient)
    {
        $this->authorize('view-nutrient', $nutrient);
        return view('nutrients.show')->with('nutrient', $nutrient);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Nutrient  $nutrient
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Nutrient $nutrient)
    {
        $this->authorize('update-nutrient', $nutrient);
        return view('nutrients.edit')->with('nutrient', $nutrient);

    }

    /**
     * @param  NutrientUpdateRequest  $request
     * @param  Nutrient  $nutrient
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(NutrientUpdateRequest $request, Nutrient $nutrient)
    {
        $data = $request->validated();
        foreach ($data as $key => $value) {
            $nutrient->{$key} = $value;
        }
        $nutrient->save();
        if ($request->expectsJson()) {
            return (new NutrientResource($nutrient))->response();
        } else {
            return back()->with('nutrient', $nutrient)
                ->with('status', 'Nutrient '.$nutrient->name.' has been updated!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Nutrient  $nutrient
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Nutrient $nutrient)
    {
        $this->authorize('delete-nutrient', $nutrient);
        $nutrient->delete();
        return response()->noContent();
    }
}
