@props(['for'])

@error($for)
<p {{ $attributes->merge(['class' => 'text-sm bg-red text-white p-4']) }}>{{ $message }}</p>
@enderror
