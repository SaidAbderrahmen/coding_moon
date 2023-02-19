@php $editing = isset($notification) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="event" label="Event">
            @php $selected = old('event', ($editing ? $notification->event : '')) @endphp
            <option value="infected bee" {{ $selected == 'infected bee' ? 'selected' : '' }} >Infected bee</option>
            <option value="hornet detected" {{ $selected == 'hornet detected' ? 'selected' : '' }} >Hornet detected</option>
            <option value="temperature change" {{ $selected == 'temperature change' ? 'selected' : '' }} >Temperature change</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="details" label="Details" required
            >{{ old('details', ($editing ? $notification->details : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="hive_id" label="Hive" required>
            @php $selected = old('hive_id', ($editing ? $notification->hive_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Hive</option>
            @foreach($hives as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($notification->date)->format('Y-m-d') : '')) }}"
            required
        ></x-inputs.date>
    </x-inputs.group>
</div>
