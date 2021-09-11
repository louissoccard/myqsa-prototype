<x-app-layout>
    <x-slot name="title">Award</x-slot>

    @if($user->isNot(Auth::user()))
        <x-slot name="pageHeader">
            <div
                class="flex flex-row justify-between items-center fixed top-16 z-10 left-0 md:left-64 right-0 h-14 bg-gray-200 dark:bg-gray-700 px-6 md:px-10">
                <p class="text-lg">You are viewing {{ Str::namePlural($user->full_name) }} award record.</p>
                <a href="{{ route('award.clear') }}">
                    <x-utilities.icon>x</x-utilities.icon>
                </a>
            </div>
        </x-slot>
        <h2 class="mt-14 mb-4">Queen's Scout Award</h2>
    @else
        <h2 class="mb-4">Your Queen's Scout Award</h2>
    @endif


    <div class="flex flex-row flex-wrap">
        <x-award.card title="Membership" href="{{ route('award.membership') }}" progressId="membership-progress"
                      percentage="100"
                      class="xl:pr-2 mb-4"></x-award.card>
        <x-award.card title="Nights Away" href="{{ route('award.nights-away') }}" progressId="nights-away-progress"
                      percentage="75"
                      class="xl:pl-2 mb-4"></x-award.card>
        <x-award.card title="ICV List" href="{{ route('award.icv-list') }}" progressId="icv-progress" percentage="25"
                      class="xl:pr-2 mb-4"></x-award.card>
        <x-award.card title="DofE" href="{{ route('award.dofe') }}" progressId="dofe-progress" percentage="100"
                      class="xl:pl-2 mb-4"></x-award.card>
        <x-award.card title="Presentation" href="{{ route('award.presentation') }}"
                      class="xl:pr-2 mb-4 xl:mb-0"></x-award.card>
        <x-award.card title="Sign Off" href="{{ route('award.sign-off') }}" class="xl:pl-2"></x-award.card>
    </div>

</x-app-layout>
