{{-- Checkbox button with radio style --}}

@props(['name', 'placeholder'])

<div class="input-field checkbox-radio">
    <input type="checkbox" 
            name="{{ $name }}" 
            id="{{ $name }}" 
            @checked(old($name))
    >
    <label for="{{ $name }}">{{ $placeholder }}</label>
</div>
