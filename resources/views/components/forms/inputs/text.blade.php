{{-- Text input field --}}

@props(['type' => 'text', 'name', 'placeholder'])

<div class="input-field text @error($name) has-errors @enderror">
    <input type="{{ $type }}" 
           id="{{ $name }}" 
           name="{{ $name }}" 
           value="{{ old($name) }}" 
           placeholder=""
           {{ $attributes }}
    >
    <label for="{{ $name }}">{{ $placeholder }}</label>
    <ul class="errors">
        @error($name)
            <li>{{ $message }}</li>
        @enderror
    </ul>
</div>
