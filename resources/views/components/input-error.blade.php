@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'mt-2 text-sm text-red-600 dark:text-red-400 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ $message }}
            </li>
        @endforeach
    </ul>
@endif
