<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.hives.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('hives.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.hives.inputs.number')
                        </h5>
                        <span>{{ $hive->number ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.hives.inputs.total_bees')
                        </h5>
                        <span>{{ $hive->total_bees ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.hives.inputs.present_bees')
                        </h5>
                        <span>{{ $hive->present_bees ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.hives.inputs.infected_bees')
                        </h5>
                        <span>{{ $hive->infected_bees ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.hives.inputs.tempreture')
                        </h5>
                        <span>{{ $hive->tempreture ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.hives.inputs.humidity')
                        </h5>
                        <span>{{ $hive->humidity ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.hives.inputs.status')
                        </h5>
                        <span>{{ $hive->status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.hives.inputs.beekeeper_id')
                        </h5>
                        <span
                            >{{ optional($hive->beekeeper)->name ?? '-' }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('hives.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Hive::class)
                    <a href="{{ route('hives.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>

            @can('view-any', App\Models\Notification::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Notifications </x-slot>

                <livewire:hive-notifications-detail :hive="$hive" />
            </x-partials.card>
            @endcan @can('view-any', App\Models\History::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Histories </x-slot>

                <livewire:hive-histories-detail :hive="$hive" />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
