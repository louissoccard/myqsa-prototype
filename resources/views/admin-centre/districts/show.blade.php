<x-app-layout>
    <x-slot name="title">Districts - Admin</x-slot>

    <h2 class="text-2xl font-bold mb-4">
        <a href="{{ route('admin-centre.show') }}" class="hover:text-blue">Admin Centre</a>
        / <span class="font-black">Districts</span>
    </h2>

    @livewire('admin.districts.table')

</x-app-layout>

