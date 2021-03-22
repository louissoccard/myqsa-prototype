@props(['paddingX' => '6'])

<div class="px-{{ $paddingX }} py-4 border-b border-gray-300 dark:border-gray-700">
    <h4 class="text-xl font-bold user-name">{{ Auth::user()->name }}</h4>
    <p class="text-sm user-district">{{ Auth::user()->district->name }}</p>
</div>

<x-utilities.dropdown-item paddingX="{{ $paddingX  }}" href="{{ route('profile.show') }}" icon="user">Manage Account
</x-utilities.dropdown-item>
<x-utilities.dropdown-item paddingX="{{ $paddingX  }}" href="#" icon="inbox">Feedback</x-utilities.dropdown-item>
<x-utilities.dropdown-item paddingX="{{ $paddingX  }}" onclick="window.darkMode.toggle();" icon="moon">Toggle Dark Mode
    <small class="block ml-9">For
                              Testing</small>
</x-utilities.dropdown-item>
<x-utilities.dropdown-item paddingX="{{ $paddingX  }}" href="#" icon="help-circle">Help</x-utilities.dropdown-item>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <x-utilities.dropdown-item paddingX="{{ $paddingX  }}" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); this.closest('form').submit();"
                               class="bg-red font-bold text-white hover:text-black dark:hover:text-white"
                               icon="log-out">Sign Out
    </x-utilities.dropdown-item>
</form>
