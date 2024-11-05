@props(['name', 'type' => 'text', 'label' => null, 'placeholder' => '', 'value' => '', 'required' => false])

<div class="form-group">
    @if($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        placeholder="{{ $placeholder }}" 
        value="{{ old($name, $value) }}" 
        {{ $required ? 'required' : '' }} 
        {{ $attributes->merge(['class' => 'form-control ' . ($attributes->get('class') ?? '')]) }}
    />
</div>


@props(['name', 'label' => null, 'placeholder' => '', 'value' => '', 'required' => false])

<div class="form-group">
    @if($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <textarea 
        name="{{ $name }}" 
        id="{{ $name }}" 
        placeholder="{{ $placeholder }}" 
        {{ $required ? 'required' : '' }} 
        {{ $attributes->merge(['class' => 'form-control ' . ($attributes->get('class') ?? '')]) }}
    >{{ old($name, $value) }}</textarea>
</div>



<form action="/submit-form" method="POST">
    @csrf

    <x-input 
        name="username" 
        label="Username" 
        placeholder="Enter your username" 
        required 
        class="custom-class"
    />

    <x-textarea 
        name="bio" 
        label="Bio" 
        placeholder="Tell us about yourself" 
        required 
        class="custom-textarea-class"
    />

    <button type="submit" class="btn btn-primary">Submit</button>
</form>