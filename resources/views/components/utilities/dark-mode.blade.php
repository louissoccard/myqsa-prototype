<script>
    @auth
    window.darkMode.update('{{ auth()->user()->preferences->dark_mode }}');
    @else
    window.darkMode.update('auto');
    @endauth
</script>
