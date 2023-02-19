<?php

namespace App\Http\Controllers;

use App\Models\Beekeeper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\BeekeeperStoreRequest;
use App\Http\Requests\BeekeeperUpdateRequest;

class BeekeeperController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Beekeeper::class);

        $search = $request->get('search', '');

        $beekeepers = Beekeeper::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.beekeepers.index', compact('beekeepers', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Beekeeper::class);

        return view('app.beekeepers.create');
    }

    /**
     * @param \App\Http\Requests\BeekeeperStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BeekeeperStoreRequest $request)
    {
        $this->authorize('create', Beekeeper::class);

        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $beekeeper = Beekeeper::create($validated);

        return redirect()
            ->route('beekeepers.edit', $beekeeper)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Beekeeper $beekeeper
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Beekeeper $beekeeper)
    {
        $this->authorize('view', $beekeeper);

        return view('app.beekeepers.show', compact('beekeeper'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Beekeeper $beekeeper
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Beekeeper $beekeeper)
    {
        $this->authorize('update', $beekeeper);

        return view('app.beekeepers.edit', compact('beekeeper'));
    }

    /**
     * @param \App\Http\Requests\BeekeeperUpdateRequest $request
     * @param \App\Models\Beekeeper $beekeeper
     * @return \Illuminate\Http\Response
     */
    public function update(
        BeekeeperUpdateRequest $request,
        Beekeeper $beekeeper
    ) {
        $this->authorize('update', $beekeeper);

        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $beekeeper->update($validated);

        return redirect()
            ->route('beekeepers.edit', $beekeeper)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Beekeeper $beekeeper
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Beekeeper $beekeeper)
    {
        $this->authorize('delete', $beekeeper);

        $beekeeper->delete();

        return redirect()
            ->route('beekeepers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
