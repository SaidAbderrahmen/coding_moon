<?php

namespace App\Http\Livewire;

use App\Models\Hive;
use Livewire\Component;
use App\Models\Beekeeper;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BeekeeperHivesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Beekeeper $beekeeper;
    public Hive $hive;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Hive';

    protected $rules = [
        'hive.number' => ['required', 'numeric'],
        'hive.total_bees' => ['required', 'numeric'],
        'hive.present_bees' => ['required', 'numeric'],
        'hive.infected_bees' => ['required', 'numeric'],
        'hive.tempreture' => ['required', 'string'],
        'hive.humidity' => ['required', 'string'],
        'hive.status' => ['required', 'in:working,down'],
    ];

    public function mount(Beekeeper $beekeeper)
    {
        $this->beekeeper = $beekeeper;
        $this->resetHiveData();
    }

    public function resetHiveData()
    {
        $this->hive = new Hive();

        $this->hive->status = 'working';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newHive()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.beekeeper_hives.new_title');
        $this->resetHiveData();

        $this->showModal();
    }

    public function editHive(Hive $hive)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.beekeeper_hives.edit_title');
        $this->hive = $hive;

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

        if (!$this->hive->beekeeper_id) {
            $this->authorize('create', Hive::class);

            $this->hive->beekeeper_id = $this->beekeeper->id;
        } else {
            $this->authorize('update', $this->hive);
        }

        $this->hive->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Hive::class);

        Hive::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetHiveData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->beekeeper->hives as $hive) {
            array_push($this->selected, $hive->id);
        }
    }

    public function render()
    {
        return view('livewire.beekeeper-hives-detail', [
            'hives' => $this->beekeeper->hives()->paginate(20),
        ]);
    }
}
