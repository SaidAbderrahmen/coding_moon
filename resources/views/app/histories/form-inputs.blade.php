@php $editing = isset($history) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="action" label="Action">
            @php $selected = old('action', ($editing ? $history->action : '')) @endphp
            <option value="spray" {{ $selected == 'spray' ? 'selected' : '' }} >Spray</option>
            <option value="sound" {{ $selected == 'sound' ? 'selected' : '' }} >Sound</option>
            <option value="manual" {{ $selected == 'manual' ? 'selected' : '' }} >Manual</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="hive_id" label="Hive" required>
            @php $selected = old('hive_id', ($editing ? $history->hive_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Hive</option>
            @foreach($hives as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($history->date)->format('Y-m-d\TH:i:s') : '')) }}"
            required
        ></x-inputs.datetime>
    </x-inputs.group>
</div>
