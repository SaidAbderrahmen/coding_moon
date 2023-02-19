<div>
    <div>
        @can('create', App\Models\Hive::class)
        <button class="button" wire:click="newHive">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Hive::class)
        <button
            class="button button-danger"
             {{ empty($selected) ? 'disabled' : '' }} 
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="mr-1 icon ion-md-trash text-primary"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal wire:model="showingModal">
        <div class="px-6 py-4">
            <div class="text-lg font-bold">{{ $modalTitle }}</div>

            <div class="mt-5">
                <div>
                    <x-inputs.group class="w-full">
                        <x-inputs.number
                            name="hive.number"
                            label="Number"
                            wire:model="hive.number"
                            placeholder="Number"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.number
                            name="hive.total_bees"
                            label="Total Bees"
                            wire:model="hive.total_bees"
                            placeholder="Total Bees"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.number
                            name="hive.present_bees"
                            label="Present Bees"
                            wire:model="hive.present_bees"
                            placeholder="Present Bees"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.number
                            name="hive.infected_bees"
                            label="Infected Bees"
                            wire:model="hive.infected_bees"
                            placeholder="Infected Bees"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="hive.tempreture"
                            label="Tempreture"
                            wire:model="hive.tempreture"
                            placeholder="Tempreture"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="hive.humidity"
                            label="Humidity"
                            wire:model="hive.humidity"
                            placeholder="Humidity"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="hive.status"
                            label="Status"
                            wire:model="hive.status"
                        >
                            <option value="working" {{ $selected == 'working' ? 'selected' : '' }} >Working</option>
                            <option value="down" {{ $selected == 'down' ? 'selected' : '' }} >Down</option>
                        </x-inputs.select>
                    </x-inputs.group>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 flex justify-between">
            <button
                type="button"
                class="button"
                wire:click="$toggle('showingModal')"
            >
                <i class="mr-1 icon ion-md-close"></i>
                @lang('crud.common.cancel')
            </button>

            <button
                type="button"
                class="button button-primary"
                wire:click="save"
            >
                <i class="mr-1 icon ion-md-save"></i>
                @lang('crud.common.save')
            </button>
        </div>
    </x-modal>

    <div class="block w-full overflow-auto scrolling-touch mt-4">
        <table class="w-full max-w-full mb-4 bg-transparent">
            <thead class="text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left w-1">
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="px-4 py-3 text-right">
                        @lang('crud.beekeeper_hives.inputs.number')
                    </th>
                    <th class="px-4 py-3 text-right">
                        @lang('crud.beekeeper_hives.inputs.total_bees')
                    </th>
                    <th class="px-4 py-3 text-right">
                        @lang('crud.beekeeper_hives.inputs.present_bees')
                    </th>
                    <th class="px-4 py-3 text-right">
                        @lang('crud.beekeeper_hives.inputs.infected_bees')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.beekeeper_hives.inputs.tempreture')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.beekeeper_hives.inputs.humidity')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.beekeeper_hives.inputs.status')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($hives as $hive)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $hive->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $hive->number ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $hive->total_bees ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $hive->present_bees ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $hive->infected_bees ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $hive->tempreture ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $hive->humidity ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $hive->status ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $hive)
                            <button
                                type="button"
                                class="button"
                                wire:click="editHive({{ $hive->id }})"
                            >
                                <i class="icon ion-md-create"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">
                        <div class="mt-10 px-4">{{ $hives->render() }}</div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
