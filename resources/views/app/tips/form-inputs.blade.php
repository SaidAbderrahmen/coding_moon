@php $editing = isset($tip) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $tip->title : ''))"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="description" label="Description" required
            >{{ old('description', ($editing ? $tip->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.partials.label
            name="file"
            label="File"
        ></x-inputs.partials.label
        ><br />

        <input type="file" name="file" id="file" class="form-control-file" />

        @if($editing && $tip->file)
        <div class="mt-2">
            <a href="{{ \Storage::url($tip->file) }}" target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('file') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="link"
            label="Link"
            :value="old('link', ($editing ? $tip->link : ''))"
            placeholder="Link"
        ></x-inputs.text>
    </x-inputs.group>
</div>
