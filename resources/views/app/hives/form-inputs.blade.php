@php $editing = isset($hive) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.number
            name="number"
            label="Number"
            :value="old('number', ($editing ? $hive->number : ''))"
            max="255"
            placeholder="Number"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="total_bees"
            label="Total Bees"
            :value="old('total_bees', ($editing ? $hive->total_bees : ''))"
            max="255"
            placeholder="Total Bees"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="present_bees"
            label="Present Bees"
            :value="old('present_bees', ($editing ? $hive->present_bees : ''))"
            max="255"
            placeholder="Present Bees"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="infected_bees"
            label="Infected Bees"
            :value="old('infected_bees', ($editing ? $hive->infected_bees : ''))"
            max="255"
            placeholder="Infected Bees"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="tempreture"
            label="Tempreture"
            :value="old('tempreture', ($editing ? $hive->tempreture : ''))"
            maxlength="255"
            placeholder="Tempreture"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="humidity"
            label="Humidity"
            :value="old('humidity', ($editing ? $hive->humidity : ''))"
            maxlength="255"
            placeholder="Humidity"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $hive->status : 'working')) @endphp
            <option value="working" {{ $selected == 'working' ? 'selected' : '' }} >Working</option>
            <option value="down" {{ $selected == 'down' ? 'selected' : '' }} >Down</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="beekeeper_id" label="Beekeeper" required>
            @php $selected = old('beekeeper_id', ($editing ? $hive->beekeeper_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Beekeeper</option>
            @foreach($beekeepers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
