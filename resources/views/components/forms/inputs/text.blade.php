{{-- Text input field --}}

@props(['name', 'placeholder'])

<div class="input-field text @error($name) has-errors @enderror">
    <input type="text" 
           id="{{ $name }}" 
           name="{{ $name }}" 
           value="{{ old($name) }}" 
           {{ $attributes }}
    >
    <label for="{{ $name }}">{{ $placeholder }}</label>
    <ul class="errors">
        @error($name)
            <li>{{ $message }}</li>
        @enderror
    </ul>
</div>
