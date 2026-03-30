@props(['name'])
@error($name)
<p class="text-xs text-red-500 dont-semibold">{{ $message }}</p>
@enderror
