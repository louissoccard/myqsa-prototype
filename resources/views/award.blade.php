<x-app-layout>
    <x-slot name="title">Award</x-slot>

    @if($user->isNot(Auth::user()))
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
