<?php

namespace App\Http\Livewire;

use App\Models\Hive;
use Livewire\Component;
use App\Models\History;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HiveHistoriesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Hive $hive;
    public History $history;
    public $historyDate;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New History';

    protected $rules = [
        'history.action' => ['required', 'in:spray,sound,manual'],
        'historyDate' => ['required', 'date'],
    ];

    public function mount(Hive $hive)
    {
        $this->hive = $hive;
        $this->resetHistoryData();
    }

    public function resetHistoryData()
    {
        $this->history = new History();

        $this->historyDate = null;
        $this->history->action = 'spray';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newHistory()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.hive_histories.new_title');
        $this->resetHistoryData();

        $this->showModal();
    }

    public function editHistory(History $history)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.hive_histories.edit_title');
        $this->history = $history;

        $this->historyDate = $this->history->date->format('Y-m-d');

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

        if (!$this->history->hive_id) {
            $this->authorize('create', History::class);

            $this->history->hive_id = $this->hive->id;
        } else {
            $this->authorize('update', $this->history);
        }

        $this->history->date = \Carbon\Carbon::parse($this->historyDate);

        $this->history->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', History::class);

        History::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetHistoryData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->hive->histories as $history) {
            array_push($this->selected, $history->id);
        }
    }

    public function render()
    {
        return view('livewire.hive-histories-detail', [
            'histories' => $this->hive->histories()->paginate(20),
        ]);
    }
}
