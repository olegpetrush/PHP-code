<?php

namespace App\Http\Controllers;

use App\Http\Requests\NutrientRdaStoreRequest;
use App\Http\Requests\NutrientRdaUpdateRequest;
use App\Http\Resources\NutrientRdaResource;
use App\Models\Nutrient;
use App\Models\NutrientRda;
use Illuminate\Http\Request;

class NutrientRdaController extends Controller
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
        $this->authorize('view-any-nutrient-rda');
        if ($request->expectsJson()) {
            $nutrient_rdas = NutrientRda::query()->with('nutrient')->latest()
                ->get();
            return (NutrientRdaResource::collection($nutrient_rdas))->response();
        } else {
            return view('nutrient_rdas.index');
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
        $this->authorize('create-nutrient-rda');
        $nutrients = Nutrient::all();
        return view('nutrient_rdas.create')->with('nutrients', $nutrients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  NutrientRdaStoreRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|object
     */
    public function store(NutrientRdaStoreRequest $request)
    {
        $data = $request->validated();
        $nutrient_rda = new NutrientRda();
        foreach ($data as $key => $value) {
            $nutrient_rda->{$key} = $value;
        }
        $nutrient_rda->save();
        $nutrient_rda->load('nutrient');

        if ($request->expectsJson()) {
            return (new NutrientRdaResource($nutrient_rda))->response()
                ->setStatusCode(201);
        } else {
            return back()->with('nutrient_rda', $nutrient_rda)
                ->with('status', 'Nutrient Rda '.$nutrient_rda->id
                    .' has been created!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  NutrientRda  $nutrientRda
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(NutrientRda $nutrientRda)
    {
        $this->authorize('view-nutrient-rda', $nutrientRda);
        $nutrientRda->load('nutrient');
        $nutrients = Nutrient::all();
        return view('nutrient_rdas.show')
            ->with('nutrient_rda', $nutrientRda)
            ->with('nutrients', $nutrients);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  NutrientRda  $nutrientRda
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(NutrientRda $nutrientRda)
    {
        $this->authorize('update-nutrient-rda', $nutrientRda);
        $nutrientRda->load('nutrient');
        $nutrients = Nutrient::all();
        return view('nutrient_rdas.edit')
            ->with('nutrient_rda', $nutrientRda)
            ->with('nutrients', $nutrients);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  NutrientRdaUpdateRequest  $request
     * @param  NutrientRda  $nutrient_rda
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(
        NutrientRdaUpdateRequest $request,
        NutrientRda $nutrient_rda
    ) {
        $data = $request->validated();
        foreach ($data as $key => $value) {
            $nutrient_rda->{$key} = $value;
        }
        $nutrient_rda->save();
        $nutrient_rda->load('nutrient');
        if ($request->expectsJson()) {
            return (new NutrientRdaResource($nutrient_rda))->response();
        } else {
            return back()->with('nutrient_rda', $nutrient_rda)
                ->with('status', 'Nutrient Rda '.$nutrient_rda->id
                    .' has been updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NutrientRda  $nutrientRda
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(NutrientRda $nutrientRda)
    {
        $this->authorize('delete-nutrient-rda', $nutrientRda);
        $nutrientRda->delete();
        return response()->noContent();
    }
}
