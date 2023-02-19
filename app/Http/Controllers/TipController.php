<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\Http\Request;
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
        $this->authorize('view-any', Tip::class);

        $search = $request->get('search', '');

        $tips = Tip::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.tips.index', compact('tips', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Tip::class);

        return view('app.tips.create');
    }

    /**
     * @param \App\Http\Requests\TipStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipStoreRequest $request)
    {
        $this->authorize('create', Tip::class);

        $validated = $request->validated();
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $tip = Tip::create($validated);

        return redirect()
            ->route('tips.edit', $tip)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tip $tip
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Tip $tip)
    {
        $this->authorize('view', $tip);

        return view('app.tips.show', compact('tip'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tip $tip
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Tip $tip)
    {
        $this->authorize('update', $tip);

        return view('app.tips.edit', compact('tip'));
    }

    /**
     * @param \App\Http\Requests\TipUpdateRequest $request
     * @param \App\Models\Tip $tip
     * @return \Illuminate\Http\Response
     */
    public function update(TipUpdateRequest $request, Tip $tip)
    {
        $this->authorize('update', $tip);

        $validated = $request->validated();
        if ($request->hasFile('file')) {
            if ($tip->file) {
                Storage::delete($tip->file);
            }

            $validated['file'] = $request->file('file')->store('public');
        }

        $tip->update($validated);

        return redirect()
            ->route('tips.edit', $tip)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tip $tip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Tip $tip)
    {
        $this->authorize('delete', $tip);

        if ($tip->file) {
            Storage::delete($tip->file);
        }

        $tip->delete();

        return redirect()
            ->route('tips.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
