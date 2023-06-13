@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #cccccc;']) !!}>
