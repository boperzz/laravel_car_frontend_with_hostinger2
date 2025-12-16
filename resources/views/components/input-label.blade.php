@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-slate-700 dark:text-slate-300 mb-2']) }}>
    {{ $value ?? $slot }}
</label>
