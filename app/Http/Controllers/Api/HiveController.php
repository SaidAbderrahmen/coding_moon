<?php

namespace App\Http\Controllers\Api;

use App\Models\Hive;
use Illuminate\Http\Request;
use App\Http\Resources\HiveResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\HiveCollection;
use App\Http\Requests\HiveStoreRequest;
use App\Http\Requests\HiveUpdateRequest;

class HiveController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$this->authorize('view-any', Hive::class);

        $search = $request->get('search', '');

        $hives = Hive::search($search)
            ->latest()
            ->paginate();

        return new HiveCollection($hives);
    }

    /**
     * @param \App\Http\Requests\HiveStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(HiveStoreRequest $request)
    {
        //$this->authorize('create', Hive::class);

        $validated = $request->validated();

        $hive = Hive::create($validated);

        return new HiveResource($hive);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Hive $hive
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Hive $hive)
    {
        //$this->authorize('view', $hive);

        return new HiveResource($hive);
    }

    /**
     * @param \App\Http\Requests\HiveUpdateRequest $request
     * @param \App\Models\Hive $hive
     * @return \Illuminate\Http\Response
     */
    public function update(HiveUpdateRequest $request, Hive $hive)
    {
        //$this->authorize('update', $hive);

        $validated = $request->validated();

        $hive->update($validated);

        return new HiveResource($hive);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Hive $hive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Hive $hive)
    {
        //$this->authorize('delete', $hive);

        $hive->delete();

        return response()->noContent();
    }
}
