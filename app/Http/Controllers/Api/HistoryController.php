<?php

namespace App\Http\Controllers\Api;

use App\Models\History;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HistoryResource;
use App\Http\Resources\HistoryCollection;
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
        //$this->authorize('view-any', History::class);

        $search = $request->get('search', '');

        $histories = History::search($search)
            ->latest()
            ->paginate();

        return new HistoryCollection($histories);
    }

    /**
     * @param \App\Http\Requests\HistoryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(HistoryStoreRequest $request)
    {
        //$this->authorize('create', History::class);

        $validated = $request->validated();

        $history = History::create($validated);

        return new HistoryResource($history);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\History $history
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, History $history)
    {
        //$this->authorize('view', $history);

        return new HistoryResource($history);
    }

    /**
     * @param \App\Http\Requests\HistoryUpdateRequest $request
     * @param \App\Models\History $history
     * @return \Illuminate\Http\Response
     */
    public function update(HistoryUpdateRequest $request, History $history)
    {
        //$this->authorize('update', $history);

        $validated = $request->validated();

        $history->update($validated);

        return new HistoryResource($history);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\History $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, History $history)
    {
        //$this->authorize('delete', $history);

        $history->delete();

        return response()->noContent();
    }
}
