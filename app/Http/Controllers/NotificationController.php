<?php

namespace App\Http\Controllers;

use App\Models\Hive;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Requests\NotificationStoreRequest;
use App\Http\Requests\NotificationUpdateRequest;

class NotificationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Notification::class);

        $search = $request->get('search', '');

        $notifications = Notification::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.notifications.index',
            compact('notifications', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Notification::class);

        $hives = Hive::pluck('tempreture', 'id');

        return view('app.notifications.create', compact('hives'));
    }

    /**
     * @param \App\Http\Requests\NotificationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationStoreRequest $request)
    {
        $this->authorize('create', Notification::class);

        $validated = $request->validated();

        $notification = Notification::create($validated);

        return redirect()
            ->route('notifications.edit', $notification)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Notification $notification)
    {
        $this->authorize('view', $notification);

        return view('app.notifications.show', compact('notification'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Notification $notification)
    {
        $this->authorize('update', $notification);

        $hives = Hive::pluck('tempreture', 'id');

        return view('app.notifications.edit', compact('notification', 'hives'));
    }

    /**
     * @param \App\Http\Requests\NotificationUpdateRequest $request
     * @param \App\Models\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function update(
        NotificationUpdateRequest $request,
        Notification $notification
    ) {
        $this->authorize('update', $notification);

        $validated = $request->validated();

        $notification->update($validated);

        return redirect()
            ->route('notifications.edit', $notification)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Notification $notification)
    {
        $this->authorize('delete', $notification);

        $notification->delete();

        return redirect()
            ->route('notifications.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
