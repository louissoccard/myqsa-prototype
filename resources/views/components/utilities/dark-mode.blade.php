<script>
    let darkModeValue = localStorage.getItem('darkMode');

    if (darkModeValue === null) {
        @auth
        window.darkMode.update('{{ auth()->user()->preferences->dark_mode }}');
        @else
        window.darkMode.update('auto');
        @endauth
    } else {
        window.darkMode.update(JSON.parse(darkModeValue) ? 'dark' : 'light');
    }
</script>
