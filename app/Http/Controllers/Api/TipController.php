<?php

namespace App\Http\Controllers\Api;

use App\Models\Tip;
use Illuminate\Http\Request;
use App\Http\Resources\TipResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\TipCollection;
use App\Http\Requests\TipStoreRequest;
use App\Http\Requests\TipUpdateRequest;
use Illuminate\Support\Facades\Storage;

class TipController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$this->authorize('view-any', Tip::class);

       

        $tips = Tip::all();
        foreach ($tips as $tip) {
    $tip->description = strip_tags($tip->description);
}



        return new TipCollection($tips);
    }

    /**
     * @param \App\Http\Requests\TipStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipStoreRequest $request)
    {
        //$this->authorize('create', Tip::class);

        $validated = $request->validated();
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $tip = Tip::create($validated);

        return new TipResource($tip);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tip $tip
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Tip $tip)
    {
        //$this->authorize('view', $tip);

        return new TipResource($tip);
    }

    /**
     * @param \App\Http\Requests\TipUpdateRequest $request
     * @param \App\Models\Tip $tip
     * @return \Illuminate\Http\Response
     */
    public function update(TipUpdateRequest $request, Tip $tip)
    {
        //$this->authorize('update', $tip);

        $validated = $request->validated();

        if ($request->hasFile('file')) {
            if ($tip->file) {
                Storage::delete($tip->file);
            }

            $validated['file'] = $request->file('file')->store('public');
        }

        $tip->update($validated);

        return new TipResource($tip);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tip $tip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Tip $tip)
    {
        //$this->authorize('delete', $tip);

        if ($tip->file) {
            Storage::delete($tip->file);
        }

        $tip->delete();

        return response()->noContent();
    }
}
