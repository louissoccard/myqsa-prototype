<x-app-layout>
    <x-slot name="title">Changelog - Admin Centre</x-slot>

    <h2 class="mb-4">Changelog</h2>

    <div class="markdown">
        @parsedown($markdown)
    </div>

</x-app-layout>

