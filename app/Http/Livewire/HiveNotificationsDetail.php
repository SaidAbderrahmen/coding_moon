<?php

namespace App\Http\Livewire;

use App\Models\Hive;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HiveNotificationsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Hive $hive;
    public Notification $notification;
    public $notificationDate;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Notification';

    protected $rules = [
        'notification.event' => [
            'required',
            'in:infected bee,hornet detected,temperature change',
        ],
        'notification.details' => ['required', 'string'],
        'notificationDate' => ['required', 'date'],
    ];

    public function mount(Hive $hive)
    {
        $this->hive = $hive;
        $this->resetNotificationData();
    }

    public function resetNotificationData()
    {
        $this->notification = new Notification();

        $this->notificationDate = null;
        $this->notification->event = 'infected bee';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newNotification()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.hive_notifications.new_title');
        $this->resetNotificationData();

        $this->showModal();
    }

    public function editNotification(Notification $notification)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.hive_notifications.edit_title');
        $this->notification = $notification;

        $this->notificationDate = $this->notification->date->format('Y-m-d');

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal()
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    public function save()
    {
        $this->validate();

        if (!$this->notification->hive_id) {
            $this->authorize('create', Notification::class);

            $this->notification->hive_id = $this->hive->id;
        } else {
            $this->authorize('update', $this->notification);
        }

        $this->notification->date = \Carbon\Carbon::parse(
            $this->notificationDate
        );

        $this->notification->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Notification::class);

        Notification::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetNotificationData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->hive->notifications as $notification) {
            array_push($this->selected, $notification->id);
        }
    }

    public function render()
    {
        return view('livewire.hive-notifications-detail', [
            'notifications' => $this->hive->notifications()->paginate(20),
        ]);
    }
}
