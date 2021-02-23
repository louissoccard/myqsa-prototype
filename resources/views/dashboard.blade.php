<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <x-dashboard.welcome-message class="mb-4" firstName="{{ $user->first_name }}"></x-dashboard.welcome-message>

    <div class="mb-4">
        <x-interface.card title="Queen's Scout Award" href="{{ route('award') }}">
            <div
                class="flex flex-row flex-wrap lg:flex-nowrap justify-center items-start mt-8 lg:space-x-6">
                <x-utilities.circular-progress-bar barId="membership-progress"
                                                   data-percentage="50" containerClass="mb-6 pr-3">
                    Membership
                </x-utilities.circular-progress-bar>
                <x-utilities.circular-progress-bar barId="nights-away-progress"
                                                   data-percentage="75" containerClass="mb-6 pl-3">
                    Nights Away
                </x-utilities.circular-progress-bar>
                <x-utilities.circular-progress-bar barId="icv-progress" data-percentage="25" containerClass="pr-3">ICV
                                                                                                                   List
                </x-utilities.circular-progress-bar>
                <x-utilities.circular-progress-bar barId="dofe-progress" data-percentage="100" containerClass="pl-3">
                    DofE
                </x-utilities.circular-progress-bar>
            </div>
        </x-interface.card>
    </div>

    <div class="flex flex-col lg:flex-row lg:space-x-4 items-stretch">

        <x-dashboard.card title="Notifications" numberOfElements="6">
            <x-dashboard.list-item daysPast="0" color="blue">Nights Away Approved</x-dashboard.list-item>
            <x-dashboard.list-item daysPast="10" color="blue">ICV List Updated</x-dashboard.list-item>
            <x-dashboard.list-item daysPast="10" color="blue">ICV List Updated</x-dashboard.list-item>
            <x-dashboard.list-item daysPast="10" color="blue">ICV List Updated</x-dashboard.list-item>
            <x-dashboard.list-item daysPast="10" color="blue">ICV List Updated</x-dashboard.list-item>
            <x-dashboard.list-item daysPast="10" color="blue">ICV List Updated</x-dashboard.list-item>
        </x-dashboard.card>

        <x-dashboard.card title="Updates & Announcements" numberOfElements="3">
            <x-dashboard.list-item daysPast="0" color="red">Upcoming Maintenance</x-dashboard.list-item>
            <x-dashboard.list-item daysPast="3" color="green">ICV List Zoom Session</x-dashboard.list-item>
            <x-dashboard.list-item daysPast="15" color="green">County Kudu 2021</x-dashboard.list-item>
        </x-dashboard.card>
    </div>

</x-app-layout>
