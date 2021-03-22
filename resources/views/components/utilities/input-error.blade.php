@props(['for'])

@error($for)
<p {{ $attributes->merge(['class' => 'text-sm bg-red text-white px-4 py-2']) }}>{{ $message }}</p>
@enderror
