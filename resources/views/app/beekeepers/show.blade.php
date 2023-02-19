<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.beekeepers.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('beekeepers.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.beekeepers.inputs.name')
                        </h5>
                        <span>{{ $beekeeper->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.beekeepers.inputs.email')
                        </h5>
                        <span>{{ $beekeeper->email ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.beekeepers.inputs.phone_number')
                        </h5>
                        <span>{{ $beekeeper->phone_number ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.beekeepers.inputs.address')
                        </h5>
                        <span>{{ $beekeeper->address ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('beekeepers.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Beekeeper::class)
                    <a href="{{ route('beekeepers.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>

            @can('view-any', App\Models\Hive::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Hives </x-slot>

                <livewire:beekeeper-hives-detail :beekeeper="$beekeeper" />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
