<div>
    <x-interface.menu-item active="{{ request()->routeIs('dashboard') }}" href="{{ route('dashboard') }}"
                           icon="layout">Dashboard
    </x-interface.menu-item>

    @if(\Illuminate\Support\Facades\Auth::user()->hasPermissionTo('qsa.has') || \Illuminate\Support\Facades\Session::exists('award_user'))
        <x-interface.menu-item active="{{ request()->routeIs('award.*') }}" href="{{ route('award.show') }}"
                               icon="award">
            @if(\Illuminate\Support\Facades\Session::exists('award_user') && \Illuminate\Support\Facades\Session::get('award_user') !== \Illuminate\Support\Facades\Auth::id()) {{ \App\Facades\Str::namePlural(\App\Models\User::find(Session('award_user'))->first_name) }} @else
                Your @endif Award
        </x-interface.menu-item>
        @if(request()->routeIs('award.*'))
            <x-interface.main-menu-sub-menu>
                <x-interface.sub-menu-item active="{{ request()->routeIs('award.membership') }}"
                                           href="{{ route('award.membership') }}">
                    Membership
                </x-interface.sub-menu-item>
                <x-interface.sub-menu-item active="{{ request()->routeIs('award.nights-away') }}"
                                           href="{{ route('award.nights-away') }}">
                    Nights Away
                </x-interface.sub-menu-item>
                <x-interface.sub-menu-item active="{{ request()->routeIs('award.icv-list') }}"
                                           href="{{ route('award.icv-list') }}">
                    ICV List
                </x-interface.sub-menu-item>
                <x-interface.sub-menu-item active="{{ request()->routeIs('award.dofe') }}"
                                           href="{{ route('award.dofe') }}">
                    DofE
                </x-interface.sub-menu-item>
                <x-interface.sub-menu-item active="{{ request()->routeIs('award.challenges') }}"
                                           href="{{ route('award.challenges') }}">
                    Challenges
                </x-interface.sub-menu-item>
                <x-interface.sub-menu-item active="{{ request()->routeIs('award.presentation') }}"
                                           href="{{ route('award.presentation') }}">
                    Presentation
                </x-interface.sub-menu-item>
                <x-interface.sub-menu-item active="{{ request()->routeIs('award.sign-off') }}"
                                           href="{{ route('award.sign-off') }}">
                    Sign Off
                </x-interface.sub-menu-item>
            </x-interface.main-menu-sub-menu>
        @endif
    @endcan

    @if(Auth::user()->hasDistrictAccess())
        <x-interface.menu-item active="{{ request()->routeIs('my-participants.*') }}"
                               href="{{ route('my-participants.show') }}" icon="users">My Participants
        </x-interface.menu-item>
    @endcan

    @can('admin_centre.access')
        <x-interface.menu-item active="{{ request()->routeIs('admin-centre.*') }}"
                               href="{{ route('admin-centre.show') }}"
                               icon="grid">
            Admin Centre
        </x-interface.menu-item>
        @if(request()->routeIs('admin-centre.*'))
            <x-interface.main-menu-sub-menu>
                <x-interface.sub-menu-item active="{{ request()->routeIs('admin-centre.accounts') }}"
                                           href="{{ route('admin-centre.accounts') }}">
                    Accounts
                </x-interface.sub-menu-item>
                <x-interface.sub-menu-item active="{{ request()->routeIs('admin-centre.districts') }}"
                                           href="{{ route('admin-centre.districts') }}">
                    Districts
                </x-interface.sub-menu-item>
                <x-interface.sub-menu-item active="{{ request()->routeIs('admin-centre.clusters') }}"
                                           href="{{ route('admin-centre.clusters') }}">
                    Clusters
                </x-interface.sub-menu-item>
                <x-interface.sub-menu-item active="{{ request()->routeIs('admin-centre.changelog') }}"
                                           href="{{ route('admin-centre.changelog') }}">
                    Changelog
                </x-interface.sub-menu-item>
                <x-interface.sub-menu-item active="{{ request()->routeIs('admin-centre.permissions') }}"
                                           href="{{ route('admin-centre.permissions') }}">
                    Permissions
                </x-interface.sub-menu-item>
                <x-interface.sub-menu-item active="{{ request()->routeIs('admin-centre.roles') }}"
                                           href="{{ route('admin-centre.roles') }}">
                    Roles
                </x-interface.sub-menu-item>
            </x-interface.main-menu-sub-menu>
        @endif
    @endcan
</div>
