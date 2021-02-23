<x-app-layout>
    <x-slot name="title">Award</x-slot>

    @if($user !== Auth::user())
        <x-slot name="pageHeader">
            <div class="flex flex-row justify-between items-center w-full bg-grey-20 dark:bg-gray-700 p-4">
                <p class="text-lg">You are viewing {{ $user->name }}'@if(substr($user->name, -1) !== 's')s @endif award
                                   record.</p>
            </div>
        </x-slot>
        <h2 class="text-2xl font-black mb-4">Queen's Scout Award</h2>
    @else
        <h2 class="text-2xl font-black mb-4">Your Queen's Scout Award</h2>
    @endif


    <div class="flex flex-row flex-wrap">
        <x-award.card title="Membership" href="#" progressId="membership-progress" percentage="100"
                      class="xl:pr-2 mb-4"></x-award.card>
        <x-award.card title="Nights Away" href="#" progressId="nights-away-progress" percentage="75"
                      class="xl:pl-2 mb-4"></x-award.card>
        <x-award.card title="ICV List" href="#" progressId="icv-progress" percentage="25"
                      class="xl:pr-2 mb-4"></x-award.card>
        <x-award.card title="DofE" href="#" progressId="dofe-progress" percentage="100"
                      class="xl:pl-2 mb-4"></x-award.card>

        <a href="#" class="w-full">
            <div class="bg-grey-5 dark:bg-gray-800 p-4 border-2 border-transparent hover:border-blue
            transition-all duration-300 select-none cursor-pointer w-full">
                <div class="flex justify-between pb-2 mb-8 border-b border-grey-20 dark:border-grey-60">
                    <h3 class="text-xl font-bold">Presentation and Sign Off</h3>
                    <x-utilities.icon>external-link</x-utilities.icon>
                </div>
            </div>
        </a>

    </div>

</x-app-layout>
