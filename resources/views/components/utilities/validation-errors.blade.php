@if ($errors->any())
    <div {{ $attributes }}>
        <div class="bg-red text-white px-4 py-2">
            <h1 class="text-base font-bold">A problem has occurred</h1>
            <ul class="mt-1 list-none list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
