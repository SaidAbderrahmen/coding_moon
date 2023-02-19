<?php

namespace App\Http\Controllers;

use App\Models\Hive;
use App\Models\Beekeeper;
use Illuminate\Http\Request;
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
        $this->authorize('view-any', Hive::class);

        $search = $request->get('search', '');

        $hives = Hive::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.hives.index', compact('hives', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Hive::class);

        $beekeepers = Beekeeper::pluck('name', 'id');

        return view('app.hives.create', compact('beekeepers'));
    }

    /**
     * @param \App\Http\Requests\HiveStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(HiveStoreRequest $request)
    {
        $this->authorize('create', Hive::class);

        $validated = $request->validated();

        $hive = Hive::create($validated);

        return redirect()
            ->route('hives.edit', $hive)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Hive $hive
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Hive $hive)
    {
        $this->authorize('view', $hive);

        return view('app.hives.show', compact('hive'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Hive $hive
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Hive $hive)
    {
        $this->authorize('update', $hive);

        $beekeepers = Beekeeper::pluck('name', 'id');

        return view('app.hives.edit', compact('hive', 'beekeepers'));
    }

    /**
     * @param \App\Http\Requests\HiveUpdateRequest $request
     * @param \App\Models\Hive $hive
     * @return \Illuminate\Http\Response
     */
    public function update(HiveUpdateRequest $request, Hive $hive)
    {
        $this->authorize('update', $hive);

        $validated = $request->validated();

        $hive->update($validated);

        return redirect()
            ->route('hives.edit', $hive)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Hive $hive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Hive $hive)
    {
        $this->authorize('delete', $hive);

        $hive->delete();

        return redirect()
            ->route('hives.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
