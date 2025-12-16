@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 py-2 border-b-2 border-indigo-500 text-sm font-semibold leading-5 text-indigo-600 dark:text-indigo-400 focus:outline-none focus:border-indigo-700 dark:focus:border-indigo-300 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-4 py-2 border-b-2 border-transparent text-sm font-medium leading-5 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200 hover:border-slate-300 dark:hover:border-slate-600 focus:outline-none focus:text-slate-900 dark:focus:text-slate-200 focus:border-slate-300 dark:focus:border-slate-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
