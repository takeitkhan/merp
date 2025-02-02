<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {!! config('sales.name') !!}
        </h2>
    </x-slot>
    <h1>Hello World</h1>

    <p>Module: {!! config('sales.name') !!}</p>
</x-app-layout>