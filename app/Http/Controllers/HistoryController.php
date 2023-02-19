<?php

namespace App\Http\Controllers;

use App\Models\Hive;
use App\Models\History;
use Illuminate\Http\Request;
use App\Http\Requests\HistoryStoreRequest;
use App\Http\Requests\HistoryUpdateRequest;

class HistoryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', History::class);

        $search = $request->get('search', '');

        $histories = History::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.histories.index', compact('histories', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', History::class);

        $hives = Hive::pluck('tempreture', 'id');

        return view('app.histories.create', compact('hives'));
    }

    /**
     * @param \App\Http\Requests\HistoryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(HistoryStoreRequest $request)
    {
        $this->authorize('create', History::class);

        $validated = $request->validated();

        $history = History::create($validated);

        return redirect()
            ->route('histories.edit', $history)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\History $history
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, History $history)
    {
        $this->authorize('view', $history);

        return view('app.histories.show', compact('history'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\History $history
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, History $history)
    {
        $this->authorize('update', $history);

        $hives = Hive::pluck('tempreture', 'id');

        return view('app.histories.edit', compact('history', 'hives'));
    }

    /**
     * @param \App\Http\Requests\HistoryUpdateRequest $request
     * @param \App\Models\History $history
     * @return \Illuminate\Http\Response
     */
    public function update(HistoryUpdateRequest $request, History $history)
    {
        $this->authorize('update', $history);

        $validated = $request->validated();

        $history->update($validated);

        return redirect()
            ->route('histories.edit', $history)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\History $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, History $history)
    {
        $this->authorize('delete', $history);

        $history->delete();

        return redirect()
            ->route('histories.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
