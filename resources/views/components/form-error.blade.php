@props(['name'])
@error($name)
        <div class="text-red-500 text-s font-semibold">{{ $message }}</div>
@enderror