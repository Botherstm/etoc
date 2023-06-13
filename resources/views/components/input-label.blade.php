@props(['value'])

<label {{ $attributes->merge(['class' => 'display: block;
            margin-bottom: 5px;']) }}>
    {{ $value ?? $slot }}
</label>
